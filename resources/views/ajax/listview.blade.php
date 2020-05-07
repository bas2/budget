<table class="table">
  <thead>
  <tr>
    <th class="text-right">Date</th>
    <th></th>
    <th>Description</th>
    <th class="text-right">IN</th>
    <th class="text-right">OUT</th>
    <th class="text-right">Balance</th>
    <!-- <th class="text-right">Total</th> -->
    <th>Notes</th>
  </tr>
  </thead>
  <tbody>
  @foreach($rows as $budgetrow)
    <tr{{ ((++$rowcounter==1)?' title2=1':'') }} id="rw{{ $budgetrow->id }}" class="cellrow">
      <td class="text-right" nowrap="nowrap">{{ \Carbon\Carbon::parse($budgetrow->date)->format('D j M') }}</td>
      <td>{{ \Carbon\Carbon::parse(date('Y-m-d'))->diff( \Carbon\Carbon::parse($budgetrow->date) )->days }}</td>
      <td>{{ $budgetrow->description }}</td>
      <td class="text-right">{{ number_format($budgetrow->incoming,2) }}</td>
      <td class="text-right">{{ number_format($budgetrow->outgoing,2) }}</td>
      <td class="text-right">{{ number_format( ($runbal += $budgetrow->incoming -= $budgetrow->outgoing),2) }}</td>
      <!-- <td class="text-right">{{ number_format( ($runbal + \App\Saving::getLastEntry('runbal')),2 ) }}</td> -->
      <td>{{ $budgetrow->notes }}&nbsp;</td>
    </tr>
  @endforeach
  </tbody>
</table>
