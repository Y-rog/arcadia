const homelinkHome = document.getElementById('home');
const homelinkAbout = document.getElementById('habitat');
const homelinkServices = document.getElementById('service');
const homelinkContact = document.getElementById('contact');
const homelinkGallery = document.getElementById('login');


if (window.location.href.indexOf('home') > -1) {
    homelinkHome.classList.add('active');
} else if (window.location.href.indexOf('habitat') > -1) {
    homelinkAbout.classList.add('active');
}
else if (window.location.href.indexOf('service') > -1) {
    homelinkServices.classList.add('active');
}
else if (window.location.href.indexOf('contact') > -1) {
    homelinkContact.classList.add('active');
}
else if (window.location.href.indexOf('login') > -1) {
    homelinkGallery.classList.add('active');
} else {
    homelinkHome.classList.add('active');
}














