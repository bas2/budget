{{-- // Retrieves row to display in 'Edit row' section: --}}
<div class="form-group">


{!! Form::text('date', $editrows2['date'], ['class'=>'form-control','id'=>'datepicker2','title'=>'date']) !!}

{!! Form::text('descr', $editrows2['description'], ['class'=>'form-control','title'=>'description']) !!}

{!! Form::text('amount', number_format($editrows2['amount'],2), ['class'=>'form-control','title'=>'amount']) !!}
</div>

<div class="form-group">
{!! Form::label('in',Form::radio('in_out', 'in', $editrows2['incoming'], ['id'=>'in']).'In',['class'=>'radio-inline'],false ) !!}

{!! Form::label('out',Form::radio('in_out', 'out', $editrows2['outgoing'], ['id'=>'out']).'Out',['class'=>'radio-inline'],false ) !!}
</div>

<div class="form-group">
{!! Form::text('notes', $editrows2['notes'], ['class'=>'form-control text-block','title'=>'notes']) !!}
</div>

{!! Form::submit('Update >', ['class'=>'btn btn-primary btn-block','id'=>'editdata2']) !!}

{!! Form::submit('< Budget', ['class'=>'btn btn-primary btn-block','id'=>'movedata2','disabled','disabled']) !!}

<script>
    $('input#datepicker2').datepicker({
        format: "dd/mm/yyyy"
    });
</script>
