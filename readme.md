# Arcadia

Application conçue dans le cadre de ma formation chez Studi.

Cette application a été conçue pour un zoo.

Cette apllication présente le zoo, permet aux visisteur de laisser des avis et aux utilisateurs de créer et modifier les différents habitats, animaux et services du zoo.

Ce projet a été deployé sur Heroku https://arcadia-app-2be7264ec06b.herokuapp.com/

Trois types d'utilisateurs sont définis:

admin: 1 seul compte, à accès au tableau de bord et à le pouvoir de création modfication et suprression habitats, animaux..

employé: avec un role plus restreint modfication des services..

veterinare: peut laisser des avis sur habitats et animaux.

## Pré-requis

Ce projet nécessite php 8.2.12., composer 2.7.1, node v20.11.0 et un serveur local Apache avec [XAMPP](https://www.apachefriends.org/fr/).

Pour ce projet il faut un compte [Cloudinary](https://cloudinary.com/) et [Mailgun](https://www.mailgun.com/).

Pour Mailgun penser à ajouter les destinataires des mails si vous optez pour la version de base. Pour éviter cela vous pouvez ajouter un domaine.

Ce projet nécessite également MongoDB et MongoDB Compass.

Un système de gestion de bases de données relationnelles, phpMyAdmin ou HeidiSQL.

## Variables d'environnement

Pour lancer ce projet vous avez besoin d'ajouter les variables d'environnemnt dans un fichier .env

### Config base de données MariadDb ou MySQL développement en local

```

DB_NAME= <nom de la bdd>

DB_USER= <utilisateur de la bdd>

DB_PASSWORD= <mot de passe de la bdd>

DB_PORT= <port>

DB_HOST='localhost'

```

### Config base de données MongoDB développement en local

```

MONGODB_URI ='mongodb://localhost:27017/'

```

### Pour envoyer et recevoir des mails depuis [Mailgun](https://www.mailgun.com/), créer un compte sur Mailgun et renseigner les informations ci-dessous

```

MAILGUN_API_KEY=<clé api>

MAILGUN_DOMAIN=<nom de domaine mailgun>

MAILGUN_COUNTRY ="https://api.mailgun.net"

```

### Renseigner une adresse mail qui servira d'envoyer ou recevoir les mails de l'apllication.

```

JOSE_ARCADIA_EMAIL=<mail>

```

### Pour pouvoir charger les images sur l'application, créer un compte [Cloudinary](https://cloudinary.com/) et renseigner les variables ci dessous.

```

CLOUDINARY_CLOUD_NAME=<cloud name>

CLOUDINARY_API_KEY=<clé api>

CLOUDINARY_API_SECRET=<secret api>

CLOUDINARY_URL=<clouddinary url>

MAILGUN_COUNTRY ="https://api.mailgun.net"

```

## Lancer localement

Cloner le projet

```bash

git  clone  https://github.com/Y-rog/arcadia.git

```

Aller dans le répertoire du projet

```bash

cd  arcadia

```

Installer les dépendances

```bash

composer  require  vlucas/phpdotenv

composer  require  mongodb/mongodb

composer  require  mailgun/mailgun-php  symfony/http-client  nyholm/psr7

composer  require  cloudinary/cloudinary_php



npm  i  bootstrap@5.3.3

npm  i  bootstrap-icons

npm  install  chart.js

```

Ensuite 2 solutions:

1.  Vous voulez utiliser des tables avec des données:
    Créer votre bdd Maria DB en local et importer le fichier bdd-arcadia-maria-db.sql disponible dans le dossier "bdd".
    Sur mongoDB Compass créer une bdd "arcadia" et une collection "animal" puis ajouter les données importer le fichier arcadia.animal.json.
    Puis une fois l'application lancé modifier les images des habitats et animaux sur l'application (en utilisant le compte admin) pour que les images se transfère sur votre compte Cloudinary. ( Vous pouvez charger celle disponible dans le dossier "uploads").
2.  Vous préférez démarrer un projet vierge:
    Créer sa bdd Maria DB en local et importer le fichier bdd-aracadia-maria-db-void.sql disponible dans le dossier "bdd".
    Créer dans MongoDB compass une bdd "arcadia" et une collection "animal".

```bash

php  -S  localhost:8000

```

Lancer le serveur

```bash

php  -S  localhost:8000

```

Lancer le serveur

```bash

php  -S  localhost:8000

```

## Authors

- Grégory Fulgueiras
