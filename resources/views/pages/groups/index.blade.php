<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Groupes') }}
            </span>
        </h1>
    </x-slot>

    <!-- Formulaire de sélection de cohorte et promotion -->
    <form action="{{ route('group.create') }}" method="GET">
        @csrf
        <x-forms.input type="number" name="number" :label="__('Number')" />

        <x-forms.dropdown type="select" name="school" :label="__('Ecole')" >
            @foreach($schools as $school)
                <option value="{{ $school->id }}"> {{ $school->name }}</option>
            @endforeach
        </x-forms.dropdown>

        <x-forms.dropdown type="select" name="promotion" :label="__('Promotion')" >
            <option value="B1">B1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="M1">M1</option>
            <option value="M2">M2</option>
        </x-forms.dropdown>

        <x-forms.primary-button>
            {{ __('Valider') }}
        </x-forms.primary-button>
    </form>

    <!-- Affichage des utilisateurs filtrés -->
    @if(isset($users) && $users->isNotEmpty())
        <table class="mt-4">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Promotion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->cohort }}</td> <!-- Affiche la promotion -->
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h2 class="text-center mt-4">Pas de promotion sélectionnée</h2> <!-- Message alternatif -->
    @endif

</x-app-layout>
