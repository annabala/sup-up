import React from 'react';
import SchemaTypeCondition from "./schema-type-condition";
import update from 'immutability-helper';
import {noop, uniqueId} from "lodash-es";
import {__, _n, sprintf} from '@wordpress/i18n';
import SchemaPropertySimple from "./schema-property-simple";
import Modal from "./modal";
import Button from "./button";
import schemaProperties from "./schema-properties";
import Dropdown from "./dropdown";
import classnames from 'classnames';
import $ from 'jQuery';
import SUI from 'SUI';
import Config_Values from "../es6/config-values";
import BoxSelectorModal from "./box-selector-modal";

export default class SchemaBuilder extends React.Component {
	constructor(props) {
		super(props);

		this.props = props;
		this.state = {
			initialized: false,
			types: {},
			deletingProperty: '',
			deletingPropertyId: 0,
			addingProperties: '',
			addingNestedForProperty: 0,
			addingSchemaTypes: false,
			resettingProperties: '',
			renamingType: '',
			newName: '',
			renameCallback: noop,
			renamingStoppedCallback: noop,
			deletingType: '',
			changingPropertyTypeForId: 0
		};
	}

	componentDidMount() {
		if (!this.state.initialized) {
			const schemaTypes = {};
			const savedSchemaTypes = Config_Values.get('types', 'schema_types');
			Object.keys(savedSchemaTypes).forEach((schemaTypeKey) => {
				const savedSchemaType = savedSchemaTypes[schemaTypeKey];
				const typeId = this.generateTypeId(savedSchemaType.type);
				const properties = this.cloneProperties(savedSchemaType.properties);
				const conditions = this.cloneConditions(savedSchemaType.conditions);

				schemaTypes[typeId] = Object.assign({}, savedSchemaType, {
					conditions: conditions,
					properties: properties
				});
			});

			this.setState({
				types: schemaTypes,
				initialized: true
			});
		}
	}

	formatSpec(keys, operation) {
		keys.slice().reverse().forEach(key => {
			operation = {[key]: operation};
		});

		return operation;
	}

	defaultCondition() {
		return {id: uniqueId(), lhs: 'post_type', operator: '=', rhs: 'post'};
	}

	getDefaultWooProductCondition() {
		return {id: uniqueId(), lhs: 'post_type', operator: '=', rhs: 'product'};
	}

	addGroup(typeKey) {
		const newIndex = this.getType(typeKey).conditions.length;
		const spec = this.formatSpec([typeKey, 'conditions'], {
			$splice: [
				[newIndex, 0, [this.defaultCondition()]]
			]
		});
		this.updateTypes(spec);
	}

	updateTypes(spec) {
		return new Promise(resolve => {
			this.setState({types: update(this.state.types, spec)}, () => {
				resolve();
			});
		});
	}

	addCondition(typeKey, id) {
		const type = this.getType(typeKey);
		const groupIndex = this.conditionGroupIndex(type.conditions, id);
		const conditionIndex = this.conditionIndex(type.conditions[groupIndex], id);
		const newConditionIndex = conditionIndex + 1;
		const spec = this.formatSpec(
			[typeKey, 'conditions', groupIndex],
			{
				$splice: [[newConditionIndex, 0, this.defaultCondition()]]
			}
		);

		this.updateTypes(spec);
	}

	updateCondition(typeKey, id, lhs, operator, rhs) {
		const type = this.getType(typeKey);
		const groupIndex = this.conditionGroupIndex(type.conditions, id);
		const conditionIndex = this.conditionIndex(type.conditions[groupIndex], id);
		const spec = this.formatSpec(
			[typeKey, 'conditions', groupIndex, conditionIndex],
			{
				lhs: {$set: lhs},
				operator: {$set: operator},
				rhs: {$set: rhs}
			}
		);

		this.updateTypes(spec);
	}

	deleteCondition(typeKey, id) {
		const type = this.getType(typeKey);
		const groupIndex = this.conditionGroupIndex(type.conditions, id);
		const group = type.conditions[groupIndex];
		let spec;
		if (group.length === 1) {
			spec = this.formatSpec([typeKey, 'conditions'], {
				$splice: [[groupIndex, 1]]
			});
		} else {
			const conditionIndex = this.conditionIndex(group, id);
			spec = this.formatSpec([typeKey, 'conditions', groupIndex], {
				$splice: [[conditionIndex, 1]]
			});
		}

		this.updateTypes(spec);
	}

	startAddingProperties(typeKey) {
		this.setState({
			addingProperties: typeKey,
		});
	}

	handleAddPropertiesButtonClick(typeKey, addedProperties) {
		this.addProperties(typeKey, addedProperties).then((newPropertyIds) => {
			newPropertyIds.forEach((newPropertyId) => {

				const property = this.getPropertyById(
					newPropertyId,
					this.getType(typeKey).properties
				);
				if (this.hasAltVersions(property)) {
					const activeAltVersion = this.getActiveAltVersion(property);
					this.openAccordionItemForProperty(activeAltVersion.id);
				} else {
					this.openAccordionItemForProperty(newPropertyId);
				}
			});

			this.showNotice(_n(
				'The property has been added. You need to save the changes to make them live.',
				'The properties have been added. You need to save the changes to make them live.',
				newPropertyIds.length,
				'wds'
			));
		});
		this.stopAddingProperties();
	}

