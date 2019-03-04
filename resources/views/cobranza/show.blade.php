<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pr&eacute;stamos</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </div>
            <h4 class="page-title">Boleta de Cobranza</h4>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-4">
        <div class="card-box">
            <div class="clearfix"></div>
            <div class="float-left">
                <img src="assets/images/logo_dark.png" width="120" />
            </div>
            <div class="float-right">
                <div class="card" style="border:1px solid #FCFDCC">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Boleta de Cobranza</h4>
                        <div class="collapse pt-3 show">
                            {{ $cobranza->serie}}
                        </div>
                    </div>
                </div>
                
            </div>      
        </div>
    </div> 
</div>

<div class="mt-3 mb-1">
    <div class="text-right d-print-none">
        <button class="btn btn-primary waves-effect waves-light"
            onclick="imprimir_boleta()">
                <i class="mdi mdi-printer mr-1"></i> imprimir</a>
        </button>
        &nbsp;
        <a href="" class="btn btn-danger waves-effect waves-light">
            <i class="mdi mdi-close"></i> Cerrar
        </a>
    </div>
</div>