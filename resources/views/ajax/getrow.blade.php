{{-- // Retrieves row to display in 'Edit row' section: --}}
{!! Form::open() !!}

{!! Form::select('code', $codes, $editrows['code']) !!}

{!! Form::text('date', $editrows['date'], ['id'=>'date','style'=>'width:6em;', 'title'=>'date']) !!}

{!! Form::text('descr', $editrows['descr'], ['style'=>'width:17em;', 'title'=>'description']) !!}

{!! Form::text('amount', $editrows['amount'], ['style'=>'width:4em;', 'title'=>'amount']) !!}

{!! Form::text('notes', $editrows['notes'], ['style'=>'width:17em;', 'title'=>'notes']) !!}

<div id="rdoBtnGroupinout">
<div>
{!! Form::label('in', 'In') !!}
{!! Form::radio('in_out', 'in', 0, ['id'=>'in']) !!}
</div>
<div>
{!! Form::label('out', 'Out') !!}
{!! Form::radio('in_out', 'out', 1, ['id'=>'out']) !!}
</div>
</div>

{!! Form::submit('Update', ['id'=>'editdata']) !!}


{!! Form::close() !!}

