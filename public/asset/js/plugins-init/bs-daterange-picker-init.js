(function($) {
    "use strict"

    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        autoUpdateInput: false, 
        showDropdowns: false, 
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });

    // Clear the input field when the picker is initialized
    $('.input-daterange-datepicker').on('apply.daterangepicker', function(ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        $(this).val(dateRange);
    });

    // Clear the input field when the "Cancel" button is clicked
    $('.input-daterange-datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.input-daterange-datepicker').attr('autocomplete', 'off');

    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
})(jQuery);