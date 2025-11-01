<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

     <style>
        body {
            background-color: #f0f6ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        main {
            padding: 2rem;
        }

        table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        th {
            background-color: #e6f0ff;
            color: #0d47a1;
            font-weight: 600;
            text-align: left;
            padding: 12px 16px;
            border-bottom: 2px solid #cbd5e1;
        }

        td {
            background-color: #fff;
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        tr:hover td {
            background-color: #f3faff;
            transition: 0.2s;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .btn-edit {
            background-color: #63a1e4;
            color: white;
        }

        .btn-edit:hover {
            background-color: #a2cfff;
        }

        .btn-delete {
            background-color: #e97067;
            color: white;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        h2 {
            color: #0d47a1;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .table-section {
            margin-bottom: 3rem;
            border-radius: 12px;
            background: white;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .text-center {
            text-align: center;
        }
    </style>
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
<div class="bg-white p-6 rounded-xl shadow-md animate__animated animate__fadeInUp mb-10">
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
                <td class="px-4 py-2 border-b text-gray-700 font-medium">{{ $etablissement->nom }}</td>
                <td class="px-4 py-2 border-b">
                    @foreach($etablissement->filieres as $filiere)
                        <span class="inline-block bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm mr-1 mb-1">
                            {{ $filiere->nom }}
                        </span>
                    @endforeach
                </td>
              
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

  <!-- Liste des filières -->
    <div class="table-section">
        <h2>Liste des Filières</h2>

        <table class="min-w-full">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filieres as $filiere)
                <tr>
                    <td>{{ $filiere->nom }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.editFiliere', $filiere->id) }}" class="btn btn-edit mr-2">Modifier</a>

                                  <!-- Bouton supprimer (SweetAlert2) -->
                            <button type="button"
                              class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm"
                               onclick="confirmDelete('{{ route('admin.deleteFiliere', $filiere->id) }}')">
                                   Supprimer
                            </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Liste des établissements -->
    <div class="table-section">
        <h2>Liste des Établissements</h2>

        <table class="min-w-full">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etablissements as $etablissement)
                <tr>
                    <td>{{ $etablissement->nom }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.editEtablissement', $etablissement->id) }}" class="btn btn-edit mr-2"> Modifier</a>

                       <!-- Bouton supprimer (SweetAlert2) -->
                            <button type="button"
                              class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm"
                               onclick="confirmDelete('{{ route('admin.deleteFiliere', $filiere->id) }}')">
                                   Supprimer
                            </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </main>
</div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Supprimer cet élément ?',
        text: "Cette action est irréversible.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563EB', // bleu (ton thème)
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // Crée dynamiquement un formulaire pour envoyer la requête DELETE
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            const token = document.createElement('input');
            token.type = 'hidden';
            token.name = '_token';
            token.value = '{{ csrf_token() }}';
            form.appendChild(token);

            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

</body>
</html>
