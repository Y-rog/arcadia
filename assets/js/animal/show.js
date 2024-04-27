const textHealthStatus = document.getElementById('healthStatus');

// Changer la classe d'un texte en fonction de sa valeur
if (textHealthStatus) {
  if (textHealthStatus.textContent === 'Etat: Bon') {
    textHealthStatus.classList.add('text-success');
  } else if (textHealthStatus.textContent === 'Etat: Moyen') {
    textHealthStatus.classList.add('text-warning');
  } else if (textHealthStatus.textContent === 'Etat: Mauvais') {
    textHealthStatus.classList.add('text-danger');
  } else {
    textHealthStatus.classList.add('text-body');
  }
}




