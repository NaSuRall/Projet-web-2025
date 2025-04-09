<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Groupes') }}
            </span>
        </h1>
    </x-slot>

    <!-- Formulaire de sélection de promotion et nombre de personnes par groupe -->
    <form action="{{ route('group.create') }}" method="GET">
        @csrf
        <x-forms.input type="number" name="number" :label="__('Number')" />

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

    @if(isset($groups) && $groups->isNotEmpty())
        <h2 class="mt-4 text-lg font-semibold">Groupes créés</h2>

        <!-- Affichage des groupes par promotion -->
        @foreach(['B1', 'B2', 'B3', 'M1', 'M2'] as $promotion)
            <h3 class="mt-4 text-xl font-semibold">{{ $promotion }}</h3>

            @php
                $promotionGroups = $groups->where('promotion', $promotion);
            @endphp

            @if($promotionGroups->isNotEmpty())
                <div class="overflow-x-auto mt-2">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b text-left">Nom</th>
                            <th class="px-4 py-2 border-b text-left">Email</th>
                            <th class="px-4 py-2 border-b text-left">Groupe</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($promotionGroups as $group)
                            @foreach($group->users as $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">Groupe {{ $group->group_number }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mt-2 text-gray-500">Aucun groupe créé pour cette promotion.</p>
            @endif
        @endforeach

    @else
        <h2 class="text-center mt-4">Pas de promotion sélectionnée</h2>
    @endif

</x-app-layout>
