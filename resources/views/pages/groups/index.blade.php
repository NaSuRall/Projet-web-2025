<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Groupes') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Mes Groupes</h3>

                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[280px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Promotion</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Groupe</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Bilan note</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($groups as $group)
                                        @foreach($group->users as $user)
                                            <tr>
                                                <td>
                                                    <div class="flex flex-col gap-2">
                                                        <span class="leading-none font-medium text-sm text-gray-900">
                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>{{ $group->promotion }}</td>
                                                <td>Groupe {{ $group->group_number }}</td>
                                                <td>Note {{ $user->bilan_note }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire à droite avec position sticky -->


        @php
            $role = Auth::user()->role ?? null;

        @endphp

        @if(in_array($role, ['admin', 'teacher']))
            <div class="lg:col-span-1">
                <div class="card h-full">
                    <div class="card-header">
                        <h3 class="card-title">Ajouter un groupe</h3>
                    </div>
                    <div class="card-body flex flex-col gap-5">
                        <!-- Formulaire -->
                        <form action="{{ route('group.create') }}" method="GET">
                            @csrf
                            <x-forms.input
                                type="number"
                                name="number"
                                :label="__('Personnes par groups')"
                                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />

                            <x-forms.dropdown
                                name="promotion"
                                :label="__('Promotion')"
                                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id  }}">{{ $cohort->name }}</option>
                                @endforeach


                            </x-forms.dropdown>

                            <div class="flex justify-center m-5">
                                <x-forms.primary-button class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                    {{ __('Valider') }}
                                </x-forms.primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-1 mt-5">
                    <div class="card h-full">
                        <div class="card-header">
                            <h3 class="card-title">Supprimer les groupe</h3>
                        </div>
                        <div class="card-body flex flex-col gap-5">
                            <!-- Formulaire -->
                            <form action="{{ route('group.clear') }}" method="post" >
                                @csrf
                                <x-forms.dropdown
                                    name="promotion"
                                    :label="__('Promotion')"
                                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"

                                >
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="M1">M1</option>
                                    <option value="M2">M2</option>
                                </x-forms.dropdown>
                                <x-forms.primary-button class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                    {{ __('Supprimer') }}
                                </x-forms.primary-button>
                            </form>
                        </div>
                    </div>

            </div>



        @else
            <div class="lg:col-span-1">
                <div class="card h-full">
                    <div class="card-header">
                        <h3 class="card-title">Vous n'avez pas la permission de modifier les groupes....</h3>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <!-- end: grid -->
</x-app-layout>