	addProperties(typeKey, propertyIds) {
		const type = this.getType(typeKey);
		const newPropertyIds = [];
		let updatedProperties = type.properties,
			newPropertyId;
		propertyIds.forEach(propertyId => {
			[updatedProperties, newPropertyId] = this.addProperty(
				propertyId,
				schemaProperties[type.type],
				updatedProperties
			);
			newPropertyIds.push(...newPropertyId);
		});

		const spec = this.formatSpec([typeKey, 'properties'], {$set: updatedProperties});
		return new Promise(resolve => {
			this.updateTypes(spec).then(() => resolve(newPropertyIds));
		});
	}

	addProperty(sourcePropertyId, sourceProperties, targetProperties) {
		const newPropertyIds = [];
		let updatedProperties = targetProperties;
		Object.keys(sourceProperties).some(sourcePropertyKey => {
			const sourceProperty = sourceProperties[sourcePropertyKey];
			if (sourceProperty.id === sourcePropertyId) {
				const newProperty = this.getDefaultProperty(sourceProperty);
				updatedProperties = update(updatedProperties, {
					[sourcePropertyKey]: {$set: newProperty}
				});
				newPropertyIds.push(newProperty.id);
				return true;
			} else if (
				this.isNestedProperty(sourceProperty)
				&& targetProperties.hasOwnProperty(sourcePropertyKey)
				&& this.isNestedProperty(targetProperties[sourcePropertyKey])
			) {
				const [nestedUpdatedProperties, newNestedPropertyIds] = this.addProperty(
					sourcePropertyId,
					sourceProperty.properties,
					targetProperties[sourcePropertyKey].properties
				);
				updatedProperties = update(updatedProperties, {
					[sourcePropertyKey]: {properties: {$set: nestedUpdatedProperties}}
				});
				newPropertyIds.push(...newNestedPropertyIds);
			}
		});

		return [updatedProperties, newPropertyIds];
	}

	stopAddingProperties() {
		this.setState({
			addingProperties: '',
			addingNestedForProperty: 0,
		});
	}

	updateProperty(typeKey, id, source, value) {
		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(id, type.properties);
		const spec = this.formatSpec([typeKey, 'properties', ...propertyKeys], {
			source: {$set: source},
			value: {$set: value},
		});
		this.updateTypes(spec);
	}

	startDeletingProperty(typeKey, id) {
		this.setState({
			deletingProperty: typeKey,
			deletingPropertyId: id
		});
	}

	handleDeleteButtonClick(typeKey) {
		this.deleteProperty(typeKey, this.state.deletingPropertyId);

		this.stopDeletingProperty();
	}

	deleteProperty(typeKey, id) {
		const type = this.getType(typeKey);
		const spec = this.formatSpec([typeKey, 'properties'], {
			$set: this.deletePropertyById(id, type.properties)
		});

		this.showNotice(__('The property has been removed from this module.', 'wds'), 'info');
		this.updateTypes(spec);
	}

	deletePropertyById(id, properties) {
		let updatedProperties = properties;
		Object.keys(properties).some((propertyKey) => {
			const property = properties[propertyKey];
			if (id === property.id) {
				updatedProperties = update(updatedProperties, {
					$unset: [propertyKey]
				});
				return true;
			} else if (this.isNestedProperty(property)) {
				const updatedNestedProperties = this.deletePropertyById(id, property.properties);
				const deletedAltVersion = this.hasAltVersions(property)
					&& Object.keys(updatedNestedProperties).length !== Object.keys(property.properties).length;
				let spec;
				if (deletedAltVersion || this.objectEmpty(updatedNestedProperties)) {
					spec = {$unset: [propertyKey]};
				} else {
					spec = {[propertyKey]: {properties: {$set: updatedNestedProperties}}};
				}
				updatedProperties = update(updatedProperties, spec);
			}
		});

		return updatedProperties;
	}

	objectEmpty(obj) {
		return !this.objectLength(obj);
	}

	objectLength(obj) {
		return Object.keys(obj).length;
	}

	stopDeletingProperty() {
		this.setState({
			deletingProperty: '',
			deletingPropertyId: 0
		});
	}

	getPropertyByKeys(propertyKeys, properties) {
		let property = properties;
		propertyKeys.forEach(key => {
			property = property[key];
		});
		return property;
	}

	/**
	 * @param id
	 * @param properties
	 *
	 * @return {Array}
	 */
	propertyKeys(id, properties) {
		return this.findPropertyKeys((property) => {
			return property.hasOwnProperty('id') && property.id === id;
		}, properties);
	}

	findPropertyKeys(callback, properties) {
		let keys = [];

		Object.keys(properties).some(propertyKey => {
			if (callback(properties[propertyKey])) {
				keys.unshift(propertyKey);
				return true;
			} else if (this.isNestedProperty(properties[propertyKey])) {
				const nestedKeys = this.findPropertyKeys(callback, properties[propertyKey].properties);
				if (nestedKeys.length) {
					keys.unshift(propertyKey, 'properties', ...nestedKeys);
					return true;
				}
			}
		});

		return keys;
	}

