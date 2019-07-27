{{-- // Retrieves row to display in 'Edit row' section: --}}
<div class="form-group">
{!! Form::select('code', $codes, $editrows['code']) !!}

{!! Form::text('date', $editrows['date'], ['class'=>'form-control','id'=>'datepicker','title'=>'date']) !!}

{!! Form::text('descr', $editrows['descr'], ['class'=>'form-control','title'=>'description']) !!}

{!! Form::text('amount', number_format($editrows['amount'],2), ['class'=>'form-control','title'=>'amount']) !!}
</div>

<div class="form-group">
{!! Form::label('in',Form::radio('in_out', 'in', $editrows['incoming'], ['id'=>'in']).'In',['class'=>'radio-inline'],false ) !!}

{!! Form::label('out',Form::radio('in_out', 'out', $editrows['outgoing'], ['id'=>'out']).'Out',['class'=>'radio-inline'],false ) !!}
</div>

<div class="form-group">
{!! Form::text('notes', $editrows['notes'], ['class'=>'form-control text-block','title'=>'notes']) !!}
</div>

{!! Form::submit('Update >', ['class'=>'btn btn-primary btn-block','id'=>'editdata']) !!}
