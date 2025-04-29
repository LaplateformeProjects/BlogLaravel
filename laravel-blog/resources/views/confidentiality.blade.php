@extends('layouts.app')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
  <h1 class="mb-4 text-2xl font-bold text-center">Confidentialité</h1>
  <p class="text-center text-gray-700">Politique de confidentialité.</p><br/>

  <div class="space-y-8 text-gray-500">
    <section>
      <h2 class="mb-2 text-xl font-semibold">ARTICLE 1 : PRÉAMBULE</h2>
      <p class="mb-4">
        La présente politique de confidentialité a pour but d’informer les utilisateurs du site :
      </p>
      <ul class="mb-4 ml-4 list-disc list-inside">
        <li>Sur la manière dont sont collectées leurs données personnelles (toute information permettant d’identifier un utilisateur : nom, prénom, âge, adresse, email, localisation, adresse IP, etc.).</li>
        <li>Sur les droits dont ils disposent concernant ces données.</li>
        <li>Sur la personne responsable du traitement des données collectées.</li>
        <li>Sur les destinataires de ces données.</li>
        <li>Sur la politique du site en matière de cookies.</li>
      </ul>
      <p>
        Cette politique complète les mentions légales et les Conditions Générales d’Utilisation consultables à l’URL : [Insérer l’URL].
      </p>
    </section>

    <section>
      <h2 class="mb-2 text-xl font-semibold">ARTICLE 2 : PRINCIPES RELATIFS À LA COLLECTE ET AU TRAITEMENT DES DONNÉES PERSONNELLES</h2>
      <p class="mb-4">
        Conformément à l’article 5 du RGPD, les données à caractère personnel sont :
      </p>
      <ul class="mb-4 ml-4 list-disc list-inside">
        <li>Traitées de manière licite, loyale et transparente.</li>
        <li>Collectées pour des finalités déterminées, explicites et légitimes.</li>
        <li>Adéquates, pertinentes et limitées à ce qui est nécessaire.</li>
        <li>Exactes et tenues à jour, effacées ou rectifiées si inexactes.</li>
        <li>Conservées sous forme identiﬁable pour une durée n’excédant pas la finalité.</li>
        <li>Traitées avec une sécurité appropriée pour protéger contre tout traitement non autorisé.</li>
      </ul>
      <p class="mb-2">
        Le traitement n’est licite que si au moins une des conditions suivantes est remplie :
      </p>
      <ul class="ml-4 list-disc list-inside">
        <li>Consentement de la personne concernée.</li>
        <li>Nécessaire à l’exécution d’un contrat ou mesures précontractuelles.</li>
        <li>Nécessaire au respect d’une obligation légale.</li>
        <li>Nécessaire à la sauvegarde des intérêts vitaux.</li>
        <li>Nécessaire à une mission d’intérêt public ou exercice de l’autorité publique.</li>
        <li>Nécessaire aux intérêts légitimes du responsable, sauf préjudice aux droits fondamentaux.</li>
      </ul>
    </section>

    <section>
      <h2 class="mb-2 text-xl font-semibold">ARTICLE 3 : DONNÉES COLLECTÉES ET TRAITÉES</h2>
      <h3 class="mb-1 font-semibold">Article 3.1 : Données collectées</h3>
      <p class="mb-4">Les données personnelles collectées sont les suivantes&nbsp;: [Liste des données collectées]</p>
      <p class="mb-4">Finalités de la collecte&nbsp;: [Préciser les raisons : gestion de contrat, espace client, newsletter, etc.]</p>

      <h3 class="mb-1 font-semibold">Article 3.2 : Mode de collecte</h3>
      <p class="mb-2">Données automatiquement collectées lors de la visite&nbsp;:</p>
      <ul class="mb-4 ml-4 list-disc list-inside">
        <li>[Liste des données automatiques : IP, logs, cookies, etc.]</li>
      </ul>
      <p class="mb-2">Données collectées lors d’actions spécifiques&nbsp;:</p>
      <ul class="ml-4 list-disc list-inside">
        <li>[Opérations spécifiques et finalités]</li>
      </ul>
      <p class="mt-4">Ces données sont conservées pour une durée de : [Durée de conservation]. Elles peuvent être conservées au-delà pour obligations légales.</p>

      <h3 class="mb-1 font-semibold">Article 3.3 : Hébergement des données</h3>
      <p class="mb-4">
        Le site est hébergé par&nbsp;:
        <br>[Dénomination sociale]<br>
        [Adresse du siège]<br>
        [Contact hébergeur]
      </p>
      <p>[Ajouter Article 3.4 : Transmission à des tiers, si applicable]</p>
      <p>[Ajouter Article 3.5 : Politique cookies, si applicable]</p>
    </section>

    <section>
      <h2 class="mb-2 text-xl font-semibold">ARTICLE 4 : RESPONSABLE DU TRAITEMENT ET DPO</h2>
      <h3 class="mb-1 font-semibold">Article 4.1 : Responsable du traitement</h3>
      <p class="mb-4">
        Responsable : [Nom / Raison sociale], [Forme juridique], capital [Montant], immatriculation RCS [Numéro].<br>
        Contact&nbsp;:
        <ul class="ml-4 list-disc list-inside">
          <li>Adresse : [Adresse siège]</li>
          <li>Téléphone : [Numéro]</li>
          <li>Email : [Email]</li>
        </ul>
      </p>
      <h3 class="mb-1 font-semibold">Article 4.2 : Délégué à la protection des données (DPO)</h3>
      <p>
        DPO&nbsp;: [Nom, adresse, téléphone, email].<br>
        En cas de réclamation, vous pouvez adresser un signalement à la CNIL.
      </p>
    </section>

    <section>
      <h2 class="mb-2 text-xl font-semibold">ARTICLE 5 : DROITS DE L’UTILISATEUR</h2>
      <p class="mb-4">
        Conformément au RGPD et à la loi Informatique et Libertés, l’utilisateur dispose des droits suivants&nbsp;:
      </p>
      <ul class="mb-4 ml-4 list-disc list-inside">
        <li>Droit d’accès, de rectification et d’effacement (articles 15, 16, 17 RGPD).</li>
        <li>Droit à la portabilité des données (article 20 RGPD).</li>
        <li>Droit à la limitation et d’opposition (articles 18, 21 RGPD).</li>
        <li>Droit de ne pas faire l’objet d’une décision automatisée.</li>
        <li>Droit de déterminer le sort des données après la mort.</li>
        <li>Droit de saisir l’autorité de contrôle (article 77 RGPD).</li>
      </ul>
      <p>
        Pour exercer vos droits, contactez&nbsp;: [Nom et adresse] ou par mail à [Email DPO].<br>
        Vous pouvez être amené(e) à fournir vos nom, prénom, email et numéro de compte.
      </p>
    </section>

    <section>
      <h2 class="mb-2 text-xl font-semibold">ARTICLE 6 : MODIFICATION DE LA POLITIQUE</h2>
      <p>
        L’Éditeur se réserve le droit de modifier la présente Politique à tout moment pour la rendre conforme à la réglementation.<br>
        Les modifications n’affectent pas les achats antérieurs, qui restent soumis à la version en vigueur au moment de la transaction.<br>
        Cette politique, éditée le [date de mise en ligne], a été mise à jour le [date de mise à jour].
      </p>
    </section>
  </div>
</div>
@endsection
