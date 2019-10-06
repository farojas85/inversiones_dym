<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">
                Reporte Gastos del Personal
                <button class="btn btn-blue btn-imprimir d-print-none">
                        <i class="fas fa-print"></i> Imprimir
                    </button>
                <a href="/personalgastos/exportar" class="btn btn-success btn-reporte-exportar d-print-none" >
                    <i class="fa fa-download"></i> Descargar
                </a>
                <button type="button" class="btn btn-danger btn-retornar btn-sm float-right d-print-none">
                    <i class="fa fa-times"></i>
                </button>
            </h4>
            <div class="row mt-2">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm dt-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-white">#</th>
                                <th class="text-white">PERSONAL</th>
                                <th class="text-white">FECHA</th>
                                <th class="text-white">DESCRIPCIÓN</th>
                                <th class="text-white">MONTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total =0;
                            @endphp
                            @forelse ($personalgastos as $per)
                            @php($total+=$per->monto)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $per->personal }}</td>
                                <td>{{ $per->fecha }}</td>
                                <td>{{ $per->descripcion }}</td>
                                <td>{{ number_format($per->monto,2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">-- DATOS NO REGISTRADOS --</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="bg-dark text-white text-right"> TOTAL S/</th>
                                <th>{{ number_format($total,2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('click', '.btn-imprimir', function (event) {
        event.preventDefault();
        window.print();
    });
    $('body').on('click', '.btn-retornar', function (event) {
        event.preventDefault();
        window.location.href="personalgastos";
    });
</script>