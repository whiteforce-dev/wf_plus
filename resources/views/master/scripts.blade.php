
 <script src="{{ url('assets') }}/vendor/global/global.min.js"></script>
 <script src="{{ url('assets') }}/js/custom.js"></script>


 <script src="https://kit.fontawesome.com/757343f716.js" crossorigin="anonymous"></script>

 <script src="{{ url('assets') }}/vendor/toastr/js/toastr.min.js"></script>
 <script src="{{ url('assets') }}/js/plugins-init/toastr-init.js"></script>
 <script>
    function errorMsg(msg){
        toastr.error("Error", msg, {
             positionClass: "toast-bottom-center",
             timeOut: 5e3,
             closeButton: !0,
             debug: !1,
             newestOnTop: !0,
             progressBar: !0,
             preventDuplicates: !0,
             onclick: null,
             showDuration: "300",
             hideDuration: "1000",
             extendedTimeOut: "1000",
             showEasing: "swing",
             hideEasing: "linear",
             showMethod: "fadeIn",
             hideMethod: "fadeOut",
             tapToDismiss: !1
         })
    }
    function successMsg(msg){
        toastr.success("Success", msg, {
             positionClass: "toast-bottom-center",
             timeOut: 5e3,
             closeButton: !0,
             debug: !1,
             newestOnTop: !0,
             progressBar: !0,
             preventDuplicates: !0,
             onclick: null,
             showDuration: "300",
             hideDuration: "1000",
             extendedTimeOut: "1000",
             showEasing: "swing",
             hideEasing: "linear",
             showMethod: "fadeIn",
             hideMethod: "fadeOut",
             tapToDismiss: !1
         })
    }
 </script>
 @if (session()->has('success'))
     <script>
         toastr.success("Success", "{{ session()->get('success') }}", {
             positionClass: "toast-bottom-center",
             timeOut: 5e3,
             closeButton: !0,
             debug: !1,
             newestOnTop: !0,
             progressBar: !0,
             preventDuplicates: !0,
             onclick: null,
             showDuration: "5000",
             hideDuration: "1000",
             extendedTimeOut: "1000",
             showEasing: "swing",
             hideEasing: "linear",
             showMethod: "fadeIn",
             hideMethod: "fadeOut",
             tapToDismiss: !1
         })
     </script>
 @endif
 @if (session()->has('error'))
     <script>
         toastr.error("Error", "{{ session()->get('error') }}", {
             positionClass: "toast-bottom-center",
             timeOut: 5e3,
             closeButton: !0,
             debug: !1,
             newestOnTop: !0,
             progressBar: !0,
             preventDuplicates: !0,
             onclick: null,
             showDuration: "300",
             hideDuration: "1000",
             extendedTimeOut: "1000",
             showEasing: "swing",
             hideEasing: "linear",
             showMethod: "fadeIn",
             hideMethod: "fadeOut",
             tapToDismiss: !1
         })
     </script>
 @endif

 <script src="{{ url('/') }}/assets/vendor/select2/js/select2.full.min.js"></script>
 <script>
     $(".single-select").select2();

     $(document).on("select2:open", () => {
         setTimeout(function() {
             document.querySelector(".select2-container--open .select2-search__field").focus();
         }, 10);

     })
 </script>

 <script>
    feather.replace()
</script>

@php
  $curMonth = date("m", time());
  $curQuarter = ceil($curMonth/3);

  if($curQuarter == 1) {
    $endDate = '31 March, '.date('Y').' 23:59:59';
  }
  if($curQuarter == 2) {
    $endDate = '30 June, '.date('Y').' 23:59:59';
  }
  if($curQuarter == 3) {
    $endDate = '30 September, '.date('Y').' 23:59:59';
  }
  if($curQuarter == 4) {
    $endDate = '31 December, '.date('Y').' 23:59:59';
  }

 
@endphp


<script>
  const main = () => {
  const second = 1000;
  const minute = second * 60;
  const hour = minute * 60;
  const day = hour * 24;
  const quarter = {{ Js::from($curQuarter) }};
  $('.timer-text').text('QUARTER '+quarter+' ENDS IN');

  //INSERT EVENT DATE AND TIME HERE IN THIS FORMAT: 'June 1, 2023, 19:00:00'
  const EVENTDATE = new Date({{ Js::from($endDate) }});
  const countDown = new Date(EVENTDATE).getTime();
  const x = setInterval(() => {
    const now = new Date().getTime();
    const distance = countDown - now;

    var calday = Math.floor(distance / day);
    var cday = calday;
    if(parseInt(cday) < 11){
      $('#days').css("color", 'red');
      $('#hours').css("color", 'red');
      $('#minutes').css("color", 'red');
      $('#seconds').css("color", 'red');
    }
    document.getElementById("days").innerText = cday;
    document.getElementById("hours").innerText = Math.floor(
      (distance % day) / hour
    );
    document.getElementById("minutes").innerText = Math.floor(
      (distance % hour) / minute
    );
    document.getElementById("seconds").innerText = Math.floor(
      (distance % minute) / second
    );

  }, 0);
};

main();


openPopupForUpdate();
function openPopupForUpdate(){
      $('.modal-dialog').css({
          "width": "770px",
          "max-width": "770px"
      });

      $.get("{{ url('show-popup-user') }}", function(res) {
        if(res.status){
            $('#modal-section').html(res.response);
            $('#rightModal').modal('show');
          }
      });
}


function closeUpdatePopup(){
    $.get("{{ url('close-popup-user') }}", function(response) {
          $('#rightModal').modal('hide');
      })
}
</script>