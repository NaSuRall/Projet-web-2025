@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Retrospectives') }}
            </span>
        </h1>
    </x-slot>


    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">

                    <div class="card-header">
                        <h3 class="card-title">Mes Retrospective</h3>
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
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($retros as $retro)
                                        <tr>
                                            <td>
                                                <div class="flex flex-col gap-2">
                                                        <span class="leading-none font-medium text-sm text-gray-900">
                                                           <a href="{{ route('retro.show', ['id' => $retro->id]) }}">{{ $retro->name }}</a>
                                                        </span>
                                                </div>
                                            </td>
                                            <td>{{ $retro->cohort?->name ?? 'Promotion inconnue' }}</td>
                                        </tr>
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

        @php
            $role = Auth::user()->role ?? null;
        @endphp

        @if(in_array($role , ['admin', 'teacher']))
            <div class="lg:col-span-1 mt-5">
                <div class="card h-full">
                    <div class="card-header">
                        <h3 class="card-title">Cree une Retrospective</h3>
                    </div>
                    <div class="card-body flex flex-col gap-5">
                        <!-- Formulaire -->
                        <form action="{{ route('retro.create') }}" method="post" >
                            @csrf
                            <input type="hidden" name="creator_id" value="{{ auth()->user()->id }}">
                            <label class="form-label font-normal text-gray-900 ">Nom de la Retrospective</label>
                            <input type="text" name="name"  class="input" maxlength="20" required>
                            <x-forms.dropdown
                                name="promotion"
                                :label="__('Quel promotion ?')"
                                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id  }}">{{ $cohort->name }}</option>
                                @endforeach
                            </x-forms.dropdown>

                            <div class="flex items-center mt-5">
                                <label class="switch">
                                 <span class="switch-label">
                                   Retro rapide <i class="fa-solid fa-bolt " style="color: #ecec0d;"></i>
                                 </span>
                                    <input name="retroRapide" type="checkbox" value="1"/>
                                </label>
                            </div>



                            <x-forms.primary-button class="w-full py-4 mt-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                {{ __('Crée une Retro') }}
                            </x-forms.primary-button>
                        </form>

                        <div class="lg:col-span-1 mt-5">
                            <div class="card h-full">
                                <div class="card-header">
                                    <h3 class="card-title">Supprimer Une Retrospective</h3>
                                </div>
                                <div class="card-body flex flex-col gap-5">

                                    <form action="{{ route('retro.delete') }}" method="post" >
                                        @csrf
                                        @method('DELETE')
                                        <x-forms.dropdown
                                            name="promotion"
                                            :label="__('Promotion')"
                                            class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"

                                        >
                                            @foreach($cohorts as $cohort)
                                                <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                                            @endforeach
                                        </x-forms.dropdown>
                                        <x-forms.primary-button class="w-full py-3 mt-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                            {{ __('Supprimer') }}
                                        </x-forms.primary-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
             <div class="lg:col-span-1">
                  <div class="card h-full">
                     <div class="card-header">
                         <h3 class="card-title">Vous n'avez pas la permission de modifier les Retrospective....</h3>
                     </div>
                  </div>
             </div>
        @endif
    </div>
</x-app-layout>
