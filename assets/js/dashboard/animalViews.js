// On crée une fonction asynchrone pour récupérer les données du tableau et les afficher dans un graphique
(async () => {
const table = document.getElementById('animalViewsTable');
let row = table.getElementsByTagName('tr')[1];
let firstName = [];
let views = [];
//On récupère les données du tableau
for (let i = 1; i < table.rows.length; i++) {
  row = table.getElementsByTagName('tr')[i];
  firstName.push(row.getElementsByTagName('td')[0].innerHTML);
  views.push(row.getElementsByTagName('td')[2].innerHTML);
}
//On initialise notre tableau de données
let data = [];
//On limite le nombre de données à 10 et on les stocke dans un tableau
for (let i = 0; i < firstName.length && i < 10; i++) {
  data.push({firstName: firstName[i], views: views[i]});
}
//On crée un graphique avec les données récupérées
new Chart(
  document.getElementById('animalViews'),
  {
    type: 'bar',
    data: {
      labels: data.map(row => row.firstName),
      datasets: [
        {
          label: 'Vues par animal',
          data: data.map(row => row.views),
          backgroundColor: '#4CAF7A'
        }
      ]
    }
  }
);
})();





  


