<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CURRENT ACCOUNT TRANSACTIONS FORECAST GRID</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="js/jquery/css/sunny/jquery-ui-1.8.22.custom.css">
  {{-- <link rel="stylesheet" href="css/autocomplete.css"> --}}
  
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-ui-1.8.22.custom.min.js"></script>
  {{-- <script src="js/cufon-yui.js"></script>
  <script src="js/aurulent-sans-mono.cufonfonts.js"></script> --}}
  <script src="js/script.js"></script>
</head>
<body>
{{ App\ProjectsMenu::display() }}
<fieldset class="l">
  <legend>Edit row <span id="rowidsel">{{ \App\Budget::oldest('date')->take(1)->get(['id'])[0]->id }}</span></legend>
  <div id="editrow">@include('ajax.getrow')</div>
</fieldset>
    

<fieldset id="r">
  <legend>Account Balances</legend>
  <div style="float:left;width:100%;background:transparent;padding: 0;border: 0;">

  <div class="accsumm">      
    <button class="btn2" id="currbutt">Current {{ \App\Current::$account_number }}</button>        
    <div id="currdescr">{{ \Carbon\Carbon::parse(\App\Current::getLastEntry('date'))->format('d/m/Y') }} &pound;<span class="negcol">{{ \App\Current::getLastEntry('amount') }}</span><br>{{ \App\Current::getLastEntry('description') }}</div>
    <input class="ambox" type="text" name="txt_currrunbal" id="currrunbal" value="{{ \App\Current::getLastEntry('runbal') }}">
  </div>
      
  <div class="accsumm">
    <button class="btn2" id="savbutt">Savings {{ \App\Saving::$account_number }}</button>        
    <div>{{ \Carbon\Carbon::parse(\App\Saving::getLastEntry('date'))->format('d/m/Y') }} &pound;<span class="negcol">{{ \App\Saving::getLastEntry('amount') }}</span><br>{{ \App\Saving::getLastEntry('description') }}</div>
    <input class="ambox" type="text" name="txt_savrunbal" id="savrunbal" value="{{ \App\Saving::getLastEntry('runbal') }}">
  </div>
      
  <div class="accsumm">      
    <button class="btn2" id="savbutt2">Total</button>
    <div>&nbsp;</div>
    <input class="ambox" type="text" name="txt_savrunbal2" id="savrunbal2" value="{{ \App\Current::getLastEntry('runbal')+\App\Saving::getLastEntry('runbal') }}">
  </div>

  </div>
</fieldset>
      
<div id="buttons">
{!! Form::button('Up', ['id'=>'btnUp']) !!}
{!! Form::button('Add row &gt;', ['id'=>'btnAddrow']) !!}
{!! Form::button('Duplicate &gt;', ['id'=>'btnDuplicate']) !!}
{!! Form::button('Delete &gt;', ['id'=>'btnDelete']) !!}
{!! Form::button('Transfer &gt;', ['id'=>'btnTransfer']) !!}
{!! Form::button('Down', ['id'=>'btnDown']) !!}   
</div>

<div id="listview">
@include('ajax.listview')
</div>

<script>
// Highlight first row:

$(document).ready( function(){

  $('ul#projectsmenu').css({'background':'#c00'});
  $('ul#projectsmenu li').css('float','none');
  $('ul#projectsmenu li').has('a[href]').hide();
  $('ul#projectsmenu li span').css('cursor','pointer').click(function() {
    $('ul#projectsmenu li').has('a[href]').toggle();
  });
  

  // What to do when an item in 'listview' is clicked.
  $('.cellrow').die('click').live('click', function(){
    // Enable / disable Transfer button depending on whether
    // the first row is selected:
    var rowsel  = $(this).attr('title2');
    (rowsel==1) ? $('#btnTransfer').removeAttr('disabled') : $('#btnTransfer').attr('disabled','disabled') ;

    $('.cellrow').removeClass('hl'); // Remove highlight from all rows.
    $(this).addClass('hl');          // Add highlight to the selected row.
    // 
    // rowid: everything after rw in id attribute value
    var selid = $(this).attr('id').substring(2);

    $('#rowidsel').hide().fadeIn('slow').text(selid);
    // Get row info for edit section using AJAX:

    // Get first row edit data via ajax - No, we're using PHP to do it ??
    $.ajax({
      type:'get',
      url:'getrow/' + selid,
      success: function (data){
        //alert(data);
        //var splitdata = data.split('|');
        var editdata  = data;
        //handleupdown(splitdata[1]); // min||morder||max
        
        $('#editrow').html(editdata); // Update edit
        
        //Cufon.replace('#cellhead, fieldset legend, #editdata'); // 
        // 
        $("#date").datepicker();
        
        $.ajax({
          type:'post',
          url:'getlist',
          data:'act=descr&id=' + selid,
          success: function (data){
            var data_split = data.split('|');
            var cities = [];
            for (var i=0; i<data_split.length; i++) cities[i]=data_split[i];

            $("#descr").autocomplete({
              source:cities,
              minLength: 0
            }).click(function(){
              $(this).autocomplete("search");
            });
        
          } // end ajax success callback.
        
        });
            
        $.ajax({
          type:'post',
          url:'getlist',
          data:'act=amount&id=' + selid,
          success: function (data){
            var data_split = data.split('|');
            var cities = [];
            for (var i=0; i<data_split.length; i++) cities[i]=data_split[i];

            $("#amount").autocomplete({
              source:cities,
              minLength: 0
            }).click(function(){
              $(this).autocomplete("search");
            });
        
          } // end ajax success callback.
        
        });
        
      } // end ajax success callback.
    });
        
  });


  $('.cellrow').live('hover', function() {
    $(this).addClass('hl2'); // Add highlight to the selected row.
  }, function() {
    $('.cellrow').removeClass('hl hl2'); // Remove highlight from all rows.
    var rowsel = $('#rowidsel').text();
    $('#rw'+rowsel).addClass('hl'); // Add highlight to the selected row.
  });


  // http://djpate.com/2009/10/07/animated-scroll-to-anchorid-function-with-jquery/
  function goToByScroll(id){
    $('html, body').animate({scrollTop: $("#"+id).offset().top},'slow');
  }

});


