const healthStatus = document.querySelectorAll('.healthStatus');

// Parcourir tous les éléments ayant la classe .healthStatus
healthStatus.forEach(status => {
  // Changer la classe d'un texte en fonction de sa valeur
  if (status.textContent === 'Etat: Bon') {
    status.classList.add('text-success');
  } else if (status.textContent === 'Etat: Moyen') {
    status.classList.add('text-warning');
  } else if (status.textContent === 'Etat: Mauvais') {
    status.classList.add('text-danger');
  } else {
    status.classList.add('text-body');
  }
});
