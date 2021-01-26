import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";

const id = uniqueId;
const AggregateRating = {
		itemReviewed: {
			id: id(),
			label: __('Item Being Reviewed', 'wds'),
			disallowAddition: true,
			properties: {
				name: {
					id: id(),
					label: __('Name', 'wds'),
					type: 'TextFull',
					source: 'post_data',
					value: 'post_title',
					disallowDeletion: true,
				}
			},
		},
		ratingCount: {
			id: id(),
			label: __('Rating Count', 'wds'),
			type: 'Text',
			source: 'custom_text',
			value: '',
		},
		reviewCount: {
			id: id(),
			label: __('Review Count', 'wds'),
			type: 'Text',
			source: 'custom_text',
			value: '',
		},
		ratingValue: {
			id: id(),
			label: __('Rating Value', 'wds'),
			type: 'Text',
			source: 'custom_text',
			value: '',
			requiredInBlock: true,
		},
		bestRating: {
			id: id(),
			label: __('Best Rating', 'wds'),
			type: 'Text',
			source: 'custom_text',
			value: '',
		},
		worstRating: {
			id: id(),
			label: __('Worst Rating', 'wds'),
			type: 'Text',
			source: 'custom_text',
			value: '',
		}
	}
;

export default AggregateRating;
