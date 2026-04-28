# 📦 SmartLogistics – Analyse Fonctionnelle

## 1. Rôle de l’application web (MySQL)

L’application web est l’outil central utilisé par les gestionnaires de flotte, dispatchers et administrateurs. Elle permet de :

- Gérer les entités métier (conducteurs, véhicules, clients, commandes, livraisons)
- Suivre les livraisons en temps réel (statut, position, retard estimé)
- Déclencher des alertes automatiques (email, SMS, notification web)
- Visualiser des KPIs pour l’optimisation des tournées
- Recevoir des prédictions de retard (issues du Data Warehouse)

### 📊 Base de données MySQL : Tables principales

| Table | Contenu |
|------|--------|
| conducteurs | id, nom, prénom, téléphone, disponibilité, zone affectée |
| vehicules | id, immatriculation, type, capacité, consommation, dernière maintenance |
| clients | id, nom, adresse, coordonnées GPS, coefficient d’importance |
| commandes | id_client, contenu, poids, volume, date_creation, urgence |
| livraisons | id_commande, id_conducteur, id_vehicule, date_prevue, date_reelle, statut, geolocalisation, retard_estime |
| alertes | id_livraison, type_alerte, message, date_envoi, lu |
| tournees | id, date, conducteur_id, optimisation_appliquee |
| evenements_trajets | id_livraison, timestamp, position GPS, vitesse, etape |

👉 L’application écrit en temps réel dans :
- `livraisons`
- `alertes`
- `evenements_trajets`

👉 Les prédictions sont lues depuis le Data Warehouse.

---

## 2. Sources de données (CSV, JSON, TXT, XLSX)

Ces fichiers servent à alimenter le Data Warehouse (historique + analytique).

### 📄 2.1 CSV
- Historique des livraisons (3 ans)
- Données carburant
- Correspondance zones géographiques

### 🔗 2.2 JSON
- Données API trafic (Google Maps, TomTom)
- Capteurs IoT véhicules
- Préférences clients

### 📝 2.3 TXT
- Logs serveur
- Notes conducteurs
- Données capteurs simples

### 📊 2.4 XLSX (Excel)
- Planning conducteurs
- Coûts maintenance
- Reporting mensuel
- Zones personnalisées

---

## 3. Fonctionnalités de l’application

### 🚚 Module 1 – Gestion des commandes
- CRUD commandes
- Association client + contenu
- Calcul fenêtre de livraison

### 👥 Module 2 – Gestion des ressources
- CRUD conducteurs / véhicules
- Assignation véhicule
- Gestion indisponibilités

### 🗺️ Module 3 – Planification
- Planification tournées
- Import CSV/Excel
- Visualisation carte

### 📡 Module 4 – Suivi temps réel
- Dashboard livraisons
- Carte dynamique GPS
- Indicateur retard

### ⚠️ Module 5 – Alertes
- Retard > 15 min
- Déviation > 500 m
- Immobilisation > 10 min
- Notifications (Email / SMS / Web)

### 🤖 Module 6 – Prédiction
- Score de risque
- Suggestion réaffectation
- Historique prédiction vs réel

### 📈 Module 7 – Reporting
- KPIs (taux, km, conso)
- Export CSV/Excel
- Statistiques avancées

---

## 4. Schéma des flux

```
[CSV/JSON/TXT/XLSX] → ETL → Data Warehouse
                             ↓
                      Modèles prédictifs
                             ↓
MySQL ← API ← Application Web
   ↓
Alertes → Dashboard
```
