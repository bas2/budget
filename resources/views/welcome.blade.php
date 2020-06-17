<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CURRENT ACCOUNT TRANSACTIONS FORECAST GRID</title>
  <!-- Bootstrap -->
  {!! Html::style('css/bootstrap.min.css') !!}
  {!! Html::style('css/styles.css') !!}
  <link id="bsdp-css" href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">

  {{-- <link rel="stylesheet" href="css/autocomplete.css"> --}}
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
  {!! Html::script('js/script.js') !!}
</head>
<body>
@include('projectmenu')
<div class="container-fluid">

  <div class="row equal">


    <div class="col-md-5 col-sm-12 col-xs-12 panel">
      {{-- <h2 class="panel-title">Test</h2> --}}
      <fieldset class="hunp" id="r">
        <legend>Account Balances</legend>

        <div class="row">
          <div class="col-md-4 col-sm-5 col-xs-5" id="currdescr">
            <button class="btn btn-primary btn-block">{{ $account_numbers['Current'] }}</button> 
          </div>
          <div class="col-md-4 col-sm-5 col-xs-5">
            <button class="btn btn-primary btn-block" id="savbutt">{{ $account_numbers['Savings'] }}</button> 
          </div>
          <div class="col-md-4 col-sm-2 col-xs-2">
            <button class="btn btn-primary btn-block" id="savbutt2">Total</button> 
          </div>
        </div>

        <div class="row transaction-detail">
          <div class="col-md-4 col-sm-5 col-xs-5">
            <div class="form-control-static alert-default currrunbal">
              {{ $last_entries['CurrentDate'] }} 
              &pound;<span class="negcol">{{ $last_entries['CurrentAmount'] }}</span><br>
              {{ $last_entries['CurrentDescr'] }}</div>
          </div>
          <div class="col-md-4 col-sm-5 col-xs-5">
            <div class="form-control-static alert-default savrunbal">
              {{ $last_entries['SavingsDate'] }} 
              &pound;<span class="negcol">{{ $last_entries['SavingsAmount'] }}</span><br>
              {{ $last_entries['SavingsDescr'] }}</div>
          </div>
          <div class="col-md-4 col-sm-2 col-xs-2"></div>
        </div>

        <div class="row">
          <div class="col-md-4 col-sm-5 col-xs-5">
            <div class="form-control-static alert-info currrunbal">{{ $running_balances['Current'] }}</div>
          </div>
          <div class="col-md-4 col-sm-5 col-xs-5">
            <div class="form-control-static alert-info savrunbal">{{ $running_balances['Savings'] }}</div>
          </div>
          <div class="col-md-4 col-sm-2 col-xs-2">
            <div class="form-control-static alert-info savrunbal2">{{ $running_balances['Total'] }}</div>
          </div>
        </div>

        <div class="row">
        <div class="col-md-12 col-sm-15 col-xs-15">
        <div class="form-control-static"></span></div>
        </div>
        </div>

      </fieldset>
    </div>

  </div>

    <!-- This div is used to indicate the original position of the scrollable fixed div. -->
    <div class="scroller_anchor"></div>

  <div class="row form-group" id="buttons">
  {!! Form::button('&uarr; Up',        ['class'=>'btn btn-primary','id'=>'btnUp']) !!}
  {!! Form::button('Add',   ['class'=>'btn btn-primary','id'=>'btnAddrow']) !!}
  {!! Form::button('Edit <span class="badge" id="rowidsel">' . $latestID . '</span>',  ['class'=>'btn btn-primary','id'=>'btnRowEdit']) !!}
  {!! Form::button('Clone', ['class'=>'btn btn-primary','id'=>'btnDuplicate']) !!}
  {!! Form::button('Delete',    ['class'=>'btn btn-danger','id'=>'btnDelete']) !!}
  {!! Form::button('TFR',  ['class'=>'btn btn-primary','id'=>'btnTransfer']) !!}
  {!! Form::button($editrows['descr'], ['class'=>'btn btn-warning','id'=>'btnRowSelected']) !!}
  {!! Form::button('&pound;' . $running_balances['Current'],  ['class'=>'btn btn-primary','id'=>'currbutt']) !!}
  </div>

  <div class="row" id="listview">
  @include('ajax.listview',['rowcounter'=>0])
  </div>

</div>
<script>
// Highlight first row:

