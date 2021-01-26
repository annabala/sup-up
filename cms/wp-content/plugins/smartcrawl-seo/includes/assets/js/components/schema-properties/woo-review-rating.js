import {__} from '@wordpress/i18n';
import {merge} from "lodash-es";
import ReviewRating from "./review-rating";

const WooReviewRating = merge({}, ReviewRating, {
	ratingValue: {
		source: 'woocommerce_review',
		value: 'rating_value',
		customSources: {
			woocommerce_review: {
				label: __('WooCommerce Review', 'wds'),
				values: {
					rating_value: __('Rating Value', 'wds'),
				}
			}
		}
	},
	bestRating: {
		value: '5',
	},
	worstRating: {
		value: '1',
	}
});

export default WooReviewRating;
