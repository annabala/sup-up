import {__} from '@wordpress/i18n';
import {merge} from "lodash-es";
import Organization from "./organization";

const WooBrand = merge({}, Organization, {
	logo: {
		source: 'image',
		value: '',
	},
	name: {
		customSources: {
			woocommerce: {
				label: __('WooCommerce', 'wds'),
				values: {
					product_category: __('Product Category', 'wds'),
					product_tag: __('Product Tag', 'wds'),
				}
			}
		}
	},
	url: {
		customSources: {
			woocommerce: {
				label: __('WooCommerce', 'wds'),
				values: {
					product_category_url: __('Product Category URL', 'wds'),
					product_tag_url: __('Product Tag URL', 'wds'),
				}
			}
		}
	}
});

export default WooBrand;
