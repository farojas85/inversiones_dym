<div class="card">
    <div class="card-body">
        <h4 class="header-title">
            REPORTE CLIENTES
            <button type="button" class="btn btn-danger btn-retornar btn-sm float-right">
                <i class="fa fa-times"></i>
            </button>
        </h4>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="row">
                    <label for="personal_id" class="col-form-label col-form-label-sm col-md-1">Personal</label>
                    <div class="col-md-4">
                        @if ($todo == 1)
                        <select id="personal_id" name="personal_id"
                                class="form-control form-control-sm">
                            <option value="%">Todos</option>
                            @foreach ($personal as $pe)
                            <option value="{{ $pe->id }}">{{ $pe->nombres." ".$pe->apellidos }}</option>
                            @endforeach
                        </select>
                        @else
                            <input type="text" id="personal_name" name="personal_name"
                                class="form-control form-control-sm"
                               value="{{ $personal->nombres." ".$personal->apellidos }}" >
                            <input type="hidden" name="personal_id" id="personal_id"
                               value="{{ $personal->id }}">
                        @endif
                    </div>
                    <label for="estado" class="col-form-label col-form-label-sm col-md-1">Estado</label>
                    <div class="col-md-3">
                        <select name="estado" id="estado" class="form-control form-control-sm">
                            <option value="%">Todos</option>
                            <option value="No Generado">No Generado</option>
                            <option value="Generado">Generado</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button  type="button" class="btn btn-primary btn-reporte-buscar">
                            <i class="fa fa-search"></i> Buscar
                        </button>
                        <a href="/cliente/exportar" class="btn btn-success btn-reporte-exportar disabled">
                           <i class="fa fa-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2" id="reporte-tabla">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="bg-dark text-white">#</th>
                        <th class="bg-dark text-white">Cliente</th>
                        <th class="bg-dark text-white">Personal</th>
                        <th class="bg-dark text-white">Préstamo</th>
                        <th class="bg-dark text-white">Interes</th>
                        <th class="bg-dark text-white">Saldo</th>
                        <th class="bg-dark text-white">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">
                            -- Datos No Seleccionados --
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Totales S/</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
