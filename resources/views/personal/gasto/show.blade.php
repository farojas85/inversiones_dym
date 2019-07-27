{!! Form::model($personalGasto, ['id' => 'form']) !!}
    <div class="form-group row">
        <div class="col-12">
            <label  class="col-form-label col-form-label-sm">
                @foreach ($personalGasto->personal() as $persona)
                    
                @endforeach
                Personal : {{ $personalGasto->personal->nombres." ".$personalGasto->personal->apellidos }}
            </label>            
            {!! Form::hidden('personal_id', $personalGasto->personal_id, ['id'=>'personal_id']) !!}            
        </div>            
    </div>
{!! Form::close() !!}