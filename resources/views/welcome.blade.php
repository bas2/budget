<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CURRENT ACCOUNT TRANSACTIONS FORECAST GRID</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="js/jquery/css/sunny/jquery-ui-1.8.22.custom.css">
  <link rel="stylesheet" href="css/autocomplete.css">
  <script src="js/jquery-1.7.2.min.js"></script>
  <script src="js/jquery-ui-1.8.22.custom.min.js"></script>
  <script src="js/cufon-yui.js"></script>
  <script src="js/aurulent-sans-mono.cufonfonts.js"></script>
  <script src="js/script.js"></script>
</head>
<body>

    <fieldset class="l">
      <legend>Edit row <span id="rowidsel">2536</span></legend>
      <div id="editrow">@include('ajax.getrow')</div>
    </fieldset>
    

    <fieldset id="r">
      <legend>Account Balances</legend>
            <div style="float:left;width:100%;background:transparent;padding: 0;border: 0;">
      <div class="accsumm">
        
<button class="btn2" id="currbutt">Current 04018001</button>        <div id="currdescr">Thu 6th Oct 
      &pound;<span class="negcol">50.00</span><br />CASH</div>
        <input class="ambox" type="text" name="txt_currrunbal" id="currrunbal" value="22.13">              </div>
      
      <div class="accsumm">
        
<button class="btn2" id="savbutt">Savings 24362957</button>        <div style="">Tue 26th Jul &pound;0.00<br />Current account</div>
        <input class="ambox" type="text" name="txt_savrunbal" id="savrunbal" value="391.59">              </div>
      
      <div class="accsumm">
        
<button class="btn2" id="savbutt2">Total</button>        <div>&nbsp;</div>
        <input class="ambox" type="text" name="txt_savrunbal2" id="savrunbal2" value="413.72">      </div>
      </div>
    </fieldset>
      
    <div id="buttons">
      
<button id="btnUp">Up</button>
<button id="btnAddrow">Add row &gt;</button>
<button id="btnDuplicate">Duplicate &gt;</button>
<button id="btnDelete">Delete &gt;</button>
<button id="btnTransfer">Transfer &gt;</button>
<button id="btnDown">Down</button>    </div>
      
    <div id="listview"><div id="cellhead">
