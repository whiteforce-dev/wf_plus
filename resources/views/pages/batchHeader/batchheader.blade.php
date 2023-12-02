<!DOCTYPE html>
<html>
<head>
    <title>Batch Header</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:400,700&display=swap" rel="stylesheet">
    <!-- Add the Google Fonts link -->
    <style>
        /* CSS for the page body */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            /* Enable flexbox */
            justify-content: center;
            /* Center content horizontally */
            align-items: center;
            /* Center content vertically */
            /* min-height: 297mm; */
            height: 96vh;
            /* A4 height */
            background: linear-gradient(to left, #f5f5f5 50%, #312fa3 50%);
            /* Gradient background */
            font-family: 'Roboto', sans-serif;
            /* Apply the font to the body */

        }

        /* CSS for the card container */
        .card-container {
            background-color: #ffffff;
            /* White background */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Box shadow */
            padding: 20px;
            /* Padding around the card */
            width: 80%;
            /* Adjust the card width as needed */
        }

        /* CSS for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;

        }

        .footer-th {
            background-color: #312fa3;
            color: white;
            text-align: center !important;
            padding: 10px;
            border: none !important;


        }

        .section-header {
            font-weight: bold;
            font-size: 18px;
        }

        .logo {
            position: absolute;
            /* Position the logo */
            top: 30px;
            /* Adjust the top position as needed */
            left: 30px;
            /* Adjust the right position as needed */
            height: 80px;
            /* filter: drop-shadow(3px 3px 5px  #777) */
        }

        .address {
            position: absolute;
            /* Position the logo */
            bottom: 30px;
            /* Adjust the top position as needed */
            left: 30px;
            /* Adjust the right position as needed */
            height: 80px;
            /* filter: drop-shadow(3px 3px 5px #777) */
        }

        /* CSS for the footer */
        .footer {
            position: absolute;
            /* Position the footer */
            bottom: 20px;
            /* Adjust the bottom position as needed */
            left: 50%;
            /* Position the footer in the center horizontally */
            transform: translateX(-50%);
            /* Center the footer horizontally */
            text-align: center;
            /* Center the text within the footer */
            width: 100%;
            /* Set the width to 100% */
        }

        /* CSS for the logo container */
        .logo-container {
            display: flex;
            justify-content: center;
            /* Center the logos horizontally */
            margin-top: 20px;
        }

        /* CSS for individual logos */
        .logo-item {
            margin: 10px;
            /* Adjust the margin as needed */
        }

    </style>
</head>

<body>
    <img src="https://white-force.com/assets/img/white-force-logo.png" alt="Logo" class="logo">
    <div class="card-container" align="center" style="margin-left: 50px; margin-top:50px">
        <h2 style="text-align: center;">Resume Summary</h2>
        <!-- Replace "logo.png" with your logo image source -->

        <table>
            <tr>
                <th class="section-header" colspan="2">Personal Information</th>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{ ucwords(strtolower($candidate->name)) }}</td>
            </tr>
            <tr>
                <td>Sourced For:</td>
                <td>{{ ucwords(strtolower($position->position_name)) }}</td>
            </tr>
            <tr>
                <td>Current Location:</td>
                <td>{{ ucwords(strtolower($candidate->current_location)) }}</td>
            </tr>
            <tr>
                <td>Age:</td>
                <td>{{ !empty($candidate->date_of_birth) ? (date('Y') - date('Y',strtotime($candidate->date_of_birth))) : '-' }}</td>
            </tr>
            <tr>
                <td>Language:</td>
                <td>{{ $candidate->languages }}</td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>{{ ucwords(strtolower($candidate->gender)) }}</td>
            </tr>
            <tr>
                <td>Candidate Rating:</td>
                <td>
                    @for($i = 1; $i <= $candidate->rating; $i++)
                        @if($i <= $candidate->rating)
                            <img src="https://white-force.com/plus/batch_header/star_images/icons8-star-64.png" width="20" />&nbsp;
                        @endif
                    @endfor
                </td>
            </tr>
            <tr>
                <th class="section-header" colspan="2">Work Experience</th>
            </tr>
            <tr>
                <td>Company:</td>
                <td>{{ ucwords(strtolower($candidate->current_company)) }}</td>
            </tr>
            <tr>
                <td>Position:</td>
                <td>{{ ucwords(strtolower($candidate->current_title)) }}</td>
            </tr>

            <tr>
                <td>Current Salary:</td>
                <td>{{  ucwords(strtolower($candidate->current_salary)) }}</td>
            </tr>
            <tr>
                <td>Expected Salary:</td>
                <td>{{ $candidate->expected_salary }}</td>
            </tr>
            <tr>
                <td>Total Experience:</td>
                <td>{{ $candidate->total_experience }}</td>
            </tr>
            <tr>
                <td>Notice Period:</td>
                <td>{{$candidate->notice_period}}</td>
            </tr>

            <tr>
                <th class="section-header" colspan="2">Education</th>
            </tr>
            <tr>
                <td>Degree:</td>
                <td>{{ $candidate->highest_qualification }}</td>
            </tr>
            <tr>
                <td>Year of Graduation:</td>
                <td>{{ $candidate->highest_qualification_year }}</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td colspan="2" class="footer-th">© 2022 White Force.All rights reserved.</td>
            </tr>
        </table>
    </div>
</body>

</html>
