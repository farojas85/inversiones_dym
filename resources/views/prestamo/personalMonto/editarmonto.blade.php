
{!! Form::model($personalmonto,
    [
        'route' => ['personalmontos.update',$personalmonto->id],'method' => 'PUT',
        'id' => 'formedit'
    ]) !!}
    @php
        $nombres = $personal->nombres." ".$personal->apellidos;
    @endphp
    
    {!! Form::hidden('id', $personalmonto->id, [ 'id' => 'id']) !!}
    {!! Form::hidden('personal_id', $personalmonto->personal_id, [ 'id' => 'personal_id']) !!}
    
    <div class="form-group row">
        {!! Form::label('nombres','Personal',['class' =>'col-md-4 col-form-label text-right']) !!}
        <div class="col-md-8">
            {!!
                Form::text('nombres', $nombres,
                            [   'class' => 'form-control', 'id' => 'nombres',
                                'placeholder' => 'Ingrese Nombres','disabled'=>''])
            !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('fecha','fecha',['class' =>'col-md-4 col-form-label text-right']) !!}
        <div class="col-md-8">
            {!!
                Form::text('fecha', null,
                            [   'class' => 'form-control', 'id' => 'fecha'])
            !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('monto_asignado','Monto Asignado',['class' =>'col-md-4 col-form-label text-right']) !!}
        <div class="col-md-8">
            {!!
                Form::text('monto_asignado', null,
                            [   'class' => 'form-control', 'id' => 'monto_asignado'])
            !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('monto_saldo','Monto Saldo',['class' =>'col-md-4 col-form-label text-right']) !!}
        <div class="col-md-8">
            {!!
                Form::text('monto_saldo', null,
                            [   'class' => 'form-control', 'id' => 'monto_saldo'])
            !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('consumido','Estado',['class' =>'col-form-label col-md-4 text-right']) !!}
        <div class="col-md-8">
            {!! 
                Form::select('consumido',$estados,null,
                                ['class' => 'form-control',
                                'placeholder'=> 'Seleccione Estado',
                                'id'=>'consumido',
                                'required'=>'']) 
            !!} 
        </div>                                           
    </div>
    <div class="form-group text-center">
        <button type="button" class="btn btn-success" id="btn-actualizar" value="{{ $estadoform }}" name="btn-actualizar">
            <i class="fe-refresh-cw"></i> Actualizar
        </button>
        &nbsp;
        <button type="button" class="btn btn-danger" id="btn-cerrar" data-dismiss="modal">
            <i class="mdi mdi-close "></i> Cerrar
        </button>
    </div>
{!! Form::close() !!}
<script>
    $( function() {
        $( "#fecha" ).flatpickr();
    } );

    $('body').on('click', '#btn-actualizar', function (event) {
        event.preventDefault();    
    
        var form = $('#formedit'),
                    url = form.attr('action'),
                    method =form.attr('method');

        
        $.ajax({
            url : url,
            method: method,
            data : form.serialize(),
            success: function (response) {              
                textos = "Registro Modificado Satisfactoriamente !";
                
                console.log(response);
                swal({
                    type : 'success',
                    title : 'Personal Montos',
                    text : textos,
                    confirmButtonText: 'Aceptar'
                }).then(function () {
                    window.location.href="personalmontos";
                });               
            },
            error : function (xhr) {
                swal({
                    type: 'error',
                    title: 'Personal Montos',
                    text: xhr.responseText
                });
            }
        });    
    });    
    
</script>
@section('scripties')
    <script src="js/prestamo/personal_monto.js"></script>
@endsection