import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";

const id = uniqueId;

const Person = {
	name: {
		id: id(),
		label: __('Name', 'wds'),
		type: 'TextFull',
		source: 'custom_text',
		value: ''
	},
	url: {
		id: id(),
		label: __('URL', 'wds'),
		type: 'URL',
		source: 'custom_text',
		value: ''
	},
	description: {
		id: id(),
		label: __('Description', 'wds'),
		type: 'TextFull',
		source: 'custom_text',
		value: '',
		optional: true
	},
	image: {
		id: id(),
		label: __('Image', 'wds'),
		type: 'ImageObject',
		source: 'image',
		value: ''
	}
};

export default Person;
