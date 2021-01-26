import {merge} from "lodash-es";
import {__} from '@wordpress/i18n';
import AggregateRating from "./aggregate-rating";

const WooAggregateRating = merge({}, AggregateRating, {
	ratingCount: {
		source: 'woocommerce',
		value: 'review_count',
		customSources: {
			woocommerce: {
				label: __('WooCommerce', 'wds'),
				values: {
					review_count: __('Review Count', 'wds'),
				}
			}
		}
	},
	reviewCount: {
		source: 'woocommerce',
		value: 'review_count',
		customSources: {
			woocommerce: {
				label: __('WooCommerce', 'wds'),
				values: {
					review_count: __('Review Count', 'wds'),
				}
			}
		}
	},
	ratingValue: {
		source: 'woocommerce',
		value: 'average_rating',
		customSources: {
			woocommerce: {
				label: __('WooCommerce', 'wds'),
				values: {
					average_rating: __('Average Rating', 'wds'),
				}
			}
		}
	},
	bestRating: {
		value: '5',
	},
	worstRating: {
		value: '1',
	},
});

export default WooAggregateRating;
