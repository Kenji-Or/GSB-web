# Intranet GSB  

**Créé par :** Kenji Ogier  
**Date :** 19/12/2024  

## Description  
L'intranet GSB est une plateforme destinée à faciliter la communication, la gestion documentaire et la coordination entre les collaborateurs du groupe. Ce guide couvre les principales fonctionnalités accessibles selon les droits des utilisateurs : standard, manager ou administrateur.  

---

## Fonctionnalités  

### Fonctionnalités principales :  
- **Authentification sécurisée** : Chaque utilisateur doit se connecter avec un identifiant pour accéder à l'intranet.  
- **Barre de navigation intuitive** : Accédez rapidement à toutes les sections disponibles.  

### En tant qu’utilisateur standard (user) :  
- Accédez aux **documents** (protocoles et formations médicales).  
- Consultez les **actualités et événements** liés au domaine pharmaceutique.  
- Participez aux discussions dans les **forums**.  
- Contactez un administrateur via la page **Contact** en cas de problème.  
- Gérez votre **profil utilisateur** : modifiez vos informations personnelles, consultez les mentions légales, et déconnectez-vous.  

### En tant que manager :  
- Créez et supprimez des **articles**.  
- Créez des **sujets de discussion** dans les forums et gérez vos propres publications.  
- Créez et supprimez des **événements**.  

### En tant qu’administrateur (admin) :  
- Accédez à toutes les fonctionnalités des managers.  
- Créez et supprimez des **documents**.  
- Gérez les **utilisateurs** : création, modification et suppression de comptes.  

---

## Prérequis  
Ajoutez ici les informations concernant les prérequis nécessaires pour utiliser l'application, par exemple :   
- **PHP** : Version 8.0 ou supérieure  
- **Base de données** : MySQL
- **Composer** : Gestionnaire de dépendances PHP  
- **Bibliothèques nécessaires** :  
  - PHPMailer  
  - FullCalendar  
  - Autoload  

---

## Installation  
Ajoutez les étapes pour installer et configurer l'application :  
1. Clonez ce dépôt :  
   ```bash
   git clone <URL_du_dépôt>
2. Installer les dépendance:
   ```bash
   composer install
3. Configurez votre fichier `.env` :  
   - Ajoutez vos paramètres de base de données, SMTP, etc.
    - SMTP_HOST=smtp.mailtrap.io
    - SMTP_PORT=2525
    - SMTP_USER=null
    - SMTP_PASSWORD=null
    - SMTP_SECURE=null
    - DB_HOST=127.0.0.1
    - DB_NAME="gsb"
    - DB_USER="root"
    - DB_PASS="password"
5. Configurez votre base de données :  
   - Créez une nouvelle base de données MySQL.  
   - Ajoutez manuellement les tables nécessaires en vous basant sur les migrations ou sur le fichier `README`.  
6. Lancez les migrations pour initialiser les tables :  
   ```bash
   php artisan migrate
7. Lancez le serveur local :
   php -S localhost:8000

---

## Utilisation  
1. Accédez à l'application via votre navigateur à l'adresse suivante :
   http://localhost:8000
2. Connectez-vous avec vos identifiants.  
3. Naviguez dans les différentes sections via la barre de navigation.
