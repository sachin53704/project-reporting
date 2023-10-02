@if (session()->has('success'))
Command: toastr["success"]("{{session()->get('success')}}", "Success")
@endif

@if (session()->has('error'))
Command: toastr["error"]("{{session()->get('error')}}", "Error")
@endif
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
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