	conditionGroupIndex(conditions, id) {
		return conditions.findIndex(conditions => this.conditionIndex(conditions, id) > -1);
	}

	conditionIndex(conditions, id) {
		return conditions.findIndex(condition => condition.id === id);
	}

	render() {
		return (
			<React.Fragment>
				{Object.keys(this.state.types).map(typeKey => {
						const type = this.getType(typeKey);
						return <React.Fragment>
							<div className={classnames(
								'sui-accordion-item',
								this.getTypeAccordionItemClassName(typeKey),
								{
									'sui-accordion-item--disabled': this.isWooCommerceProduct(type.type) && !this.isWooCommerceActive()
								}
							)}>
								{this.getTypeAccordionItemHeaderElement(typeKey)}

								<div className="sui-accordion-item-body">
									{this.getSchemaTypeRulesElement(typeKey, this.getType(typeKey).conditions)}
									{this.getPropertiesTableElement(typeKey, this.getType(typeKey).properties)}
								</div>
							</div>

							{this.state.deletingProperty === typeKey && this.getPropertyDeletionModalElement(typeKey)}
							{this.state.addingProperties === typeKey && this.getAddTypePropertyModalElement(typeKey)}
							{this.state.resettingProperties === typeKey && this.getPropertyResetModalElement(typeKey)}
							{this.state.renamingType === typeKey && this.getTypeRenameModalElement(typeKey)}
							{this.state.deletingType === typeKey && this.getTypeDeleteModalElement(typeKey)}
						</React.Fragment>;
					}
				)}

				<div className="wds-schema-types-footer">
					<button type="button"
							onClick={() => this.startAddingSchemaType()}
							className="sui-button sui-button-dashed">

						<span className="sui-icon-plus" aria-hidden="true"/>
						{__('Add New Type', 'wds')}
					</button>

					<p className="sui-description">
						{__('Add additional schema types you want to output on this site.', 'wds')}
					</p>
				</div>
				{this.state.addingSchemaTypes && this.getAddSchemaModalElement()}
				{this.getStateInput()}
				{this.getSaveSettingsFooter()}
			</React.Fragment>
		);
	}

	getPropertiesTableElement(typeKey, properties) {
		return <table className="sui-table">
			<thead>
			<tr>
				<th>{__('Property', 'wds')}</th>
				<th>{__('Source', 'wds')}</th>
				<th colSpan={2}>{__('Value', 'wds')}</th>
			</tr>
			</thead>

			<tbody>
			{this.getPropertyElements(typeKey, properties)}
			</tbody>

			<tfoot>
			<tr>
				<td colSpan={4}>
					<div>
						<span className="sui-tooltip" data-tooltip={__('Reset the properties list to default.', 'wds')}>
						<Button ghost={true}
								onClick={() => this.startResettingProperties(typeKey)}
								icon="sui-icon-refresh"
								text={__('Reset Properties', 'wds')}
						/>
						</span>

						<Button icon="sui-icon-plus"
								onClick={() => this.startAddingProperties(typeKey)}
								text={__('Add Property', 'wds')}
						/>
					</div>
				</td>
			</tr>
			</tfoot>
		</table>;
	}

	getSchemaTypeRulesElement(typeKey, conditions) {
		return <div className="wds-schema-type-rules">
			<i className="sui-icon-link" aria-hidden="true"/>
			<small>
				<strong>{__('Location', 'wds')}</strong>
			</small>
			<span className="sui-description">
				{__('Create a set of rules to determine where this schema.org type will be enabled or excluded.', 'wds')}
			</span>

			{this.getConditionGroupElements(typeKey, conditions)}

			<Button text={__('Add Rule (Or)', 'wds')}
					ghost={true}
					onClick={() => this.addGroup(typeKey)}
					icon="sui-icon-plus"/>
		</div>;
	}

	getTypeAccordionItemHeaderElement(typeKey) {
		const type = this.getType(typeKey);

		return <div className="sui-accordion-item-header">
			<div className="sui-accordion-item-title">
				<i className={this.getSchemaTypeIcon(type.type)}/>
				<span>{type.label}</span>
			</div>

			<div className="sui-accordion-col-auto">
				<Dropdown buttons={[
					<button onClick={() => this.startRenamingType(typeKey, () => this.showRenameSuccessNotice())}
							type="button">
						<i className="sui-icon-pencil" aria-hidden="true"/>
						{__('Rename', 'wds')}
					</button>,
					<button onClick={() => this.startDeletingType(typeKey)}
							type="button">
						<i className="sui-icon-trash" aria-hidden="true"/>
						{__('Delete', 'wds')}
					</button>,
				]}/>

				<button className="sui-button-icon sui-accordion-open-indicator"
						type="button"
						aria-label={__('Open item', 'wds')}>
					<i className="sui-icon-chevron-down" aria-hidden="true"/>
				</button>
			</div>
		</div>;
	}

