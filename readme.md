# Arcadia

Application conçue dans le cadre de ma formation chez Studi.

Cette application a été conçue pour un zoo.
Cette apllication présente le zoo, permet aux visisteur de laisser des avis et aux utilisateurs de créer et modifier les différents habitats, animaux et services du zoo.

Trois types d'utilisateurs sont définis:

admin: 1 seul compte, à accès au tableau de bord et à le pouvoir de création modfication et suprression habitats, animaux..

employé: avec un role plus restreint modfication des services..

veterinare: peut laisser des avis sur habitats et animaux.

## Installation

Ce projet nécessite php 8.2.12., composer 2.7.1, node v20.11.0 et un serveur local Apache avec [XAMPP](https://www.apachefriends.org/fr/).

Ce projet a été deployé sur Heroku https://arcadia-app-2be7264ec06b.herokuapp.com/

Vous pouvez déployer une copie ce projet sur [heroku](https://dashboard.heroku.com/) en ajoutant les addons Cloudinary, Mailgun et JawsDB Maria.
Il faut également créer une bdd sur MongoDb Atlas.

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
```

### Renseigner une adresse mail qui servira d'envoyer ou recevoir les mails de l'apllication.

```
JOSE_ARCADIA_EMAIL=<mail>
```

### Pour pouvoir charger les images sur l'apllication, créer un compte [Cloudinary](https://cloudinary.com/) et renseigner les variables ci dessous.

```
CLOUDINARY_CLOUD_NAME=<cloud name>
CLOUDINARY_API_KEY=<clé api>
CLOUDINARY_API_SECRET=<secret api>
CLOUDINARY_URL=<clouddinary url>
```

## LAncer localement

Cloner le projet

```bash
  git clone https://github.com/Y-rog/arcadia.git
```

Aller dans le répertoire du projet

```bash
  cd arcadia
```

Installer les dépendances

```bash
  composer require v/lucas/phpdotenv
  composer require mongodb/mongodb
  composer require mailgun/mailgun-php symfony/http-client nyholm/psr7
  composer require cloudinary/cloudinary_php

  npm init
  npm i bootstrap@5.3.3
  npm i bootstrap-icons
  npm install chart.js
```

Lancer le serveur

```bash
  php -S localhost:8000
```

## Authors

- Grégory Fulgueiras

## Documentation

[Documentation](https://linktodocumentation)
