# Projet Blog

Bienvenue dans le projet blog de Capucine Madoulaud.
## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre machine :

- [PHP](https://www.php.net/) (version 8.1 ou supérieure)
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)

## Téléchargement

1. Clonez le dépôt :

   ```bash
   git clone https://github.com/CapucineWebtech/blogproject.git
   
2. Accédez au répertoire du projet :

    ```bash
    cd BlogProject
    ```

3. Installez les dépendances PHP avec Composer :

    ```bash
    composer install
    ```
4. Copiez le fichier .env.example en le renomment .env

Une fois le .env en place, modifiez-le avec les informations de connexion à votre base de données.

## Lancement

1. Créez la base de données :
 ```bash
  php artisan migrate
 ```
2. Démarrez le serveur Laravel :
```bash
php artisan serve
 ```
Le projet est maintenant accessible à l'adresse http://localhost:8000.

## Info projet
Dans ce projet, le premier utilisateur créé est automatiquement configuré en tant qu'administrateur. Si cet administrateur est supprimé, le prochain compte créé après cette suppression prendra automatiquement le rôle d'administrateur. Si vous souhaitez avoir plusieurs administrateurs, vous pouvez ajuster le code ou définir manuellement les rôles dans la base de données.
