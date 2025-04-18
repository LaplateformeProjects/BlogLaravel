@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-400">Tableau de bord</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Articles -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Articles publiés</h2>
                <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">
                    {{ $articlesCount }}
                </p>
            </div>

            <!-- Graphique des articles -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mt-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Articles publiés par mois</h2>
                <canvas id="articlesChart" height="120"></canvas>
            </div>

            <!-- Commentaires en attente -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Commentaires en attente</h2>
                <p class="mt-2 text-3xl font-bold text-yellow-500 dark:text-yellow-400">
                    {{ $pendingComments }}
                </p>
            </div>

            <!-- Utilisateurs -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Utilisateurs enregistrés</h2>
                <p class="mt-2 text-3xl font-bold text-green-500 dark:text-green-400">
                    {{ $userCount }}
                </p>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Actions rapides</h2>
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                <a href="{{ route('admin.articles.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    ✍️ Nouvel article
                </a>
                <a href="{{ route('admin.comments.index') }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                    🛠️ Modérer commentaires
                </a>
            </div>
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

@endsection
