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

- Utilisation des Seeders et Factory pour remplir la bdd

- Note bilan afficher uniquement pour le student et ne vois pas les autres note de la classe

- Creation d'une Retro Rapide

- Utilisation des seeders et factory


---

## 💻 Organisation

### 1. GIT

```bash
git clone https://github.com/NaSuRall/Projet-web-2025.git
```
https://github.com/NaSuRall/Projet-web-2025/tree/master
### 2. Trello

https://trello.com/invite/b/67f6c7b7fd189a9eed88d27d/ATTIf52630e22ac3a7ed94702301b9ee3766328E9250/projet-web



---

## 🚧 Fonctionnalités Manquantes

- 🔧 Prise en compte de la note bilan
- 📅 Mise a jour du Kanban avec pusher.js



## Ressenti sur le projet

J'ai trouvé ce projet vraiment très intéressant et passionnant. J’ai rencontré quelques difficultés avec Pusher.js, même si je pense que j’aurais pu en faire davantage.
Malgré cela, je suis assez fier de moi, je trouve que j’ai réussi à faire de belles choses.
Merci encore pour ton aide précieuse, Thibaud !


## Detail de la semaine 

Semaine | Objectifs prévus | Tâches réalisées | Difficultés rencontrées | Solutions / apprentissages
Semaine 1 | - Comprendre le sujet du projet  
            - Mettre en place la BDD  
- Débuter le développement de la rétro
- Initialisation du projet Laravel  
- Création des modèles et des migrations 
- Ajout des premières vues et routes 
- Prise en main de la structure Laravel
Semaine 2 | - Intégration de Pusher.js  - Gestion des colonnes  - Finalisation du projet + README | - Création dynamique des colonnes  - Mise en place de la redirection après création  - Début d'intégration de Pusher.js  - Rédaction du README | Difficultés avec Pusher.js  Un peu de retard sur la fin | Aide de Thibaud  Documentation + adaptation rapide


## 👤 Detail des semaines / Organisation

| Semaine   | detail                                                                                             | 
|-----------|----------------------------------------------------------------------------------------------------|
| Semaine 1 | Comprendre le projet / Mettre en place la bdd / Développement creation groupes (User Story 1 et 2) |
| Semaine 2 | Développement  retros avec kanban test avec Jkanban et Pusher JS   (User Story 3 et 4)             |
