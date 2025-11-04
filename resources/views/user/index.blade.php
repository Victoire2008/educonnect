<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect – Choisir un établissement</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animate.css -->
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

        /* Bouton admin discret */
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
            background-color: #2d3748;
            border-color: #2d3748;
            transform: scale(1.05);
        }
    </style>
</head>

<body class="font-sans bg-blue-50">

    <!-- Bouton Accès Admin -->
    <button onclick="accesAdmin()" class="admin-btn">Accès</button>

    <!-- HERO SECTION -->
    <section id="hero" 
        class="relative min-h-screen md:h-screen flex flex-col items-center justify-center text-center bg-cover bg-center bg-no-repeat px-4 sm:px-6 lg:px-8"
        style="background-image: url('{{ asset('image/hero-bg1.jpg') }}');">

        <!-- Filtre bleu semi-transparent -->
        <div class="absolute inset-0 bg-blue-900/60"></div>

        <!-- Contenu centré -->
        <div class="relative z-10 text-white w-full max-w-2xl mx-auto">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 leading-tight">
                Bienvenue sur <span class="text-yellow-400">EduConnect</span>
            </h1>
            <p class="text-base sm:text-lg mb-6">
                Explorez, comparez et choisissez facilement votre établissement.
            </p>

            <!-- Formulaire de choix -->
            <form action="{{ route('user.index') }}" method="GET" id="etablissementForm" class="w-full">
                <div class="flex flex-col sm:flex-row gap-3 items-center justify-center">
                    <select name="etablissement_id" class="p-3 rounded-lg w-full sm:w-2/3 text-gray-800 border" required>
                        <option value="">-- Sélectionnez un établissement --</option>
                        @foreach($etablissements as $etablissement)
                            <option value="{{ $etablissement->id }}"
                                {{ request('etablissement_id') == $etablissement->id ? 'selected' : '' }}>
                                {{ $etablissement->nom }}
                            </option>
                        @endforeach
                    </select>
                    <button id="viewBtn" type="submit" 
                            class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 text-sm px-4 py-2 rounded-md font-medium shadow transition w-full sm:w-auto">
                        Valider
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- SECTION FILIÈRES -->
    <section id="filieresSection" class="hidden-section px-4 sm:px-6 lg:px-8 py-10 bg-white min-h-screen">
        @if($selectedEtablissement)
            <div class="container mx-auto mt-12">
                <h3 class="text-2xl sm:text-3xl font-semibold text-blue-700 text-center mb-6 animate__animated animate__fadeInDown">
                    Filières de {{ $selectedEtablissement->nom }}
                </h3>

                @if($selectedEtablissement->filieres->isEmpty())
                    <p class="text-gray-500 text-center">Aucune filière associée à cet établissement.</p>
                @else
                    <div class="overflow-x-auto animate__animated animate__fadeInUp">
                        <table class="min-w-full border border-gray-200 shadow-md rounded-lg overflow-hidden text-sm sm:text-base">
                            <thead class="bg-blue-100 text-blue-800 uppercase">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 text-left border-b">Nom de la filière</th>
                                    <th class="px-4 sm:px-6 py-3 text-left border-b">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedEtablissement->filieres as $filiere)
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-4 sm:px-6 py-3 border-b text-gray-700 font-medium">{{ $filiere->nom }}</td>
                                        <td class="px-4 sm:px-6 py-3 border-b text-gray-600">
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
        // Transition entre sections
        document.getElementById('etablissementForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('hero').classList.add('animate__animated', 'animate__fadeOutUp');
            setTimeout(() => this.submit(), 700);
        });

        // Afficher la section des filières si un établissement est sélectionné
        @if($selectedEtablissement)
            document.getElementById('hero').style.display = 'none';
            document.getElementById('filieresSection').classList.add('visible');
        @endif

        // Boîte d'accès admin
        function accesAdmin() {
            const alertDiv = document.createElement('div');
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '0';
            alertDiv.style.left = '0';
            alertDiv.style.width = '100%';
            alertDiv.style.height = '100%';
            alertDiv.style.backgroundColor = 'rgba(0,0,0,0.5)';
            alertDiv.style.display = 'flex';
            alertDiv.style.justifyContent = 'center';
            alertDiv.style.alignItems = 'center';
            alertDiv.style.zIndex = '9999';

            alertDiv.innerHTML = `
                <div style="background:#fff; padding:20px; border-radius:10px; width:300px; text-align:center; box-shadow:0 0 10px rgba(0,0,0,0.3);">
                    <h3 style="margin-bottom:10px; color:#2563EB;">Accès Admin</h3>
                    <input type="password" id="adminPassword" placeholder="Mot de passe" style="width:90%; padding:5px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                    <div style="display:flex; justify-content:space-between;">
                        <button id="cancelBtn" style="background:#ccc; padding:5px 10px; border-radius:5px;">Annuler</button>
                        <button id="submitBtn" style="background:#2563EB; color:#fff; padding:5px 10px; border-radius:5px;">Valider</button>
                    </div>
                </div>
            `;
            document.body.appendChild(alertDiv);

            document.getElementById('cancelBtn').onclick = () => document.body.removeChild(alertDiv);
            document.getElementById('submitBtn').onclick = () => {
                const pwd = document.getElementById('adminPassword').value;
                if (pwd === "2008@") window.location.href = "{{ route('admin.dashboard') }}";
                else alert("Mot de passe incorrect !");
            };
        }
    </script>

</body>
</html>
