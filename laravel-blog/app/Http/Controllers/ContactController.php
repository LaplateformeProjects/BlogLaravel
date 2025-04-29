<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Afficher le formulaire de contact
    public function show()
    {
        return view('contact');
    }

    // Traiter le formulaire de contact et envoyer l'email
    public function send(ContactRequest $request)
    {
        // Validation des données
        $validated = $request->validated();

        // Envoi de l'email
        Mail::to('stephane.haluszczak@laplateforme.io')->send(new ContactMessage($validated));

        // Retourner à la page de contact avec un message de succès
        return redirect()->route('contact')->with('success', 'Votre message a bien été envoyé ! Je vous répondrai dans les plus brefs délais.');
    }
}
