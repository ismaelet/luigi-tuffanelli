function api_call(hroot, method, item, id = false, parameters = {}) {

	const debug = false;
	let url;
	let options;

	//generate url
	if (id) {
		url = hroot + '/api/' + item + '/' + id;
	} else {
		url = hroot + '/api/' + item;
	}

	if (method == 'GET') {
		url = url + '?' + (new URLSearchParams(parameters));
		options = {};
	} else {
		options = {
			'method': method,
			'body': JSON.stringify(parameters)
		};
	}

	//fetch the result
	return fetch(url, options)
	.then((response) => {

		if (debug) {
			return response.text();
		} else {
			return response.json();
		}

	})
	.catch(error => {
		console.error(error);
	});

}