	getPropertyDeletionModalElement(typeKey) {
		return <Modal small={true}
					  id="wds-confirm-property-deletion"
					  title={__('Are you sure?', 'wds')}
					  onClose={() => this.stopDeletingProperty()}
					  focusAfterOpen="wds-schema-property-delete-button"
					  description={__('Are you sure you wish to delete this property? You can add it again anytime.', 'wds')}>

			<Button text={__('Cancel', 'wds')}
					onClick={() => this.stopDeletingProperty()}
					ghost={true}
			/>

			<Button text={__('Delete', 'wds')}
					onClick={() => this.handleDeleteButtonClick(typeKey)}
					icon="sui-icon-trash"
					color="red"
					id="wds-schema-property-delete-button"
			/>
		</Modal>;
	}

	getAddTypePropertyModalElement(typeKey) {
		const type = this.getType(typeKey);
		const options = this.preparePropertySelectorOptions(type.properties, schemaProperties[type.type]);

		return this.getAddPropertyModalElement(typeKey, options, sprintf(
			__('Choose the properties to insert into your %s type module.', 'wds'),
			type.label
		));
	}

	getAddNestedPropertyModalElement(typeKey, propertyId) {
		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(propertyId, type.properties);
		const targetProperty = this.getPropertyByKeys(propertyKeys, type.properties);
		const sourceProperty = this.getPropertyByKeys(propertyKeys, schemaProperties[type.type]);
		const options = this.preparePropertySelectorOptions(targetProperty.properties, sourceProperty.properties);

		return this.getAddPropertyModalElement(typeKey, options, sprintf(
			__('Choose the properties to insert into the %s section of your %s schema.', 'wds'),
			sourceProperty.label,
			type.label
		));
	}

	getAddPropertyModalElement(typeKey, options, description) {
		return <BoxSelectorModal
			id="wds-add-property"
			title={__('Add Properties', 'wds')}
			description={description}
			actionButtonText={__('Add', 'wds')}
			actionButtonIcon="sui-icon-plus"
			onClose={() => this.stopAddingProperties()}
			onAction={(propertyIds) => this.handleAddPropertiesButtonClick(typeKey, propertyIds)}
			options={options}
			noOptionsMessage={
				<div className="wds-box-selector-message">
					<h3>{__('No properties to add', 'wds')}</h3>
					<p className="sui-description">{__('It seems that you have already added all the available properties.', 'wds')}</p>
				</div>
			}
		/>;
	}

	preparePropertySelectorOptions(typeProperties, sourceProperties) {
		const selectorOptions = [];
		Object.keys(sourceProperties).forEach((sourcePropertyKey) => {
			const sourceProperty = sourceProperties[sourcePropertyKey];

			if (!typeProperties.hasOwnProperty(sourcePropertyKey)) {
				selectorOptions.push({
					id: sourceProperty.id,
					label: sourceProperty.label
				});
			}
		});

		return selectorOptions;
	}

	getConditionGroupElements(typeKey, conditions) {
		return conditions.map((conditionGroup, conditionGroupIndex) =>
			<div className="wds-schema-type-condition-group">
				{this.getConditionElements(typeKey, conditionGroup, conditionGroupIndex)}
			</div>
		);
	}

	getConditionElements(typeKey, conditionGroup, conditionGroupIndex) {
		return conditionGroup.map((condition, conditionIndex) =>
			<SchemaTypeCondition
				onChange={(id, lhs, operator, rhs) => this.updateCondition(typeKey, id, lhs, operator, rhs)}
				onAdd={(id) => this.addCondition(typeKey, id)}
				onDelete={(id) => this.deleteCondition(typeKey, id)}
				disableDelete={conditionGroupIndex === 0 && conditionIndex === 0}
				key={condition.id} id={condition.id}
				lhs={condition.lhs} operator={condition.operator}
				rhs={condition.rhs}/>
		);
	}

	isNestedProperty(property) {
		return property.properties;
	}

	getActiveAltVersion(property) {
		return property.properties[property.activeVersion];
	}

	hasLoop(property) {
		return !!property.loop;
	}

	hasAltVersions(property) {
		return this.isNestedProperty(property) && !!property.activeVersion && property.properties.hasOwnProperty(property.activeVersion);
	}

	getPropertyElements(typeKey, properties) {
		const elements = [];
		Object.keys(properties).forEach((propertyKey) => {
			const property = properties[propertyKey];

			elements.push(this.getPropertyElement(typeKey, property));
		});

		return elements;
	}

	getPropertyElement(typeKey, property, isAnAltVersion = false) {
		if (this.hasAltVersions(property)) {
			return this.getPropertyElement(typeKey, this.getActiveAltVersion(property), true);
		} else if (this.isPropertyRepeatable(property)) {
			return this.getRepeatingPropertyElements(typeKey, property, isAnAltVersion);
		} else if (this.isNestedProperty(property)) {
			return this.getNestedPropertyElements(typeKey, property, isAnAltVersion);
		} else {
			return this.getSimplePropertyElement(typeKey, property);
		}
	}

	getSimplePropertyElement(typeKey, property) {
		return <SchemaPropertySimple
			{...property}
			onChange={(id, source, value) => this.updateProperty(typeKey, id, source, value)}
			onDelete={id => this.startDeletingProperty(typeKey, id)}
		/>;
	}

	getDefaultProperties(properties) {
		const defaultProperties = {};
		Object.keys(properties).forEach((propertyKey) => {
			const property = properties[propertyKey];
			if (!property.optional) {
				defaultProperties[propertyKey] = this.getDefaultProperty(property);
			}
		});

		return defaultProperties;
	}

