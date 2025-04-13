function showOverlay(text) {

  switch (text) {
    case 'Student overview':
      // TODO: Add logic to fetch and display student overview data
      break;
    case 'Assessment report':
      // TODO: Add logic to fetch and display assessment report data
      break;
    case 'Logbook tracker':
      // TODO: Add logic to fetch and display logbook tracker data
      break;
    case 'Reminders':
      // TODO: Add logic to fetch and display reminders data
      break;
    case 'Upcoming visit':
      // TODO: Add logic to fetch and display upcoming visit data
      break;
    case 'Logbooks':
      overlay = document.getElementById('logbooks');
      break;
    case 'Assessment reports':
      overlay = document.getElementById('reports');
      break;
    default:
      content = 'No content available.';
  }

  overlay.style.display = 'flex';
}

function closeOverlay() {
  const overlays = document.querySelectorAll('.overlay');
  overlays.forEach((overlay) => {
    overlay.style.display = 'none';
  });
}