import React from 'react';
import {render} from 'react-dom';
import SchemaBuilder from "./components/schema-builder";
import $ from 'jQuery';

$(document).ready(() => {
	render(
		<SchemaBuilder/>,
		document.getElementById('wds-schema-type-components')
	);
});
