<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>
<body class="p-6 text-gray-800 bg-gray-100">
    <div class="max-w-xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg">
        <div class="p-6 bg-blue-600">
            <h1 class="text-2xl font-bold text-center text-white">Nouveau message 📬</h1>
        </div>

        <div class="p-8 space-y-4">
            <div class="flex items-center">
                <div class="w-24 font-semibold text-gray-700">👤 Nom :</div>
                <div>{{ $data['name'] }}</div>
            </div>

            <div class="flex items-center">
                <div class="w-24 font-semibold text-gray-700">📞 Téléphone :</div>
                <div>{{ $data['phone'] ?? 'Non fourni' }}</div>
            </div>

            <div class="flex items-center">
                <div class="w-24 font-semibold text-gray-700">✉️ Email :</div>
                <div>{{ $data['email'] }}</div>
            </div>

            <div class="pt-6">
                <div class="mb-2 font-semibold text-gray-700">📝 Message :</div>
                <div class="p-4 whitespace-pre-line border border-gray-200 rounded-md bg-gray-50">
                    {{ $data['message'] }}
                </div>
            </div>
        </div>

        <div class="p-4 text-sm text-center text-gray-500 bg-gray-100">
            Ce message vous a été envoyé automatiquement depuis le formulaire de contact.
        </div>
    </div>
</body>
</html>
