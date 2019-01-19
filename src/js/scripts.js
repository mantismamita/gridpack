const FontFaceObserver = require('fontfaceobserver');

const titleFont = new FontFaceObserver('Roboto Slab');
const html = document.documentElement;

titleFont.load().then(function () {
    html.classList.add('fonts-loaded');
    sessionStorage.fontsLoaded = true
}).catch(function () {
    sessionStorage.fontsLoaded = false
    console.warn('font-loading problem')
});

