# BluffAndTell

BluffAndTell est un jeu en ligne multijoueur basé sur le storytelling et le bluff. Les joueurs doivent raconter une anecdote autour d’un thème imposé, et identifier l’imposteur qui invente la sienne.

## 🚀 Fonctionnalités principales

- Création et gestion de parties en ligne
- Attribution automatique de rôles et de thèmes
- Vote et résultats dynamiques
- Interface responsive
- Mode administrateur

## 🧑‍💻 Technologies utilisées

- **PHP 8.1+**
- **Symfony**
- **Twig**
- **MySQL**
- **JavaScript**
- **HTML/CSS**

## ⚙️ Installation locale

1. Clone le projet :

```bash
git clone https://github.com/ArthurPaul-io/bluffandtell.git
cd bluffandtell

2. Installe les dépendances PHP et JS dans visual studio code:

composer install
npm install
npm run dev

3. Configure ta base de données :

Crée un fichier .env.local à partir du fichier .env :

bash
Copier
Modifier
cp .env .env.local
Modifie la ligne DATABASE_URL avec tes identifiants.

4. Crée la base et exécute les migrations :

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate



🧠 Restauration de la base de données
Une sauvegarde de la base est disponible dans le dossier db/dump.sql.

Étapes pour restaurer la base de données :

1. Crée une nouvelle base vide (si elle n'existe pas déjà) :

bash
Copier
Modifier
mysql -u root -p -e "CREATE DATABASE bluffandtell"

2. Importe le fichier de dump :

bash
Copier
Modifier
mysql -u root -p bluffandtell < db/dump.sql

3. Vérifie que la base a bien été importée :

bash
Copier
Modifier
mysql -u root -p -e "USE bluffandtell; SHOW TABLES;"





🧩 Extensions Visual Studio Code à installer
Pour travailler efficacement sur ce projet, installe les extensions suivantes dans Visual Studio Code :

1. PHP Intelephense
Fournit la coloration syntaxique, l'autocomplétion et l'analyse statique pour PHP.

2. Symfony Support
Ajoute des fonctionnalités spécifiques à Symfony, comme la reconnaissance des annotations et des fichiers de configuration.

3. Twig Language 2
Fournit la coloration syntaxique et l'autocomplétion pour les fichiers Twig.

4. PHP Namespace Resolver
Aide à gérer les namespaces dans tes fichiers PHP.

5. YAML
Fournit la coloration syntaxique et l'autocomplétion pour les fichiers YAML.

6. Prettier - Code Formatter
Permet de formater automatiquement ton code PHP, Twig, et d'autres fichiers.

7. PHP Debug
Nécessaire pour déboguer ton projet Symfony avec Xdebug.


