jQuery(document).ready( function($) { 
    // Auto dismiss bootstrap alert
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 6000);
    
    $('#check_in_date').daterangepicker({
        locale: {format: 'YYYY-MM-DD HH:mm'},
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
        autoUpdateInput:true,
        timePickerIncrement: 60,
        minDate: moment(),
    }); 

    function checkout_date(date) {
        $('#check_out_date').daterangepicker({
            locale: {format: 'YYYY-MM-DD HH:mm'},
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            autoUpdateInput:true,
            timePickerIncrement: 60,
            minDate: date,
        });
    }
    checkout_date(moment());

    $('#check_in_date').on('apply.daterangepicker', function(ev, picker) {
        checkout_date(picker.startDate);
    });
});