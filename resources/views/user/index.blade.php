<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect – Choisir un établissement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Animation de transition entre sections */
        .hidden-section {
            display: none;
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.6s ease;
        }
        .visible {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        .admin-btn {
  position: fixed;
  bottom: 20px;
  left: 20px;
  background-color: transparent;
  color: #888;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
  padding: 6px 12px;
  opacity: 0.4;
  transition: all 0.3s ease;
  z-index: 1000;
}

.admin-btn:hover {
  opacity: 1;
  color: #fff;
  background-color: #2d3748; /* gris bleuté élégant */
  border-color: #2d3748;
  transform: scale(1.05);
}

    </style>
</head>

<body class="font-sans bg-blue-50">

    <!-- Bouton Accès Admin discret -->
    <button onclick="accesAdmin()" class="btn btn-outline-secondary admin-btn">Accès</button>
    <!-- HERO SECTION -->
    <section id="hero" class="relative h-screen flex flex-col items-center justify-center text-center bg-cover bg-center" 
             style="background-image: url('{{ asset('image/hero-bg1.jpg') }}');">
        <div class="absolute inset-0 bg-blue-900/60"></div>

        <div class="relative z-10 text-white px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Bienvenue sur <span class="text-yellow-400">EduConnect</span></h1>
            <p class="max-w-2xl mx-auto text-lg mb-6">Ne soyez plus perdu dans votre choix d’établissement — explorez, comparez et décidez avec simplicité.</p>

            <!-- Formulaire de choix d’établissement -->
            <form action="{{ route('user.index') }}" method="GET" id="etablissementForm" class="max-w-md mx-auto">
                <div class="flex flex-col md:flex-row gap-3 items-center">
                    <select name="etablissement_id" class="p-3 rounded-lg w-full text-gray-800" required>
                        <option value="">-- Sélectionnez un établissement --</option>
                        @foreach($etablissements as $etablissement)
                            <option value="{{ $etablissement->id }}"
                                {{ request('etablissement_id') == $etablissement->id ? 'selected' : '' }}>
                                {{ $etablissement->nom }}
                            </option>
                        @endforeach
                    </select>
                    <button id="viewBtn" type="submit" 
                            class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 text-sm px-4 py-2 rounded-md font-medium shadow transition">
                        Valider
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- SECTION FILIÈRES -->
    <section id="filieresSection" class="hidden-section px-6 py-10 bg-white min-h-screen">
        @if($selectedEtablissement)
            <div class="container mx-auto mt-[50px]">
                <h3 class="text-3xl font-semibold text-blue-700 text-center mb-6 animate__animated animate__fadeInDown">
                    Filières de {{ $selectedEtablissement->nom }}
                </h3>

                @if($selectedEtablissement->filieres->isEmpty())
                    <p class="text-gray-500 text-center">Aucune filière associée à cet établissement.</p>
                @else
                    <div class="overflow-x-auto animate__animated animate__fadeInUp">
                        <table class="min-w-full border border-gray-200 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-blue-100 text-blue-800 uppercase text-sm">
                                <tr>
                                    <th class="px-6 py-3 text-left border-b">Nom de la filière</th>
                                    <th class="px-6 py-3 text-left border-b">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedEtablissement->filieres as $filiere)
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-6 py-3 border-b text-gray-700 font-medium">{{ $filiere->nom }}</td>
                                        <td class="px-6 py-3 border-b text-gray-600">
                                            {{ $filiere->description ?? 'Aucune description disponible' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endif
    </section>

    <script>
        // Transition douce entre les sections
        document.getElementById('etablissementForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche le rechargement immédiat
            document.getElementById('hero').classList.add('animate__animated', 'animate__fadeOutUp');
            setTimeout(() => {
                this.submit(); // Envoie le formulaire après l'animation
            }, 700);
        });

        // Si l’établissement est déjà sélectionné, afficher la section des filières
        @if($selectedEtablissement)
            document.getElementById('hero').style.display = 'none';
            document.getElementById('filieresSection').classList.add('visible');
        @endif

          function accesAdmin() {
            const motdepasse = prompt("Entrez le mot de passe admin :");
            if(motdepasse === "2008@") {
                window.location.href = "{{ route('admin.dashboard') }}";
            } else {
                alert("Mot de passe incorrect !");
            }
        }
    </script>

    
      
    
</body>
</html>
