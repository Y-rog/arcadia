const tableReviewVeterinary = document.getElementById('reviewVeterinaryTable');
let row = tableReviewVeterinary.getElementsByTagName('tr')[1];
let firstName = []; 
let date = [];
let race = [];
const caretFirstName = document.getElementById('caretFirstName');
const caretRace = document.getElementById('caretRace');
const caretDate = document.getElementById('caretDate');


for (let i = 1; i < tableReviewVeterinary.rows.length; i++) {
    row = tableReviewVeterinary.getElementsByTagName('tr')[i];
    firstName.push(row.getElementsByTagName('td')[0].innerHTML);
    race.push(row.getElementsByTagName('td')[1].innerHTML);
    date.push(row.getElementsByTagName('td')[7].innerHTML);
}




console.log(firstName);
console.log(date);
console.log(race);

