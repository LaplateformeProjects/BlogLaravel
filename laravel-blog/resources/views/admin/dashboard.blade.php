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
