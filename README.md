# roqua2
BTS SIO symfony project
# Forker le projet symfony Roqua

A partir de cette étape, vous allez développer vos propres fonctionnalités et personnaliser le projet. 

Avant de commencer, créer vous un compte mailtrap (procédure présentée en annexe) pour pouvoir simuler l'envoi d'email.

## Procédure du clonage

Pour clonage d'un projet Symfony à partir de GitHub, suivez ces étapes :

### Allez sur la page GitHub du projet Symfony 

```
https://github.com/trentindev/roqua2
```
### Clonez le projet forké sur votre ordinateur 

- Cliquez sur le bouton `<> Code` en vert situé en haut à droite.
- Choisissez Clone SSH ou HTTPS selon votre config - copier l'adresse
- Cloner le projet dans votre repertoire local :
 En HTTPS `git clone https://github.com/trentindev/roqua2.git`
 ou
 En SSH `git clone git@github.com:trentindev/roqua2.git`
 
Naviguez dans le dossier du projet cloné en utilisant la commande cd :

```
cd nom_projet
```

### Installez les dépendances du projet en utilisant la commande

 ``composer install``.
  puis les dépendances JS
  ``yarn install``

Faite un premier build du projet
`Yarn build`

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

Pour éviter les conflits vous devrez peut être créer une nouvelle base de données ou  bien la recréer et la repeupler.

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

### Lancez les serveurs 

#### Serveur de dev en utilisant la commande :
```
yarn dev-server
```
#### ServeurSymfony en utilisant la commande :
```
symfony server:start
```
Accédez à l'URL [http://localhost:8000](http://localhost:8000/) dans votre navigateur pour voir le site Symfony forké.

Vous pouvez maintenant travailler sur le projet cloné, apporter des modifications.
N'oubliez pas que git est votre amis...

