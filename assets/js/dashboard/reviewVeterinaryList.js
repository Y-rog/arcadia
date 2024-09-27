let rows = [];
let firstName =[];
let race = [];
let healthStatus = [];
let food = [];
let quantity = [];
let healthStatusDetails = [];
let name = [];
let date = [];
let nbRows = 0;
const firstNameCaret = document.getElementById('firstNameCaret');
const dateCaret = document.getElementById('dateCaret');
const raceCaret = document.getElementById('raceCaret'); 
const inputAnimalFirstName = document.getElementById('animalFirstName');
const inputFirstDate = document.getElementById('firstDate');
const inputLastDate = document.getElementById('lastDate');
const searchButton = document.getElementById('search');
const resetButton = document.getElementById('reset');

//On récupère les valeurs de chaque colonne pour chaque ligne du tableau
function getValues() {
for (let i = 1; i < reviewVeterinaryTable.rows.length; i++) {
    let row = reviewVeterinaryTable.getElementsByTagName('tr')[i];
    date.push(row.getElementsByTagName('td')[0].innerHTML);
    firstName.push(row.getElementsByTagName('td')[1].innerHTML);
    race.push(row.getElementsByTagName('td')[2].innerHTML);
    healthStatus.push(row.getElementsByTagName('td')[3].innerHTML);
    food.push(row.getElementsByTagName('td')[4].innerHTML);
    quantity.push(row.getElementsByTagName('td')[5].innerHTML);
    name.push(row.getElementsByTagName('td')[6].innerHTML);
    healthStatusDetails.push(row.getElementsByTagName('td')[7].innerHTML); 
}
}
getValues();



//On crée un tableau data avec les valeurs de chaque colonne pour chaque ligne du tableau
function getData(nbRows = reviewVeterinaryTable.rows.length +100) {
let data = [];
for (let i = 0; i < firstName.length && i <= nbRows; i++) {
    //Pour chaque ligne du tableau, on crée un objet data avec les valeurs de chaque colonne
    data.push({firstName:firstName[i], race:race[i], healthStatus:healthStatus[i], food:food[i], quantity:quantity[i], healthStatusDetails:healthStatusDetails[i], name:name[i], date:date[i]});
       
}
return data;
}

//On crée les lignes du tableau
function pushRows(data) {
for (let i = 0; i < data.length; i++) {
    rows.push(`<tr>
    <td class="text-center">${data[i].date}</td>
    <td class="text-center">${data[i].firstName}</td>
    <td class="text-center">${data[i].race}</td>
    <td class="text-center">${data[i].healthStatus}</td>
    <td class="text-center">${data[i].food}</td>
    <td class="text-center">${data[i].quantity}</td>
    <td class="text-center">${data[i].name}</td>
    <td class="text-center">${data[i].healthStatusDetails}</td>
</tr>`);
}
}

//On ajoute les lignes dans le tableau html
function showHtml(rows) {
    let reviewVeterinaryTableBody = document.getElementById('reviewVeterinaryTableBody');
    reviewVeterinaryTableBody.innerHTML = 
`<tbody id="reviewVeterinaryTableBody">
${rows.join('')}
</tbody>`;
};


/* les fonctions de filtre*/

let firstDate = inputFirstDate.value;
let lastDate = inputFirstDate.value;

//Fonction pour convertir une chaine de caractères 'dd/mm/yyyy' en objet Date au format 'yyyy-mm-dd'
function convertDate(date) {
    let dateArray = date.split('/');
    let newDate = new Date(dateArray[2], dateArray[1] - 1, dateArray[0]);
    return newDate;
}


//Fonction pour filtrer les données par prénom de l'animal
function filterFirstName() {
    let data = getData();
    let filter = inputAnimalFirstName.value.toUpperCase();
    data = data.filter((item) => item.firstName.toUpperCase().includes(filter));
    return data;
}

//Fonction pour filtrer les données par date de l'avis
function filterDate() {
    let data = getData();
    //On converti les dates au format ("dd/mm/yyyy") au format (yyyy-mm-dd) pour pouvoir les comparer
    data.forEach((item) => {
        let date = item.date.split('/');
        item.date = `${date[2]}-${date[1]}-${date[0]}`;
    });
    firstDate = convertDate(inputFirstDate.value);
    lastDate = convertDate(inputLastDate.value);
    lastDate.setDate(lastDate.getDate() + 1);
    data = data.filter((item) => new Date(item.date) >= firstDate && new Date(item.date) <= lastDate);
    //On reconverti les dates au format (yyyy-mm-dd) au format ("dd/mm/yyyy") pour les afficher
    data.forEach((item) => {
        let date = item.date.split('-');
        item.date = `${date[2]}/${date[1]}/${date[0]}`;
    });
    return data;
}

//Fonction pour filtrer les données par prénom de l'animal et date de l'avis
function filterFirstNameAndDate() {
    let data = getData();
    //On converti les dates au format ("dd/mm/yyyy") au format (yyyy-mm-dd) pour pouvoir les comparer
    data.forEach((item) => {
        let date = item.date.split('/');
        item.date = `${date[2]}-${date[1]}-${date[0]}`;
    });
    firstDate = convertDate(inputFirstDate.value);
    lastDate = convertDate(inputLastDate.value);
    lastDate.setDate(lastDate.getDate() + 1);
    let filter = inputAnimalFirstName.value.toUpperCase();
    data = data.filter((item) => item.firstName.toUpperCase().includes(filter) && new Date(item.date) >= firstDate && new Date(item.date) <= lastDate);
    //On reconverti les dates au format (yyyy-mm-dd) au format ("dd/mm/yyyy") pour les afficher
    data.forEach((item) => {
        let date = item.date.split('-');
        item.date = `${date[2]}/${date[1]}/${date[0]}`;
    });
    return data;
}

