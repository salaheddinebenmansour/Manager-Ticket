# 🛠️ Ticket Manager

Application web de gestion des tickets et du parc informatique, inspirée de GLPI (Gestionnaire Libre de Parc Informatique).

## 📋 Fonctionnalités

### Gestion des Tickets
- ✅ Création de tickets par les utilisateurs
- ✅ Assignation aux techniciens
- ✅ Suivi des statuts : Nouveau, En cours, Résolu, Difficile, Fermé
- ✅ Notifications automatiques aux managers lors de la résolution
- ✅ **Visibilité différenciée** :
  - **Utilisateur** : Voir uniquement le problème résolu et le temps de résolution
  - **Admin/Technicien** : Voir les notes techniques détaillées + PDF des étapes

### Parc Informatique
- ✅ Inventaire des serveurs Windows, postes, imprimantes, équipements réseau
- ✅ Suivi des logiciels installés sur chaque équipement
- ✅ Description des outils et services sur chaque serveur

### Rapports
- ✅ Rapport d'activité filtrable par période, technicien et statut
- ✅ Statistiques de performance par technicien
- ✅ Temps moyen de résolution

### Gestion des Utilisateurs
- ✅ 4 rôles : Admin, Technicien, Manager, Utilisateur
- ✅ Activation/Désactivation des comptes
- ✅ Système de notifications en temps réel

## 🚀 Installation

### Prérequis
- PHP 8.0+
- MySQL 5.7+ ou MariaDB 10.3+
- Serveur web (Apache, IIS, Nginx)

### Étapes

1. **Extraire le ZIP** dans le dossier racine de votre serveur web (ex: `htdocs/ticket-manager/`)

2. **Créer la base de données** :
   ```bash
   mysql -u root -p < sql/database.sql
   ```
   Ou importer `sql/database.sql` via phpMyAdmin.

3. **Configurer la connexion** :
   Modifier le fichier `config/database.php` avec vos paramètres :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'ticket_manager');
   define('DB_USER', 'root');
   define('DB_PASS', 'votre_mot_de_passe');
   define('BASE_URL', 'http://localhost/ticket-manager/');
   ```

4. **Créer le dossier uploads** (s'il n'existe pas) :
   ```bash
   mkdir uploads
   chmod 777 uploads
   ```

5. **Accéder à l'application** :
   Ouvrez votre navigateur et allez à : `http://localhost/ticket-manager/`

## 🔑 Comptes par défaut

| Utilisateur | Mot de passe | Rôle |
|------------|-------------|------|
| admin | password | Administrateur |
| salah | password | Technicien |
| tech2 | password | Technicienne |
| manager1 | password | Manager |
| user1 | password | Utilisateur |
| user2 | password | Utilisateur |

## 📁 Structure du projet

```
ticket-manager/
├── index.php                 # Page de connexion
├── logout.php                # Déconnexion
├── config/
│   └── database.php          # Configuration BDD + fonctions
├── includes/
│   ├── header.php            # En-tête commun
│   ├── sidebar.php           # Menu latéral
│   └── footer.php            # Pied de page
├── pages/
│   ├── dashboard/
│   │   └── index.php         # Tableau de bord
│   ├── tickets/
│   │   ├── list.php          # Liste des tickets
│   │   ├── create.php        # Créer un ticket
│   │   ├── view.php          # Voir un ticket (détail)
│   │   ├── edit.php          # Modifier un ticket
│   │   └── delete.php        # Supprimer un ticket
│   ├── assets/
│   │   ├── list.php          # Parc informatique
│   │   ├── create.php        # Ajouter un équipement
│   │   ├── view.php          # Détails équipement
│   │   ├── add_software.php  # Ajouter un logiciel
│   │   ├── delete_software.php # Supprimer un logiciel
│   │   └── delete.php        # Supprimer un équipement
│   ├── reports/
│   │   └── activity.php      # Rapport d'activité
│   └── users/
│       ├── list.php          # Liste des utilisateurs
│       ├── create.php        # Créer un utilisateur
│       ├── edit.php          # Modifier un utilisateur
│       └── toggle.php        # Activer/Désactiver
├── assets/
│   ├── css/style.css         # Styles personnalisés
│   └── js/app.js             # Scripts JavaScript
├── uploads/                  # Fichiers uploadés (PDF)
└── sql/
    └── database.sql          # Script de création BDD
```

## 🔒 Sécurité

- Requêtes préparées PDO (protection SQL Injection)
- Échappement des sorties HTML (protection XSS)
- Contrôle d'accès basé sur les rôles
- Hashage des mots de passe (bcrypt)
- Sessions sécurisées

## 📝 Notes importantes

- Les **notes techniques détaillées** et les **PDF de procédures** ne sont visibles que par les administrateurs et techniciens
- Les **utilisateurs** ne voient que : le problème résolu + le temps de résolution
- Les **managers** reçoivent une notification automatique quand un ticket passe en statut "Résolu"
- Le dossier `uploads/` doit avoir les permissions d'écriture pour le serveur web

## 🖥️ Serveurs Windows documentés

L'application inclut déjà des données de démonstration pour les serveurs suivants :
- **SRV-DC-01** : Contrôleur de domaine (AD, DNS, DHCP)
- **SRV-APP-01** : Serveur d'applications (IIS, SQL Server, GLPI)
- **SRV-FILE-01** : Serveur de fichiers
- **SRV-BACKUP-01** : Serveur de sauvegarde Veeam
- **SRV-VPN-01** : Serveur VPN / Accès à distance

## 📄 Licence

Projet développé dans le cadre d'un stage. Libre d'utilisation et de modification.

## 👨‍💻 Développeur

Stage de fin d'études - 3ème année Génie Informatique
Encadrant : Prof. Mohamed GHAILANI
"# Manager-Ticket" 