	getDefaultProperty(property) {
		const args = [{}, property];
		if (this.isNestedProperty(property)) {
			args.push({
				properties: this.getDefaultProperties(property.properties)
			});
		}
		args.push({id: uniqueId()});
		return Object.assign({}, ...args);
	}

	cloneConditions(conditionGroups) {
		const clonedConditionGroup = [];
		conditionGroups.forEach((conditions) => {
			const clonedConditions = [];
			conditions.forEach((condition) => {
				clonedConditions.push(Object.assign(
					{},
					condition,
					{id: uniqueId()}
				));
			});
			clonedConditionGroup.push(clonedConditions);
		});
		return clonedConditionGroup;
	}

	cloneProperties(properties) {
		const clonedProperties = {};
		Object.keys(properties).forEach((propertyKey) => {
			clonedProperties[propertyKey] = this.cloneProperty(properties[propertyKey]);
		});

		return clonedProperties;
	}

	cloneProperty(property) {
		const args = [{}, property];
		if (this.isNestedProperty(property)) {
			args.push({
				properties: this.cloneProperties(property.properties)
			});
		}
		args.push({id: uniqueId()});
		return Object.assign({}, ...args);
	}

	startAddingSchemaType() {
		this.setState({
			addingSchemaTypes: true,
		});
	}

	stopAddingSchemaType() {
		this.setState({
			addingSchemaTypes: false,
		});
	}

	handleAddSchemaTypesButtonClick(schemaTypes) {
		this.addSchemaTypes(schemaTypes)
			.then((typeKey) => {
				this.stopAddingSchemaType();
				this.startRenamingType(typeKey, noop, () => {
					this.showNotice(__('The type has been added. You need to save the changes to make them live.', 'wds'));
					this.openAccordionItemFromSchemaType(typeKey);
				});
			});
	}

	getAddSchemaModalElement() {
		const options = this.getSchemaTypeOptions();

		return <BoxSelectorModal
			id="wds-add-schema-type"
			title={__('Add Schema Type', 'wds')}
			description={__('Start by selecting the schema type you want to output.', 'wds')}
			actionButtonText={__('Continue', 'wds')}
			actionButtonIcon="sui-icon-plus"
			onClose={() => this.stopAddingSchemaType()}
			onAction={(types) => this.handleAddSchemaTypesButtonClick(types)}
			options={options}
			multiple={false}
			generalMessage={
				<div className="wds-box-selector-message">
					<h3>{__('Coming Next', 'wds')}</h3>
					<p className="sui-description">{__('Heaps more schema types like Courses, Books, Job Postings and others coming soon.', 'wds')}</p>
				</div>
			}
		/>;
	}

	getSchemaTypeIcon(typeKey) {
		const options = this.getSchemaTypeOptions();
		const option = options.find((typeOption) => {
			return typeOption.id === typeKey;
		});

		return option.icon;
	}

	getSchemaTypeOptions() {
		const options = [
			{
				id: 'Article',
				label: __('Article', 'wds'),
				icon: 'sui-icon-page'
			},
			{
				id: 'Event',
				label: __('Event', 'wds'),
				icon: 'sui-icon-calendar'
			},
			{
				id: 'Product',
				label: __('Product', 'wds'),
				icon: 'sui-icon-element-checkbox'
			},
			{
				id: 'FAQPage',
				label: __('FAQ Page', 'wds'),
				icon: 'sui-icon-question'
			},
			{
				id: 'HowTo',
				label: __('How To', 'wds'),
				icon: 'sui-icon-list-bullet'
			},
		];

		options.push({
			id: 'WooProduct',
			label: __('WooCommerce Product', 'wds'),
			icon: 'sui-icon-element-checkbox',
			disabled: !this.isWooCommerceActive()
		});

		return options;
	}

	isProduct(type) {
		return type === 'Product' || this.isWooCommerceProduct(type);
	}

	isWooCommerceProduct(type) {
		return type === 'WooProduct';
	}

	generateTypeId(type) {
		return uniqueId(type + '-');
	}

	addSchemaTypes(schemaTypes) {
		const spec = {};
		let typeKey;
		schemaTypes.forEach((type) => {
			typeKey = this.generateTypeId(type);

			const defaultCondition = this.isWooCommerceProduct(type)
				? this.getDefaultWooProductCondition()
				: this.defaultCondition();

			spec[typeKey] = {
				$set: {
					label: type,
					type: type,
					conditions: [[defaultCondition]],
					properties: this.getDefaultProperties(schemaProperties[type])
				}
			};
		});

		return new Promise(resolve => {
			this.updateTypes(spec).then(() => resolve(typeKey));
		});
	}

	getType(typeKey) {
		return this.state.types[typeKey];
	}

	handleRepeatButtonClick(typeKey, propertyId) {
		this.repeatProperty(typeKey, propertyId);
		this.openAccordionItemForProperty(propertyId);

		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(propertyId, type.properties);
		const property = this.getPropertyByKeys(propertyKeys, type.properties);
		this.showNotice(sprintf(
			__('A new %s has been added.', 'wds'),
			property.hasOwnProperty('label_single')
				? property.label_single
				: property.label
		));
	}

