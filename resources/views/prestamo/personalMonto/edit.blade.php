{!! Form::model($personal, 
    [
        'route' => ['personalmontos.update',$personal->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}
    <div class="col-md-12">
        <div class="form-group row">
            {!! Form::label('nombres','Nombres',['class' =>'col-md-3 col-form-label text-right']) !!}
            <div class="col-md-9">
                {!!
                    Form::text('nombres', null,
                                [   'class' => 'form-control', 'id' => 'nombres',
                                    'placeholder' => 'Ingrese Nombres','required'=>''])
                !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            {!! Form::label('apellidos','Apellidos',['class' =>'col-md-3 col-form-label text-right']) !!}
            <div class="col-md-9">
                {!!
                    Form::text('apellidos', null,
                                [   'class' => 'form-control', 'id' => 'apellidos',
                                    'placeholder' => 'Ingrese Apellidos','required'=>''])
                !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive" id="tabla-detalle">
            <table id="model-datatable" class="table dt-responsive table-sm table-bordered" >
                <thead>
                    <tr>
                        <th >Acciones</th>
                        <th >Fecha</th>
                        <th >Monto Asignado</th>
                        <th >Monto Saldo</th>
                        <th >Estado</th>                                 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalmontos as $pm)
                    @php
                    switch ($pm->consumido) {
                        case 0: case null: 
                            $alert = "badge badge-success";
                            $text ="disponible";break;
                        case 1: 
                            $alert = "badge badge-dark";
                            $text ="consumido";break;
                    }
                @endphp
                    <tr id="tr_show_{{$pm->id }}" >
                        <td>
                            <button class="btn btn-warning btn-xs" type="button"
                                title="Editar Monto Personal" onclick="editar_monto( {{$pm->id}})">
                                <i class="fas fa-edit"></i>
                            </button>

                        </td>
                        <td>{{ $pm->fecha }}</td>
                        <td>{{ "S/ ".number_format($pm->monto_asignado,2) }}</td>
                        <td>{{ "S/ ".number_format($pm->monto_saldo,2) }}</td>
                        <td>
                            <span class="{{ $alert }}">{{ $text }}</span>
                        </td>
                    </tr>
                    <tr id="tr_edit_{{ $pm->id}}" style="visibility:hidden">
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
{!! Form::close() !!}
<script>
    
</script>