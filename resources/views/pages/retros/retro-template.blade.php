@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Retrospectives') }}
            </span>
        </h1>
    </x-slot>

    {{--    <div id="myKanban" class="p-5"></div>--}}
    {{--    <script>--}}
    {{--        document.addEventListener('DOMContentLoaded', function () {--}}
    {{--            var kanban = new jKanban({--}}
    {{--                element: '#myKanban',--}}
    {{--                boards: [--}}
    {{--                    {--}}
    {{--                        id: '_todo',--}}
    {{--                        title: 'À faire',--}}
    {{--                        class: 'bg-light',--}}
    {{--                        item: [{ title: 'Tâche 1' }, { title: 'Tâche 1' } ]--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        id: '_doing',--}}
    {{--                        title: 'En cours',--}}
    {{--                        class: 'bg-warning',--}}
    {{--                        item: []--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        id: '_done',--}}
    {{--                        title: 'Terminé',--}}
    {{--                        class: 'bg-success',--}}
    {{--                        item: []--}}
    {{--                    }--}}
    {{--                ]--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}

    @php
        $role = Auth::user()->role ?? null;
    @endphp

    <h2>{{ $retro->name }}</h2>

</x-app-layout>
