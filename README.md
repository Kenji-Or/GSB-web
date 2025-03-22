# 🌐 Portail Intranet - GSB   

**Créé par :** Kenji Ogier  
**Date :** 31/12/2024  

## 📌 Description  
Le projet **GSB Intranet** est une plateforme interne développée pour le laboratoire **Galaxy Swiss Bourdin (GSB)**.  
Elle permet aux employés d’accéder à des documents, d’échanger via un forum, de suivre des actualités et événements, et d’optimiser la communication interne.  

## 🚀 Fonctionnalités principales  
✔️ **Gestion des utilisateurs** (rôles : utilisateur, manager, administrateur)  
✔️ **Consultation et gestion de documents** (protocoles médicaux, formations)  
✔️ **Actualités et articles**  
✔️ **Calendrier des événements internes**  
✔️ **Forum de discussion**  
✔️ **Gestion des profils utilisateurs**  
✔️ **Système de contact et assistance**  

## 🛠️ Installation  

### 1️⃣ Prérequis  
Avant d’installer le projet, assure-toi d’avoir :  
- **PHP 8+**, **MySQL** et **Apache/Nginx**  
- **Composer** et **Node.js (avec npm)**  
- **Git** (pour cloner le repo)  

### 2️⃣ Clonage du projet  
```sh
git clone https://github.com/Kenji-Or/GSB-web.git
cd GSB-web
```

### 3️⃣ Installation des dépendances
```sh
composer install
npm install
```

### 4️⃣ Configuration
Renomme le fichier .env.example en .env et configure la base de données et le service smtp :
```sh
DB_HOST=localhost
DB_DATABASE=gsb_intranet
DB_USERNAME=root
DB_PASSWORD=<yourpassword>
SMTP_HOST=<your smtp>
SMTP_PORT=<your port>
SMTP_USER=<your mail>
SMTP_PASSWORD=<your password>
SMTP_SECURE=ssl
```

### 5️⃣ Importation de la base de données
Le fichier de la base de données (gsb_intranet.sql) est inclus dans le repo. Importe-le via :
```sh
mysql -u root -p gsb_intranet < database/gsb_intranet.sql
```

### 6️⃣ Lancer le serveur
```sh
php artisan serve
```
L’application sera disponible sur http://localhost:8000 🎉

---

## Utilisation  
1. Accédez à l'application via votre navigateur à l'adresse suivante :
   http://localhost:8000
2. Connectez-vous avec vos identifiants.  
3. Naviguez dans les différentes sections via la barre de navigation.
