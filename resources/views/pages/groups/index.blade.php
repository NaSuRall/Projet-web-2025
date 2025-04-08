<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Groupes') }}
            </span>
        </h1>
    </x-slot>


    <form class="card-body flex flex-row gap-5 align-middle bg-gray-100 w-[550px]" action="{{ route('formGroup.create') }}" method="POST">
        @csrf
        <x-forms.input type="number" name="number" :label="__('Nombre de personnes dans les groupes')" placeholder="2 - 5"/>

        <x-forms.dropdown type="promotion" :label="__('Promotions')">
            <option value="CodingFactoryCergy">Coding Factory Cergy</option>
            <option value="CodingFactoryParis">Coding Factory Paris</option>
        </x-forms.dropdown>

        <x-forms.input type="date" name="date-end" :label="__('Fin de l\'année')" placeholder="" />

        <x-forms.primary-button>
            {{ __('Valider') }}
        </x-forms.primary-button>
    </form>



    @foreach ($groups as $groupe)
        <div>
            <h2>{{ $groupe->name }}</h2>

            @if ($groupe->users->isEmpty())
                <p>Aucun utilisateur dans ce groupe.</p>
            @else
                <ul>
                    @foreach ($groupe->users as $user)
                        <li>{{ $user->first_name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach

</x-app-layout>
