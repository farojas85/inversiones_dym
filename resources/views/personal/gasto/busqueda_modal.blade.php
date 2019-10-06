<form id="form">
    <div class="form-group row">
        <label for="personal_id"
            class="col-form-label col-form-label-sm col-md-3"
        >Personal&nbsp;:&nbsp;</label>
        <div class="col md-8">
            <select name="personal_id" id="personal_id"
                class="form-control form-control-sm">
                <option value="%">TODOS</option>
                @forelse ($personals as $pe)
                <option value="{{ $pe->id  }}">{{ $pe->personal }}</option>
                @empty
                <option value="">-CONFIGURAR-</option>
                @endforelse
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <input type="text" name="fecha_inicio" id="fecha_inicio" required
                class="form-control form-control-sm" placeholder="Fecha Inicio" >
        </div>
        <div class="col-md-6">
            <input type="text" name="fecha_final" id="fecha_final" required
                class="form-control form-control-sm" placeholder="Fecha Final">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times"></i> Cancelar
            </button>
            <button type="button" class="btn btn-success btn-generar-reporte">
                <i class="fa fa-search"></i> Generar
            </button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $( function() {
        $( "#fecha_inicio" ).flatpickr({
            locale: {
                firstDayOfWeek: 7,
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
            },
        });
        $( "#fecha_final" ).flatpickr({
            locale: {
                firstDayOfWeek: 7,
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
            },
        });
    } );
</script>