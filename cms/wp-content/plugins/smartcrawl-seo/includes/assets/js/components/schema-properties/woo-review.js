import {__} from '@wordpress/i18n';
import {merge} from "lodash-es";
import Review from "./review";
import WooReviewRating from "./woo-review-rating";

const WooReview = merge({}, Review, {
	reviewBody: {
		source: 'woocommerce_review',
		value: 'comment_text',
		customSources: {
			woocommerce_review: {
				label: __('WooCommerce Review', 'wds'),
				values: {
					comment_text: __('Review Text', 'wds'),
				}
			}
		}
	},
	datePublished: {
		source: 'woocommerce_review',
		value: 'comment_date',
		customSources: {
			woocommerce_review: {
				label: __('WooCommerce Review', 'wds'),
				values: {
					comment_date: __('Date Published', 'wds'),
				}
			}
		}
	},
	author: {
		properties: {
			Person: {
				properties: {
					name: {
						source: 'woocommerce_review',
						value: 'comment_author_name',
						customSources: {
							woocommerce_review: {
								label: __('WooCommerce Review', 'wds'),
								values: {
									comment_author_name: __('Author Name', 'wds'),
								}
							}
						}
					}
				}
			},
			Organization: {
				properties: {
					name: {
						source: 'woocommerce_review',
						value: 'comment_author_name',
						customSources: {
							woocommerce_review: {
								label: __('WooCommerce Review', 'wds'),
								values: {
									comment_author_name: __('Author Name', 'wds'),
								}
							}
						}
					}
				}
			}
		}
	},
	reviewRating: {
		properties: WooReviewRating
	}
});

export default WooReview;
