{!! Form::model($role, ['route' => ['permissionrole.updatePermissions',$role->id],'method' => 'PUT',
                        'id'=>'form']) !!}
    {!! form::hidden('hdd_role_id',$role->id) !!}
<div id="table-responsive">
    <table class="table table-stripped nowrap dt-responsive table-bordered" >
        <thead class="thead-dark">
            <th class="text-white" width="5px">N&deg;</th>
            <th class="text-white">Permisos para {{ mb_strtoupper($role->name) }}</th>
        </thead>
        @foreach ($permissions as $permission)
            <tbody>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <label>
                            {!! form::checkbox('permissions[]',$permission->id,null) !!}
                            {{ $permission->name }}
                            <small>({{ $permission->description ? : 'Sin Descripción' }})</small>
                        </label>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
</div>
<div class="form-group text-center">
    <button class="btn btn-primary" id="btn-guardar" type="button"> 
        <i class="fa fa-refresh"></i> Actualizar
    </button>
</div>
{!! Form::Close() !!}