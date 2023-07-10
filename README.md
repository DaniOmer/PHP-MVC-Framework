Projet PHP-MVC-Framework
Ce projet consiste à développer un framework MVC (Modèle-Vue-Contrôleur) en PHP. Le framework fournira une structure et des fonctionnalités de base pour faciliter le développement d'applications web.

Informations liées au projet
Thème du projet
Le thème du projet est "Voyage".

Credentials
Créez un fichier .env dans le dossier "www" en vous basant sur le fichier .env.example fourni.
Configurez l'adresse email à partir de laquelle vous enverrez les mails de vérification en utilisant la variable EMAIL.
Configurez un mot de passe pour l'application en activant la double authentification Gmail et en générant un mot de passe d'application. Ce mot de passe doit être configuré dans la variable PASSWORD.

Lancement en local
Utilisez la commande suivante pour démarrer l'environnement de développement en local : docker compose up -d

Exécution des migrations pour créer les tables
Utilisez la commande suivante pour exécuter les migrations et créer les tables dans la base de données : docker exec nom_du_conteneur_php php migrations.php(Remplacez "nom_du_conteneur_php" par le nom réel du conteneur Docker où votre application PHP s'exécute.)

Accès à la base de données PostgreSQL
Pour accéder à la base de données PostgreSQL, ouvrez votre navigateur et allez sur l'URL suivante : localhost:8080

Accès au projet
Pour accéder à votre projet, ouvrez votre navigateur et allez sur l'URL suivante : localhost:80

Veuillez suivre ces instructions pour configurer et exécuter le projet localement.