	repeatProperty(typeKey, propertyId) {
		const type = this.getType(typeKey);
		const propertyKeys = this.propertyKeys(propertyId, type.properties);
		const property = this.getPropertyByKeys(propertyKeys, type.properties);
		const sourceProperty = this.getPropertyByKeys(propertyKeys, schemaProperties[type.type]);
		const repeatableKey = Object.keys(sourceProperty.properties).shift();
		const repeatable = sourceProperty.properties[repeatableKey];
		const newKey = Math.max(...Object.keys(property.properties)) + 1;

		let cloned = this.getDefaultProperty(repeatable);
		if (repeatable.disallowDeletion && repeatable.disallowFirstItemDeletionOnly) {
			delete cloned.disallowDeletion;
		}

		const spec = this.formatSpec([typeKey, 'properties', ...propertyKeys, 'properties', newKey], {
			$set: cloned
		});

		this.updateTypes(spec);
	}

	startAddingNestedProperties(typeKey, property) {
		this.openAccordionItemForProperty(property.id);

		this.setState({
			addingNestedForProperty: property.id,
		});
	}

	getTypeAccordionItemClassName(typeKey) {
		return 'wds-schema-type-' + typeKey + '-accordion';
	}

	getPropertyAccordionItemClassName(propertyId) {
		return 'wds-schema-property-' + propertyId + '-accordion';
	}

	openAccordionItemFromSchemaType(typeKey) {
		const className = this.getTypeAccordionItemClassName(typeKey);
		$('.' + className).addClass('sui-accordion-item--open');
	}

	openAccordionItemForProperty(propertyId) {
		const className = this.getPropertyAccordionItemClassName(propertyId);
		$('.' + className).addClass('sui-accordion-item--open');
	}

	getNestedPropertyElements(typeKey, property, isAnAltVersion) {
		return <tr>
			<td colSpan={4} className="wds-schema-nested-properties">
				<div className="sui-accordion">
					<div
						className={classnames('sui-accordion-item', this.getPropertyAccordionItemClassName(property.id))}>
						{this.getAccordionItemHeaderElement(typeKey, property)}

						<div className="sui-accordion-item-body">
							{this.hasLoop(property) &&
							<div>{this.getLoopDescription(property)}</div>
							}

							<table className="sui-table">
								<tbody>
								{this.getPropertyElements(typeKey, property.properties)}
								</tbody>
								{(isAnAltVersion || !property.disallowAddition) && <tfoot>
								<tr>
									<td colSpan={4}>
										{isAnAltVersion &&
										<Button onClick={() => this.startChangingPropertyType(property.id)}
												ghost={true}
												icon="sui-icon-defer"
												text={__('Switch Type', 'wds')}/>
										}

										{!property.disallowAddition &&
										<Button onClick={() => this.startAddingNestedProperties(typeKey, property)}
												ghost={true}
												icon="sui-icon-plus"
												text={__('Add Property', 'wds')}/>
										}
									</td>
								</tr>
								</tfoot>}
							</table>
						</div>
					</div>
					{this.state.addingNestedForProperty === property.id && this.getAddNestedPropertyModalElement(typeKey, property.id)}
					{this.state.changingPropertyTypeForId === property.id && this.getPropertyTypeChangeModalElement(typeKey, property.id)}
				</div>
			</td>
		</tr>;
	}

	getRepeatingPropertyElements(typeKey, property, isAnAltVersion) {
		const repeatables = property.properties;

		return <tr>
			<td colSpan={4} className="wds-schema-repeating-properties">
				<div className="sui-accordion">
					<div
						className={classnames('sui-accordion-item', this.getPropertyAccordionItemClassName(property.id))}>
						{this.getAccordionItemHeaderElement(
							typeKey, property,
							<React.Fragment>
								{isAnAltVersion &&
								<div className="sui-accordion-item-action">
									<button onClick={() => this.startChangingPropertyType(property.id)}
											data-tooltip={__('Change the type of this property', 'wds')}
											type="button"
											className="sui-button-icon sui-tooltip">
										<i className="sui-icon-defer" aria-hidden="true"/>
									</button>
								</div>
								}

								<div className="sui-accordion-item-action">
									<button onClick={() => this.handleRepeatButtonClick(typeKey, property.id)}
											type="button"
											data-tooltip={sprintf(
												__('Add another %s', 'wds'),
												this.getSingleLabel(property)
											)}
											className="sui-button-icon sui-tooltip">
										<i className="sui-icon-plus" aria-hidden="true"/>
									</button>
								</div>
							</React.Fragment>
						)}

						<div className="sui-accordion-item-body">
							{Object.keys(repeatables).map(propertyKey => {
									const repeatable = repeatables[propertyKey];
									return <table className="sui-table">
										<tbody>
										{repeatable.properties && this.getPropertyElements(typeKey, repeatable.properties)}
										{!repeatable.properties && this.getSimplePropertyElement(typeKey, repeatable)}
										</tbody>

										{!repeatable.disallowDeletion &&
										<tfoot>
										<tr>
											<td colSpan={4}>
												<Button text=""
														ghost={true}
														icon="sui-icon-trash"
														color="red"
														onClick={() => this.startDeletingProperty(typeKey, repeatable.id)}
												/>
											</td>
										</tr>
										</tfoot>
										}
									</table>;
								}
							)}
						</div>
					</div>
					{this.state.changingPropertyTypeForId === property.id && this.getPropertyTypeChangeModalElement(typeKey, property.id)}
				</div>
			</td>
		</tr>;
	}

