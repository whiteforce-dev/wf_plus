


<!DOCTYPE html>
<html lang="en">

<head>
    <title>About Position - </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    @php
        $location = $position->locations;
        $skills = $position->skillSet;
        $edu = $position->eduQualification;
        
        $clientname = \App\Models\Client::where(['id' => $position->client_id, 'software_category' => Auth::user()->software_category ?? 'onrole'])->first();
        // dd($clientname->name);
    @endphp

    <div class="container">
        
        <table class="table table-striped mt-5">
            <tr>
                    <td><b>Client</b></td>
                    <td>-</td>
                    <td>{{ ucwords($clientname->name ?? '') }}</td>
                </tr>
                <tr>
                    <td><b>Position</b></td>
                    <td>-</td>
                    <td>{{ ucwords($position->position_name) }}</td>
                </tr>
                <tr>
                    <td><b>No Of Openings</b></td>
                    <td>-</td>
                    <td>{{ $position->openings }}</td>
                </tr>
                <tr>
                    <td><b>Locations</b></td>
                    <td>-</td>
                   <td>{{ $position->city }}</td>
                </tr>
                <tr>
                    <td><b>Skill Set</b></td>
                    <td>-</td>
                    <td>{{ $position->skill_set }}</td>
                </tr>
                <tr>
                    <td><b>Job Description</b></td>
                    <td>-</td>
                    <td>{!! $position->job_description ?? '-' !!}</td>
                </tr>
                <tr>
                    <td><b>Experience</b></td>
                    <td>-</td>
                    <td>{{ $position->min_year_exp.' Years - '.$position->max_year_exp.' Years' }}</td>
                </tr>
               
                <tr>
                    <td><b>Job Type</b></td>
                    <td>-</td>
                    <td>{{$position->job_type }}</td>
                </tr>
                <tr>
                    <td><b>Industry</b></td>
                    <td>-</td>
                    <td>{{ $position->industry}}</td>
                </tr>
                <tr>
                    <td><b>Salary</b></td>
                    <td>-</td>
                    @php if($position->salary_type == 'USD'){
                         
                         $format = '$';
                    }
                    else{
                        $format = '₹';
                    }
                    @endphp
                    <td>{{ $format . $position->min_salary . '-' . $format .$position->max_salary }}</td>
                </tr>
               
                <tr>
                    <td><b>Gender</b></td>
                    <td>-</td>
                    <td>{{ $position->gender }}</td>
                </tr>
        </table>
    </div>

</body>

</html>
