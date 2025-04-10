function showOverlay(text) {
  let content = '';

  switch (text) {
    case 'Student overview':
      content = 'Title: Student Overview\nContent:\n- Name: John Doe\n- Program: Bachelor of Science in Computer Science\n- Year: 3rd Year\n- Progress: 75% completed\n- Notes: Keep up the good work!';
      break;
    case 'Assessment report':
      content = 'Title: Assessment Report\nContent:\n- Latest Grade: A\n- Feedback: Excellent performance in the last assessment.\n- Areas of Improvement: Focus on time management.\n- Next Assessment: April 25, 2025';
      break;
    case 'Logbook tracker':
      content = 'Title: Logbook Tracker\nContent:\n- Total Entries: 15\n- Last Updated: April 10, 2025\n- Pending Entries: 3\n- Notes: Ensure all entries are submitted by the end of the week.';
      break;
    case 'Reminders':
      content = 'Title: Reminders\nContent:\n- Submit weekly report by April 12, 2025.\n- Attend the team meeting on April 13, 2025.\n- Prepare for the upcoming assessment.';
      break;
    case 'Upcoming visit':
      content = 'Title: Upcoming Visit\nContent:\n- Date: April 20, 2025\n- Time: 10:00 AM\n- Location: Company Headquarters\n- Agenda: Progress review and feedback session.';
      break;
    default:
      content = 'No content available.';
  }

  document.getElementById('overlay-text').innerText = content;
  document.getElementById('overlay').style.display = 'flex';
}

function closeOverlay() {
  document.getElementById('overlay').style.display = 'none';
}