//Fonction pour afficher les données filtrées
function showFilteredData() {
    if (inputAnimalFirstName.value === '' && inputFirstDate.value === '' && inputLastDate.value === '') {
        data = getData();
    } else if (inputAnimalFirstName.value !== '' && inputFirstDate.value === '' && inputLastDate.value === '') {
        data = filterFirstName();
    }
    else if (inputAnimalFirstName.value === '' && inputFirstDate.value !== '' && inputLastDate.value !== '') {
        data = filterDate();
    } else if (inputAnimalFirstName.value !== '' && inputFirstDate.value !== '' && inputLastDate.value !== '') {
        data = filterFirstNameAndDate();
    }
    rows = [];
    pushRows(data);
    showHtml(rows);
}

/*Les fonctions de tries

Fonction pour trier les données par date de l'avis dans l'order croissant*/
function dataDateAsc() {
    data = getData();
    showFilteredData();
    //On converti les dates au format ("dd/mm/yyyy") au format (yyyy-mm-dd) pour pouvoir les comparer
    data.forEach((item) => {
        let date = item.date.split('/');
        item.date = `${date[2]}-${date[1]}-${date[0]}`;
    });
    data.sort((a, b) => new Date(a.date)- new Date(b.date));
    //On reconverti les dates au format (yyyy-mm-dd) au format ("dd/mm/yyyy") pour les afficher
    data.forEach((item) => {
        let date = item.date.split('-');
        item.date = `${date[2]}/${date[1]}/${date[0]}`;
    });
    return data;
}

//Fonction pour trier les données par date de l'avis dans l'ordre décroissant
function dataDateDesc() {
    data = getData();
    showFilteredData();
    //On converti les dates au format ("dd/mm/yyyy") au format (yyyy-mm-dd) pour pouvoir les comparer
    data.forEach((item) => {
        let date = item.date.split('/');
        item.date = `${date[2]}-${date[1]}-${date[0]}`;
    });
    data.sort((a, b) => new Date(b.date) - new Date(a.date));
    //On reconverti les dates au format (yyyy-mm-dd) au format ("dd/mm/yyyy") pour les afficher
    data.forEach((item) => {
        let date = item.date.split('-');
        item.date = `${date[2]}/${date[1]}/${date[0]}`;
    });
    return data;
}



//Fonction pour trier les données par prénom de l'animal dans l'ordre croissant
function dataFirstNameAsc() {
    data = getData();
    showFilteredData();
    data.sort((a, b) => (a.firstName).localeCompare(b.firstName));
    return data;
}

//Fonction pour trier les données par prénom de l'animal dans l'ordre décroissant
function dataFirstNameDesc() {  
    data = getData();
    showFilteredData();
    data.sort((a, b) => (b.firstName).localeCompare(a.firstName));
    return data;
}

//Fonction pour trier les données par race dans l'ordre croissant
function dataRaceAsc() {
    data = getData();
    showFilteredData();
    data.sort((a, b) => (a.race).localeCompare(b.race));
    return data;
}

//Fonction pour trier les données par race dans l'ordre décroissant
function dataRaceDesc() {
    data = getData();
    showFilteredData();
    data.sort((a, b) => (b.race).localeCompare(a.race));
    return data;
}
//Fonction afficher les données par date de l'avis au clic sur la flèche
dateCaret.addEventListener('click', function() {
    if (dateCaret.className === 'bi bi-caret-down-fill') {
        data = dataDateAsc();
        rows = [];
        pushRows(data);
        showHtml(rows);
        dateCaret.className = 'bi bi-caret-up-fill';
    } else {
        data = dataDateDesc();
        rows = [];
        pushRows(data);
        showHtml(rows);
        dateCaret.className = 'bi bi-caret-down-fill';
        
    }
});

//Fonction afficher les données par prénom de l'animal au clic sur la flèche
firstNameCaret.addEventListener('click', function() {
    if (firstNameCaret.className === 'bi bi-caret-down-fill') {
        data = dataFirstNameAsc();
        rows = [];
        pushRows(data);
        showHtml(rows);
        firstNameCaret.className = 'bi bi-caret-up-fill';
    } else {
        data = dataFirstNameDesc();
        rows = [];
        pushRows(data);
        showHtml(rows);
        firstNameCaret.className = 'bi bi-caret-down-fill';
    }
});

//Fonction afficher les données par race de l'animal au clic sur la flèche
raceCaret.addEventListener('click', function() {
    if (raceCaret.className === 'bi bi-caret-down-fill') {
        data = dataRaceAsc();
        rows = [];
        pushRows(data);
        showHtml(rows);
        raceCaret.className = 'bi bi-caret-up-fill';
    } else {
        data = dataRaceDesc();
        rows = [];
        pushRows(data);
        showHtml(rows);
        raceCaret.className = 'bi bi-caret-down-fill';
    }
});


//Afficher les donéées apèr filtre et tri
function showFilteredAndSortedData() {
    showFilteredData();
    showHtml(rows);
}

//On affiche les données filtrées et triées au clic sur le bouton "Filtrer"
searchButton.addEventListener('click', showFilteredAndSortedData);  
    

//On réaffiche les données initiales au clic sur le bouton "Réinitialiser"
resetButton.addEventListener('click', function() {
    window.location.reload();
});







