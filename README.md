*Application de Recrutement
Aplication de recrutement ! Cette application facilite le suivi des candidatures, la gestion des offres d'emploic (concours) et le processus de recrutement pour les recruteurs et les candidats.

*Fonctionnalités
-Gestion des Offres d'Emploi : Création, modification et suppression d'offres d'emploi(concour).
-Candidature en Ligne : Les candidats peuvent postuler aux offres directement via l'application.
-Suivi des Candidatures : Les recruteurs peuvent suivre l'évolution des candidatures (nouvelles, en cours, acceptées, rejetées).
-Multi-Authentification : Authentification pour les recruteurs et les candidats.
-Notifications : Envoi de notifications aux candidats et aux recruteurs pour chaque étape du processus de recrutement.

*Technologies Utilisées
-Backend : Laravel
-Frontend : HTML, CSS, JavaScript
-Base de Données : MySQL
-Autres Outils : Composer, npm, phpMyAdmin (pour la gestion de la base de données)

*Installation
-Clonez le dépôt : git clone
-Installez les dépendances backend : composer install.
-Installez les dépendances frontend : npm install && npm run dev.
-Configurez les informations de la base de données dans le fichier .env.
-Exécutez les migrations : php artisan migrate.

*Configuration
-Configurez les paramètres de messagerie pour les notifications dans le fichier .env :
.MAIL_MAILER=smtp
.MAIL_HOST=your_mail_host
.MAIL_PORT=your_mail_port
.MAIL_USERNAME=your_email@example.com
.MAIL_PASSWORD=your_password
.MAIL_ENCRYPTION=tls

*Utilisation
-Démarrez le serveur de développement : php artisan serve
-Accédez à l'application via http://localhost:8000
-Créez deux nouveaux comptes, puis accédez à la table users pour modifier le type de l'un des deux comptes en admin.


