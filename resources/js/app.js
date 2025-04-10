import './bootstrap';
import 'jkanban/dist/jkanban.min.css';
import Kanban from 'jkanban';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const kanban = new Kanban({
    element: '#myKanban',
    boards: [
        {
            id: '_todo',
            title: 'À faire',
            class: 'bg-light',
            item: [
                { title: 'Tâche 1' },
                { title: 'Tâche 2' }
            ]
        },
        {
            id: '_doing',
            title: 'En cours',
            class: 'bg-warning',
            item: [
                { title: 'Tâche 3' }
            ]
        },
        {
            id: '_done',
            title: 'Terminé',
            class: 'bg-success',
            item: []
        }
    ]
});
