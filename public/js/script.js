//Cufon.replace('#cellhead, fieldset legend'); // Works without a selector engine
               
/* English/UK initialisation for the jQuery UI date picker plugin. */
/* Written by Stuart. */
jQuery(function($){
  $.datepicker.regional['en-GB'] = {
      closeText: 'Done',
      prevText: 'Prev',
      nextText: 'Next',
      currentText: 'Today',
      monthNames: ['January','February','March','April','May','June',
        'July','August','September','October','November','December'],
  monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
  'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
  dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
  dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
  weekHeader: 'Wk',
  dateFormat: 'dd/mm/yy',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['en-GB']);
});

function handleupdown(datemore) {
  // Handle up/down buttons:
  // Disable both:
  $('#btnUp,#btnDown').attr('disabled','disabled');
  
  //var datemore = str; // e.g. 0-1-1 or 0
  //alert(datemore);
  if (datemore!=0) {
    var splitdatemore = datemore.split('-');
    var minmorder     = splitdatemore[0]; 
    var curmorder     = splitdatemore[1];
    var maxmorder     = splitdatemore[2];
    //alert(minmorder+' '+curmorder+' '+maxmorder);
    if (minmorder==curmorder) { // Enable down
      $('#btnDown').removeAttr('disabled');
    } else if (maxmorder==curmorder) { // Enable up
      $('#btnUp').removeAttr('disabled');
    } else if ( (curmorder > minmorder && curmorder < maxmorder)
             ) {
      $('#btnDown,#btnUp').removeAttr('disabled');
    }
    if (minmorder == curmorder && curmorder == maxmorder) {
      $('#btnUp,#btnDown').attr('disabled','disabled');
    }
  } // End if.
}
