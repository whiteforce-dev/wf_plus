@extends('master.master')
@section('title', 'Dashboard')
@section('content')
<style>
    /* Styles for the calendar container */
#calendar {
  font-family: Arial, sans-serif;
  margin: 20px auto;
  max-width: 600px;
  padding: 10px;
  text-align: center;
}

/* Styles for the calendar header */
.header {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

/* Styles for the calendar table */
table {
  border-collapse: collapse;
  width: 100%;
}

/* Styles for the calendar table cells */
td {
  border: 1px solid #ccc;
  padding: 5px;
  text-align: center;
}

/* Styles for the calendar table header cells */
th {
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  font-weight: bold;
  padding: 5px;
}

</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex flex-wrap align-items-center">
              <title>Calendar</title>
              <div id="calendar"></div>
        </div>
    </div>
</div>
<script>
    // Get the calendar container element
const calendarContainer = document.getElementById('calendar');

// Create a function to generate the calendar
function generateCalendar(year, month) {
  // Create a Date object for the specified year and month
  const date = new Date(year, month - 1);

  // Get the number of days in the month
  const daysInMonth = new Date(year, month, 0).getDate();

  // Get the day of the week for the first day of the month
  const startDay = new Date(year, month - 1, 1).getDay();

  // Create an array to store the calendar HTML
  const calendarHTML = [];

  // Generate the calendar header
  calendarHTML.push('<div class="header">' + date.toLocaleString('default', { month: 'long', year: 'numeric' }) + '</div>');
  calendarHTML.push('<table>');

  // Generate the calendar days
  calendarHTML.push('<tr>');
  calendarHTML.push('<th>Sun</th>');
  calendarHTML.push('<th>Mon</th>');
  calendarHTML.push('<th>Tue</th>');
  calendarHTML.push('<th>Wed</th>');
  calendarHTML.push('<th>Thu</th>');
  calendarHTML.push('<th>Fri</th>');
  calendarHTML.push('<th>Sat</th>');
  calendarHTML.push('</tr>');

  // Generate the empty cells for the days before the start day
  calendarHTML.push('<tr>');
  for (let i = 0; i < startDay; i++) {
    calendarHTML.push('<td></td>');
  }

  // Generate the calendar cells for each day
  for (let day = 1; day <= daysInMonth; day++) {
    calendarHTML.push('<td>' + day + '</td>');

    // Move to the next row if it's the last day of the week
    if ((startDay + day) % 7 === 0) {
      calendarHTML.push('</tr>');
      if (day < daysInMonth) {
        calendarHTML.push('<tr>');
      }
    }
  }

  // Close the remaining empty cells for the days after the last day
  while ((startDay + daysInMonth) % 7 !== 0) {
    calendarHTML.push('<td></td>');
    daysInMonth++;
  }

  calendarHTML.push('</table>');

  // Set the calendar HTML inside the container element
  calendarContainer.innerHTML = calendarHTML.join('');
}

// Call the generateCalendar function with the current year and month
const currentDate = new Date();
generateCalendar(currentDate.getFullYear(), currentDate.getMonth() + 1);

</script>

@endsection
