<ul class="todo-list list-group text-center">
    @if($listarRoles->isNotEmpty())
        @foreach($listarRoles as $parametro)
            <li class="list-group-item btn btn-link" wire:click="show('{{ $parametro->rowquid }}')">
                <span class="text-bold text-lightblue text-uppercase">{{ $parametro->nombre }}</span>
            </li>
        @endforeach
    @endif
</ul>
