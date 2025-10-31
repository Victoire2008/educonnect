<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-blue-50 font-sans">

<div class="flex min-h-screen">

        
    <!-- Main Content -->
    <main class="flex-1 p-8">
        <h1 class="text-4xl font-bold text-blue-600 mb-10 animate__animated animate__fadeInDown text-center w-full">Tableau de bord Admin</h1>

        @if(session('success'))
            <div class="mb-6 px-6 py-4 rounded-lg bg-white border-l-4 border-blue-500 text-blue-700 animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaires -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <!-- Ajouter un établissement -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">Ajouter un établissement</h2>
                <form action="{{ route('admin.storeEtablissement') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="text" name="nom" placeholder="Nom" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300" required>
                    <input type="text" name="adresse" placeholder="Adresse" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                    <input type="text" name="contact" placeholder="Contact" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Ajouter</button>
                </form>
            </div>

            <!-- Ajouter une filière -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">Ajouter une filière</h2>
                <form action="{{ route('admin.storeFiliere') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="text" name="nom" placeholder="Nom" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300" required>
                    <input type="text" name="description" placeholder="Description" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300" required>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Ajouter</button>
                </form>
            </div>

            <!-- Attribution filières -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 animate__animated animate__fadeInUp">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">Attribuer des filières</h2>
                <form action="{{ route('admin.assignFiliere') }}" method="POST" class="space-y-3">
                    @csrf
                    <select name="etablissement_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300" required>
                        <option value="">-- Choisir un établissement --</option>
                        @foreach($etablissements as $etablissement)
                            <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
                        @endforeach
                    </select>

                    <select name="filieres[]" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300" multiple required>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                        @endforeach
                    </select>

                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Attribuer</button>
                </form>
            </div>
        </div>

        <!-- Liste des établissements avec leurs filières -->
        <div class="bg-white p-6 rounded-xl shadow-md animate__animated animate__fadeInUp">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Établissements et filières associées</h2>
            <table class="min-w-full border border-gray-200 text-left">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-2 border-b">Établissement</th>
                        <th class="px-4 py-2 border-b">Filières</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etablissements as $etablissement)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-2 border-b text-gray-700">{{ $etablissement->nom }}</td>
                            <td class="px-4 py-2 border-b">
                                @if($etablissement->filieres->isEmpty())
                                    <span class="text-gray-400 italic">Aucune filière</span>
                                @else
                                    @foreach($etablissement->filieres as $filiere)
                                        <span class="inline-block bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm mr-1 mb-1">{{ $filiere->nom }}</span>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>
