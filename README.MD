### Installation

- Git clone (Lien git) https://github.com/
- composer update
- npm install
- Verifier le fichier .env faire les modifications si nécessaire (DATABASE_URL)

- php bin/console doctrine:database:create
- php bin/console doctrine:migration:migrate
- php bin/console doctrine:fixture:load

### Lancer le site

- php -S locahost:8000 -t public
- npm run dev-server

### Lancer le server SMTP

- maildev