$(document).ready( function(){
    
  $("#date").datepicker();

  // Update edit bit
  function updateeditbit(newrowid) {
    
    // Code copied from listview.inc.php
    // Handle up/down buttons:
    // Disable both:
    $('#btnUp,#btnDown').attr('disabled','disabled');
    
    // Update edit bit
    $.ajax({
      type:'get',
      url:'getrow/' + newrowid,
      success: function (data){
        //alert(data);
        //var splitdata = data.split('|');
        var editdata  = data;
        //handleupdown(splitdata[1]);

        $('#editrow').html(editdata); // Update edit

        // Update scroll position
        //goToByScroll("listview #rw"+$('#rowidsel').text());
        //Cufon.replace('#cellhead, fieldset legend'); // 
        $("#date").datepicker();
      }
    });
    // 
  } // End function.
  
  
  // Repopulate listview
  function repopulatelistview(newrowid, firstrow) {
    if (parseInt(firstrow)>0) {
      // 
      newrowid = firstrow;
      $('#btnTransfer').removeAttr('disabled');
    } else {
      $('#btnTransfer').attr('disabled', 'disabled')
    } // End if.
    //alert(newrowid);
    // Update listview
    $.ajax({
      type:'get',
      url:'listview',
      success: function(data2) {
        $('#listview').html(data2);       // repopulate listview
        $('.cellrow').removeClass('hl');  // Remove highlight from all rows.
        $('#rw'+newrowid).addClass('hl'); // Add highlight to the new row.
        $('#rowidsel').hide().fadeIn('slow').text(newrowid); // Update id
            
        updateeditbit(newrowid);
      }
    });
    // 
  } // End function.
  
  
  // Update row
  $('#editdata').live('click', function(e) {
    $.ajax({
      type:'POST',
      url:'listview/' + $('#rowidsel').text(),
      data:''
        + '&code='      + $('#code').val()
        + '&date='      + $('#date').val()
        + '&amount='    + $('input[name=amount]').val()
        + '&in='        + $('#in').is(':checked')
        + '&descr='     + encodeURIComponent($('input[name=descr]').val())
        + '&notes='     + encodeURIComponent($('input[name=notes]').val()),
      success: function(data) {
        $('#listview').html(data); // Repopulate listview
        //goToByScroll("listview #rw"+$('#rowidsel').text());
      }
    });
    e.preventDefault();
  });
  
  $('#btnZero').live('click', function() {
      //alert('');
      var prevtext  = $('#txtAmount').val();
      var prevtext1 = $('#txtAmount').data('prevtext1');
      if ( prevtext1>0 ) {
       $('#txtAmount').data('prevtext1',prevtext).val( prevtext1 );
      }
      else
       {$('#txtAmount').data('prevtext1',prevtext).val('');}
      
    });
  
  // Open accounts div:
  $('#currbutt, #savbutt').click(function() {
    $('#accsdiv').remove();
    
    // Get contents of Accounts screen via ajax:
    $.ajax({
      type:'post',
      url:'acc/' + $(this).attr('id'),
      success: function(data) {
        //alert(data); // Id for row that was moved.

        $('<div id="accsdiv"><div id="accsdivinnerbottom">'+data+'</div></div>')
        .hide()
        .center()
        .appendTo('body')
        .fadeIn();
        
      } // End success.

    });
    

  });
  
  $('#accsdivclose').live('click', function() {
    $('#accsdiv').remove();  
  });

  // 13/05/13 -
  $('#accsdiv tr').live('click', function(){
    var accnum1 = $(this).attr('id').split('-');
    accnum = accnum1[1]; // rowid
    $('#accsdiv tr').css('background', 'white');
    $(this).css('background', 'red');
    $.ajax({
      type:'post',
      url:'acc',
      data:'a=' + accnum1[0] + '&rowid=' + accnum1[1],
      success: function(data) {
        //alert(data); // Id for row that was moved.
        $('#accsdiv').html(data);
      } // End success.

    });
    
  });
  
  // Move row up or down
  $('#btnUp,#btnDown').click(function(){
    var dir = ( $(this).attr('id') == 'btnUp' ) ? 'u' : 'd' ;
    $.ajax({
      type:'get',
      url:'moveupdown/' + $('#rowidsel').text(),
      data:'dir=' + dir,
      success: function(data) {
        //alert(data); // Id for row that was moved.
        var splitdata = data.split('|');
        if (splitdata.length==2) {
          var newdata  = splitdata[0];
          var firstrow = splitdata[1];
          repopulatelistview(newdata, firstrow);
        }
        else {repopulatelistview(data);}

      } // End success.

    });
    
    
  });
  // End
  
  

  
  // Add row:
  $('#btnAddrow').live('click', function(){
    $.ajax({
      type:'post',
      url:'addrow',
      success: function(newrowid) {
        alert(newrowid);
        // Returns ID for the new row added in data
        repopulatelistview(newrowid);
      } // End success.

    });
      
  });
  // End 
    
    
  // Duplicate row:  
  $('#btnDuplicate').live('click', function(){
    $.ajax({
      type:'post',
      url:'duplicaterow/' + $('#rowidsel').text(),
      data:''
      + '&code='   + $('#code').val()
      + '&date='   + $('#date').val() 
      + '&amount=' + $('input[name=amount]').val()
      + '&in='     + $('#rdoIn').is(':checked')
      + '&descr='  + encodeURIComponent($('input[name=descr]').val())
      + '&notes='  + encodeURIComponent($('input[name=notes]').val()),
      
      success: function(data) {
        //alert(data);
        // data contains the ID of the new row.
        repopulatelistview(data);
      }

    });

  });
  // End duplicate row ajax code.
    
    
    
    
    
    
    
  // Delete row:  
  $('#btnDelete').live('click', function(){
    $.ajax({
      type:'post',
      url:'deleterow/' + $('#rowidsel').text(),
      data:'highlightfirstrow=0' + '&date=' + $('#txtDate').val(),
      success: function(data) {repopulatelistview(data, data);}
    });
  });
  // End 
    
    
  // Transfer row
  $('#btnTransfer').live('click', function() {
    // Get details of row to be transferred:
    //alert('');
    $.ajax({
      type:'post',
      url:'transfer/' + $('#rowidsel').text(),
      data:'runbal=' + $('#currrunbal').val(),
      success: function(runbal) {
        //var retstr = runbal.split('|');
        //runbal = retstr[0];
        //var descr = retstr[1];
        if (confirm("Transfer row #"+$('#rowidsel').text()+"\n" + "to make new balance £" + (parseFloat(runbal).toFixed(2)) + "?")) {
          //alert('Transfered row');
          $.ajax({
            type:'post',
            url:'transfer/' + $('#rowidsel').text(),
            data:'getrow=0&runbal=' + runbal,
            success: function(data) {
              $.ajax({
                type:'post',
                url:'deleterow/' + $('#rowidsel').text(),
                data:'highlightfirstrow=1&date=' + $('#txtDate').val(),
                success: function(rowid) {
                  repopulatelistview(rowid, rowid);
              
                  // Update account balance:
                  $('#currrunbal').val(parseFloat(runbal).toFixed(2)); // new running balance
                  //$('#currdescr').text(descr); // new descr
                }

              });
              
              // End delete row.
            }

          });

        } // End if (conf).
        
      }
    });
    
    

    
  });

  var cities = [  ];

  $("#descr").autocomplete({
    source:cities,
    minLength: 0
  }).click(function(){
    $(this).autocomplete("search");
  });

  var cities = [  ];

  $("#amount").autocomplete({
    source:cities,
    minLength: 0
  }).click(function(){
    $(this).autocomplete("search");
  });
    
  // Disable up/down button  
  $('#btnUp,#btnDown').attr('disabled','disabled');
    
  jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - this.outerWidth()) / 2) +  $(window).scrollLeft()) + "px");
    return this;
  }


    
  // http://djpate.com/2009/10/07/animated-scroll-to-anchorid-function-with-jquery/
  function goToByScroll(id){
    $('#listviewbody').scrollTop($("#"+id).offset().top - 280);
  }
   

$('fieldset.l').css('height', $('fieldset#r').css('height') );
$('#editdata').css('bottom', '10px');
$('#editdata').css('right', 0);
});
</script>
</body>
</html>