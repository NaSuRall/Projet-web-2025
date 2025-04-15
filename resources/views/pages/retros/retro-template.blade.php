@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
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


    <div class="w-full bg-white border border-gray-200 shadow-sm rounded-xl p-4 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3 w-full items-center">
            <form method="POST" action="{{ route('retro.createColumn') }}" class="flex flex-row w-full">
                @csrf
                <input type="text" name="name" placeholder="Nom de la column" class="input">
                <input type="hidden" value="{{ $retro->id }}" name="board_id">
                <x-forms.primary-button class="w-20 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    <i class="fa-solid fa-paper-plane"></i>
                </x-forms.primary-button>
            </form>


        </div>
    </div>

{{--   <h2 class="text-gray-600">Eleve dans la classe {{ $retro->promotion }} :</h2>--}}
{{--    <ul>--}}
{{--        @forelse($users as $user)--}}
{{--            <li>{{ $user->first_name }} - {{ $user->last_name }} {{ $user->id }}</li>--}}
{{--        @empty--}}
{{--            <li>Aucun utilisateur trouvé pour ce cohort.</li>--}}
{{--        @endforelse--}}
{{--    </ul>--}}


    <!-- Wrapper pleine page -->
    <div class="min-h-[70vh] w-full bg-muted py-10 px-4 flex items-start justify-center">

        <!-- Bloc intérieur stylé -->
        <div class="w-full h-[70vh] bg-white p-6 flex  gap-6 overflow-auto" style="height: 70vh">
            @foreach($retro->board->columns as $column)
                <div class="flex flex-col h-[70vh] bg-gray-50 border border border-gray-500 rounded-xl p-4 w-full">
                    <div class="card-header flex items-center ">
                        <h2 class="text-lg font-semibold  text-gray-800">{{ $column->name }}</h2>


                        <div class="buttone flex flex-row gap-2">
                            @if(Auth::user()->id === $retro->creator_id)
                                <button class="w-10 flex items-center justify-center bg-destructive text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-destructive/90 transition" style="background-color: red; color: white;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            @endif
                        </div>


                    </div>

                    <!-- Cartes ici -->
                    <div class="text-sm text-gray-500 italic mt-auto">Aucune carte pour l’instant</div>
                    @foreach($column->cards as $card)
                        <div class="bg-white p-3 mb-3 rounded shadow">
                            <h3 class="font-bold text-sm">{{ $card->name}}</h3>
                            <p class="text-sm text-gray-600">{{ $card->description }}</p>
                        </div>
                    @endforeach

                <div class="card-footer">
                    <form action="{{ route('retro.createCard') }}" method="Post" name="formCreateCard" class="flex flex-row w-full items-center" >
                        @csrf
                        <input type="hidden" value="{{ $column->id}}" name="column_id">
                        <x-forms.input  type="text" name="nameCard" placeholder="Nom de la card..."  />
                        <textarea name="textarea" rows="1" cols="10" placeholder="Description..." class="textarea" style="resize: none" ></textarea>
                        <button class="w-20 h-10 flex items-center justify-center bg-destructive text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-destructive/90 transition"
                                style="background-color: dodgerblue; color: white;">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </form>
                </div>

                </div>

            @endforeach
        </div>
    </div>
</x-app-layout>
