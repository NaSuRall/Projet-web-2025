<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Groupes') }}
            </span>
        </h1>
    </x-slot>


    <form class="card-body flex flex-row gap-5 align-middle bg-gray-100" action="" method="POST">
        <x-forms.input type="number" name="number" :label="__('Nombre de personnes dans les groupes')" placeholder="2 - 5"/>
        <x-forms.dropdown type="select" :label="__('Promotions')"/>
            @for

        <x-forms.input type="date" name="year" :label="__('Fin de l\'année')" placeholder="" />

        <x-forms.primary-button>
            {{ __('Valider') }}
        </x-forms.primary-button>

    </form>

</x-app-layout>
