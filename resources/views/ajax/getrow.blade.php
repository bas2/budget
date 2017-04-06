{{-- // Retrieves row to display in 'Edit row' section: --}}
{{-- {!! Form::open() !!} --}}

{!! Form::select('code', $codes, $editrows['code']) !!}

{!! Form::text('date', $editrows['date'], ['id'=>'date','title'=>'date']) !!}

{!! Form::text('descr', $editrows['descr'], ['title'=>'description']) !!}

{!! Form::text('amount', $editrows['amount'], ['title'=>'amount']) !!}

{!! Form::text('notes', $editrows['notes'], ['title'=>'notes']) !!}

<div id="rdoBtnGroupinout">
  <div>
  {!! Form::label('in', 'In') !!}
  {!! Form::radio('in_out', 'in', $editrows['incoming'], ['id'=>'in']) !!}
  </div>
  <div>
  {!! Form::label('out', 'Out') !!}
  {!! Form::radio('in_out', 'out', $editrows['outgoing'], ['id'=>'out']) !!}
  </div>
</div>

{!! Form::submit('Update', ['id'=>'editdata']) !!}


{{-- {!! Form::close() !!} --}}

