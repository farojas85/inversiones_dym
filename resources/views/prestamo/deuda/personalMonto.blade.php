<div class="col-6">
    {!! Form::label(null,'Asignado: S/ '.number_format($personalmonto->total_asignado,2),['class' =>'col-form-label']) !!}
</div>
<div class="col-6">
    {!! Form::label(null,'Saldo: S/ '.number_format($personalmonto->total_saldo,2),['class' =>'col-form-label']) !!}
    {!! Form::hidden('hdd_saldo', $personalmonto->total_saldo , [ 'id' => 'hdd_saldo']) !!}
</div>