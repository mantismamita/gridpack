const staticCacheName = 'staticfiles';

const cacheArr= [
    '/wp-content/themes/gridpack/dist/css/home.css',
    '/wp-includes/css/dist/block-library/style.css'
]

self.addEventListener('install', installEvent => {
    installEvent.waitUntil(
        caches.open(staticCacheName)
            .then( staticCache => {
                staticCache.addAll(cacheArr)
            }) // end open then
    ); // end waitUntil
});

self.addEventListener('activate', e => {
    console.log('The service worker is activated.');
});
self.addEventListener('fetch', fetchEvent => {
    const request= fetchEvent.request
    fetchEvent.respondWith(
        fetch(request)
            .then( responseFromFetch => {
                return responseFromFetch;
            })
            .catch(error => {
                return new Response(
                    '<h1>Oops!</h1> <p>Something went wrong.</p>',
                    {
                        headers: {'Content-type': 'text/html; charset=utf-8'}
                    }
                );
            })
    );
});