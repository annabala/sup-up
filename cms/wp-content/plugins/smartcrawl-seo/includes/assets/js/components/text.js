import React from 'react';

export default class Text extends React.Component {
	static defaultProps = {
		value: '',
		onChange: () => false
	}

	constructor(props) {
		super(props);

		this.props = props;
	}

	handleChange(e) {
		e.target.style.height = 0;

		const scrollHeight = e.target.scrollHeight;
		e.target.style.height = (scrollHeight < 30 ? 30 : scrollHeight) + 'px';

		this.props.onChange(e.target.value);
	}

	render() {
		return <textarea value={this.props.value} onChange={e => this.handleChange(e)}/>
	}
}
