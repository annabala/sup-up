import React from 'react';
import Select from "./select";
import {__, sprintf} from '@wordpress/i18n';
import MediaItemSelector from "./media-item-selector";
import Text from "./text";
import Config_Values from "../es6/config-values";
import DatePicker from "./date-picker";
import schemaSources from "./schema-sources/schema-sources";

export default class SchemaPropertySimple extends React.Component {
	static defaultProps = {
		id: '',
		label: '',
		source: '',
		value: '',
		options: false,
		disallowDeletion: false,
		onChange: () => false,
		onDelete: () => false,
	}

	constructor(props) {
		super(props);

		this.props = props;
	}

	render() {
		const label = this.props.label,
			source = this.props.source,
			value = this.props.value,
			sourceSelectOptions = this.getSourceSelectOptions(),
			valueElement = this.getValueElement(source, value);

		return <tr className={'wds-schema-property-source-' + source}>
			<td className="sui-table-item-title wds-schema-property-label">
				{label}
			</td>

			<td className="wds-schema-property-source">
				<Select key={sprintf('wds-property-%s-source', this.props.id)}
						options={sourceSelectOptions}
						small={true}
						selectedValue={source}
						onSelect={source => this.handleSourceChange(source)}/>
			</td>

			<td className="wds-schema-property-value">{valueElement}</td>

			<td className="wds-schema-property-delete">
				{!this.props.disallowDeletion &&
				<i onClick={() => this.handleDelete()} className="sui-icon-trash" aria-hidden="true"/>
				}
			</td>
		</tr>;
	}

	handleSourceChange(source) {
		const valueOptions = this.getValueSelectOptions(source);
		let value = '';
		if (valueOptions) {
			value = Object.keys(valueOptions).shift();
		}

		this.props.onChange(this.props.id, source, value);
	}

	handleValueChange(value) {
		this.props.onChange(this.props.id, this.props.source, value);
	}

	handleDelete() {
		this.props.onDelete(this.props.id);
	}

	getSources() {
		const propertyType = this.getPropertyType();
		return Object.assign(
			{},
			this.getObjectValue(schemaSources, [propertyType, 'sources']),
			this.props.customSources || {}
		);
	}

	getSourceSelectOptions() {
		const sources = this.getSources();
		const options = {};
		Object.keys(sources).forEach((sourceKey) => {
			options[sourceKey] = sources[sourceKey]['label'];
		});

		return options;
	}

	getValueElement(source, value) {
		const key = sprintf('wds-property-%s-source-%s', this.props.id, source);
		const selectOptions = this.getValueSelectOptions(source);
		if (selectOptions) {
			return <Select key={key}
						   options={selectOptions}
						   small={true}
						   onSelect={(selectValue) => this.handleValueChange(selectValue)}
						   selectedValue={value}/>
		}

		if ('image' === source || 'image_url' === source) {
			return <MediaItemSelector
				key={key}
				value={this.props.value}
				onChange={(imageId) => this.handleValueChange(imageId)}
			/>
		}

		if ('custom_text' === source) {
			return <Text key={key}
						 value={this.props.value}
						 onChange={(text) => this.handleValueChange(text)}/>
		}

		if ('post_meta' === source) {
			let ajaxURL = Config_Values.get('ajax_url', 'schema_types');
			return <Select key={key}
						   tagging={true}
						   placeholder={__('Search for meta key', 'wds')}
						   options={{}}
						   small={true}
						   selectedValue={this.props.value}
						   onSelect={(selectValue) => this.handleValueChange(selectValue)}
						   ajaxUrl={ajaxURL + '?action=wds-search-post-meta'}/>
		}

		if ('datetime' === source) {
			return <DatePicker value={this.props.value}
							   onChange={(dateTimeValue) => this.handleValueChange(dateTimeValue)}
			/>
		}
	}

	getPropertyType() {
		return this.props.type;
	}

	getValueSelectOptions(sourceKey) {
		const options = this.getObjectValue(this.getSources(), [sourceKey]);
		if (options.hasOwnProperty('values')) {
			return options['values'];
		}

		return false;
	}

	getObjectValue(object, keys) {
		let value = object;
		keys.forEach((key) => {
			value = value.hasOwnProperty(key) ? value[key] : [];
		});
		return value;
	}
}
