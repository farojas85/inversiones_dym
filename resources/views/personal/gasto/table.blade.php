<table id="model-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm dt-responsive" >
    @if ($role_name == 'admin' || $role_name == 'master')
        <thead class="thead-dark text-white">
            <tr>
                <th width="5px"  class="text-white">Acciones</th>
                <th class="text-white">ID</th>
                <th class="text-white">Personal</th>
                <th class="text-white">Fecha</th>
                <th class="text-white">Descripcion</th>
                <th class="text-white">Monto</th>                                         
            </tr>
        </thead>
        <tbody>
            @forelse ($personalgastos as $pergastos)
            <tr>
                <td>
                    @can('personalgastos.show')
                    <a class="btn btn-info btn-xs modal-show" 
                        title="Ver Gasto de Personal"
                        href="{{ route('personalgastos.show',$pergastos->id)}}">
                        <i class="fa fa-eye"></i>
                    </a>
                    @endcan
                    @can('personalgastos.edit')
                    <a class="btn btn-warning btn-xs modal-edit" 
                        title="Editar Gasto de Personal"
                        href="{{ route('personalgastos.edit',$pergastos->id)}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('personalgastos.destroy')
                    <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Gasto de Personal"
                        href="{{ route('personalgastos.destroy',$pergastos->id)}}">
                        <i class="fe-trash-2"></i>
                    </a>
                    @endcan
                </td>
                <td>{{ $loop->iteration}}</td>
                <td> {{ $pergastos->personal}} </td>
                <td> {{ $pergastos->fecha}} </td>
                <td> {{ $pergastos->descripcion }}</td>
                <td>{{ "S/ ".number_format($pergastos->monto,2)}} </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-danger">-- Datos No Registrados - Tabla Vacía -- </td>
            </tr>
            @endforelse
        </tbody>   
    @else 
        <thead class="thead-dark text-white">
            <tr>
                <th width="5px" class="text-white">Acciones</th>
                <th class="text-white">ID</th>
                <th class="text-white">Fecha</th>
                <th class="text-white">Descripcion</th>
                <th class="text-white">Monto</th>                                         
            </tr>
        </thead>
        <tbody>
            @forelse ($personalgastos as $pergastos)
            <tr>
                <td>
                    @can('personalgastos.show')
                    <a class="btn btn-info btn-xs modal-show" 
                        title="Ver Gasto de Personal"
                        href="{{ route('personalgastos.show',$pergastos->id)}}">
                        <i class="fa fa-eye"></i>
                    </a>
                    @endcan
                    @can('personalgastos.edit')
                    <a class="btn btn-warning btn-xs modal-edit" 
                        title="Editar Gasto de Personal"
                        href="{{ route('personalgastos.edit',$pergastos->id)}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('personalgastos.destroy')
                    <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Gasto de Personal"
                        href="{{ route('personalgastos.destroy',$pergastos->id)}}">
                        <i class="fe-trash-2"></i>
                    </a>
                    @endcan
                </td>
                <td>{{ $loop->iteration}}</td>
                <td> {{ $pergastos->fecha}} </td>
                <td>{{ $pergastos->descripcion }}</td>
                <td>{{ "S/ ".number_format($pergastos->monto,2)}} </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-danger">-- Datos No Registrados - Tabla Vacía --</td>
            </tr>
            @endforelse
        </tbody>
    @endif
</table>