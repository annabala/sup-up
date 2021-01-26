import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";
import Review from "./review";
import Offer from "./offer";
import Organization from "./organization";
import AggregateRating from "./aggregate-rating";
import AggregateOffer from "./aggregate-offer";

const id = uniqueId;
const Product = {
	name: {
		id: id(),
		label: __('Name', 'wds'),
		type: 'TextFull',
		source: 'post_data',
		value: 'post_title'
	},
	description: {
		id: id(),
		label: __('Description', 'wds'),
		type: 'TextFull',
		source: 'seo_meta',
		value: 'seo_description'
	},
	sku: {
		id: id(),
		label: __('SKU', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
	},
	gtin: {
		id: id(),
		label: __('GTIN', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		optional: true,
	},
	gtin8: {
		id: id(),
		label: __('GTIN-8', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		optional: true,
	},
	gtin12: {
		id: id(),
		label: __('GTIN-12', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		optional: true,
	},
	gtin13: {
		id: id(),
		label: __('GTIN-13', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		optional: true,
	},
	gtin14: {
		id: id(),
		label: __('GTIN-14', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		optional: true,
	},
	mpn: {
		id: id(),
		label: __('MPN', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		optional: true,
	},
	image: {
		id: id(),
		label: __('Images', 'wds'),
		label_single: __('Image', 'wds'),
		properties: {
			0: {
				id: id(),
				label: __('Image', 'wds'),
				type: 'ImageObject',
				source: 'post_data',
				value: 'post_thumbnail'
			}
		}
	},
	brand: {
		id: id(),
		label: __('Brand', 'wds'),
		type: 'Organization',
		properties: Organization
	},
	review: {
		id: id(),
		label: __('Reviews', 'wds'),
		label_single: __('Review', 'wds'),
		properties: {
			0: {
				id: id(),
				type: 'Review',
				properties: Review
			}
		}
	},
	aggregateRating: {
		id: id(),
		label: __('Aggregate Rating', 'wds'),
		type: 'AggregateRating',
		properties: AggregateRating
	},
	offers: {
		id: id(),
		label: __('Offers', 'wds'),
		activeVersion: 'Offer',
		properties: {
			Offer: {
				id: id(),
				label: __('Offers', 'wds'),
				label_single: __('Offer', 'wds'),
				properties: {
					0: {
						id: id(),
						type: 'Offer',
						properties: Offer,
					}
				}
			},
			AggregateOffer: {
				id: id(),
				type: 'AggregateOffer',
				label: __('Aggregate Offer', 'wds'),
				properties: AggregateOffer,
			}
		}
	},
};
export default Product;
