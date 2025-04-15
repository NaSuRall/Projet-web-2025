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






{{--    <div id="myKanban" class="py-5"></div>--}}
{{--        <script>--}}
{{--            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                var KanbanTest = new jKanban({--}}
{{--                    element: "#myKanban",--}}
{{--                    gutter: "10px",--}}
{{--                    widthBoard: "450px",--}}
{{--                    itemHandleOptions:{--}}
{{--                        enabled: true,--}}
{{--                    },--}}
{{--                    click: function(el) {--}}
{{--                        console.log("Trigger on all items click!");--}}
{{--                    },--}}
{{--                    context: function(el, e) {--}}
{{--                        console.log("Trigger on all items right-click!");--}}
{{--                    },--}}
{{--                    dropEl: function(el, target, source, sibling){--}}
{{--                        console.log(target.parentElement.getAttribute('data-id'));--}}
{{--                        console.log(el, target, source, sibling)--}}
{{--                    },--}}
{{--                    buttonClick: function(el, boardId) {--}}
{{--                        console.log(el);--}}
{{--                        console.log(boardId);--}}
{{--                        // create a form to enter element--}}
{{--                        var formItem = document.createElement("form");--}}
{{--                        formItem.setAttribute("class", "itemform");--}}
{{--                        formItem.innerHTML =--}}
{{--                            '<div class="form-group"><textarea class="form-control" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-xs pull-right">Submit</button><button type="button" id="CancelBtn" class="btn btn-default btn-xs pull-right">Cancel</button></div>';--}}

{{--                        KanbanTest.addForm(boardId, formItem);--}}
{{--                        formItem.addEventListener("submit", function(e) {--}}
{{--                            e.preventDefault();--}}
{{--                            var text = e.target[0].value;--}}
{{--                            KanbanTest.addElement(boardId, {--}}
{{--                                title: text--}}
{{--                            });--}}
{{--                            formItem.parentNode.removeChild(formItem);--}}
{{--                        });--}}
{{--                        document.getElementById("CancelBtn").onclick = function() {--}}
{{--                            formItem.parentNode.removeChild(formItem);--}}
{{--                        };--}}
{{--                    },--}}
{{--                    itemAddOptions: {--}}
{{--                        enabled: true,--}}
{{--                        content: '+ Add New Card',--}}
{{--                        class: 'custom-button',--}}
{{--                        footer: true--}}
{{--                    },--}}
{{--                    boards: [--}}
{{--                        {--}}
{{--                            id: "_todo",--}}
{{--                            title: "{{ $retro->name }}",--}}
{{--                            class: "info,good",--}}
{{--                            dragTo: ["_working"],--}}
{{--                            item: [--}}
{{--                                {--}}
{{--                                    id: "_test_delete",--}}
{{--                                    title: "Try drag this (Look the console)",--}}
{{--                                    drag: function(el, source) {--}}
{{--                                        console.log("START DRAG: " + el.dataset.eid);--}}
{{--                                    },--}}
{{--                                    dragend: function(el) {--}}
{{--                                        console.log("END DRAG: " + el.dataset.eid);--}}
{{--                                    },--}}
{{--                                    drop: function(el) {--}}
{{--                                        console.log("DROPPED: " + el.dataset.eid);--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                {--}}
{{--                                    title: "Try Click This!",--}}
{{--                                    click: function(el) {--}}
{{--                                        alert("click");--}}
{{--                                    },--}}
{{--                                    context: function(el, e){--}}
{{--                                        alert("right-click at (" + `${e.pageX}` + "," + `${e.pageX}` + ")")--}}
{{--                                    },--}}
{{--                                    class: ["peppe", "bello"]--}}
{{--                                }--}}
{{--                            ]--}}
{{--                        },--}}
{{--                        {--}}
{{--                            id: "_working",--}}
{{--                            title: "Working (Try drag me too)",--}}
{{--                            class: "warning",--}}
{{--                            item: [--}}
{{--                                {--}}
{{--                                    title: "Do Something!"--}}
{{--                                },--}}
{{--                                {--}}
{{--                                    title: "Run?"--}}
{{--                                }--}}
{{--                            ]--}}
{{--                        },--}}
{{--                        {--}}
{{--                            id: "_done",--}}
{{--                            title: "Done (Can drop item only in working)",--}}
{{--                            class: "success",--}}
{{--                            dragTo: ["_working"],--}}
{{--                            item: [--}}
{{--                                {--}}
{{--                                    title: "All right"--}}
{{--                                },--}}
{{--                                {--}}
{{--                                    title: "Ok!"--}}
{{--                                }--}}
{{--                            ]--}}
{{--                        }--}}
{{--                    ]--}}
{{--                });--}}

{{--                var toDoButton = document.getElementById("addToDo");--}}
{{--                toDoButton.addEventListener("click", function() {--}}
{{--                    KanbanTest.addElement("_todo", {--}}
{{--                        title: "Test Add"--}}
{{--                    });--}}
{{--                });--}}
{{--                var toDoButtonAtPosition = document.getElementById("addToDoAtPosition");--}}
{{--                toDoButtonAtPosition.addEventListener("click", function() {--}}
{{--                    KanbanTest.addElement("_todo", {--}}
{{--                        title: "Test Add at Pos"--}}
{{--                    }, 1);--}}
{{--                });--}}
{{--                var addBoardDefault = document.getElementById("addDefault");--}}
{{--                addBoardDefault.addEventListener("click", function() {--}}
{{--                    KanbanTest.addBoards([--}}
{{--                        {--}}
{{--                            id: "_default",--}}
{{--                            title: "Kanban Default",--}}
{{--                            item: [--}}
{{--                                {--}}
{{--                                    title: "Default Item"--}}
{{--                                },--}}
{{--                                {--}}
{{--                                    title: "Default Item 2"--}}
{{--                                },--}}
{{--                                {--}}
{{--                                    title: "Default Item 3"--}}
{{--                                }--}}
{{--                            ]--}}
{{--                        }--}}
{{--                    ]);--}}
{{--                });--}}
{{--                var removeBoard = document.getElementById("removeBoard");--}}
{{--                removeBoard.addEventListener("click", function() {--}}
{{--                    KanbanTest.removeBoard("_done");--}}
{{--                });--}}
{{--                var removeElement = document.getElementById("removeElement");--}}
{{--                removeElement.addEventListener("click", function() {--}}
{{--                    KanbanTest.removeElement("_test_delete");--}}
{{--                });--}}
{{--                var allEle = KanbanTest.getBoardElements("_todo");--}}
{{--                allEle.forEach(function(item, index) {--}}
{{--                    //console.log(item);--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}



</x-app-layout>
