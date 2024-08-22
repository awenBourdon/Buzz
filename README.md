# Buzz

Buzz est une application web permettant aux utilisateurs de poster et partager des photos. Elle est construite avec Laravel, utilise Docker pour la conteneurisation, et Blade comme moteur de template.

## Fonctionnalités

- Inscription et connexion des utilisateurs
- Publication de photos avec descriptions
- Fil d'actualité pour voir les photos des autres utilisateurs


## Prérequis

- Docker
- Docker Compose

## Installation

1. Clonez ce dépôt : git clone https://github.com/votre-nom-utilisateur/buzz.git puis cd buzz
2. Copiez le fichier d'environnement : cp .env.example .env
3. Lancez les conteneurs Docker : docker-compose up -d
4. Installez les dépendances PHP :  composer install
5. Générez la clé d'application : php artisan key:generate
6. Exécutez les migrations : php artisan migrate

## Utilisation

Accédez à l'application via votre navigateur à l'adresse `http://localhost:8000`.

## Développement

- Les vues Blade se trouvent dans le dossier `resources/views`
- Les contrôleurs sont dans `app/Http/Controllers`
- Les modèles sont dans `app/Models`

## Tests

Pour exécuter les tests : php artisan test


## Contribution

Les suggestions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou à soumettre une pull request.

## Licence

Ce projet est sous licence MIT. 
