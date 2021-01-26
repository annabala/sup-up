import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";

const id = uniqueId;
const ReviewRating = {
	ratingValue: {
		id: id(),
		label: __('Rating Value', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
	bestRating: {
		id: id(),
		label: __('Best Rating', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
	worstRating: {
		id: id(),
		label: __('Worst Rating', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
};

export default ReviewRating;
