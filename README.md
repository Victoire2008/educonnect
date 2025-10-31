🎓 Gestion des Établissements et Filières

Une application web développée avec Laravel permettant d’administrer facilement les établissements et leurs filières associées, ainsi que de les consulter via une interface utilisateur fluide et moderne.

🚀 Fonctionnalités principales
👩‍💼 Côté administrateur

Ajouter, modifier ou supprimer un établissement.

Ajouter, modifier ou supprimer une filière.

Associer plusieurs filières à un établissement.

Tableau de bord clair avec affichage dynamique des établissements et de leurs filières.

👨‍🎓 Côté utilisateur

Choisir un établissement depuis une interface simple.

Visualiser les filières disponibles pour cet établissement.

Consulter la description de chaque filière.

Expérience fluide avec effet de transition entre les sections (choix ➜ résultats).

🧱 Structure du projet
project/
├── app/
│   ├── Http/Controllers/
│   │   ├── EtablissementController.php
│   │   ├── FiliereController.php
│   │   └── AttributionController.php
│   ├── Models/
│   │   ├── Etablissement.php
│   │   └── Filiere.php
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── etablissements.blade.php
│   │   │   └── filieres.blade.php
│   │   └── utilisateur/
│   │       ├── accueil.blade.php
│   │       └── resultat.blade.php
├── public/
│   ├── css/
│   ├── js/
│   └── images/
└── routes/
    └── web.php

⚙️ Installation et configuration
1️⃣ Cloner le dépôt
git clone https://github.com/ton-compte/gestion-etablissements.git
cd gestion-etablissements

2️⃣ Installer les dépendances
composer install
npm install
npm run dev

3️⃣ Créer le fichier d’environnement
cp .env.example .env


Puis configure la connexion à ta base de données dans .env :

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=etablissement_db
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Générer la clé de l’application
php artisan key:generate

5️⃣ Migrer la base de données
php artisan migrate

🖥️ Lancer le serveur
php artisan serve


Puis ouvrir ton navigateur sur :
👉 http://127.0.0.1:8000

🎨 Design

L’interface a été conçue avec :

Tailwind CSS & Bootstrap 5

Couleurs principales : bleu clair et blanc

Animations avec Animate.css et transitions douces entre sections

🔐 Accès administrateur

Un bouton discret d’accès est placé en bas à gauche de la page :

<button onclick="accesAdmin()" class="btn btn-outline-secondary admin-btn">Accès</button>


Ce bouton permet de rejoindre le tableau de bord d’administration.

✨ Auteur

Victoire Emmanuelle
Développeuse d’applications web (Laravel / PHP / MySQL)
📧 [victoirebamba1@gmail.com
]