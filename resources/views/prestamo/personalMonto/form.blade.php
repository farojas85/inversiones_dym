<div class="col-md-12">
    <div class="form-group row">
        {!! Form::label('personal_id','Personal',['class' =>'col-md-3 col-form-label text-right']) !!}
        <div class="col-md-9">
            <select id="personal_id" name="personal_id" class="form-control" 
                    0placeholder="Seleccione"  required="">
                <option value="">-SELECCIONE-</option>
                @foreach ($personals as $p)
                <option value="{{ $p->id }}">{{ $p->nombres }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group row">
        {!! Form::label('fecha','fecha',['class' =>'col-md-3 col-form-label text-right']) !!}
        <div class="col-md-9">
            {!!
                Form::date('fecha', \Carbon\Carbon::now(),
                            [   'class' => 'form-control', 'id' => 'fecha'])
            !!}
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group row">
        {!! Form::label('monto_asignado','Monto',['class' =>'col-md-3 col-form-label text-right']) !!}
        <div class="col-md-9">
            {!!
                Form::number('monto_asignado', null,
                            [   'class' => 'form-control', 'id' => 'monto_asignado',
                                'placeholder' => 'Ingrese Monto a Asignar','required'=>'',
                                'min'=>0])
            !!}
        </div>
    </div>
</div>
<div class="form-group text-center">
    <button type="button" class="btn btn-success" id="btn-guardar" value="{{ $estadoform }}" name="btn-guardar">
        <i class="{{ ($estadoform == 'create') ? 'ti-save' : 'fe-refresh-cw '}}"></i>
        {{ ($estadoform =='create') ? 'Guardar' : 'Actualizar' }}
    </button>
    &nbsp;
    <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
        <i class="mdi mdi-close "></i> Cerrar
    </button>
</div>
