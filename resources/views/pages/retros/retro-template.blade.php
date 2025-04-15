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

    <h2 class="text-gray-600">Eleve dans la classe {{ $retro->promotion }} :</h2>
{{--    <ul>--}}
{{--        @forelse($users as $user)--}}
{{--            <li>{{ $user->first_name }} - {{ $user->last_name }} {{ $user->id }}</li>--}}
{{--        @empty--}}
{{--            <li>Aucun utilisateur trouvé pour ce cohort.</li>--}}
{{--        @endforelse--}}
{{--    </ul>--}}

<form method="POST" action="{{ route('retro.createColumn') }}">
    @csrf
    <x-forms.input type="texte" :label="__('Nom de la column')" name="name" />
    <input type="hidden" value="{{ $retro->id }}" name="board_id">
    <x-forms.primary-button class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
        {{ __('Crée une Retro') }}
    </x-forms.primary-button>
</form>



{{--    @foreach($columns as $column)--}}

{{--        <p>{{ $column->name }}</p>--}}

{{--    @endforeach--}}

</x-app-layout>
