
const tableReviewVeterinary = document.getElementById('reviewVeterinaryTable');
const tableReviewVeterinary2 = document.getElementById('reviewVeterinaryTable2');   
let row = tableReviewVeterinary.getElementsByTagName('tr')[1];
let rows = [];
let firstName =[];
let race = [];
let healthStatus = [];
let food = [];
let quantity = [];
let healthStatusDetails = [];
let name = [];
let date = [];

for (let i = 1; i < tableReviewVeterinary.rows.length; i++) {
    row = tableReviewVeterinary.getElementsByTagName('tr')[i];
    firstName.push(row.getElementsByTagName('td')[0].innerHTML);
    race.push(row.getElementsByTagName('td')[1].innerHTML);
    healthStatus.push(row.getElementsByTagName('td')[2].innerHTML);
    food.push(row.getElementsByTagName('td')[3].innerHTML);
    quantity.push(row.getElementsByTagName('td')[4].innerHTML);
    healthStatusDetails.push(row.getElementsByTagName('td')[5].innerHTML);
    name.push(row.getElementsByTagName('td')[6].innerHTML);
    date.push(row.getElementsByTagName('td')[7].innerHTML); 
}


let data = [];
for (let i = 0; i < firstName.length && i < 10; i++) {
    //Pour chaque ligne du tableau, on crée un objet data avec les valeurs de chaque colonne
    data.push({firstName:firstName[i], race:race[i], healthStatus:healthStatus[i], food:food[i], quantity:quantity[i], healthStatusDetails:healthStatusDetails[i], name:name[i], date:date[i]});
    console.log(data);
    //Pour chaque objet data, on crée une ligne dans le tableau
    rows.push(`
    <tr> 
    <td class="text-center">${firstName[i]}</td>
    <td class="text-center">${race[i]}</td>
    <td class="text-center">${healthStatus[i]}</td>
    <td class="text-center">${food[i]}</td>
    <td class="text-center">${quantity[i]}</td>
    <td class="text-center">${healthStatusDetails[i]}</td>
    <td class="text-center">${name[i]}</td>
    <td class="text-center">${date[i]}</td></tr>`);
    
    console.log(rows);
    //On ajoute les lignes dans le tableau
    tableReviewVeterinary2.innerHTML = `<table>
                <thead>
                        <tr>
                        <th class="text-center px-3" scope="col">Prénom de l'animal <i id="firstNameCaret" class="bi bi-caret-up-fill"></i></th>
                        <th class="text-center px-3" scope="col">Race <i id="raceCaret" class="bi bi-caret-up-fill"></i></th>
                        <th class="text-center px-3" scope="col">Status de santé</th>
                        <th class="text-center px-3" scope="col">Nourriture proposée</th>
                        <th class="text-center px-3" scope="col">Quantité</th>
                        <th class="text-center px-3" scope="col">Détails</th>
                        <th class="text-center px-3" scope="col">Vétérinaire</th>
                        <th class="text-center px-3" scope="col">Date de l'avis<i id="dateCaret" class="bi bi-caret-up-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    
                    ${rows}
                    
                </tbody>
            </table>`;


}





/*const firstNameCaret = document.getElementById('firstNameCaret');
const raceCaret = document.getElementById('raceCaret');
const dateCaret = document.getElementById('dateCaret');

firstNameCaret.addEventListener('click', () => {
        firstNameCaret.classList.toggle('bi-caret-down-fill');
        firstNameCaret.classList.toggle('bi-caret-up-fill');
});

raceCaret.addEventListener('click', () => {
    raceCaret.classList.toggle('bi-caret-down-fill');
    raceCaret.classList.toggle('bi-caret-up-fill');
});

dateCaret.addEventListener('click', () => {
    dateCaret.classList.toggle('bi-caret-down-fill');
    dateCaret.classList.toggle('bi-caret-up-fill');
}); */
    

//Afficher les avis vétérinaires



