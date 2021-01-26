import React from 'react';
import $ from 'jQuery';

export default class Select extends React.Component {
	static defaultProps = {
		small: false,
		tagging: false,
		placeholder: '',
		ajaxUrl: '',
		getSingleAjaxUrl: '',
		selectedValue: '',
		minimumResultsForSearch: 10,
		minimumInputLength: 3,
		options: {},
		onSelect: () => false,
	};

	constructor(props) {
		super(props);

		this.props = props;
		this.state = {
			loadingText: false
		};
		this.selectElement = React.createRef();
	}

	componentDidMount() {
		const $select = $(this.selectElement.current);
		$select
			.addClass(this.props.small ? 'sui-select sui-select-sm' : 'sui-select')
			.SUIselect2(this.getSelect2Args());

		this.includeSelectedValueAsDynamicOption();

		$select.on('change', (e) => this.handleChange(e));
	}

	includeSelectedValueAsDynamicOption() {
		if (this.props.selectedValue && this.noOptionsAvailable()) {
			if (this.props.tagging) {
				this.addOption(this.props.selectedValue, this.props.selectedValue, true);
			} else if (this.props.getSingleAjaxUrl) {
				this.loadTextFromRemote();
			}
		}
	}

	loadTextFromRemote() {
		if (this.state.loadingText) {
			// Already in the middle of a remote call
			return;
		}

		this.setState({loadingText: true});

		$.get(this.props.getSingleAjaxUrl, {
			'id': this.props.selectedValue
		}).done((data) => {
			if (data && data.results && data.results.length) {
				const result = data.results.shift();
				this.addOption(result.id, result.text, true);
			}

			this.setState({loadingText: false});
		});
	}

	addOption(value, text, selected) {
		let newOption = new Option(text, value, false, selected);
		$(this.selectElement.current).append(newOption).trigger('change');
	}

	noOptionsAvailable() {
		return !Object.keys(this.props.options).length;
	}

	componentWillUnmount() {
		const $select = $(this.selectElement.current);
		$select.off().SUIselect2('destroy');
	}

	getSelect2Args() {
		let args = {
			dropdownCssClass: 'sui-select-dropdown',
			minimumResultsForSearch: this.props.minimumResultsForSearch,
			tagging: this.props.tagging
		};

		if (this.props.placeholder) {
			args['placeholder'] = this.props.placeholder;
		}

		if (this.props.ajaxUrl) {
			args['ajax'] = {url: this.props.ajaxUrl};
			args['minimumInputLength'] = this.props.minimumInputLength;
		}

		if (this.props.ajaxUrl && this.props.tagging) {
			args['ajax']['processResults'] = (response, request) => {
				if (response.results && !response.results.length) {
					return {
						results: [{
							id: request.term,
							text: request.term
						}]
					}
				}

				return response;
			};
		}

		return args;
	}

	handleChange(e) {
		this.props.onSelect(e.target.value);
	}

	render() {
		const optionsProp = this.props.options;
		let options;
		if (Object.keys(optionsProp).length) {
			options = Object.keys(optionsProp).map((key) =>
				<option key={key}
						selected={this.props.selectedValue === key}
						value={key}>

					{optionsProp[key]}
				</option>
			);
		} else {
			options = <option/>;
		}

		return <select disabled={this.state.loadingText} ref={this.selectElement}>{options}</select>;
	}
}
