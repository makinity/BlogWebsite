import './bootstrap';
import Alpine from 'alpinejs';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Alpine = Alpine;

Alpine.start();

// Initialize Pusher/Echo for real-time features
if (
    import.meta.env.VITE_PUSHER_APP_KEY && 
    import.meta.env.VITE_PUSHER_APP_CLUSTER
) {
    window.Pusher = Pusher;

    // Use the environment variables from your .env file
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
        wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
        wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
        forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
        enabledTransports: ['ws', 'wss'],
    });

    console.log("[Pusher/Echo] Real-time services initialized.");

} else {
    console.error("Pusher environment variables (VITE_PUSHER_APP_KEY/CLUSTER) not found. Real-time features disabled.");
}
