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
    <label for="fecha_inicio"
        class="col-form-label col-form-label-sm col-md-3"
    >Fecha Inicio</label>
    <div class="col-md-3">
        <input type="text" name="fecha_inicio" id="fecha_inicio"
            class="form-control form-control-sm" placeholder="Fecha Inicio">
    </div>
    <label for="fecha_final"
        class="col-form-label col-form-label-sm col-md-3"
    >Fecha Inicio</label>
    <div class="col-md-3">
        <input type="text" name="fecha_final" id="fecha_final"
            class="form-control form-control-sm" placeholder="Fecha Inicio">
    </div>
</div>