<div id="datehead">Date</div>
<div id="morderhead"><span style="visibility: hidden;">-</span></div>
<div id="descrhead">Description</div>
<div id="inhead">IN</div>
<div id="outhead">OUT</div>
<div id="balhead">Balance</div>
<div id="savhead">Total</div>
<div id="noteshead">Notes</div>
</div>
<div id="listviewbody">

    <div title2="1" id="rw2536" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Thu 13th Oct&nbsp;</div>
    <div class="cellmorder">-134</div>
    <div class="celldescr">EE & T-MOBILE</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">11.42</div>
    <div class="cellbal r">10.71</div>
    <div class="cellsav r">402.30</div>
    <div class="cellnotes">Need to move over to payg -Cancelled DD on 11/09! 11.42&nbsp;</div>
    </div>
  
    <div title2="2" id="rw2547" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Tue 18th Oct&nbsp;</div>
    <div class="cellmorder">-129</div>
    <div class="celldescr">Amazon Digital Dwn</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">8.64</div>
    <div class="cellbal r">2.07</div>
    <div class="cellsav r">393.66</div>
    <div class="cellnotes">Job you will love2&nbsp;</div>
    </div>
  
    <div title2="3" id="rw2543" class="cellrow negcol">
    <div style="clear:both"></div>
    <div class="celldate">Tue 18th Oct&nbsp;</div>
    <div class="cellmorder">-129</div>
    <div class="celldescr">BYTEMARK HOSTING</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">12.00</div>
    <div class="cellbal r">-9.93</div>
    <div class="cellsav r">381.66</div>
    <div class="cellnotes">Web hosting # 33&nbsp;</div>
    </div>
  
    <div title2="4" id="rw2546" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Wed 19th Oct&nbsp;</div>
    <div class="cellmorder">-128</div>
    <div class="celldescr">ISA Account</div>
    <div class="cellin r">200.00</div>
    <div class="cellout r">0.00</div>
    <div class="cellbal r">190.07</div>
    <div class="cellsav r">381.66</div>
    <div class="cellnotes">&nbsp;</div>
    </div>
  
    <div title2="5" id="rw2544" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Mon 31st Oct&nbsp;</div>
    <div class="cellmorder">-115</div>
    <div class="celldescr">CASH</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">60.00</div>
    <div class="cellbal r">130.07</div>
    <div class="cellsav r">321.66</div>
    <div class="cellnotes">LINK 18:20OCT30&nbsp;</div>
    </div>
  
    <div title2="6" id="rw2545" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Tue 1st Nov&nbsp;</div>
    <div class="cellmorder">-114</div>
    <div class="celldescr">TRAVELODGE WEBSITE</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">29.00</div>
    <div class="cellbal r">101.07</div>
    <div class="cellsav r">292.66</div>
    <div class="cellnotes">Twickenham on 30 Oct&nbsp;</div>
    </div>
  
    <div title2="7" id="rw2548" class="cellrow todcol">
    <div style="clear:both"></div>
    <div class="celldate">Mon 7th Nov&nbsp;</div>
    <div class="cellmorder">-108</div>
    <div class="celldescr">HOL CHA DRI LTD HCD</div>
    <div class="cellin r">100.00</div>
    <div class="cellout r">0.00</div>
    <div class="cellbal r">201.07</div>
    <div class="cellsav r">392.66</div>
    <div class="cellnotes">&nbsp;</div>
    </div>
  
    <div title2="8" id="rw2557" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Fri 11th Nov&nbsp;</div>
    <div class="cellmorder">-104</div>
    <div class="celldescr">National Lottery</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">10.00</div>
    <div class="cellbal r">191.07</div>
    <div class="cellsav r">382.66</div>
    <div class="cellnotes">&nbsp;</div>
    </div>
  
    <div title2="9" id="rw2558" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Wed 16th Nov&nbsp;</div>
    <div class="cellmorder">-99</div>
    <div class="celldescr">BYTEMARK HOSTING</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">12.00</div>
    <div class="cellbal r">179.07</div>
    <div class="cellsav r">370.66</div>
    <div class="cellnotes">Web hosting # 34&nbsp;</div>
    </div>
  
    <div title2="10" id="rw2562" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Mon 28th Nov&nbsp;</div>
    <div class="cellmorder">-87</div>
    <div class="celldescr">TESCO DIRECT</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">14.99</div>
    <div class="cellbal r">164.08</div>
    <div class="cellsav r">355.67</div>
    <div class="cellnotes">Nokia 130 PAYG phone&nbsp;</div>
    </div>
  
    <div title2="11" id="rw2563" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Fri 2nd Dec&nbsp;</div>
    <div class="cellmorder">-83</div>
    <div class="celldescr">MIPAY Tesco Mobile</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">10.00</div>
    <div class="cellbal r">154.08</div>
    <div class="cellsav r">345.67</div>
    <div class="cellnotes">Mobile phone topup&nbsp;</div>
    </div>
  
    <div title2="12" id="rw2561" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Fri 16th Dec&nbsp;</div>
    <div class="cellmorder">-69</div>
    <div class="celldescr">BYTEMARK HOSTING</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">12.00</div>
    <div class="cellbal r">142.08</div>
    <div class="cellsav r">333.67</div>
    <div class="cellnotes">Web hosting # 35&nbsp;</div>
    </div>
  
    <div title2="13" id="rw2564" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Wed 28th Dec&nbsp;</div>
    <div class="cellmorder">-57</div>
    <div class="celldescr">CASH</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">100.00</div>
    <div class="cellbal r">42.08</div>
    <div class="cellsav r">233.67</div>
    <div class="cellnotes">LINK    19:29DEC23&nbsp;</div>
    </div>
  
    <div title2="14" id="rw1913" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Sat 31st Dec&nbsp;</div>
    <div class="cellmorder">-54</div>
    <div class="celldescr">INTEREST TAX PAID</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">0.00</div>
    <div class="cellbal r">42.08</div>
    <div class="cellsav r">233.67</div>
    <div class="cellnotes">2014&nbsp;</div>
    </div>
  
    <div title2="15" id="rw2206" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Sat 31st Dec&nbsp;</div>
    <div class="cellmorder">-54</div>
    <div class="celldescr">Tmobile</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">0.00</div>
    <div class="cellbal r">42.08</div>
    <div class="cellsav r">233.67</div>
    <div class="cellnotes">£10 top-up #4 (smart pack - 1GB data, 400mins)&nbsp;</div>
    </div>
  
    <div title2="16" id="rw2566" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Tue 10th Jan&nbsp;</div>
    <div class="cellmorder">-44</div>
    <div class="celldescr">ISA Account</div>
    <div class="cellin r">200.00</div>
    <div class="cellout r">0.00</div>
    <div class="cellbal r">242.08</div>
    <div class="cellsav r">233.67</div>
    <div class="cellnotes">&nbsp;</div>
    </div>
  
    <div title2="17" id="rw2567" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Wed 11th Jan&nbsp;</div>
    <div class="cellmorder">-43</div>
    <div class="celldescr">PAYPAL *FRONTLINE</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">12.16</div>
    <div class="cellbal r">229.92</div>
    <div class="cellsav r">221.51</div>
    <div class="cellnotes">Anusol&nbsp;</div>
    </div>
  
    <div title2="18" id="rw2568" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Wed 18th Jan&nbsp;</div>
    <div class="cellmorder">-36</div>
    <div class="celldescr">BYTEMARK HOSTING</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">12.00</div>
    <div class="cellbal r">217.92</div>
    <div class="cellsav r">209.51</div>
    <div class="cellnotes">Web hosting # 35&nbsp;</div>
    </div>
  
    <div title2="19" id="rw2569" class="cellrow prevdayscol">
    <div style="clear:both"></div>
    <div class="celldate">Thu 26th Jan&nbsp;</div>
    <div class="cellmorder">-28</div>
    <div class="celldescr">CASH</div>
    <div class="cellin r">0.00</div>
    <div class="cellout r">100.00</div>
    <div class="cellbal r">117.92</div>
    <div class="cellsav r">109.51</div>
    <div class="cellnotes">LINK    19:29DEC23&nbsp;</div>
    </div>
  </div>

