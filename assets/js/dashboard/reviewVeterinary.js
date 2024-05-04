let rows = [];
let firstName =[];
let race = [];
let healthStatus = [];
let food = [];
let quantity = [];
let healthStatusDetails = [];
let name = [];
let date = [];

//On récupère les valeurs de chaque colonne pour chaque ligne du tableau
for (let i = 1; i < reviewVeterinaryTable.rows.length; i++) {
    let row = reviewVeterinaryTable.getElementsByTagName('tr')[i];
    firstName.push(row.getElementsByTagName('td')[0].innerHTML);
    race.push(row.getElementsByTagName('td')[1].innerHTML);
    healthStatus.push(row.getElementsByTagName('td')[2].innerHTML);
    food.push(row.getElementsByTagName('td')[3].innerHTML);
    quantity.push(row.getElementsByTagName('td')[4].innerHTML);
    healthStatusDetails.push(row.getElementsByTagName('td')[5].innerHTML);
    name.push(row.getElementsByTagName('td')[6].innerHTML);
    date.push(row.getElementsByTagName('td')[7].innerHTML); 
}


function dataDateDesc() {
    //On crée un tableau data avec les valeurs de chaque colonne pour chaque ligne du tableau
let data = [];
for (let i = 0; i < firstName.length && i < 10; i++) {
    //Pour chaque ligne du tableau, on crée un objet data avec les valeurs de chaque colonne
    data.push({firstName:firstName[i], race:race[i], healthStatus:healthStatus[i], food:food[i], quantity:quantity[i], healthStatusDetails:healthStatusDetails[i], name:name[i], date:date[i]});
    data.sort((a, b) => new Date(b.date) - new Date(a.date));   
}
return data;
}
data = dataDateDesc()

function dataDateAsc() {
    //On crée un tableau data avec les valeurs de chaque colonne pour chaque ligne du tableau
let data = [];
for (let i = 0; i < firstName.length && i < 10; i++) {
    //Pour chaque ligne du tableau, on crée un objet data avec les valeurs de chaque colonne
    data.push({firstName:firstName[i], race:race[i], healthStatus:healthStatus[i], food:food[i], quantity:quantity[i], healthStatusDetails:healthStatusDetails[i], name:name[i], date:date[i]});
    data.sort((a, b) => new Date(a.date) - new Date(b.date));   
}
return data;
}
//data = dataDateAsc()



//On crée les lignes du tableau
function pushRows(data) {
for (let i = 0; i < data.length; i++) {
    rows.push(`
    <tr>
    <td class="text-center">${data[i].firstName}</td>
    <td class="text-center">${data[i].race}</td>
    <td class="text-center">${data[i].healthStatus}</td>
    <td class="text-center">${data[i].food}</td>
    <td class="text-center">${data[i].quantity}</td>
    <td class="text-center">${data[i].healthStatusDetails}</td>
    <td class="text-center">${data[i].name}</td>
    <td class="text-center">${data[i].date}</td></tr>`);
}
}
pushRows(data);


//On ajoute les lignes dans le tableau
function showHtml(rows) {
    let reviewVeterinaryTable = document.getElementById('reviewVeterinaryTable');
    reviewVeterinaryTable.innerHTML = 
`<table>
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
};
showHtml(rows);
