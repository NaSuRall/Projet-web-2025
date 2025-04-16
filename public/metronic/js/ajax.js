document.querySelectorAll('.form-create-card').forEach(form => {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const columnId = form.dataset.columnId;
        const userId = '{{ auth()->user()->id }}';
        const description = form.querySelector('textarea[name="textarea"]').value;

        const response = await fetch("{{ route('retro.createCard') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                column_id: columnId,
                user_id: userId,
                textarea: description
            })
        });

        if (response.ok) {
            const data = await response.json();

            // Ajouter dynamiquement la carte à la colonne
            const cardHTML = `
                <div class="relative p-3 mb-3 rounded card shadow">
                    <div class="card-body w-full">
                        <p class="text-sm text-gray-600">${data.description}</p>
                        <form method="POST" class="form-delete-card" data-card-id="${data.id}">
                            <button type="submit" class="absolute top-2 right-0 bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            `;

            form.closest('.flex.flex-col').querySelector('.scrollable').insertAdjacentHTML('beforeend', cardHTML);
            form.querySelector('textarea[name="textarea"]').value = '';
        } else {
            alert('Erreur lors de la création de la carte');
        }
    });
});
