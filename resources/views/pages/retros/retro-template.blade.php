@php use Illuminate\Support\Facades\Auth; @endphp

<!-- CA AUSSI MAIS BON c'est relou tailwind :') -->
<style>
    .card p{
        color: black;
    }
.card:nth-child(10n+1) {
    background-color: var(--tw-pastel-pink);
}
.card:nth-child(10n+2) {
    background-color: var(--tw-pastel-blue);
}
.card:nth-child(10n+3) {
    background-color: var(--tw-pastel-green);
}
.card:nth-child(10n+4) {
    background-color: var(--tw-pastel-yellow);
}
.card:nth-child(10n+5) {
    background-color: var(--tw-pastel-purple);
}
.card:nth-child(10n+6) {
    background-color: var(--tw-pastel-cyan);
}
.card:nth-child(10n+7) {
    background-color: var(--tw-pastel-orange);
}
.card:nth-child(10n+8) {
    background-color: var(--tw-pastel-peach);
}
.card:nth-child(10n+9) {
    background-color: var(--tw-pastel-lavender);
}
.card:nth-child(10n+10) {
    background-color: var(--tw-pastel-mint);
}
</style>
<x-app-layout class="bg-gray-900">
    <x-slot name="header">
        <div class="my-4">
            <a href="{{ route('retro.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-lg transition duration-200 shadow-sm">
                ⬅ Retour
            </a>
        </div>
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Retrospectives') }} - {{ $retro->name }}
            </span>
        </h1>
    </x-slot>
    @php
        $role = Auth::user()->role ?? null;
    @endphp
    <div class="content">

        <!-- Modal membre classe -->
        <button class="btn btn-primary" data-modal-toggle="#modal_1_3">
            Membres
        </button>
        <div class="modal" data-modal="true" id="modal_1_3">
            <div class="modal-content max-w-[600px] top-[10%]">
                <div class="modal-header border-b-0">
                    <h3 class="modal-title">
                       Class student
                    </h3>
                    <button class="btn btn-xs btn-icon btn-light" data-modal-dismiss="true">
                        <i class="ki-outline ki-cross">
                        </i>
                    </button>
                </div>
                <div class="modal-table scrollable-auto">
                    <table class="table table-border align-middle text-gray-700 font-medium text-sm" id="my_table_2">
                        <thead>
                        <tr>
                            <th class="min-w-[250px]">
                               <span class="sort asc">
                                <span class="sort-label">
                                 First name
                                </span>
                                <span class="sort-icon">
                                </span>
                               </span>
                            </th>
                            <th class="min-w-[250px]">
                               <span class="sort asc">
                                <span class="sort-label">
                                 Last name
                                </span>
                                <span class="sort-icon">
                                </span>
                               </span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-1.png"/>
                                    <h4 class="leading-none font-semibold text-gray-900 hover:text-primary">
                                        {{ $user->first_name }}
                                    </h4>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-1.png"/>
                                    <h4 class="leading-none font-semibold text-gray-900 hover:text-primary">
                                         {{ $user->last_name }}
                                    </h4>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <!-- NAV CREATION COLUMN -->
        <div class="container flex align-middle justify-center items-center ">
            @if(in_array($role, ['admin', 'teacher']))
                <div class="max-w-[460px] w-full bg-white border border-gray-200 shadow-sm rounded-xl p-2   flex items-center justify-center">
                    <div class="flex items-center gap-3  w-full items-center">
                        <form method="POST" action="{{ route('retro.createColumn') }}" class="flex flex-row w-full">
                            @csrf
                            <x-forms.input type="text" name="name" class="w-full   rounded-md  focus:ring-indigo-500 focus:border-indigo-500" placeholder="Crée une column ( 4 max )" />
                            <input type="hidden"  value="{{ $retro->id }}" name="board_id">
                            <x-forms.primary-button class="w-20 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700
                                focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                <i class="fa-solid fa-paper-plane"></i>
                            </x-forms.primary-button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- SHOW COLUMNS -->
        <div class="w-full h-[70vh] bg-white p-6 flex gap-6 " style="height: 70vh; margin-top: 20px">
            @foreach($retro->board->columns as $column)
                <div class="flex flex-col h-full bg-gray-50 border shadow-default border-gray-200 rounded-xl scrollable p-4 w-full overflow-auto" >
                    <div class="card-header flex items-center">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $column->name }}</h2>
                        <div class="buttone flex flex-row gap-2">
                            @if(Auth::user()->id === $retro->creator_id)
                                <form action="{{ route('column.delete', $column->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-10 flex items-center justify-center bg-destructive text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-destructive/90 transition" style="background-color: red; color: white;">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- SHOW CARD -->
                    <div class="flex-grow scrollable overflow-auto">
                        @foreach($column->cards as $card)
                            <div class="relative p-3 mb-3 rounded card overflow-hidden shadow">
                                <div class="card-body w-full">
                                    <p class="text-sm text-gray-600">{{ $card->description }}</p>
                                    @if(auth()->user()->id == $card->user_id || in_array($role, ['admin', 'teacher']))
                                        <form action="{{ route('card.delete', $card->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="absolute top-2 right-0 bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- CREATE CARDS AJAX -->
                    <div class="card-footer mt-auto">
                        <form class="form-create-card flex flex-row w-full items-center" data-column-id="{{ $column->id }}">
                            @csrf
                            <input type="hidden" value="{{ $column->id}}" name="column_id">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                            <textarea name="textarea" rows="1" cols="10" placeholder="Crée une carte..." class="textarea" style="resize: none"></textarea>
                            <button class="w-10 h-10 flex items-center justify-center bg-destructive text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-destructive/90 transition" style="background-color: dodgerblue; color: white;">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>






































<!-- Oui je n'ai pas fait d'effort pour ca je n'avais plus le temps :') -->
<!-- tu es le meilleur ;) -->
<script>
    document.querySelectorAll('.form-create-card').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const columnId = form.dataset.columnId;
            const userId = '{{ auth()->user()->id }}';
            const description = form.querySelector('textarea[name="textarea"]').value;

            const response = await fetch("{{ route('retro.createCard') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    column_id: columnId,
                    user_id: userId,
                    textarea: description
                })
            });

            if (response.ok) {
                const data = await response.json();

                // Ajouter dynamiquement la carte à la colonne
                const cardHTML = `
                <div class="relative p-3 mb-3 rounded card shadow">
                    <div class="card-body w-full">
                        <p class="text-sm text-gray-600">${data.description}</p>
                        <form method="POST" class="form-delete-card" data-card-id="${data.id}">
                            <button type="submit" class="absolute top-2 right-0 bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            `;

                form.closest('.flex.flex-col').querySelector('.scrollable').insertAdjacentHTML('beforeend', cardHTML);
                form.querySelector('textarea[name="textarea"]').value = '';
            } else {
                alert('Erreur lors de la création de la carte');
            }
        });
    });

</script>