$(document).ready( function(){

  $('#btnRowSelected').click(function(){
    $([document.documentElement, document.body]).animate({
        scrollTop: $(".hl").offset().top - 60
    }, 1000);
  });

/*
  $('#btnRowEdit').click(function(){
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#diveditrow").offset().top - 20
    }, 1000);
  });
  */

// This function will be executed when the user scrolls the page.
$(window).scroll(function(e) {
    // Get the position of the location where the scroller starts.
    var scroller_anchor = $(".scroller_anchor").offset().top;
     
    // Check if the user has scrolled and the current position is after the scroller start location and if its not already fixed at the top 
    if ($(this).scrollTop() >= scroller_anchor && $('#buttons').css('position') != 'fixed') 
    {    // Change the CSS of the scroller to hilight it and fix it at the top of the screen.
        $('#buttons').css({
            'position': 'fixed',
            'top': '0'
        });
        // Changing the height of the scroller anchor to that of scroller so that there is no change in the overall height of the page.
        $('.scroller_anchor').css('height', '0');
    } 
    else if ($(this).scrollTop() < scroller_anchor && $('#buttons').css('position') != 'relative') 
    {    // If the user has scrolled back to the location above the scroller anchor place it back into the content.
         
        // Change the height of the scroller anchor to 0 and now we will be adding the scroller back to the content.
        $('.scroller_anchor').css('height', '0');
         
        // Change the CSS and put it back to its original position.
        $('#buttons').css({
            'position': 'relative'
        });
    }
});

  function getTimeAndDate()
    {
        $.ajax({
            "type":"GET",
            "url":"time",
            "success":function(data) {
                //var timestring = data.split('|');
                $('div.tm').text(data);
            }
        });
    }

    $('<div class="tm" style="position:fixed;left:90%;top:0;transform:translateX(-50%);background-color:rgba(192,33,33,0.842);border:1px solid #fff;border-radius:.3em;color:#fff;font-family:Impact,arial;width:10em;z-index:1;font-weight:bold;opacity:1;text-align:center;">'
    + '</div>')
    .prependTo('body');

    setInterval(function(){
        getTimeAndDate();
    }, 60000);
    getTimeAndDate();

  //$('ul#projectsmenu').css({'background':'#c00'});
  //$('ul#projectsmenu li').css('float','none');
  //$('ul#projectsmenu li').has('a[href]').hide();
  //$('ul#projectsmenu li span').css('cursor','pointer').click(function() {
  //  $('ul#projectsmenu li').has('a[href]').toggle();
  //});

  // What to do when an item in 'listview' is clicked.
  $('body').on('click', '.cellrow', function(){
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
        var editdata  = data;

        $('#editrow').html(editdata); // Update edit

        //$.ajax({
        //  type:'post',
        //  url:'getlist',
        //  data:'act=descr&id=' + selid,
        //  success: function (data){
            //var data_split = data.split('|');
            //var cities = [];
            //for (var i=0; i<data_split.length; i++) cities[i]=data_split[i];
/*
            $("#descr").autocomplete({
              source:cities,
              minLength: 0
            }).click(function(){
              $(this).autocomplete("search");
            });
  */      
        //  } // end ajax success callback.
        
        //});
            
        //$.ajax({
        //  type:'post',
        //  url:'getlist',
        //  data:'act=amount&id=' + selid,
        //  success: function (data){
        //    var data_split = data.split('|');
        //    var cities = [];
        //    for (var i=0; i<data_split.length; i++) cities[i]=data_split[i];
/*
            $("#amount").autocomplete({
              source:cities,
              minLength: 0
            }).click(function(){
              $(this).autocomplete("search");
            });
*/      
        //  } // end ajax success callback.
        
        //});
        
      } // end ajax success callback.
    });

    // Handle Up/Down buttons:

    $('#btnRowSelected').text($(this).text().substring(25, 50));

    enable_disable_up($('#rowidsel').text());
        
  });


  $('body').on('hover', '.cellrow', function() {
    $(this).addClass('hl2'); // Add highlight to the selected row.
  }, function() {
    $('.cellrow').removeClass('hl hl2'); // Remove highlight from all rows.
    var rowsel = $('#rowidsel').text();
    $('#rw'+rowsel).addClass('hl'); // Add highlight to the selected row.
  });


  function enable_disable_up(row)
  {
  $.ajax({
      type:'get',
      url:'moveupdown/' + row,
      success: function(data) {
        var data_split = data.split('|');
        $('#btnUp').attr('disabled', 'disabled');
        if (data_split[0]>1)
        {
          if (data_split[2] == 1) $('#btnUp').removeAttr('disabled');
        }

      } // End success.

    });
  }


      

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
        var editdata  = data;
        $('#editrow').html(editdata); // Update edit
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

    // Update listview
    $.ajax({
      type:'get',
      url:'listview',
      success: function(data2) {
        $('#listview').html(data2);       // repopulate listview
        $('.cellrow').removeClass('hl');  // Remove highlight from all rows.
        $('#rw'+newrowid).addClass('hl'); // Add highlight to the new row.
        $('#rowidsel').hide().fadeIn('slow').text(newrowid); // Update id
        $('#btnRowSelected').text($('#rw'+newrowid).text().substring(25, 50));

        enable_disable_up(newrowid);
            
        updateeditbit(newrowid);

      }
    });

  } // End function.
  
  
  // Update row
  $('body').on('click', '#editdata', function(e) {
    $.ajax({
      type:'POST',
      url:'listview/' + $('#rowidsel').text(),
      data:''
        + 'code='       + $('select[name=code]').val()
        + '&date='      + $('#datepicker').val()
        + '&amount='    + $('input[name=amount]').val()
        + '&in='        + $('#in').is(':checked')
        + '&descr='     + encodeURIComponent($('input[name=descr]').val())
        + '&notes='     + encodeURIComponent($('input[name=notes]').val()),
      success: function(data) {
        $('#listview').html(data);                     // Repopulate listview
        $('.cellrow').removeClass('hl');               // Remove highlight from all rows.
        $('#rw'+$('#rowidsel').text()).addClass('hl'); // Add highlight to the Updated row.

        $('#editdiv').remove();
        $('body, html').css('overflow','auto');
      }
    });
    e.preventDefault();
  });
  

  $('body').on('click', '#btnZero', function() {
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
      type:'get',
      url:'acc/0',
      success: function(data) {

        $('<div id="accsdiv" class="togglewidth">'+data+'</div>')
        .hide()
        .appendTo('body')
        .fadeIn();
        $('body, html').css('overflow','hidden');
        
      } // End success.

    });
    

  });

  // Open Edit dialog.
  $('#btnRowEdit').click(function(){
  
    $('#editdiv').remove();

    // Get contents of Edit row screen via ajax:
    $.ajax({
      type:'get',
      url:'edit/' + $('#rowidsel').text(),
      success: function(data) {

        $('<div id="editdiv" class="togglewidth">'+data+'</div>')
        .hide()
        .appendTo('body')
        .fadeIn();
        $('body, html').css('overflow','hidden')
        
      } // End success.

    });
  
  });

  $('body').on('click', '#editclose', function() {
    $('#editdiv').remove();
    $('body, html').css('overflow','auto');
  });
  

  $('body').on('click', '#accsdiv p', function() {
    $('#accsdiv').remove();
    $('body, html').css('overflow','auto');
  });


  // Click on row in Account screen.
  $('body').on('click', '.cellrow2', function(){

    $('.cellrow2').removeClass('hl'); // Remove highlight from all rows.
    $(this).addClass('hl');          // Add highlight to the selected row.

    $('#rowidsel2').hide().fadeIn('slow').text($(this).attr('title2'));

    var rowsel = $(this).attr('title2');
    var rowsel2 = $(this).attr('title3');

    $.ajax({
      type:'get',
      url:'getrows2/' + rowsel,
      success: function(data) {
        $('#editrow2').html(data);

        (rowsel2==1) ? $('#movedata2').removeAttr('disabled') : $('#movedata2').attr('disabled','disabled') ;
      } // End success.

    });

  });


  // Move row up or down
  $('body').on('click', '#btnUp,#btnDown', function(){
    var dir = ( $(this).attr('id') == 'btnUp' ) ? 'u' : 'd' ;
    var curr = $('#rowidsel').text();
    $.ajax({
      type:'get',
      url:'moveupdown2/' + curr + '/' + dir,
      success: function(newrowid) {
        repopulatelistview(curr);
      } // End success.

    });
    
  });
  // End

  
  // Add row:
  $('body').on('click', '#btnAddrow', function(){
    $.ajax({
      type:'post',
      url:'addrow',
      success: function(newrowid) {
        // Returns ID for the new row added in data
        repopulatelistview(newrowid);
      } // End success.

    });
      
  });
  // End 
    
    
  // Duplicate row:  
  $('body').on('click', '#btnDuplicate', function(){
    $.ajax({
      type:'post',
      url:'duplicaterow/' + $('#rowidsel').text(),
      
      success: function(newrow) {
        // data contains the ID of the new row.
        repopulatelistview(newrow);
      }

 

    });



  });
  // End duplicate row ajax code.
    

    
  // Delete row:  
  $('body').on('click', '#btnDelete', function(){
    $.ajax({
      type:'post',
      url:'deleterow/' + $('#rowidsel').text(),
      data:'highlightfirstrow=0' + '&date=' + $('#txtDate').val(),
      success: function(data) {repopulatelistview(data, data);}
    });
  });
  // End 
    
    
  // Transfer row
  $('body').on('click', '#btnTransfer', function() {
    // Get details of row to be transferred:
    $.ajax({
      type:'post',
      url:'transfer/' + $('#rowidsel').text(),
      data:'runbal=' + $('.currrunbal').last().text(),
      success: function(runbal) {
        if (confirm("Transfer row #"+$('#rowidsel').text()+"\n" 
        + "to make new balance £" 
        + (parseFloat(runbal).toFixed(2)) + "?")) {

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
                  $('.currrunbal').eq(1).text(parseFloat(runbal).toFixed(2)); // new running balance
                  $('.currrunbal').eq(0).text('');
                  //$('.currrunbal').eq(1).text('');
                }
              });
              // End delete row.
            }
          });
        } // End if (conf).
      } // End ajax success.
    });
    
    

    
  });
/*
  var cities = [ ];

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
*/  
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

  $('tr[title2=1]').addClass('hl');

});
</script>
</body>
</html>