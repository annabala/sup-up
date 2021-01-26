import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";

const id = uniqueId;

const AggregateOffer = {
	availability: {
		id: id(),
		label: __('Availability', 'wds'),
		type: 'Text',
		source: 'options',
		value: 'InStock',
		customSources: {
			options: {
				label: __('Availability', 'wds'),
				values: {
					InStock: __('In Stock', 'wds'),
					SoldOut: __('Sold Out', 'wds'),
					PreOrder: __('PreOrder', 'wds'),
				}
			}
		},
	},
	lowPrice: {
		id: id(),
		label: __('Low Price', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
	},
	highPrice: {
		id: id(),
		label: __('High Price', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
	},
	priceCurrency: {
		id: id(),
		label: __('Price Currency', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
	},
	offerCount: {
		id: id(),
		label: __('Offer Count', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
	},
};

export default AggregateOffer;
