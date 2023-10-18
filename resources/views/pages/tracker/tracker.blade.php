<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


  <table class="table table-striped">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Date</th>
        <th>Position</th>
        <th>Name of the Candidate</th>
        <th>Mobile Number</th>
        <th>Email</th>
        <th>Current Location</th>
        <th>Total Exp</th>
        <th>Current CTC</th>
        <th>Exp CTC</th>
        <th>Notice Period</th>
        <th>REMARK</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($pipelines as $key => $tracker)
         <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ date('F, d Y')}}</td>
            <td>{{ $tracker->position->position_name }}</td>
            <td>{{ $tracker->candidate->name }}</td>
            <td>{{ $tracker->candidate->mobile }}</td>
            <td>{{ $tracker->candidate->email }}</td>
            <td>{{ $tracker->candidate->current_location }}</td>
            <td>{{ $tracker->candidate->experience == 'no' ? '0' : $tracker->total_experience }}</td>
            <td>{{ $tracker->candidate->current_salary }}</td>
            <td>{{ $tracker->candidate->expected_salary }}</td>
            <td>{{ $tracker->candidate->notice_period }}</td>
            <td>No Remark</td>
         </tr>
     @endforeach
    </tbody>
  </table>

</body>
</html>
