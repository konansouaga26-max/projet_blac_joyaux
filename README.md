Blac Joyaux — Site e-commerce

Projet Mode Agence — IFRAN, Communication digitale / Création digitale / Développement web

Présentation

Blac Joyaux est une marque ivoirienne de maroquinerie fondée par Manuela Kouadio, célébrant
l'héritage culturel africain à travers la poupée Joyaux de Bla. Ce dépôt contient le site
e-commerce développé pour renforcer l'offre produit et le dispositif de vente en ligne de la marque.


Site en ligne : https://projet-blac-joyaux.onrender.com
Stack : Laravel · Blade · Tailwind CSS · SQLite · Docker


Prérequis


PHP 8.2+
Composer
Node.js (pour Tailwind CSS)
Git


Installation en local


Cloner le dépôt :


   git clone https://github.com/konansouaga26-max/projet_blac_joyaux.git


Installer les dépendances PHP :


   composer install


Installer les dépendances front :


   npm install && npm run build


Copier le fichier d'environnement :


   cp .env.example .env


Générer la clé d'application :


   php artisan key:generate


Lancer les migrations et le seed :


   php artisan migrate:fresh --seed


Démarrer le serveur local :


   php artisan serve

Déploiement en production (Render)

Le projet est conteneurisé via Docker (voir dockerfile à la racine).


Créer un nouveau "Web Service" sur Render, connecté au dépôt GitHub, branche main.
Render détecte automatiquement le dockerfile et construit l'image.
Configurer les variables d'environnement dans Render (Settings → Environment) :

APP_ENV=production
APP_URL=https://votre-domaine.onrender.com (obligatoirement en https)
APP_KEY= (générée en local avec php artisan key:generate --show)
SESSION_DRIVER=cookie



Le conteneur exécute automatiquement au démarrage php artisan migrate:fresh --seed,
puis lance Nginx + PHP-FPM via Supervisor.
Déploiement automatique à chaque push sur main, ou manuel via "Manual Deploy → Deploy latest commit".


⚠️ Point d'attention : migrate:fresh réinitialise la base à chaque redémarrage du service
(comportement volontaire, la base SQLite n'étant pas persistante sur le plan gratuit Render).
Pour une mise en production réelle, il faudrait remplacer par migrate --force et connecter
une base de données externe persistante (PostgreSQL par exemple).

Notes de fonctionnement


Le plan gratuit Render met le service en veille après inactivité ; la première requête
après une période creuse peut prendre 15 à 50 secondes.


Organisation Git


main — branche de production, déployée automatiquement sur Render
back-end — développement back-end
front-end — développement front-end


Convention de commit : feat: (nouvelle fonctionnalité), fix: (correction de bug),
chore: (tâche technique sans impact fonctionnel).

Équipe


Back-end : Souaga Marc-Aurel
Front-end : Kouakou Yao Nehemie
