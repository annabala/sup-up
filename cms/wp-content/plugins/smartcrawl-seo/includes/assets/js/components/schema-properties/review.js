import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";
import Person from "./person";
import Organization from "./organization";
import ReviewRating from "./review-rating";
import {cloneDeep, mapValues} from "lodash-es";

const id = uniqueId;
const Review = {
	reviewBody: {
		id: id(),
		label: __('Review Body', 'wds'),
		type: 'Text',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
	datePublished: {
		id: id(),
		label: __('Date Published', 'wds'),
		type: 'DateTime',
		source: 'custom_text',
		value: '',
		disallowDeletion: true,
	},
	author: {
		id: id(),
		label: __('Author', 'wds'),
		activeVersion: 'Person',
		properties: {
			Person: {
				id: id(),
				label: __('Author', 'wds'),
				disallowDeletion: true,
				disallowAddition: true,
				type: 'Person',
				properties: mapValues(Person, (personProperty) => {
					const newProperty = cloneDeep(personProperty);
					newProperty.optional = false;
					newProperty.disallowDeletion = true;
					return newProperty;
				}),
			},
			Organization: {
				id: id(),
				label: __('Author Organization', 'wds'),
				disallowDeletion: true,
				disallowAddition: true,
				type: 'Organization',
				properties: mapValues(Organization, (orgProperty) => {
					const newProperty = cloneDeep(orgProperty);
					newProperty.optional = false;
					newProperty.disallowDeletion = true;
					return newProperty;
				})
			}
		}
	},
	itemReviewed: {
		id: id(),
		label: __('Item Being Reviewed', 'wds'),
		disallowAddition: true,
		disallowDeletion: true,
		properties: {
			name: {
				id: id(),
				label: __('Name', 'wds'),
				type: 'TextFull',
				source: 'post_data',
				value: 'post_title',
				disallowDeletion: true,
			}
		},
	},
	reviewRating: {
		id: id(),
		label: __('Rating', 'wds'),
		type: 'Rating',
		disallowAddition: true,
		disallowDeletion: true,
		properties: ReviewRating
	}
};

export default Review;
