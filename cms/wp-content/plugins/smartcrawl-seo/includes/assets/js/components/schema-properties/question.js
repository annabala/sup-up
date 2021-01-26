import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";

const id = uniqueId;
const Question = {
	name: {
		id: id(),
		label: __('Question', 'wds'),
		type: 'Text',
		disallowDeletion: true,
		source: 'custom_text',
		value: ''
	},
	image: {
		id: id(),
		label: __('Image', 'wds'),
		type: 'ImageObject',
		source: 'image',
		value: ''
	},
	url: {
		id: id(),
		label: __('URL', 'wds'),
		type: 'URL',
		source: 'custom_text',
		value: ''
	},
	acceptedAnswer: {
		id: id(),
		label: __('Accepted Answer', 'wds'),
		type: 'Answer',
		disallowDeletion: true,
		disallowAddition: true,
		properties: {
			text: {
				id: id(),
				label: __('Text', 'wds'),
				type: 'Text',
				disallowDeletion: true,
				source: 'custom_text',
				value: ''
			}
		}
	}
};
export default Question;
