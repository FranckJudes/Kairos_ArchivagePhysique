# Kairos - STATS
# README

## Prérequis

Avant d'exécuter ce projet Laravel, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [PHP](https://www.php.net/downloads.php) (version 8.2 ou supérieure)
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://dev.mysql.com/downloads/)
- [Laravel](https://laravel.com/docs/)

## Installation

1. **Cloner le projet**
   ```sh
   git clone https://github.com/utilisateur/projet-laravel.git
   cd projet-laravel
   ```

2. **Installer les dépendances PHP**
   ```sh
   composer install
   ```

3. **Configurer l’environnement**
   - Copier le fichier `.env.example` en `.env`
     ```sh
     cp .env.example .env
     ```
   - Modifier les informations de connexion à la base de données dans `.env` :
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nom_de_la_base
     DB_USERNAME=utilisateur
     DB_PASSWORD=mot_de_passe
     ```

4. **Générer la clé d'application**
   ```sh
   php artisan key:generate
   ```

5. **Exécuter les migrations et les seeders** (si disponibles)
   ```sh
   php artisan migrate --seed
   ```


## Lancer l'application

1. **Démarrer le serveur Laravel**
   ```sh
   php artisan serve
   ```
   L'application sera accessible sur `http://127.0.0.1:8000`

2**Accéder à l'application**
   - Ouvrez votre navigateur web et accédez à `http://127.0.0.1:8000`.
   - Identifiiez-vous avec les informations d'identification fournies:
        - username : admin@example.com
        - password : password

## Dépannage

- Vérifiez que MySQL est bien démarré.
- Exécutez `php artisan cache:clear` et `php artisan config:clear` en cas de problème de cache.
- Si une dépendance manque, relancez `composer install`.

## Contributions

Les contributions sont les bienvenues ! Merci de suivre les bonnes pratiques de développement et de soumettre vos Pull Requests avec des descriptions claires.

