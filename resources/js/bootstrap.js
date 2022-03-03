window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

window.io = require('socket.io-client');


window.socket=io('http://localhost:3000', {
    withCredentials: false,
    extraHeaders: {
        "x-schubwerk-token": "test"
    }
})

socket.on('dacsonline_database_maps.1:maps.1',function(data){
    console.log(data)
    console.log('i got reached');
})
//
// test.emit('test.message','testingmessage')

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001' // this is laravel-echo-server host
// });
// window.Echo.channel('dacsonline_database_maps')
//     .listen('App\\Events\\PlayerMoved', (event) => {
//         console.log(event);
//     });
// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
