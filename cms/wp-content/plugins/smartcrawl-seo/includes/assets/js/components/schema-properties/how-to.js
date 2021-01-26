import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";
import MonetaryAmount from "./monetary-amount";

const id = uniqueId;
const HowTo = {
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
	totalTime: {
		id: id(),
		label: __('Total Time', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: ''
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
	supply: {
		id: id(),
		label: __('Supplies', 'wds'),
		label_single: __('Supply', 'wds'),
		properties: {
			0: {
				id: id(),
				label: __('Supply', 'wds'),
				type: 'HowToSupply',
				properties: {
					name: {
						id: id(),
						label: __('Name', 'wds'),
						type: 'Text',
						source: 'custom_text',
						value: ''
					},
					image: {
						id: id(),
						label: __('Image', 'wds'),
						type: 'ImageObject',
						source: 'image',
						value: ''
					},
				}
			}
		}
	},
	tool: {
		id: id(),
		label: __('Tools', 'wds'),
		label_single: __('Tool', 'wds'),
		properties: {
			0: {
				id: id(),
				label: __('Tool', 'wds'),
				type: 'HowToTool',
				properties: {
					name: {
						id: id(),
						label: __('Name', 'wds'),
						type: 'Text',
						source: 'custom_text',
						value: ''
					},
					image: {
						id: id(),
						label: __('Image', 'wds'),
						type: 'ImageObject',
						source: 'image',
						value: ''
					},
				}
			}
		}
	},
	estimatedCost: {
		id: id(),
		label: __('Estimated Cost', 'wds'),
		type: 'MonetaryAmount',
		disallowAddition: true,
		properties: MonetaryAmount,
	},
	step: {
		id: id(),
		label: __('Steps', 'wds'),
		label_single: __('Step', 'wds'),
		properties: {
			0: {
				id: id(),
				label: __('Step', 'wds'),
				type: 'HowToStep',
				disallowDeletion: true,
				disallowFirstItemDeletionOnly: true,
				properties: {
					name: {
						id: id(),
						label: __('Name', 'wds'),
						type: 'Text',
						source: 'custom_text',
						value: ''
					},
					text: {
						id: id(),
						label: __('Text', 'wds'),
						type: 'Text',
						source: 'custom_text',
						value: ''
					},
					image: {
						id: id(),
						label: __('Image', 'wds'),
						type: 'ImageObject',
						source: 'image',
						value: ''
					},
					url: {
						id: id(),
						label: __('Url', 'wds'),
						type: 'Text',
						source: 'custom_text',
						value: ''
					},
				}
			}
		}
	}
};
export default HowTo;
