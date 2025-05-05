@extends('layouts.app')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-2xl font-bold text-center">À propos de moi</h1>
    <p class="text-center text-gray-700">Bienvenue sur mon blog ! Je partage mes passions avec vous.</p><br/>
    <p class="text-gray-500">
    Comment rédiger une page À propos de nous
Les meilleures pages À propos de nous partagent les histoires de l’entreprise et des fondateurs. C’est l’occasion de tirer le rideau sur l’entreprise et de présenter les personnes qui la font vivre.

Voici quelques-unes des pages À propos de nous les plus efficaces :

Connecter le consommateur à l’entreprise à un niveau plus profond
Fournir un aperçu contextuel de la raison pour laquelle les fondateurs ont créé l’entreprise
Partager les valeurs fondamentales, la mission, les croyances et la vision de l’entreprise
Répondre à toutes les questions que les consommateurs peuvent se poser sur l’entreprise

Modèle de page À propos de nous
Une page À propos de nous comporte quatre éléments principaux :

1. Partager l’histoire de la création de l’entreprise
C’est l’occasion de vous concentrer sur le « pourquoi » de votre entreprise Il pourrait s’agir de ce qui vous distingue des autres concurrents sur le marché.
Partagez le moment où vous avez eu l’inspiration pour votre entreprise et ce qui vous a motivé à la lancer.

2. Mettez en évidence votre parcours et le rôle de votre équipe fondatrice
Qui êtes-vous ? Pourquoi êtes-vous la bonne personne pour diriger votre entreprise en ce moment ? Partagez vos antécédents et votre histoire personnelle. Cela vous rapprochera de vos clients.

3. Documentez l’évolution de l’entreprise
Exposez tout, des obstacles aux améliorations apportées aux produits. Mettez vos nouveaux clients au courant. Où se trouve l’entreprise aujourd’hui ? En quoi est-elle différente de ce qu’elle était auparavant ?

4. Documentez la mission et la vision
Que tente de résoudre votre entreprise ? Où va-t-elle ? Terminez la page À propos de nous en détaillant les mesures que vous prenez pour transformer l’entreprise selon votre vision ultime.

Grâce à ces quatre éléments, vous créerez une page À propos de nous exceptionnelle qui épatera les prospects et convertira de nouveaux clients.
En combinant ces éléments avec le bon constructeur de site web et une conception de page appropriée, vous transformerez un visiteur en client.
Il est important de ne pas oublier ce que veulent vos clients, également.
Les utilisateurs de votre public cible veulent voir votre déclaration de mission, une preuve sociale et un exemple d’utilisation de votre produit. Ces éléments sur votre page web À propos de nous renforceront la confiance du public cible.
    </p>
</div>

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

@endsection
