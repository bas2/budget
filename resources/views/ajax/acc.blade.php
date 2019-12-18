<div class="container-fluid" id="listview2">

<div class="row">
<div class="col-md-7 col-sm-12 col-xs-12 panel text-center">
      <fieldset class="l hunp">
        <legend>Edit row <span class="badge" id="rowidsel2">{{ $latestID }}</span></legend>
        <div id="editrow2">@include('ajax.getrow2')</div>
      </fieldset>
    </div>
</div>

<div class="row">

<p>[Close X]</p>

<table class="table">
  <thead>
  <tr>
    <th>Code</th>
    <th>Date</th>
    <th>Description</th>
    <th class="text-right">Incoming</th>
    <th class="text-right">Outgoing</th>
    <th class="text-right">Balance</th>
    <th>Notes</th>

  </tr>
  </thead>
  <tbody>
  @foreach($rows as $accrow)
    <tr title2="{{ $accrow->id }}" class="cellrow2 {{ ($accrow->id == $latestID) ? ' hl' : '' }}">
      <td>{{ $accrow->code }}</td>
      <td>{{ \Carbon\Carbon::parse($accrow->date)->format('d/m/Y') }}</td>
      <td>{{ $accrow->description }}</td>
      <td class="text-right">{{ number_format($accrow->incoming, 2) }}</td>
      <td class="text-right">{{ number_format($accrow->outgoing, 2) }}</td>
      <td class="text-right">{{ number_format($accrow->runbal, 2) }}</td>
      <td>{{ $accrow->notes }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
</div>

<script>
  // Update row
  $('body').on('click', '#editdata2', function(e) {
    $.ajax({
      type:'POST',
      url:'acc/' + $('#rowidsel2').text(),
      data:''
        + 'code='       + $('select[name=code2]').val()
        + '&date='      + $('#datepicker2').val()
        + '&amount='    + $('input[name=amount2]').val()
        + '&in='        + $('#in2').is(':checked')
        //+ '&runbal='    + 
        + '&descr='     + encodeURIComponent($('input[name=descr2]').val())
        + '&notes='     + encodeURIComponent($('input[name=notes2]').val()),
      success: function(data) {
        $('#accsdiv').html(data);                     // Repopulate listview
      }
    });
    e.preventDefault();
  });
</script>
