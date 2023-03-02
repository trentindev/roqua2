# roqua2
BTS SIO symfony project
# Forker le projet symfony Roqua

A partir de cette étape, vous allez développer vos propres fonctionnalités et personnaliser le projet. 

Avant de commencer, créer vous un compte mailtrap (procédure présentée en annexe) pour pouvoir simuler l'envoi d'email.

## Procédure du Fork

Pour forker un projet Symfony à partir de GitHub, suivez ces étapes :

### Allez sur la page GitHub du projet Symfony 

```
https://github.com/trentindev/roqua2
```

- Cliquez sur le bouton "Fork" situé en haut à droite de la page.
- Choisissez le compte GitHub sur lequel vous souhaitez forker le projet.
- Attendez que le projet soit copié sur votre compte GitHub.



### Clonez le projet forké sur votre ordinateur 

En utilisant la commande ``git clone``, en veillant à remplacer "nom_utilisateur" par votre nom d'utilisateur GitHub et "nom_projet" par le nom du projet forké :

```
git clone https://github.com/nom_utilisateur/nom_projet.git
```

Naviguez dans le dossier du projet forké en utilisant la commande cd :

```
cd nom_projet
```

### Installez les dépendances du projet en utilisant la commande ``composer install``.



### Editez le fichier ``.env``

Configurez le fichier .env en créant une copie du fichier .env.dist et en le renommant en .env. 

#### Modifiez les paramètres de connexion à la base de données.

```
# DATABASE_URL="mysql://<votreidentifiant>:<Votre mot de passe>@127.0.0.1:3306/<Votre BDD>?serverVersion=<Votre version>"

```



#### Insérez les identifiant pour le mailer

Selon la procédure décrite en annexe

```
###> symfony/mailer ###
MAILER_DSN=smtp://< Vos identifiants >
###< symfony/mailer ###

```

Générez les clés SSH en utilisant la commande :

```
php bin/console secrets:generate-keys
```

### Recréer la base de données

Pour éviter les conflits vous devrez créer une nouvelle base de données ou  bien la recréer et la repeupler.

Supprimez la base de données locale :

```
symfony console doctrine:database:drop --force
```


Et recréez la :

```
symfony console doctrine:database:create
```

Exécutez les migrations précédentes :

```
symfony console doctrine:migrations:migrate
```

#### Rappel 

Quand vous modifierez une ``entity`` par exemple

```
symfony console make:entity User
```

Vous devrez créer une nouvelle migration

```
symfony console make:migration
```

Et l'exécuter.

```
symfony console doctrine:migrations:migrate
```

---------

### Lancez le serveur Symfony en utilisant la commande :

```
symfony server:start
```

Accédez à l'URL [http://localhost:8000](http://localhost:8000/) dans votre navigateur pour voir le site Symfony forké.

Vous pouvez maintenant travailler sur le projet forké, apporter des modifications et soumettre des demandes de fusion (pull requests) au projet original si vous le souhaitez.

