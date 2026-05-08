# LibCore - Gestion de Bibliothèque

Application PHP simple pour gérer une bibliothèque avec deux interfaces: administrateur/bibliothécaire et membre.

## Fichiers principaux

- `mainAdmin.php` : menu principal pour le bibliothécaire.
- `mainMember.php` : interface membre.
- `Database/connection.php` : connexion MySQL.
- `src/Entities/` : entités métier.
- `src/Services/Library.php` : logique d'accès à la base.

## Configuration

Créez un fichier `.env` à la racine pour garder les paramètres locaux de base.


## Lancement

1. Démarrez MySQL via XAMPP ou votre environnement local.
2. Vérifiez que la base `library` existe.
3. Lancez l'interface admin:

```bash
php mainAdmin.php
```

4. Lancez l'interface membre:

```bash
php mainMember.php
```
