<div class="row justify-content-center" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="col-sm-6 col-md-5 col-lg-4">
        <div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
        <div class="card-header">
                <h3 class="card-title">
                    Firebase Cloud Messaging (FCM)
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" wire:click="limpiar" onclick="cancelar()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form wire:submit="sendMessage">

                    <div class="form-group">
                        <label for="name">Tipo FCM</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-paper-plane"></i></span>
                            </div>
                            <select class="custom-select" wire:model="tipo">
                                <option value="">Seleccione...</option>
                                <option value="notification">With Notification</option>
                                <option value="data">With Data</option>
                            </select>
                            @error('tipo')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Titulo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-window-maximize"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model="title" placeholder="Titulo para la Notificación">
                            @error('title')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Contenido</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope-open-text"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model="body" placeholder="Mensaje para la Notificación">
                            @error('body')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Dispositivos</label>
                        <div class="input-group mb-3" wire:ignore>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            </div>
                            <select id="dispositivos_users">
                                <option value="todos">Enviar a Todos</option>
                                @if(!$listarUsers->isEmpty())
                                    @foreach($listarUsers as $user)
                                        <option value="{{ $user->user->rowquid }}">{{ ucfirst($user->user->name) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @error('dispositivos')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fas fa-paper-plane"></i> Enviar
                        </button>
                    </div>

                </form>

                <!-- /.card-body -->
            </div>

            {!! verSpinner() !!}

        </div>
    </div>
</div>
