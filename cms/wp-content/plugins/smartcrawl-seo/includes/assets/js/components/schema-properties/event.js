import {__} from '@wordpress/i18n';
import uniqueId from "lodash-es/uniqueId";
import Place from "./place";
import Organization from "./organization";
import Person from "./person";
import EventOffer from "./event-offer";
import AggregateOffer from "./aggregate-offer";

const id = uniqueId;
const Event = {
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
	startDate: {
		id: id(),
		label: __('Start Date', 'wds'),
		type: 'DateTime',
		source: 'datetime',
		value: '',
	},
	endDate: {
		id: id(),
		label: __('End Date', 'wds'),
		type: 'DateTime',
		source: 'datetime',
		value: '',
	},
	eventAttendanceMode: {
		id: id(),
		label: __('Event Attendance Mode', 'wds'),
		type: 'Text',
		source: 'options',
		value: 'MixedEventAttendanceMode',
		customSources: {
			options: {
				label: __('Event Attendance Mode', 'wds'),
				values: {
					MixedEventAttendanceMode: __('Mixed Attendance Mode', 'wds'),
					OfflineEventAttendanceMode: __('Offline Attendance Mode', 'wds'),
					OnlineEventAttendanceMode: __('Online Attendance Mode', 'wds'),
				}
			}
		},
	},
	eventStatus: {
		id: id(),
		label: __('Event Status', 'wds'),
		type: 'Text',
		source: 'options',
		value: 'EventScheduled',
		customSources: {
			options: {
				label: __('Event Status', 'wds'),
				values: {
					EventScheduled: __('Scheduled', 'wds'),
					EventMovedOnline: __('Moved Online', 'wds'),
					EventRescheduled: __('Rescheduled', 'wds'),
					EventPostponed: __('Postponed', 'wds'),
					EventCancelled: __('Cancelled', 'wds'),
				}
			},
		}
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
				source: 'image',
				value: ''
			}
		}
	},
	location: {
		id: id(),
		label: __('Location', 'wds'),
		type: 'Place',
		properties: Place
	},
	organizer: {
		id: id(),
		label: __('Organizer', 'wds'),
		type: 'Organization',
		properties: Organization
	},
	performer: {
		id: id(),
		label: __('Performers', 'wds'),
		label_single: __('Performer', 'wds'),
		properties: {
			0: {
				id: id(),
				type: 'Person',
				properties: Person
			}
		}
	},
	offers: {
		id: id(),
		label: __('Aggregate Offer', 'wds'),
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
						properties: EventOffer
					}
				}
			},
			AggregateOffer: {
				id: id(),
				type: 'AggregateOffer',
				label: __('Aggregate Offer', 'wds'),
				properties: AggregateOffer
			}
		}
	}
};

export default Event;
