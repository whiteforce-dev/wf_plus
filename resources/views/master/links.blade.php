<link rel="stylesheet" href="{{ url('assets') }}/vendor/chartist/css/chartist.min.css">
<link href="{{ url('assets') }}/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">



<link href="{{ url('assets') }}/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="{{ url('assets') }}/vendor/toastr/css/toastr.min.css">
<link rel="stylesheet" href="{{ url('assets') }}/vendor/select2/css/select2.min.css">
<link href="{{ url('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">




<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"
    integrity="sha512-24XP4a9KVoIinPFUbcnjIjAjtS59PUoxQj3GNVpWc86bCqPuy3YxAcxJrxFCxXe4GHtAumCbO2Ze2bddtuxaRw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
    rel="stylesheet">


    <script>
        function inc_format(num) {
            let explrestunits = "";
            num = Math.abs(num).toString();

            if (num.length > 3) {
                const lastthree = num.slice(-3);
                let restunits = num.slice(0, -3);
                restunits = restunits.length % 2 === 1 ? "0" + restunits : restunits;
                const expunit = restunits.match(/.{1,2}/g);

                for (let i = 0; i < expunit.length; i++) {
                    if (i === 0) {
                        explrestunits += parseInt(expunit[i]) + ",";
                    } else {
                        explrestunits += expunit[i] + ",";
                    }
                }

                const thecash = explrestunits + lastthree;
                return thecash;
            } else {
                return num;
            }
        }
    </script>