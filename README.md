# Snowtricks
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/25c2db74f27b4b258ba2b95ae2ccbe40)](https://app.codacy.com/app/JordanGtl/Snowtricks?utm_source=github.com&utm_medium=referral&utm_content=JordanGtl/Snowtricks&utm_campaign=Badge_Grade_Dashboard)

# Installation (fr)

1. Cloner le projet depuis le dépot public
2. Installer les dépendences du projet avec composer "composer install --no-dev --optimize-autoloader"
3. Renommer le fichier ".env.dist" en ".env" puis modifier les variables d'environnements ( dans une configuration de production, utiliser les variables d'environnements directement dans la configuration du serveur web et supprimer le fichier .env)
4. Créer la base de données.
5. Appliquer la migration avec la commande "php bin/console doctrine:migration:migrate"
6. Si vous souhaitez utiliser le jeu de demo fournis avec le projet, charger les fixtures avec la commande "php bin/console doctrine:fixtures:load"


# Installation (en)

1. Clone the project from the repository
2. Install dependency with composer "composer install --no-dev --optimize-autoloader"
3. Rename file ".env.dist" to ".env", change environement variable in file. (in prod configuration, use environement variable in web server configuration and remove .env)
4. Create your database.
5. Apply migration with command "php bin/console doctrine:migration:migrate"
6. If you want use demo data, you can load fixture with the command  "php bin/console doctrine:fixtures:load"