	getLoopDescription(property) {
		if (property.loopDescription) {
			return property.loopDescription;
		}

		return sprintf(
			__('The following block will be repeated for each %s in loop', 'wds'),
			this.getSingleLabel(property)
		);
	}

	getSingleLabel(property) {
		return property.label_single ? property.label_single : property.label;
	}

	getAccordionItemHeaderElement(typeKey, property, actions) {
		return <div className="sui-accordion-item-header">
			<div className="sui-accordion-item-title">
				<span>{property.label}</span>
			</div>

			<div className="sui-accordion-col-auto">
				{actions}
				{!property.disallowDeletion && <div className="sui-accordion-item-action">
					<button onClick={() => this.startDeletingProperty(typeKey, property.id)}
							type="button"
							className="sui-button-icon sui-button-red">
						<i className="sui-icon-trash" aria-hidden="true"/>
					</button>
				</div>}

				<button className="sui-button-icon sui-accordion-open-indicator"
						type="button"
						aria-label={__('Open item', 'wds')}>
					<i className="sui-icon-chevron-down" aria-hidden="true"/>
				</button>
			</div>
		</div>;
	}

	isPropertyRepeatable(property) {
		if (!this.isNestedProperty(property)) {
			return false;
		}

		const nonNumericKeys = Object.keys(property.properties).filter(key => isNaN(key));
		return nonNumericKeys.length === 0;
	}

	startResettingProperties(typeKey) {
		this.setState({
			resettingProperties: typeKey
		});
	}

	getPropertyResetModalElement(typeKey) {
		return <Modal small={true}
					  id="wds-confirm-property-reset"
					  title={__('Are you sure?', 'wds')}
					  onClose={() => this.stopResettingProperties()}
					  focusAfterOpen="wds-schema-property-reset-button"
					  description={__('Are you sure you want to dismiss your changes and turn back your properties list to default?', 'wds')}>

			<Button text={__('Cancel', 'wds')}
					onClick={() => this.stopResettingProperties()}
					ghost={true}
			/>

			<Button text={__('Reset Properties', 'wds')}
					onClick={() => this.resetProperties(typeKey)}
					icon="sui-icon-refresh"
					id="wds-schema-property-reset-button"
			/>
		</Modal>;
	}

	resetProperties(typeKey) {
		const type = this.getType(typeKey);
		const spec = this.formatSpec([typeKey, 'properties'], {
			$set: this.getDefaultProperties(schemaProperties[type.type])
		});

		this.updateTypes(spec).then(() => {
			this.showNotice(__('Properties have been reset to default', 'wds'));
		});
		this.stopResettingProperties();
	}

	stopResettingProperties() {
		this.setState({
			resettingProperties: ''
		});
	}

	startRenamingType(typeKey, renameCallback = noop, renamingStoppedCallback = noop) {
		this.setState({
			renamingType: typeKey,
			newName: this.getType(typeKey).label,
			renameCallback: renameCallback,
			renamingStoppedCallback: renamingStoppedCallback
		});
	}

	stopRenamingType() {
		this.state.renamingStoppedCallback();

		this.setState({
			renamingType: '',
			newName: '',
			renameCallback: noop,
			renamingStoppedCallback: noop,
		});
	}

	setNewName(name) {
		this.setState({newName: name});
	}

	renameType(typeKey) {
		if (!this.state.newName) {
			this.stopRenamingType();
			this.showNotice(__('You need to enter a name', 'wds'), 'error');

			return;
		}

		const spec = this.formatSpec([typeKey, 'label'], {
			$set: this.state.newName
		});
		this.updateTypes(spec).then(() => {
			this.state.renameCallback();
			this.stopRenamingType();
		});
	}

	showRenameSuccessNotice() {
		this.showNotice(__('The type has been renamed.', 'wds'));
	}

	getTypeRenameModalElement(typeKey) {
		return <Modal
			id="wds-schema-type-rename-modal"
			title={__('Rename', 'wds')}
			description={__('Leave the default type name or change it for a recognizable one.', 'wds')}
			onClose={() => this.stopRenamingType()}
			dialogClasses={{'sui-modal-sm': true}}
			focusAfterOpen="wds-schema-rename-type-input"
			onEnter={() => this.renameType(typeKey)}
			footer={
				<React.Fragment>
					<Button text={__('Cancel', 'wds')}
							onClick={() => this.stopRenamingType()}
							ghost={true}
					/>

					<Button text={__('Save', 'wds')}
							onClick={() => this.renameType(typeKey)}
							icon="sui-icon-check"
							id="wds-schema-rename-type-button"
					/>
				</React.Fragment>
			}
		>
			<div className="sui-form-field">
				<label className="sui-label">{__('New Type Name', 'wds')}</label>
				<input className="sui-form-control"
					   id="wds-schema-rename-type-input"
					   onChange={e => this.setNewName(e.target.value)}
					   value={this.state.newName}/>

				{this.isProduct(this.getType(typeKey).type) && this.isWooCommerceActive() &&
				<div className="sui-notice sui-notice-info" style={{"margin-top": "30px"}}>
					<div className="sui-notice-content">
						<div className="sui-notice-message">
							<i className="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"/>
							<p>{__('On the pages where this schema type is printed, schema generated by WooCommerce will be replaced to avoid generating multiple product schemas for the same product page.', 'wds')}</p>
						</div>
					</div>
				</div>
				}
			</div>
		</Modal>;
	}

