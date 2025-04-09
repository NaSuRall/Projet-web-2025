<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Groupes') }}
            </span>
        </h1>
    </x-slot>

    @if ($errors->has('groupe_error'))
        <div class="alert alert-danger">
            <h1 style="color: red">{{ $errors->first('groupe_error') }}</h1>
        </div>
    @endif
    <form class="card-body flex flex-row gap-5 align-middle bg-gray-100 w-[550px]" action="{{ route('formGroup.create') }}" method="POST">
        @csrf
        <x-forms.input type="number" name="number" :label="__('Nombre de personnes dans les groupes')" placeholder="2 - 5"/>

        <x-forms.dropdown type="promotion" :label="__('Promotions')">
           @foreach($promotions as $promotion)
                <option value="">{{ $promotion->name }}</option>
            @endforeach
        </x-forms.dropdown>

        <x-forms.primary-button>
            {{ __('Valider') }}
        </x-forms.primary-button>
    </form>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 m">
        @foreach ($groups as $groupe)
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h2 class="text-1xl font-semibold text-gray-800 mb-4">{{ $groupe->name }}</h2>

                @if ($groupe->users->isEmpty())
                    <p class="text-gray-500">Aucun utilisateur dans ce groupe.</p>
                @else
                    <ul class="mt-4 space-y-3">
                        @foreach ($groupe->users as $user)
                            <li class="flex items-center space-x-3 text-gray-800">
                                <span class=" text-1xl  font-medium">{{ $user->first_name }} {{ $user->last_name }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>


</x-app-layout>
