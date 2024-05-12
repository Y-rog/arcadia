const homelinkHome = document.getElementById('home');
const homelinkHabitat = document.getElementById('habitat');
const homelinkService = document.getElementById('service');
const homelinkContact = document.getElementById('contact');
const homelinkDashboard = document.getElementById('dashboard');
const homelinkLogin = document.getElementById('login');


if (window.location.href.indexOf('home') > -1) {
    homelinkHome.classList.add('active');
} else if (window.location.href.indexOf('habitat') > -1) {
    homelinkHabitat.classList.add('active');
}
else if (window.location.href.indexOf('service') > -1) {
    homelinkService.classList.add('active');
}
else if (window.location.href.indexOf('contact') > -1) {
    homelinkContact.classList.add('active');
}
else if (window.location.href.indexOf('dashboard') > -1) {
    homelinkDashboard.classList.add('active');
}
else if (window.location.href.indexOf('login') > -1) {
    homelinkLogin.classList.add('active');
} else {
    homelinkHome.classList.add('active');
}