	isWooCommerceActive() {
		return !!Config_Values.get('woocommerce', 'schema_types');
	}

	startDeletingType(typeKey) {
		this.setState({
			deletingType: typeKey
		});
	}

	stopDeletingType() {
		this.setState({
			deletingType: ''
		});
	}

	deleteType(typeKey) {
		this.updateTypes({
			$unset: [typeKey]
		}).then(() => {
			this.showNotice(__('The type has been removed. You need to save the changes to make them live.', 'wds'), 'info');
		});
		this.stopDeletingType();
	}

	getTypeDeleteModalElement(typeKey) {
		return <Modal small={true}
					  id="wds-confirm-type-deletion"
					  title={__('Are you sure?', 'wds')}
					  onClose={() => this.stopDeletingType()}
					  focusAfterOpen="wds-schema-type-delete-button"
					  description={__('Are you sure you wish to delete this schema type? You can add it again anytime.', 'wds')}>

			<Button text={__('Cancel', 'wds')}
					onClick={() => this.stopDeletingType()}
					ghost={true}
			/>

			<Button text={__('Delete', 'wds')}
					onClick={() => this.deleteType(typeKey)}
					icon="sui-icon-trash"
					color="red"
					id="wds-schema-type-delete-button"
			/>
		</Modal>;
	}

	showNotice(message, type = 'success', dismiss = false) {
		const icons = {
			error: 'info',
			info: 'info',
			success: 'check-tick'
		};

		SUI.openNotice('wds-schema-types-notice', '<p>' + message + '</p>', {
			type: type,
			icon: icons[type],
			dismiss: {show: dismiss}
		});
	}

	getStateInput() {
		return <input type="hidden" name="wds-schema-types" value={JSON.stringify(this.state.types)}/>;
	}

	getSaveSettingsFooter() {
		return <div id="wds-save-schema-types" className="sui-box-footer">
			<button name="submit"
					type="submit"
					className="sui-button sui-button-blue">
				<i className="sui-icon-save" aria-hidden="true"/>

				{__('Save Settings', 'wds')}
			</button>
		</div>;
	}

	startChangingPropertyType(propertyId) {
		this.setState({changingPropertyTypeForId: propertyId});
	}

	stopChangingPropertyType() {
		this.setState({changingPropertyTypeForId: 0});
	}

	getPropertyTypeChangeModalElement(typeKey, propertyId) {
		const type = this.getType(typeKey);
		const parentProperty = this.getPropertyParent(propertyId, type.properties);
		let options = this.getAltVersionTypes(parentProperty);
		if (options) {
			options = options.filter((altVersion) => {
				return parentProperty.activeVersion !== altVersion.id;
			});
		}

		return <BoxSelectorModal
			id="wds-change-property-type"
			title={__('Change Property Type', 'wds')}
			description={__('Select one of the following types to switch.', 'wds')}
			actionButtonText={__('Change', 'wds')}
			actionButtonIcon="sui-icon-defer"
			onClose={() => this.stopChangingPropertyType()}
			onAction={(selectedType) => this.handlePropertyTypeChange(typeKey, parentProperty, selectedType)}
			options={options}
			multiple={false}
		/>;
	}

	handlePropertyTypeChange(schemaTypeKey, parentProperty, selectedPropertyTypes) {
		if (!selectedPropertyTypes.length) {
			return;
		}

		const selectedPropertyType = selectedPropertyTypes[0];
		const type = this.getType(schemaTypeKey);
		const propertyKeys = this.propertyKeys(parentProperty.id, type.properties);
		const spec = this.formatSpec([schemaTypeKey, 'properties', ...propertyKeys], {
			activeVersion: {$set: selectedPropertyType}
		});
		const altVersion = this.getPropertyByKeys([...propertyKeys, 'properties', selectedPropertyType], type.properties);

		this.updateTypes(spec).then(() => {
			this.openAccordionItemForProperty(altVersion.id);
			this.showNotice(sprintf(__('Property type has been changed to %s', 'wds'), selectedPropertyType));
		});
	}

	getPropertyParent(childId, properties) {
		const propertyKeys = this.propertyKeys(childId, properties);
		propertyKeys.pop(); // child key
		propertyKeys.pop(); // 'properties'
		return this.getPropertyByKeys(propertyKeys, properties);
	}

	getPropertyById(propertyId, properties) {
		const propertyKeys = this.propertyKeys(propertyId, properties);
		return this.getPropertyByKeys(propertyKeys, properties);
	}

	getAltVersionTypes(property) {
		if (!this.hasAltVersions(property)) {
			return false;
		}

		const types = [];
		Object.keys(property.properties).forEach((type) => {
			const altVersion = property.properties[type];

			types.push({
				id: type,
				label: altVersion.label
			});
		});

		return types;
	}
}
