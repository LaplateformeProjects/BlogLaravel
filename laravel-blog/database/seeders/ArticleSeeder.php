<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Récupération des catégories existantes
        $categories = [
            'technologie' => Category::where('slug', 'technologie')->first(),
            'voyage' => Category::where('slug', 'voyage')->first(),
            'sante' => Category::where('slug', 'sante')->first(),
        ];

        // Vérification (optionnel)
        foreach ($categories as $slug => $cat) {
            if (!$cat) {
                $this->command->error("La catégorie '$slug' n'existe pas !");
                return;
            }
        }

        // Articles par catégorie
        $articles = [
            'technologie' => [
                [
                    'title' => 'Les nouveautés de PHP 8',
                    'slug' => 'php-8-nouveautes',
                    'body' => "PHP 8 introduit des fonctionnalités comme les attributs, les unions de types, et le moteur JIT. Une avancée majeure pour les développeurs PHP."
                ],
                [
                    'title' => 'Laravel : le framework incontournable',
                    'slug' => 'laravel-framework',
                    'body' => "Laravel simplifie la création d'applications web modernes grâce à son écosystème puissant et sa syntaxe élégante."
                ]
            ],
            'voyage' => [
                [
                    'title' => 'Découvrir le Japon : culture et traditions',
                    'slug' => 'japon-culture-traditions',
                    'body' => "Le Japon offre un mélange unique entre traditions ancestrales et innovations technologiques. À visiter au moins une fois dans sa vie."
                ],
                [
                    'title' => 'Les plus beaux villages de France',
                    'slug' => 'villages-france',
                    'body' => "Explorez les joyaux cachés de la France comme Saint-Cirq-Lapopie ou Gordes. Un vrai retour dans le temps."
                ]
            ],
            'sante' => [
                [
                    'title' => "L'importance du sommeil pour la santé",
                    'slug' => 'sommeil-sante',
                    'body' => "Le sommeil régule notre mémoire, notre humeur et notre immunité. Dormir 7 à 8 heures par nuit est essentiel pour une bonne santé."
                ],
                [
                    'title' => "Bien manger pour vivre mieux",
                    'slug' => 'alimentation-equilibree',
                    'body' => "Une alimentation variée, riche en fruits, légumes et fibres, contribue à prévenir les maladies et à améliorer le bien-être."
                ]
            ]
        ];

        // Insertion des articles
        foreach ($articles as $slug => $list) {
            foreach ($list as $article) {
                Article::create([
                    'title' => $article['title'],
                    'slug' => $article['slug'],
                    'body' => $article['body'],
                    'category_id' => $categories[$slug]->id
                ]);
            }
        }
    }
}
