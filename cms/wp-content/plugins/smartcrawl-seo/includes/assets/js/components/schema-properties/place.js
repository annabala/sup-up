import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";
import PostalAddress from "./postal-address";

const id = uniqueId;
const Place = {
	name: {
		id: id(),
		label: __('Name', 'wds'),
		type: 'TextFull',
		source: 'custom_text',
		value: '',
	},
	address: {
		id: id(),
		label: __('Address', 'wds'),
		type: 'PostalAddress',
		properties: PostalAddress
	}
};
export default Place;
