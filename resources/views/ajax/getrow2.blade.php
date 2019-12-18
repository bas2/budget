{{-- // Retrieves row to display in 'Edit row' section: --}}
<div class="form-group">
{!! Form::select('code2', $codes, $editrows2['code']) !!}

{!! Form::text('date2', $editrows2['date'], ['class'=>'form-control','id'=>'datepicker2','title'=>'date']) !!}

{!! Form::text('descr2', $editrows2['descr'], ['class'=>'form-control','title'=>'description']) !!}

{!! Form::text('amount2', number_format($editrows2['amount'],2), ['class'=>'form-control','title'=>'amount']) !!}
</div>

<div class="form-group">
{!! Form::label('in2',Form::radio('in_out', 'in', $editrows2['incoming'], ['id'=>'in2']).'In',['class'=>'radio-inline'],false ) !!}

{!! Form::label('out2',Form::radio('in_out', 'out', $editrows2['outgoing'], ['id'=>'out2']).'Out',['class'=>'radio-inline'],false ) !!}
</div>

<div class="form-group">
{!! Form::text('notes2', $editrows2['notes'], ['class'=>'form-control text-block','title'=>'notes']) !!}
</div>

{!! Form::submit('Update >', ['class'=>'btn btn-primary btn-block','id'=>'editdata2']) !!}

{!! Form::submit('< Budget', ['class'=>'btn btn-primary btn-block','id'=>'movedata2']) !!}

<script>
    $('input#datepicker2').datepicker({
        format: "dd/mm/yyyy"
    });
</script>
