/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

import fetchData from './fetch';
import * as alert from './alert';

const ApiService = {
    fetchData,
    alert
}

window.ApiService = ApiService;
