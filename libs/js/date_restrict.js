(function($) {
    "use strict";
    $( document ).ready( function () { 
        setTimeout(function(){ 
            $(".elementor").not(".elementor-location-popup").each(function(e){
            $( ".elementor-field-restrict_date", $(this) ).each(function( index ) {
                elementor_field_restrict_date($(this));
            });
        }) 
        }, 200);
        $( document ).on( 'elementor/popup/show', () => {
            setTimeout(function(){ 
                $( ".elementor-field-restrict_date" ).each(function( index ) {
                        elementor_field_restrict_date($(this));
                });
            }, 200);
        } );
        function cover_format(date_format = ""){
            date_format = date_format.replaceAll('/', '-');
            return date_format.replaceAll('y', 'yy').toUpperCase();
        }
        function elementor_field_restrict_date(field){
            var form = field.closest("form"); 
            var offset = field.offset();
            var min = field.data("min");
            var min_plus = field.data("max_plus_min");
            var min_number = field.data("max_number_min");
            var min_type = field.data("max_type_min");
            var min_pick = field.data("min_pick");
            var max = field.data("max");
            var max_plus = field.data("max_plus");
            var max_number = field.data("max_number");
            var max_type = field.data("max_type");
            var max_pick = field.data("max_pick");
            var weekdays_data = field.data("weekdays");
            var special_data = field.data("special");
            var format_data = field.data("format");
            var sync_min = field.data("sync_min");
            var sync_max = field.data("sync_max");
            var sync_min_number = field.data("sync_min_number");
            var sync_max_number = field.data("sync_max_number");
            var current_date = new Date();
            var minDate = "";
            var maxDate = "";
            var format = "yy-mm-dd";
            var weekdays =  [0, 1, 2, 3, 4, 5, 6];
            var special = [];
            if( min !== undefined && min != ""){
                if( min == "current_date" ) {
                    if( min_number > 0 ){
                        switch ( min_type ) { 
                            case 'd':
                                if( min_plus == "+" ){
                                    minDate = new Date(current_date.getFullYear(), current_date.getMonth(), current_date.getDate() + parseInt(min_number));
                                }else{
                                    minDate = new Date(current_date.getFullYear(), current_date.getMonth(), current_date.getDate() - parseInt(min_number));
                                }
                                break;
                            case 'm':
                                if( min_plus == "+" ){
                                    minDate = new Date(current_date.getFullYear(), current_date.getMonth() + parseInt(min_number), current_date.getDate() );
                                }else{
                                    minDate = new Date(current_date.getFullYear(), current_date.getMonth() - parseInt(min_number) , current_date.getDate() );
                                }
                                break;
                            case 'y':
                                if( min_plus == "+" ){
                                    minDate = new Date(current_date.getFullYear() + parseInt(min_number) , current_date.getMonth(), current_date.getDate());
                                }else{
                                    minDate = new Date(current_date.getFullYear() - parseInt(min_number), current_date.getMonth(), current_date.getDate());
                                }
                                break;
                        }
                    }else{
                        minDate = 0; 
                    }
                }else if( min == "special" && min_pick !== undefined && min_pick != ""){
                    minDate = new Date(min_pick);
                }
            }
            if( max !== undefined &&  max != ""){
                if( max == "current_date") {
                    if( max_number > 0 ){
                        switch ( max_type ) { 
                            case 'd':
                                if( max_plus == "+" ){
                                    maxDate = new Date(current_date.getFullYear(), current_date.getMonth(), current_date.getDate() + parseInt(max_number));
                                }else{
                                    maxDate = new Date(current_date.getFullYear(), current_date.getMonth(), current_date.getDate() - parseInt(max_number));
                                }
                                break;
                            case 'm':
                                if( max_plus == "+" ){
                                    maxDate = new Date(current_date.getFullYear(), current_date.getMonth() + parseInt(max_number), current_date.getDate() );
                                }else{
                                    maxDate = new Date(current_date.getFullYear(), current_date.getMonth() - parseInt(max_number) , current_date.getDate() );
                                }
                                break;
                            case 'y':
                                if( max_plus == "+" ){
                                    maxDate = new Date(current_date.getFullYear() + parseInt(max_number) , current_date.getMonth(), current_date.getDate());
                                }else{
                                    maxDate = new Date(current_date.getFullYear() - parseInt(max_number), current_date.getMonth(), current_date.getDate());
                                }
                                break;
                        }
                    }else{
                        maxDate = 0;
                    }
                }else if( max == "special" && max_pick !== undefined && max_pick != ""){
                    maxDate = new Date(max_pick);
                }
            }
            if( weekdays_data !== undefined && weekdays_data != "allday" ){
                weekdays = [];
                weekdays_data = weekdays_data.toString();
                weekdays = weekdays_data.split('|');
                weekdays = weekdays.map( Number );
            }
            if( special_data !== undefined && special_data != "" ){
                special_data= special_data.toString();
                special = special_data.split('|');
            }
            if( format_data !== undefined && format_data != "" ){
                format = format_data;
            }
            field.datepicker({
                container:'.dialog-widget',
                minDate: minDate,
                maxDate: maxDate,
                dateFormat: format,
                firstDay: restrict_dates_for_elementor_forms.start_of_week,
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+100",
                beforeShow: function(input, inst) {
                    var $this = $(this);
                    var cal = inst.dpDiv;
                    var top = $this.offset().top + $this.outerHeight();
                    var left = $this.offset().left;
                    setTimeout(function() {
                        cal.css({
                            'top': top,
                            'left': left
                        });
                    }, 10);
                },
                onSelect: function(dateStr) {
                    var data_fm = cover_format(format);
                    dateStr = moment(dateStr, data_fm).format('YYYY-MM-DD');
                    dateStr = new Date(dateStr);
                    var dateStr1 = new Date(dateStr);
                    var dateStr_max = new Date(dateStr);
                    var dateStr1_max = new Date(dateStr); 
                    if( sync_min !== undefined && sync_min != "" && dateStr !== undefined ){ 
                        $("#form-field-"+sync_min, form).datepicker('option','maxDate',dateStr);
                    }
                    if( sync_max !== undefined && sync_max != "" && dateStr !== undefined){ 
                        if( sync_min_number != "" && sync_min_number !== undefined){
                            dateStr = dateStr.setDate(dateStr.getDate() + parseInt(sync_min_number));
                            dateStr = new Date(dateStr);
                        }
                        if( sync_max_number != "" && sync_max_number !== undefined){
                            dateStr1_max.setDate(dateStr1_max.getDate() + parseInt(sync_max_number));
                            $("#form-field-"+sync_max, form).datepicker('option','maxDate',dateStr1_max);
                        }
                        $("#form-field-"+sync_max, form).datepicker('option','minDate',dateStr);
                    }
                    $(this).change();
                },
                beforeShowDay: function(date){
                    var day = date.getDay();
                    if( jQuery.inArray( day, weekdays) > -1 ){
                    //check special
                    if( special.length > 0 ){
                        var sdate = moment(date).format('YYYY-MM-DD');
                        if ($.inArray(sdate, special) !== -1) {
                            return [false];
                            }else{
                            return [true];
                            }
                    }else{
                        return [true];
                    }
                    }else{ 
                        //check special
                    if( special.length > 0 ){
                        var sdate = moment(date).format('YYYY-MM-DD');
                        if ($.inArray(sdate, special) !== -1) {
                            return [true];
                            }else{
                            return [false];
                            }
                    }else{
                        return [false];
                    }
                    }
                }
            });
        }   
    })
})(jQuery);
