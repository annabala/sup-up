import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";
import Review from "./review";
import Organization from "./organization";
import AggregateRating from "./aggregate-rating";
import WooOffer from "./woo-offer";
import WooAggregateOffer from "./woo-aggregate-offer";
import WooReview from "./woo-review";
import WooAggregateRating from "./woo-aggregate-rating";
import WooBrand from "./woo-brand";

const id = uniqueId;
const WooProduct = {
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
		source: 'woocommerce',
		value: 'product_id',
		customSources: {
			woocommerce: {
				label: __('WooCommerce', 'wds'),
				values: {
					product_id: __('Product ID', 'wds'),
					sku: __('Product SKU', 'wds'),
				}
			}
		}
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
		properties: WooBrand
	},
	review: {
		id: id(),
		label: __('Reviews', 'wds'),
		activeVersion: 'WooCommerceReviewLoop',
		properties: {
			WooCommerceReviewLoop: {
				id: id(),
				label: __('WooCommerce Reviews', 'wds'),
				label_single: __('WooCommerce Review', 'wds'),
				loop: 'woocommerce-reviews',
				loopDescription: __('The following block will be repeated for each Review in a WooCommerce product'),
				type: 'Review',
				properties: WooReview,
				disallowAddition: true
			},
			Review: {
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
			}
		}
	},
	aggregateRating: {
		id: id(),
		label: __('Aggregate Rating', 'wds'),
		type: 'AggregateRating',
		properties: WooAggregateRating
	},
	offers: {
		id: id(),
		label: __('Offers', 'wds'),
		activeVersion: 'AggregateOffer',
		properties: {
			Offer: {
				id: id(),
				label: __('Offers', 'wds'),
				label_single: __('Offer', 'wds'),
				properties: {
					0: {
						id: id(),
						type: 'Offer',
						properties: WooOffer
					}
				}
			},
			AggregateOffer: {
				id: id(),
				type: 'AggregateOffer',
				label: __('Aggregate Offer', 'wds'),
				properties: WooAggregateOffer
			}
		}
	},
};

export default WooProduct;
