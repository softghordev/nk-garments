@if(session('success'))
<script>
    toastr.options = {
               "closeButton": false,
               "debug": false,
               "newestOnTop": false,
               "progressBar": true,
               "positionClass": "toast-top-right",
               "preventDuplicates": false,
               "onclick": null,
               "showDuration": "300",
               "hideDuration": "1000",
               "timeOut": "5000",
               "extendedTimeOut": "1000",
               "showEasing": "swing",
               "hideEasing": "linear",
               "showMethod": "fadeIn",
               "hideMethod": "fadeOut"
     }
    toastr.success('{{ session("success") }}', ' Success ! ');
</script>
@endif
@if(session('warning'))
<script>
    toastr.options = {
               "closeButton": false,
               "debug": false,
               "newestOnTop": false,
               "progressBar": true,
               "positionClass": "toast-top-right",
               "preventDuplicates": false,
               "onclick": null,
               "showDuration": "400",
               "hideDuration": "1000",
               "timeOut": "6000",
               "extendedTimeOut": "1000",
               "showEasing": "swing",
               "hideEasing": "linear",
               "showMethod": "fadeIn",
               "hideMethod": "fadeOut"
     }
    toastr.warning('{{ session("warning") }}', ' Warning !');
</script>
@endif
@if(session('error'))
<script>
    toastr.options = {
               "closeButton": false,
               "debug": false,
               "newestOnTop": false,
               "progressBar": true,
               "positionClass": "toast-top-right",
               "preventDuplicates": false,
               "onclick": null,
               "showDuration": "400",
               "hideDuration": "1000",
               "timeOut": "6000",
               "extendedTimeOut": "1000",
               "showEasing": "swing",
               "hideEasing": "linear",
               "showMethod": "fadeIn",
               "hideMethod": "fadeOut"
     }
    toastr.error('{{ session("error") }}', ' Wrong !');
</script>
@endif