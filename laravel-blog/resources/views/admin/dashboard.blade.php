@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="space-y-6">
        <div class="p-6 mt-1 text-center bg-white rounded-lg shadow dark:bg-gray-800">
            <h1 class="text-3xl italic font-bold text-gray-800">~ Tableau de bord ~</h1>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Articles -->
            <div class="p-6 mt-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Nb total d'articles publiés</h2>
                <p class="mt-2 text-4xl font-bold text-blue-600 dark:text-blue-400">
                    {{ $articlesCount }}
                </p>
            </div>

            <!-- Graphique des articles -->
            <div class="p-6 mt-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-300">Nb d'articles publiés / mois</h2>
                <canvas id="articlesChart" height="280"></canvas>
            </div>

           <!-- Type d'articles -->
            <div class="p-6 mt-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-300">Répartition des articles / catégorie</h2>
                <canvas id="categoriesChart" height="120"></canvas>
            </div>

            <!-- Utilisateurs -->
            <div class="p-6 mt-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Nb total d'utilisateurs enregistrés</h2>
                <p class="mt-2 text-4xl font-bold text-green-500 dark:text-green-400">
                    {{ $userCount }}
                </p>
            </div>

            <!-- Graphique des utilisateurs -->
            <div class="p-6 mt-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-300">Nb d'utilisateurs enregistrés / mois</h2>
                <canvas id="usersChart" height="280"></canvas>
            </div>

            <!-- Taux d'acquisition en utilisateurs -->
            <div class="p-6 mt-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-300">Taux d'acquisition utilisateurs</h2>
                <canvas id="progressionRateChart" height="280"></canvas>
            </div>

            <!-- Articles en attente -->
            <div class="p-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Articles à modérer</h2>
                <p class="mt-2 text-4xl font-bold text-blue-600 dark:text-blue-400">
                    {{ $pendingArticles }}
                </p>
            </div>

            <!-- Commentaires en attente -->
            <div class="p-6 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Commentaires à modérer</h2>
                <p class="mt-2 text-4xl font-bold text-orange-400 dark:text-orange-300">
                    {{ $pendingComments }}
                </p>
            </div>
        </div>

        <!-- Liste des utilisateurs -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Liste des utilisateurs</h2>
            
        </div>

        <!-- Gestion des catégories -->
        <div class="p-6 mt-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-300">Gestion des catégories</h2>

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
                <input type="text" name="name" placeholder="Nouvelle catégorie" class="px-3 py-2 mb-2 border border-gray-300 rounded" required>
                <button type="submit" class="px-4 py-2 mb-2 text-white bg-green-600 rounded hover:bg-green-700">
                    + Ajouter
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
    const articlesCtx = document.getElementById('articlesChart').getContext('2d');
    new Chart(articlesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Articles publiés',
                data: {!! json_encode($articlesPerMonth) !!},
                backgroundColor: 'rgba(37, 99, 235, 0.7)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>

<script>
    const categoryCtx = document.getElementById("categoriesChart").getContext("2d");

    const categories = @json($categories);
    const labels = categories.map(cat => cat.name);
    const data = categories.map(cat => cat.articles_count);

    // Définir les couleurs selon le slug
    const backgroundColor = categories.map(cat => {
        switch (cat.slug) {
            case 'technologie': return '#3B82F6'; // blue-500
            case 'voyage': return '#10B981';      // emerald-500
            case 'sante': return '#EC4899';       // pink-500
            default: return '#6B7280';            // gray-500
        }
    });

    new Chart(categoryCtx, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [{
                label: "Articles par catégorie",
                data: data,
                backgroundColor: backgroundColor,
                borderColor: "#fff",
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        color: "#374151"
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || "";
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} articles (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const usersCtx = document.getElementById('usersChart').getContext('2d');
    new Chart(usersCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: "Utilisateurs enregistrés",
                data: {!! json_encode($usersPerMonth) !!},
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>

<script>
    // Récupère le contexte du canvas
    const progressionCtx = document.getElementById('progressionRateChart').getContext('2d');

    // Labels et données brutes depuis Laravel
    const months = {!! json_encode($months) !!};
    const usersPerMonth = {!! json_encode($usersPerMonth) !!};

    // Calcul du taux d'acquisition (%) : variation relative par rapport au mois précédent
    const acquisitionRates = usersPerMonth.map((current, idx, arr) => {
        if (idx === 0 || arr[idx - 1] === 0) {
            return 0; // pas de taux pour le premier mois ou division par zéro
        }
        const rate = ((current - arr[idx - 1]) / arr[idx - 1]) * 100;
        return parseFloat(rate.toFixed(1)); // arrondi à 1 décimale
    });

    new Chart(progressionCtx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: "Taux d'acquisition (%)",
                data: acquisitionRates,
                fill: false,
                tension: 0.3,                     // courbe légèrement lissée
                borderColor: 'rgba(16,185,129,0.7)',  // vert-500
                pointBackgroundColor: 'rgba(16,185,129,1)',
                pointRadius: 4,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => value + '%'  // ajoute le symbole %
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#374151' }     // gris foncé
                },
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.parsed.y}%`  // affiche la valeur avec %
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
        if (window.scrollY > 100) {
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
    // Cacher automatiquement les messages flash après 6 secondes(6000)
    setTimeout(() => {
        document.querySelectorAll('.flash-message').forEach(el => {
            el.classList.add('transition', 'opacity-0', 'duration-700');
            setTimeout(() => el.remove(), 700); // Supprime l'élément après la transition
        });
    }, 6000);
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