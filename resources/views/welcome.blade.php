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

    <div class="col-md-6 panel text-center">
      <fieldset class="l hunp">
        <legend>Edit row <span class="badge" id="rowidsel">
        {{ \App\Budget::oldest('date')->take(1)->get(['id'])[0]->id }}</span></legend>
        <div id="editrow">@include('ajax.getrow')</div>
      </fieldset>
    </div>

    <div class="col-md-6 panel">
      {{-- <h2 class="panel-title">Test</h2> --}}
      <fieldset class="hunp" id="r">
        <legend>Account Balances</legend>

        <div class="row">
          <div class="col-md-4" id="currdescr">
            <button class="btn btn-primary btn-block" id="currbutt">Current {{ \App\Current::$account_number }}</button> 
          </div>
          <div class="col-md-4">
            <button class="btn btn-primary btn-block" id="savbutt">Savings {{ \App\Saving::$account_number }}</button> 
          </div>
          <div class="col-md-4">
            <button class="btn btn-primary btn-block" id="savbutt2">Total</button> 
          </div>
        </div>

        <div class="row transaction-detail">
          <div class="col-md-4">
            <div class="form-control-static alert-default currrunbal">{{ \Carbon\Carbon::parse(\App\Current::getLastEntry('date'))->format('d/m/Y') }} &pound;<span class="negcol">{{ \App\Current::getLastEntry('amount') }}</span><br>{{ \App\Current::getLastEntry('description') }}</div>
          </div>
          <div class="col-md-4">
            <div class="form-control-static alert-default savrunbal">{{ \Carbon\Carbon::parse(\App\Saving::getLastEntry('date'))->format('d/m/Y') }} &pound;<span class="negcol">{{ \App\Saving::getLastEntry('amount') }}</span><br>{{ \App\Saving::getLastEntry('description') }}</div>
          </div>
          <div class="col-md-4"></div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-control-static alert-info currrunbal">{{ number_format(\App\Current::getLastEntry('runbal'),2) }}</div>
          </div>
          <div class="col-md-4">
            <div class="form-control-static alert-info savrunbal">{{ number_format(\App\Saving::getLastEntry('runbal'),2) }}</div>
          </div>
          <div class="col-md-4">
            <div class="form-control-static alert-info savrunbal2">{{ number_format(\App\Current::getLastEntry('runbal')+\App\Saving::getLastEntry('runbal'),2) }}</div>
          </div>
        </div>

      </fieldset>
    </div>

  </div>


  <div class="row form-group" id="buttons">
  {!! Form::button('&uarr; Up',        ['class'=>'btn btn-primary','id'=>'btnUp']) !!}
  {!! Form::button('Add row &rarr;',   ['class'=>'btn btn-primary','id'=>'btnAddrow']) !!}
  {!! Form::button('Duplicate &rarr;', ['class'=>'btn btn-primary','id'=>'btnDuplicate']) !!}
  {!! Form::button('Delete &rarr;',    ['class'=>'btn btn-danger','id'=>'btnDelete']) !!}
  {!! Form::button('Transfer &rarr;',  ['class'=>'btn btn-primary','id'=>'btnTransfer']) !!}
  {!! Form::button('&darr; Down',      ['class'=>'btn btn-primary','id'=>'btnDown']) !!}   
  </div>

  <div class="row" id="listview">
  @include('ajax.listview',['rowcounter'=>0])
  </div>

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

  $('input#datepicker').datepicker({
        format: "dd/mm/yyyy"
  });
  

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
        $('input#datepicker').datepicker({
        format: "dd/mm/yyyy"
        });
        
        $.ajax({
          type:'post',
          url:'getlist',
          data:'act=descr&id=' + selid,
          success: function (data){
            var data_split = data.split('|');
            var cities = [];
            for (var i=0; i<data_split.length; i++) cities[i]=data_split[i];
/*
            $("#descr").autocomplete({
              source:cities,
              minLength: 0
            }).click(function(){
              $(this).autocomplete("search");
            });
  */      
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
/*
            $("#amount").autocomplete({
              source:cities,
              minLength: 0
            }).click(function(){
              $(this).autocomplete("search");
            });
*/      
          } // end ajax success callback.
        
        });
        
      } // end ajax success callback.
    });
        
  });


  $('body').on('hover', '.cellrow', function() {
    $(this).addClass('hl2'); // Add highlight to the selected row.
  }, function() {
    $('.cellrow').removeClass('hl hl2'); // Remove highlight from all rows.
    var rowsel = $('#rowidsel').text();
    $('#rw'+rowsel).addClass('hl'); // Add highlight to the selected row.
  });


      

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
            
        updateeditbit(newrowid);

      }
    });
    $('input#datepicker').datepicker({
        format: "dd/mm/yyyy"
    });
    //alert ( $('input#datepicker').attr('value') );
    // 
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
        $('#listview').html(data); // Repopulate listview
        $('.cellrow').removeClass('hl');  // Remove highlight from all rows.
        $('#rw'+$('#rowidsel').text()).addClass('hl'); // Add highlight to the Updated row.
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
      type:'post',
      url:'acc/' + $(this).attr('id'),
      success: function(data) {

        $('<div id="accsdiv"><div id="accsdivinnerbottom">'+data+'</div></div>')
        .hide()
        .center()
        .appendTo('body')
        .fadeIn();
        
      } // End success.

    });
    

  });
  
  $('body').on('click', '#accsdivclose', function() {
    $('#accsdiv').remove();  
  });

  // 13/05/13 -
  $('#accsdiv').on('click', 'tr', function(){
    var accnum1 = $(this).attr('id').split('-');
    accnum = accnum1[1]; // rowid
    $('#accsdiv tr').css('background', 'white');
    $(this).css('background', 'red');
    $.ajax({
      type:'post',
      url:'acc',
      data:'a=' + accnum1[0] + '&rowid=' + accnum1[1],
      success: function(data) {
        $('#accsdiv').html(data);
      } // End success.

    });
    
  });
  
  // Move row up or down
  $('body').on('click', '#btnUp,#btnDown', function(){
    var dir = ( $(this).attr('id') == 'btnUp' ) ? 'u' : 'd' ;
    $.ajax({
      type:'get',
      url:'moveupdown/' + $('#rowidsel').text(),
      data:'dir=' + dir,
      success: function(data) {
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
  $('body').on('click', '#btnAddrow', function(){
    $.ajax({
      type:'post',
      url:'addrow',
      success: function(newrowid) {
        // Returns ID for the new row added in data
        repopulatelistview(newrowid);
        $('input#datepicker').datepicker({
        format: "dd/mm/yyyy"
        });

      } // End success.

    });
      
  });
  // End 
    
    
  // Duplicate row:  
  $('body').on('click', '#btnDuplicate', function(){
    $.ajax({
      type:'post',
      url:'duplicaterow/' + $('#rowidsel').text(),
      data:''
      + '&code='   + $('#code').val()
      + '&date='   + $('#datepicker').val() 
      + '&amount=' + $('input[name=amount]').val()
      + '&in='     + $('#rdoIn').is(':checked')
      + '&descr='  + encodeURIComponent($('input[name=descr]').val())
      + '&notes='  + encodeURIComponent($('input[name=notes]').val()),
      
      success: function(data) {
        // data contains the ID of the new row.
        repopulatelistview(data);
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
                  $('.currrunbal').last().text(parseFloat(runbal).toFixed(2)); // new running balance
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

});
</script>
</body>
</html>