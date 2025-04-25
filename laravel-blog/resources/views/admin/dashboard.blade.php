@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-400">Tableau de bord</h1>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Articles -->
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Articles publiés</h2>
                <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">
                    {{ $articlesCount }}
                </p>
            </div>

            <!-- Graphique des articles -->
            <div class="p-6 mt-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-200">Articles publiés par mois</h2>
                <canvas id="articlesChart" height="120"></canvas>
            </div>

            <!-- Commentaires en attente -->
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Commentaires en attente</h2>
                <p class="mt-2 text-3xl font-bold text-yellow-500 dark:text-yellow-400">
                    {{ $pendingComments }}
                </p>
            </div>

            <!-- Utilisateurs -->
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Utilisateurs enregistrés</h2>
                <p class="mt-2 text-3xl font-bold text-green-500 dark:text-green-400">
                    {{ $userCount }}
                </p>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-200">Actions rapides</h2>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
                <a href="{{ route('admin.articles.create') }}"
                   class="px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">
                    ✍️ Nouvel article
                </a>
                <a href="{{ route('admin.comments.index') }}"
                   class="px-4 py-2 text-white transition bg-yellow-500 rounded hover:bg-yellow-600">
                    🛠️ Modérer commentaires
                </a>
            </div>
        </div>

        <!-- Gestion des catégories -->
        <div class="p-6 mt-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-200">🗂️ Gestion des catégories</h2>

            <!-- Feedback visuel (succès ou erreur) -->
            @if (session('success'))
                <div class="p-4 mt-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded flash-message">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mt-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded flash-message">
                    ❌ {{ session('error') }}
                </div>
            @endif

            @if (session('deleted'))
                <div class="p-4 mt-4 text-sm text-yellow-700 bg-yellow-100 border border-yellow-300 rounded flash-message">
                    ⚠️ {{ session('deleted') }}
                </div>
            @endif

            <!-- Ajout d'une catégorie -->
            <form action="{{ route('admin.categories.store') }}" method="POST" class="flex items-center space-x-4">
                @csrf
                <input type="text" name="name" placeholder="Nouvelle catégorie" class="px-3 py-2 border border-gray-300 rounded" required>
                <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    ➕ Ajouter
                </button>
            </form>

            @if ($errors->any())
                <div class="p-3 mt-4 text-sm text-red-600 bg-red-100 border border-red-300 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Liste des catégories et suppression d'une catégorie -->
            <ul class="space-y-2">
                @foreach(App\Models\Category::all() as $category)
                    <li class="flex items-center justify-between px-4 py-2 bg-gray-100 rounded dark:bg-gray-700">
                        <span class="text-gray-800 dark:text-white">{{ $category->name }}</span>
                        <form id="form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    class="text-red-500 hover:underline"
                                    data-category-name="{{ $category->name }}"
                                    data-form-id="form-{{ $category->id }}">
                                Supprimer
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('articlesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Articles publiés',
                data: {!! json_encode($articlesPerMonth) !!},
                backgroundColor: 'rgba(37, 99, 235, 0.7)', // blue-600
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision:0
                    }
                }
            }
        }
    });
</script>

{{-- Bouton de retour en haut --}}
<div class="fixed z-50 group bottom-6 right-6">
    <button id="scrollToTopBtn"
        class="hidden p-3 text-white transition-all duration-300 transform bg-white rounded-full shadow-lg
               hover:scale-110 hover:shadow-[0_0_15px_4px_rgba(99,102,241,0.4)] animate-pulse"
        aria-label="Retour en haut">
        ⬆️
    </button>

    {{-- Tooltip à gauche avec animation --}}
    <div class="absolute items-center hidden px-3 py-1 mr-3 text-xs font-medium text-white transition-all duration-300 ease-out transform scale-95 -translate-y-1/2 bg-black rounded shadow-md opacity-0 right-full top-1/2 group-hover:flex bg-opacity-80 group-hover:opacity-100 group-hover:scale-100">
        Retour en haut
        <div class="absolute w-2 h-2 rotate-45 -translate-y-1/2 bg-black bg-opacity-80 top-1/2 -right-1"></div>
    </div>
</div>

<script>
    const scrollBtn = document.getElementById('scrollToTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollBtn.classList.remove('hidden');
        } else {
            scrollBtn.classList.add('hidden');
        }
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

<script>
    // Cacher automatiquement les messages flash après 4 secondes(4000)
    setTimeout(() => {
        document.querySelectorAll('.flash-message').forEach(el => {
            el.classList.add('transition', 'opacity-0', 'duration-700');
            setTimeout(() => el.remove(), 700); // Supprime l'élément après la transition
        });
    }, 4000);
</script>

<!-- Modal de confirmation -->
<div id="deleteModal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="modalTitle"
     aria-describedby="modalDesc"
     class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 bg-white rounded shadow-lg dark:bg-gray-800">
        <h2 id="modalTitle" class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Confirmer la suppression</h2>
        <p id="modalDesc" class="mb-6 text-gray-700 dark:text-gray-300">
            Voulez-vous vraiment supprimer la catégorie <span id="categoryName" class="font-bold"></span> ?
        </p>
        <div class="flex justify-end space-x-4">
            <button id="cancelDelete" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 dark:bg-gray-700 dark:text-white">Annuler</button>
            <button id="confirmDelete" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">Supprimer</button>
        </div>
    </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');
    const categoryName = document.getElementById('categoryName');

    let currentForm = null;

    // Boutons de suppression
    document.querySelectorAll('button[data-form-id]').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            const formId = button.getAttribute('data-form-id');
            const name = button.getAttribute('data-category-name');

            currentForm = document.getElementById(formId);
            categoryName.textContent = name;

            deleteModal.classList.remove('hidden');

            // 🔽 Focus sur "Annuler"
            setTimeout(() => {
                cancelDelete.focus();
            }, 100);
        });
    });

    // Annulation de la suppression
    cancelDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
        currentForm = null;
    });

    // Confirmation de suppression
    confirmDelete.addEventListener('click', () => {
        if (currentForm) {
            currentForm.submit();
        }
    });

    // Fermeture avec Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            deleteModal.classList.add('hidden');
            currentForm = null;
        }
    });
</script>

@endsection