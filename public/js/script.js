
function handleupdown(datemore) {
  // Handle up/down buttons:
  // Disable both:
  $('#btnUp,#btnDown').attr('disabled','disabled');
  
  if (datemore!=0) {
    var splitdatemore = datemore.split('-');
    var minmorder     = splitdatemore[0]; 
    var curmorder     = splitdatemore[1];
    var maxmorder     = splitdatemore[2];

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
