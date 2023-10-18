{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    function findstate() {
        var countryId = $('#country').val();
        $.get("{{ url('statelist') }}", {
            country: countryId,
        }, function(response) {
            $('#state').html(response);
        });
    };
    //end function//
    function findcity() {
        var stateId = $('#state').val();
        $.get("{{ url('citylist') }}", {
            state: stateId,
        }, function(response) {
            $('#city').html(response);
        });
    };
    //end function
</script>
