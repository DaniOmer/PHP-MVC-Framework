# PHP-MVC-Framework

### Credentials

Crée un fichier .env dans le dossier www en se basant sur .env.example
EMAIL = l'adresse mail à partir duquel vous envoyez les mails de vérification
PASSWORD = Activez la double authentification gmail. Ensuite générez un mot de passe pour application

### Lancement en local

docker compose up -d

### Executer les migrations pour créer les tables

docker exec nom_du_conteneur_php php migrations.php

### Voir la base de données

Aller sur localhost:8080

### Voir le projet

Aller sur localhost:80
