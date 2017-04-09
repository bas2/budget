<table class="table">
  <thead>
  <tr>
    <th>Date</th>
    <th>-</th>
    <th>Description</th>
    <th>IN</th>
    <th>OUT</th>
    <th>Balance</th>
    <th>Total</th>
    <th>Notes</th>
  </tr>
  </thead>
  <tbody>
  @foreach($rows as $budgetrow)
    <tr id="rw{{ $budgetrow->id }}" class="cellrow">
      <td>{{ \Carbon\Carbon::parse($budgetrow->date)->format('d/m/Y') }}</td>
      <td>{{ \Carbon\Carbon::parse($budgetrow->date)->diff(\Carbon\Carbon::now())->days }}</td>
      <td>{{ $budgetrow->description }}</td>
      <td>{{ number_format($budgetrow->incoming,2) }}</td>
      <td>{{ number_format($budgetrow->outgoing,2) }}</td>
      <td>{{ $runbal += $budgetrow->incoming -= $budgetrow->outgoing }}</td>
      <td>{{ $runbal + \App\Saving::getLastEntry('runbal') }}</td>
      <td>{{ $budgetrow->notes }}&nbsp;</td>
    </tr>
  @endforeach
  </tbody>
</table>