<script>
// Highlight first row:

$(document).ready( function(){

  // What to do when an item in 'listview' is clicked.
  $('.cellrow').click( function(){
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
      url:'inc/ajax/ajax.getrow.php',
      data:'rowid=' + selid,
      success: function (data){
        //alert(data);
        var splitdata = data.split('|');
        var editdata  = splitdata[0];
        handleupdown(splitdata[1]); // min||morder||max
        
        $('#editrow').html(editdata); // Update edit
        
        //Cufon.replace('#cellhead, fieldset legend, #editdata'); // 
        // 
        $("#date").datepicker();
        
        $.ajax({
          type:'post',
          url:'inc/ajax/ajax.getlist.php',
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
          url:'inc/ajax/ajax.getlist.php',
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


  $('.cellrow').hover( function() {
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
</script>
</div>
    
    <script>

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
      url:'inc/ajax/ajax.getrow.php',
      data:'rowid=' + newrowid,
      success: function (data){
        //alert(data);
        var splitdata = data.split('|');
        var editdata  = splitdata[0];
        handleupdown(splitdata[1]);

        $('#editrow').html(editdata); // Update edit

        // Update scroll position
        goToByScroll("listview #rw"+$('#rowidsel').text());
        Cufon.replace('#cellhead, fieldset legend'); // 
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
    // Update listview
    $.ajax({
      type:'post',
      url:'inc/ajax/ajax.listview.php',
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
      url:'inc/ajax/ajax.listview.php',
      data:'editrowid=' + $('#rowidsel').text()
        + '&code='      + $('#code').val()
        + '&date='      + $('#date').val()
        + '&amount='    + $('#amount').val()
        + '&in='        + $('#in').is(':checked')
        + '&descr='     + encodeURIComponent($('#descr').val())
        + '&notes='     + encodeURIComponent($('#notes').val()),
      success: function(data) {
        //alert(data);
        $('#listview').html(data); // Repopulate listview
        goToByScroll("listview #rw"+$('#rowidsel').text());
        Cufon.replace('#cellhead, fieldset legend'); // 
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
      url:'inc/ajax/ajax.acc.php',
      data:'a=' + $(this).attr('id'),
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
      url:'inc/ajax/ajax.acc.php',
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
      type:'post',
      url:'inc/ajax/ajax.moveupdown.php',
      data:'rowid=' + $('#rowidsel').text()
        + '&dir=' + dir,
      success: function(data) {
        //alert(data); // Id for row that was moved.
        var splitdata = data.split('|');
        if (splitdata.length==2) {
          var newdata  = splitdata[0];
          var firstrow = splitdata[1];
          repopulatelistview(newdata, firstrow);
        } else {
          repopulatelistview(data);
        }

      } // End success.

    });
    
    
  });
  // End
  
  

  
  // Add row:
  $('#btnAddrow').live('click', function(){
    //alert();
    $.ajax({
      type:'post',
      url:'inc/ajax/ajax.addrow.php',
      success: function(data) {
        // Returns ID for the new row added in data
        repopulatelistview(data);
      } // End success.

    });
      
  });
  // End 
    
    
  // Duplicate row:  
  $('#btnDuplicate').live('click', function(){
    //alert();
    $.ajax({
      type:'post',
      url:'inc/ajax/ajax.duplicaterow.php',
      data:'editrowid=' + $('#rowidsel').text()
      + '&code='   + $('#code').val()
      + '&date='   + $('#date').val() 
      + '&amount=' + $('#amount').val()
      + '&in='     + $('#rdoIn').is(':checked')
      + '&descr='  + $('#descr').val()
      + '&notes='  + $('#notes').val(),
      
      success: function(data) {
        alert(data);
        // data contains the ID of the new row.
        repopulatelistview(data);
      }

    });

  });
  // End duplicate row ajax code.
    
    
    
    
    
    
    
  // Delete row:  
  $('#btnDelete').live('click', function(){
    //alert();
    $.ajax({
      type:'post',
      url:'inc/ajax/ajax.deleterow.php',
      data:'highlightfirstrow=0&rowid=' + $('#rowidsel').text()
         + '&date=' + $('#txtDate').val(),
      success: function(data) {
        repopulatelistview(data, data);
      }

    });

  });
  // End 
    
    
  // Transfer row
  $('#btnTransfer').live('click', function() {
    // Get details of row to be transferred:
    //alert('');
    $.ajax({
      type:'post',
      url:'inc/ajax/ajax.transfer.php',
      data:'getrow=1'
      + '&rowid=' + $('#rowidsel').text()
      + '&runbal=' + $('#currrunbal').val(),
      success: function(runbal) {
        var retstr = runbal.split('|');
        runbal = retstr[0];
        var descr = retstr[1];
        if (confirm("Transfer row #"+$('#rowidsel').text()+"\n" + "to make new balance £" + (parseFloat(runbal).toFixed(2)) + "?")) {
          //alert('Transfered row');
          $.ajax({
            type:'post',
            url:'inc/ajax/ajax.transfer.php',
            data:'getrow=0&rowid=' + $('#rowidsel').text() + '&runbal=' + runbal,
            success: function(data) {
              $.ajax({
                type:'post',
                url:'inc/ajax/ajax.deleterow.php',
                data:'highlightfirstrow=1&rowid=' + $('#rowidsel').text() + '&date=' + $('#txtDate').val(),
                success: function(rowid) {
                  repopulatelistview(rowid, rowid);
              
                  // Update account balance:
                  $('#currrunbal').val(parseFloat(runbal).toFixed(2)); // new running balance
                  $('#currdescr').text(descr); // new descr
                }

              });
              
              // End delete row.
            }

          });

        } // End if (conf).
        
      }
    });
    
    

    
  });

  var cities = [ ' LOCALBILLING.COM/7','7DIGITAL EUROPE SA','A.P.C.C','A&P TECHNOLOGY INC','ad','AMAZON *MKTPLCE EU','Amazon Digital Dwn','AMAZON EU','Amazon Marketplace','AMAZON SERVICES EU','AMAZON SERVICES EU 04089082314','AMAZON SERVICES EU 04603136616','AMAZON SERVICES EU 04657033181','AMAZON SERVICES EU 05947017882','AMAZON SERVICES EU 06431373798','AMAZON SERVICES EU 09254982382','AMAZON SERVICES EU 12910790719','AMAZON SERVICES EU 13999807611','AMAZON SERVICES EU 17354131498','AMAZON SERVICES EU 17805641519','AMAZON SERVICES EU 18555674843','AMAZON SERVICES EU 18891136876','AMAZON SERVICES EU 19183307052','AMAZON SERVICES EU 19597376709','AMAZON SERVICES EU 23862922097','AMAZON SERVICES EU 28625814744 ','AMAZON SERVICES EU 29022266853','AMAZON SERVICES EU 29267235758','Amazon Svcs EU-Ind','AMAZON SVCS EU-UK','AMAZON SVCS EU-UK 02402714763','AMAZON SVCS EU-UK 04040511559','AMAZON SVCS EU-UK 07056753738','AMAZON SVCS EU-UK 07294333191','AMAZON SVCS EU-UK 11610358815','AMAZON SVCS EU-UK 12740331687','AMAZON SVCS EU-UK 14470553647','AMAZON SVCS EU-UK 14942756237','AMAZON SVCS EU-UK 18396900415','AMAZON SVCS EU-UK 29567555700','Amazon Svcs Europe','Amazon UK Retail','AMAZON.CO.UK','APRESSMEDIA','ARGOS DIRECT','ARGOS RETAIL GROUP','ARIA TECHNOLOGY LTD','ARQIVA WIFI','ASDA DIRECT WEB 4','AW','AWL*PEARSON EDUCAT','AWL*PRENTICE HALL','AWORK','AWORK.CO.UK','B&K verlag','Barrats','Bikes 2U Direct','BLUE LEVEL.COM','Boots','Boots.com','BYTEMARK HOSTING','CASH','CB-CAST','CCB','CCBill.com *','CCBill.com *Activ','CCBill.com *Billi','CCBill.com *Darin','CCBill.com *Dee','CCBill.com *FTV L','CCBill.com *Globa','CCBill.com *Go-Su','CCBill.com *Halst','CCBill.com *HVLCy','CCBill.com *K3X E','CCBill.com *Littl','CCBill.com *Mythi','CCBill.com *On Th','CCBill.com *Profi','CCBill.com *Rob','CCBill.com *XFC I','CCBILLEU','CCBILLEU.COM','CCBILLEU.COM +1888','CCBILLEU.COM*','CCBILLEU8885969279','CET UK','CGBILLING.COM','Chat','CLARANET','CLKBANK*COM DOWNLO','COMPUTER BASED EXA','COMPUTER BASED EXAM','COUNTER17:20 18OCT','Crucial','DALEPAK PARTNERSHIP','DATAVIZ','Digi-UK','DIGITAL RIVERINTER','DISCOUNT BICYCLES','DR *Mpeg to AVI DI','DR *SWREG, Inc.','DR*PINNACLESYS.','DRI*GR1 INNOVATION','DRI*WWW.ELEMENT5.I','DVLA DRIVER ONLINE','EASILY LTD','EATAY.COM','eBay','eBay-PayPal','EBUYER (UK)','EBUYER (UK) LTD','EE & T-MOBILE','EE & T-MOBILE Q0340319839','EE and T-MOBILE Q0340319839','EE dongle','EMETRIXONLINESALES','EMPIRE DIRECT WEB','EPOCH.COM *RAWME','EYE-DEZIGNS','FEES COPY ITEM','FRd','FWBILLING.COM','GETDATA PTY LTD','GITHUB.COM 2EM3G','GMBILL COM PTY LTD','GOBEYOND SERVICES','GOOGLE *Commerce L','GOOGLE *Music','GOOGLE *SomaFM com','GOOGLE *TCreations','GOOGLE CHECKOUT','gpl-cc.com','HCDCHAUFFER.COM','HMRC SELF ASSESSME','ICS.COM','IMCBILL.COM','INDIA EARTHQUAKE','IOBILLING.COM','IPAYBV.COM','ISLAMICBOOKSTORE.COM','JJBSPORTS','Kamera Photographic Ltd','KASPERSKY-ARVATO','KITBAG GBP','LALIBCO.COM 6048','LEARNABLE.COM','limevpnco','LINK 19:21JAN13','Lovefilm','lovefilm.com','MAXXPAY.COM','MBI-PROBILLER.COM/','MC - WWW.ITIPS.NET','MCAFFE.COM','MicrosoftIrelandOp','MISCO','MOTRICITYINC PALMG','NERO AG','NETBANX-HUBPEOPLE','NEWSQUEST (LONDON)','NEWSQUEST NEWSPRS','NSTF GBP12.23','NSTF GBP5.49','O\'REILLY MEDIA','OFFTEK INTERNETLTD','OLYMPIC SHAVER CEN','ORANGE','ORANGE (A/EQ/02','ORANGE (AE/EQ/02)','ORANGE (AE/PG/02)','ORANGE.CO.UK TOPUP','OREILLY MEDIA','OYSTER RENEW WEB','OYSTER TRAVELCARD','P-MYDOWNLOADING.C','PAYCOM.NET','PAYCOM.NET  *393MediaGr','PAYCOM.NET  *ECWDInc','PAYCOM.NET  *InternetMe','PAYCOM.NET *APNet','PAYCOM.NET *Cyber','PAYCOM.NET *MANSTERMED','Paypal - ebay','PAYPAL *','PAYPAL *A2BSHOPPIN','PAYPAL *AMAGICOM A','PAYPAL *AMJIDMAHMO','PAYPAL *ARQIVAWIFI','PAYPAL *ASDASTORES','PAYPAL *BABZMEDIAL','PAYPAL *DNREGISTRA','PAYPAL *EASYINTSOL','PAYPAL *LARRYULLMA','PAYPAL *LI XUEHUA','PAYPAL *MMANIA','PAYPAL *MMPARTNERS','PAYPAL *SERVICECHA','PAYPAL *SITEPOINT','PAYPAL *SPORTSDIRE','PAYPAL *SUBLIMEHQP','PAYPAL *TNVWEBSERV','PAYPAL *TRAVELODGE','PAYPAL *WARDAHGULL','PAYPAL *WENDY','PayPal eBay','PAYPAL ebuyer','PAYPAL PAYMENT','PAYPAL PAYMENT - eBay','PAYPAL PAYMENT 4D5222226E4','PAYPAL PAYMENT 4D5222226E478','PAYPAL VERIFY','pixmania.com','PLENTYOFFISH MEDIA','POF','Post Office Ltd','Premere Inn','Premier Inn','PREMIER INN4402864','Premiere Inn','Q B S SOFTWARE LTD','QUIETLYNN LIMITED','ROYAL MAIL','ROYAL MAIL NON REC','RYMAN DIRECT','SCAN COMPUTERS LTD','SegpayEU.com/Reall','SHANGHAI HANYUEYIN','SIMPLY COMPUTERS','SIMPLY COMPUTERS M','SitePoint','Sportsdirect','SPORTSDIRECT.COM','SPORTY SHOP LTD','STAK TRADING COMP','STERLING HOUSE INT','SUMIT SINHA OYSTER','Tele-Billing','TELE-BILLING.COM','Tesco Direct','TESCO IC','TFL TOM','TFL.GOV.UK/CP','TFR 40071551370235','TFR 40403961626213','Tmobile','Top Man','TRANSPORT TRADING','Travelodge','TRAVELODGE WEBSITE','Travelodge wifi','Trust Systems Ltd','U K SPORT IMPORTS','Uncov','VODAFONE PAYG','VTL SCE','VUE ITCERTIFICATIO','WEBBILING.COM LTD','WESTCOAST (HP) LTD','WP-DASHWOOD DIRECT','WP-ILEARN.TO LTD','WP-LOW CARBS','WP-SITEPOINT PTY Ltd','WP-SUNGLASSES SHOP','WPI*IFRIENDS-UK CM','WPI*IFRIENDS-UK EL','WPI*IFRIENDS-UK IN','WPI*IFRIENDS-UK MU','WPI*IFRIENDS-UK RE','WWW.247STARSUPPORT','WWW.DIYHOSTS.CO.UK','WWW.E-LITES.CO.UK','WWW.EASYINTSOL.CO.','WWW.EASYINTSOL.CO.UK','WWW.MAPLIN.CO.UK','WWW.STAPLES.CO.UK','WWW.TOTALPDA.CO.UK','WWW.TRAVELODGE.CO.','WWW.TRIPP.CO.UK','XTRABILL','XTRABILL.COM','zombaio.com 36LRAM','zombaio.com RET-C0' ];

  $("#descr").autocomplete({
    source:cities,
    minLength: 0
  }).click(function(){
    $(this).autocomplete("search");
  });

  var cities = [ '0.00','0.05','0.10','0.14','0.15','0.16','0.20','0.33','0.49','0.60','0.63','0.65','0.71','0.79','0.80','0.86','0.97','0.99','1.00','1.02','1.03','1.19','1.40','1.43','1.49','1.50','1.54','1.60','1.63','1.80','1.88','1.89','1.93','1.95','1.98','1.99','2.00','2.15','2.21','2.22','2.29','2.44','2.48','2.58','2.59','2.70','2.75','2.76','2.77','2.80','2.84','2.89','2.95','2.98','2.99','3.00','3.04','3.09','3.10','3.13','3.19','3.20','3.21','3.24','3.29','3.35','3.42','3.43','3.47','3.48','3.49','3.50','3.66','3.74','3.76','3.79','3.81','3.85','3.90','3.92','3.96','3.98','3.99','4.03','4.04','4.07','4.09','4.10','4.11','4.19','4.20','4.25','4.29','4.42','4.44','4.45','4.46','4.48','4.49','4.50','4.52','4.55','4.56','4.62','4.66','4.67','4.71','4.73','4.75','4.76','4.78','4.89','4.92','4.97','4.98','4.99','5.00','5.03','5.10','5.12','5.13','5.17','5.19','5.23','5.26','5.29','5.33','5.35','5.40','5.43','5.49','5.50','5.51','5.54','5.60','5.72','5.74','5.82','5.85','5.90','5.94','5.96','5.97','5.98','5.99','6.06','6.10','6.22','6.27','6.29','6.30','6.32','6.36','6.38','6.39','6.40','6.42','6.48','6.49','6.50','6.55','6.58','6.61','6.70','6.72','6.74','6.75','6.76','6.80','6.84','6.85','6.90','6.91','6.93','6.95','6.97','6.99','7.01','7.15','7.19','7.27','7.35','7.45','7.49','7.50','7.59','7.60','7.70','7.82','7.90','7.92','7.94','7.98','7.99','8.02','8.03','8.05','8.16','8.35','8.45','8.76','8.88','8.89','9.17','9.32','9.39','9.52','9.59','9.69','9.90','9.95','9.96','9.98','9.99','10.00','10.01','10.11','10.22','10.34','10.40','10.45','10.49','10.50','10.51','10.56','10.66','10.70','10.80','10.84','10.85','10.95','10.99','11.07','11.14','11.15','11.24','11.25','11.42','11.43','11.44','11.49','11.50','11.56','11.63','11.64','11.73','11.74','11.88','11.93','11.99','12.00','12.16','12.22','12.23','12.38','12.49','12.50','12.60','12.68','12.69','12.71','12.73','12.76','12.80','12.82','12.83','12.87','12.90','12.91','12.92','12.95','12.99','13.00','13.06','13.09','13.14','13.20','13.24','13.25','13.35','13.38','13.40','13.44','13.45','13.46','13.48','13.49','13.52','13.57','13.59','13.80','13.89','13.94','13.96','13.97','14.10','14.18','14.22','14.28','14.29','14.32','14.39','14.43','14.46','14.49','14.52','14.53','14.62','14.66','14.70','14.83','14.87','14.95','14.99','15.00','15.02','15.14','15.21','15.26','15.28','15.30','15.33','15.39','15.49','15.60','15.77','15.79','15.90','15.95','15.98','15.99','16.00','16.13','16.14','16.18','16.38','16.42','16.45','16.58','16.60','16.68','16.90','16.95','17.09','17.33','17.39','17.40','17.43','17.50','17.54','17.56','17.58','17.59','17.61','17.63','17.77','17.80','17.82','17.86','17.95','17.97','17.98','18.00','18.04','18.12','18.13','18.32','18.51','18.65','18.73','18.78','18.79','18.80','18.82','18.85','18.91','18.97','18.99','19.00','19.03','19.22','19.28','19.49','19.50','19.56','19.60','19.82','19.83','19.86','19.95','19.96','19.99','20.00','20.01','20.21','20.34','20.35','20.41','20.42','20.48','20.65','20.74','20.80','20.86','20.99','21.00','21.06','21.20','21.42','21.60','21.94','21.96','21.98','22.00','22.44','22.65','22.90','22.98','23.00','23.13','23.25','23.48','23.50','23.70','23.99','24.00','24.01','24.11','24.26','24.43','24.45','24.49','24.59','24.60','24.66','24.93','24.94','24.97','24.99','25.00','25.32','25.46','26.00','26.30','26.71','26.75','26.89','26.91','26.94','26.95','27.00','27.07','27.24','27.26','27.33','27.68','27.95','27.96','27.99','28.00','28.13','28.50','28.78','28.95','29.00','29.06','29.10','29.14','29.23','29.45','29.50','29.70','29.74','29.79','29.95','29.97','29.99','30.00','30.75','30.84','30.95','30.98','31.00','31.04','31.54','31.95','31.98','31.99','32.53','32.98','33.00','33.26','33.29','33.48','33.69','33.99','34.00','34.01','34.72','34.79','34.90','34.95','35.00','35.21','35.25','35.40','35.50','36.00','36.08','36.16','37.00','37.75','37.84','37.97','37.99','38.00','38.62','38.74','38.78','39.00','39.90','39.95','39.99','40.00','40.98','41.02','41.90','41.92','41.98','42.00','42.01','42.48','42.90','43.00','43.20','43.26','43.36','43.51','44.00','44.03','44.05','44.10','44.20','44.64','45.18','45.47','45.50','45.71','45.98','46.20','46.58','46.95','47.14','47.22','48.10','48.47','48.76','48.82','48.99','49.69','49.98','49.99','50.00','50.58','51.00','51.59','51.71','52.42','52.86','52.92','53.67','53.98','54.00','54.09','55.72','55.80','56.00','56.69','56.94','57.00','57.08','57.47','58.83','59.71','59.90','59.98','60.00','61.97','62.00','62.20','63.45','64.10','64.67','66.90','68.14','68.93','69.30','69.77','69.99','70.40','70.90','71.59','74.00','74.84','75.11','75.50','75.97','76.92','76.95','77.00','78.70','79.30','79.88','79.97','79.98','81.00','82.00','82.98','83.00','83.99','84.60','84.96','85.00','86.96','88.00','88.15','89.00','89.98','89.99','90.60','91.50','93.00','93.98','94.94','95.86','97.81','99.27','99.96','99.98','100.00','103.80','104.94','105.50','105.94','107.50','109.00','109.98','110.12','111.96','112.00','114.16','115.00','117.50','119.00','120.50','123.36','124.00','125.00','125.73','126.00','128.94','130.28','140.00','143.00','144.95','145.50','146.00','147.25','150.00','153.00','154.00','159.24','159.99','163.00','169.99','170.00','180.00','183.93','191.93','197.00','197.40','198.07','199.99','200.00','209.99','212.76','220.00','230.00','238.00','245.55','247.08','255.00','259.66','264.39','310.20','327.50','379.99','392.00','403.00','455.50','481.03','500.00','520.00','540.00','580.00','615.00','641.67','654.46','706.00','713.23','730.00','746.00','812.19','903.00','936.00','1095.00','1145.00','1183.00','1407.03','1442.00','1540.00','1545.00','1597.00','1600.00','1609.00' ];

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