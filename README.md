# README - TP DevOps CRUD API

## Démarrage du projet

Ce projet est une petite API CRUD conteneurisée (utilisateurs) avec une base MariaDB et Nginx en reverse proxy.  
L’objectif est de pouvoir lancer l’application facilement et de tester les endpoints.

### 1. Lancer les conteneurs

```bash
docker-compose up -d   # -d est optionnel pour lancer en arrière-plan
```

### 2. Vérifier que l’API est bien en ligne

```bash
curl -s http://localhost:8080/health
```

Ensuite mise à jour de la base 

```bash
docker compose exec app php bin/console make:migration   
```

```bash
docker compose exec app php bin/console doctrine:migrations:migrate -n
```

---

## 📡 Endpoints disponibles

### Lister tous les utilisateurs
```bash
curl -i http://localhost:8080/api/users
```

### Récupérer un utilisateur par UUID
```bash
curl -i http://localhost:8080/api/users/<uuid>
```

### Créer un nouvel utilisateur
```bash
curl -s -X POST http://localhost:8080/api/users \
  -H "Content-Type: application/ld+json" \
  -d '{"fullname":"Remi","studyLevel":"L3","age":21}' | jq
```

### Mettre à jour un utilisateur
```bash
curl -s -X PUT http://localhost:8080/api/users/<uuid> \
  -H "Content-Type: application/json" \
  -d '{"fullname":"Nouveau Nom","studyLevel":"M1","age":23}' | jq
```

### Supprimer un utilisateur
```bash
curl -s -X DELETE http://localhost:8080/api/users/<uuid>
```

---

## 📑 Logs

Les logs sont stockés dans le conteneur à l’emplacement `/var/logs/crud/`.

Pour consulter les derniers logs :

```bash
docker compose exec app tail -n 5 /var/logs/crud/app.log      # Logs applicatifs
docker compose exec app tail -n 5 /var/logs/crud/access.log   # Logs d'accès Nginx
docker compose exec app tail -n 5 /var/logs/crud/error.log    # Logs d'erreur Nginx
```

---

## ✅ Checklist de fonctionnement

- [x] `docker-compose up` lance bien l’app et la DB  
- [x] Endpoint `/health` répond avec un statut OK  
- [x] CRUD utilisateurs fonctionnel (`GET`, `POST`, `PUT`, `DELETE`)  
- [x] Logs disponibles dans le conteneur  
