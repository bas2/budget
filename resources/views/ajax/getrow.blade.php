{{-- // Retrieves row to display in 'Edit row' section: --}}
{{-- {!! Form::open() !!} --}}

{!! Form::select('code', $codes, $editrows['code']) !!}

{!! Form::date('date', $editrows['date'], ['class'=>'form-control','id'=>'date','title'=>'date']) !!}

{!! Form::text('descr', $editrows['descr'], ['class'=>'form-control','title'=>'description']) !!}

{!! Form::text('amount', $editrows['amount'], ['class'=>'form-control','title'=>'amount']) !!}

{!! Form::text('notes', $editrows['notes'], ['class'=>'form-control','title'=>'notes']) !!}

<div class="form-group">
{!! Form::label('in',Form::radio('in_out', 'in', $editrows['incoming'], ['id'=>'in']).'In',['class'=>'radio-inline'],false ) !!}

{!! Form::label('out',Form::radio('in_out', 'out', $editrows['outgoing'], ['id'=>'out']).'Out',['class'=>'radio-inline'],false ) !!}
</div>

{!! Form::submit('Update >', ['class'=>'btn btn-primary btn-block','id'=>'editdata']) !!}


{{-- {!! Form::close() !!} --}}

