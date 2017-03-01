<div id="cellhead">
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
@foreach($rows as $budgetrow)
  <div title2="1" id="rw{{ $budgetrow->id }}" class="cellrow prevdayscol">
  <div style="clear:both"></div>
  <div class="celldate">{{ \Carbon\Carbon::parse($budgetrow->date)->format('d/m/Y') }}</div>
  <div class="cellmorder">{{ \Carbon\Carbon::parse($budgetrow->date)->diff(\Carbon\Carbon::now())->days }}</div>
  <div class="celldescr">{{ $budgetrow->description }}</div>
  <div class="cellin r">{{ number_format($budgetrow->incoming,2) }}</div>
  <div class="cellout r">{{ number_format($budgetrow->outgoing,2) }}</div>
  <div class="cellbal r">
  {{ $runbal += $budgetrow->incoming -= $budgetrow->outgoing }}
  </div>
  <div class="cellsav r">{{ $runbal + \App\Saving::getLastEntry('runbal') }}</div>
  <div class="cellnotes">{{ $budgetrow->notes }}&nbsp;</div>
  </div>
@endforeach
</div>

