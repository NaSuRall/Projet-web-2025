# 🚀 Coding Tool Box User Story 3 🚀

Bienvenue dans **Coding Tool Box**, un outil complet de gestion pédagogique conçu pour la Coding Factory.  
Ce projet Laravel inclut la gestion des groupes, promotions, étudiants, rétro (Kanban), QCM  dynamiques, et bien plus.

---

## 🚧 Fonctionnalités principales

- Création de groupes par promotion (Cergy et Paris) en fonction du nombre d'étudiants, accessible aux enseignants et administrateurs.

- Possibilité de Supprimer tous les groupes d'une promotion (Admin, Teacher)

- Affichage Filtrer pour les groupes et un bar de recherche qui marche pas bien 

- Création de rétrospectives pour toutes les promotions (Cergy et Paris) avec un Kanban unique par rétrospective, et possibilité d’ajouter des cartes (cards).

- Suppression des colonnes (columns) et cartes (cards) possible pour les administrateurs et enseignants.

- Un étudiant peut uniquement supprimer ses propres cartes.

- Intégration de Pusher.js au projet (connexion fonctionnelle, mais non encore opérationnelle pour le Kanban).

- Affichage dynamique des rétrospectives en cours dans la sidebar, ainsi que des promotions et groupes

- Utilisation des Seeders et Factory pour remplire la bdd

---

## 💻 Organisation


### 1. GIT

```bash
git clone https://github.com/NaSuRall/Projet-web-2025.git
```

### 2. Trello

https://trello.com/invite/b/67f6c7b7fd189a9eed88d27d/ATTIf52630e22ac3a7ed94702301b9ee3766328E9250/projet-web



---

## 🚧 Fonctionnalités Manquantes

- 🔧 Creé les groupes en fonction de la note bilan
- 📅 Mise a jour du Kanban avec pusher.js
