# Fraternité Services Auto

Application web de gestion de la vente et de la location de véhicules, développée pour le pôle **Automobile** de **Fraternité Services**.

Elle permet de gérer le parc automobile, le fichier clients, les ventes de véhicules et les contrats de location, avec un tableau de bord de suivi de l'activité.

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Stack technique](#stack-technique)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Comptes de démonstration](#comptes-de-démonstration)
- [Structure du projet](#structure-du-projet)
- [Modèle de données](#modèle-de-données)
- [Commandes utiles](#commandes-utiles)

## Fonctionnalités

- **Authentification** avec deux rôles : `admin` (accès complet, création d'utilisateurs) et `gestionnaire` (gestion courante).
- **Tableau de bord** : véhicules disponibles/loués, chiffre d'affaires ventes et locations, dernières opérations.
- **Véhicules** : fiche complète (marque, modèle, année, immatriculation, kilométrage, carburant, transmission), type d'offre (vente, location, ou les deux), prix et statut (disponible, vendu, loué, en maintenance, indisponible). Recherche et filtre par statut.
- **Clients** : fichier client avec coordonnées, pièce d'identité, historique des ventes et locations.
- **Ventes** : enregistrement d'une vente liée à un véhicule et un client, mode de paiement, statut (en attente, payée, annulée). Le passage au statut "payée" met automatiquement le véhicule au statut "vendu".
- **Locations** : contrat de location avec dates de début/fin, prix par jour, caution, calcul automatique du montant total. Le statut "en cours" met le véhicule au statut "loué" ; "terminée"/"annulée" le repasse "disponible".

## Stack technique

- **Backend** : Laravel 12 (PHP 8.2+)
- **Base de données** : MySQL / MariaDB
- **Frontend** : Blade + Tailwind CSS + Alpine.js (via Laravel Breeze), icônes SVG inline
- **Authentification** : Laravel Breeze

## Prérequis

- PHP >= 8.2 avec les extensions habituelles de Laravel (`pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`)
- Composer 2.x
- MySQL ou MariaDB (par exemple via XAMPP/WAMP/Laragon)
- Node.js >= 18 et npm (pour compiler les assets Tailwind)

## Installation

1. **Cloner le dépôt**

   ```bash
   git clone <URL_DU_DEPOT>
   cd fraternite-services-auto
   ```

2. **Installer les dépendances PHP et JavaScript**

   ```bash
   composer install
   npm install
   ```

3. **Configurer l'environnement**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Ouvrez le fichier `.env` et vérifiez les paramètres de connexion à la base de données :

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fraternite_auto
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Créer la base de données**

   Créez une base de données vide nommée `fraternite_auto` (ou le nom choisi dans `.env`), par exemple :

   ```bash
   mysql -u root -e "CREATE DATABASE fraternite_auto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   ```

5. **Lancer les migrations et charger les données de démonstration**

   ```bash
   php artisan migrate --seed
   ```

6. **Compiler les assets front-end**

   ```bash
   npm run build
   ```

   (ou `npm run dev` pendant le développement, pour le rechargement automatique)

7. **Démarrer le serveur local**

   ```bash
   php artisan serve
   ```

   L'application est accessible sur [http://localhost:8000](http://localhost:8000).

## Comptes de démonstration

Le seeder (`database/seeders/DatabaseSeeder.php`) crée deux comptes utilisables immédiatement :

| Rôle | Email | Mot de passe |
|---|---|---|
| Administrateur | `admin@fraternite-services.sn` | `password` |
| Gestionnaire | `gestion@fraternite-services.sn` | `password` |

⚠️ Ces identifiants sont fournis uniquement pour la démonstration locale. Pensez à créer de nouveaux comptes et à supprimer ces comptes de démonstration avant tout déploiement en production.

Seul un administrateur peut créer de nouveaux utilisateurs, via le lien **"Ajouter un utilisateur"** dans le menu latéral (il n'y a pas d'inscription publique).

## Structure du projet

```
app/
  Http/Controllers/       Contrôleurs (Vehicule, Client, Vente, Location, Dashboard)
  Http/Middleware/        Middleware d'accès administrateur
  Models/                 Modèles Eloquent et leurs relations
database/
  migrations/             Schéma des tables (vehicules, clients, ventes, locations...)
  seeders/                Données de démonstration
resources/
  views/                  Vues Blade (layout, composants réutilisables, pages par module)
routes/
  web.php                 Routes de l'application (ressources CRUD)
  auth.php                Routes d'authentification
```

## Modèle de données

- **users** : comptes internes (`admin` / `gestionnaire`)
- **vehicules** : parc automobile (offre vente/location, prix, statut)
- **clients** : fichier client
- **ventes** : transactions de vente (véhicule, client, vendeur, statut)
- **locations** : contrats de location (véhicule, client, dates, montant calculé)

## Commandes utiles

```bash
php artisan migrate:fresh --seed   # Réinitialiser la base avec les données de démo
php artisan route:list             # Lister toutes les routes disponibles
php artisan tinker                 # Console interactive pour manipuler les modèles
```
