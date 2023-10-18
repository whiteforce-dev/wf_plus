<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>White Force</title>
    <link rel="shortcut icon" href="https://white-force.com/mail_assets/whiteforcelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('assets/prescreening/pageAssets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/prescreening/pageAssets/css/style.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,500;1,600&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="row error-container mx-auto my-auto">
        <div class="error-img col-md-5">
            <img src="{{ url('assets/prescreening/pageAssets/img/pixar.jpeg') }}" alt="">
        </div>
        <div class="error-text col-md-5 text-start">
            <h1>
                Oops!!
            </h1>
            <h6>
                Something went wrong....!
                <hr>
                <span style="color:#c30202"><b>{{ $message }}</b></span>.
                @if(!empty($mail))
                <br>
                <br>
                <span>Executive Email Id : <b style="color:#2b529d">{{ $mail }}</b></span><br>
                <span>Executive Mobile Number : <b style="color:#2b529d">{{ $phone_number }}</b></span>
                @endif
            </h6>
            @if(!empty($action_button))
            <a href="{{ url()->previous() }}" class="btn button-74 mt-4">Go Back</a>
            <a href="https://white-force.com" class="btn button-74 mt-4 mx-4">White Force</a>
            @endif
        </div>
    </div>
</body>

</html>