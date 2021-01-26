import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";
import Question from "./question";

const id = uniqueId;
const FAQPage = {
	mainEntity: {
		id: id(),
		label: __('Questions', 'wds'),
		label_single: __('Question', 'wds'),
		disallowDeletion: true,
		properties: {
			0: {
				id: id(),
				type: 'Question',
				disallowDeletion: true,
				disallowFirstItemDeletionOnly: true,
				properties: Question
			}
		}
	}
};

export default FAQPage;
