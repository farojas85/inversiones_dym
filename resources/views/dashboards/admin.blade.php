<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                        <i class="fas fa-user-tie font-22 avatar-title text-primary"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark mt-1">
                            <span data-plugin="counterup">{{ $personals }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Cobradores</p>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                        <i class="fe-users font-22 avatar-title text-success"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark mt-1">
                            <span data-plugin="counterup">{{ $clientes}}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Clientes.</p>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <a href="prestamos"><i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i></a>
            <h4 class="mt-0 font-16">Cantidad Pr&eacute;stamos </h4>
            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $prestamos }}</span></h2>
            <!--<p class="text-muted mb-0">Total sales: 2398 <span class="float-right"><i class="fa fa-caret-down text-danger mr-1"></i>7.85%</span></p> --!>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <a href="prestamos"><i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i></a>
            <h4 class="mt-0 font-16"> Pr&eacute;stamos </h4>
            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $prestamos }}</span></h2>
            <!--<p class="text-muted mb-0">Total sales: 2398 <span class="float-right"><i class="fa fa-caret-down text-danger mr-1"></i>7.85%</span></p> --!>
        </div>
    </div>

</div>