# Snowtricks
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/25c2db74f27b4b258ba2b95ae2ccbe40)](https://app.codacy.com/app/JordanGtl/Snowtricks?utm_source=github.com&utm_medium=referral&utm_content=JordanGtl/Snowtricks&utm_campaign=Badge_Grade_Dashboard)

# Installation

1. Cloner le projet depuis le dépot public
2. Installer les dépendences du projet avec composer "composer install --no-dev --optimize-autoloader"
3. Renommer le fichier ".env.dist" puis saisir 
4. Créer la base de données et renseigner les identifiants concernant votre base de données sur la ligne : DATABASE_URL
5. Appliquer la migration avec la commande "php bin/console doctrine:migration:migrate"
6. Si vous souhaitez utiliser le jeu de demo fournis avec le projet, charger les fixtures avec la commande "php bin/console doctrine:fixtures:load"
