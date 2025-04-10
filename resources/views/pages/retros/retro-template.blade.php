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

        <div id="myKanban" class="p-5"></div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var kanban = new jKanban({
                    element: '#myKanban',
                    boards: [
                        {
                            id: '_todo',
                            title: 'À faire',
                            class: 'bg-light',
                            item: [{ title: 'Tâche 1' }, { title: 'Tâche 1' } ]
                        },
                        {
                            id: '_doing',
                            title: 'En cours',
                            class: 'bg-warning',
                            item: []
                        },
                        {
                            id: '_done',
                            title: 'Terminé',
                            class: 'bg-success',
                            item: []
                        }
                    ]
                });
            });
        </script>



</x-app-layout>
