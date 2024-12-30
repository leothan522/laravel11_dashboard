<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">{{ __('Name') }}:</small>
    <div class="input-group">
        <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre">
        @error('nombre')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">RIF:</small>
    <div class="input-group">
        <input type="text" wire:model="nombre" class="form-control @error('rif') is-invalid @enderror" placeholder="RIF">
        @error('rif')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Jefe:</small>
    <div class="input-group">
        <input type="text" wire:model="jefe" class="form-control @error('jefe') is-invalid @enderror" placeholder="Jefe">
        @error('jefe')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Moneda Base:</small>
    <div class="input-group">
        <select class="custom-select @error('moneda') is-invalid @enderror" wire:model="moneda">
            <option value="">Seleccione</option>
            <option value="Bolivares">Bolivares</option>
            <option value="Dolares">Dolares</option>
        </select>
        @error('moneda')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Teléfonos:</small>
    <div class="input-group">
        <input type="text" wire:model="jefe" class="form-control @error('telefonos') is-invalid @enderror" placeholder="Teléfonos">
        @error('telefonos')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">{{ __('Email') }}:</small>
    <div class="input-group">
        <input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}">
        @error('email')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Dirección:</small>
    <div class="input-group">
        <input type="text" wire:model="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="{{ __('Email') }}">
        @error('direccion')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>




