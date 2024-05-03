
(async () => {
  const table = document.getElementById('animalViewsTable');
let row = table.getElementsByTagName('tr')[1];
let firstName = [];
let views = [];

for (let i = 1; i < table.rows.length; i++) {
  row = table.getElementsByTagName('tr')[i];
  firstName.push(row.getElementsByTagName('td')[0].innerHTML);
  views.push(row.getElementsByTagName('td')[2].innerHTML);
}
let data = [];
for (let i = 0; i < firstName.length && i < 10; i++) {
  data.push({firstName: firstName[i], views: views[i]});
}
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





  


