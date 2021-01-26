import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";

const id = uniqueId;
const MonetaryAmount = {
	value: {
		id: id(),
		label: __('Value', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
	currency: {
		id: id(),
		label: __('Currency', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
	maxValue: {
		id: id(),
		label: __('Max Value', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
	minValue: {
		id: id(),
		label: __('Min Value', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	}
};
export default MonetaryAmount;
