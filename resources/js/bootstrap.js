window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

 window.Swal = require('sweetalert2');


window.axios = require('axios');

window.axios.defaults.headers.common['Accept'] = 'application/json';
window.axios.defaults.headers.common['Authorization'] =localStorage.getItem('token');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
const userId=localStorage.getItem('userId');
const token=localStorage.getItem('token');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '3865e8ca95b47dd99a86',
    cluster: 'us2',
    encrypted:true,
    authHost: "http://127.0.0.1:8000/broadcasting/auth",
    authEndpoint: "/broadcasting/auth", 
    wsPort: 8000,
    forceTLS: true,
        auth: {
        headers: {
            Authorization: token
        }
    }
});
// window.Echo = new Echo({
//     authEndpoint : 'http://127.0.0.1:8000/public/broadcasting/auth',
//      broadcaster: 'pusher',
//      key: '3865e8ca95b47dd99a86',
//      cluster: 'us2',
//      encrypted: true
//  });

// window.Echo.private('App.User.' + userId)
//     .notification((notification) => {
//         console.log(notification);
//     });

// import Echo from 'laravel-echo';
 
// window.Pusher = require('pusher-js');
 
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '3865e8ca95b47dd99a86',
//     cluster: 'us2',
//     forceTLS: true,
//             auth: {
//         headers: {
//             Authorization: token
//         }
//     }
// });



// window.Echo.private('App.User.' + userId)
//     .notification((notification) => {
//         console.log(notification);
//     });