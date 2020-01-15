on défini l'accès à la bdd dans fichier .env
- id = root
- pw = root
- port (sur MacOs) =  8889
- ligne 28 : ```DATABASE_URL=mysql://root:root@127.0.0.1:8889/db_capital_airways?serverVersion=5.7```

pr créer bdd : ```bin/console doctrine:database:create```

pr créer les entités :```bin/console make:entity```
entité City :
- champs "Name"

Entité Flight :
- number : numéro de vol
- schedule : horaire
- price
- reduction (boolein)
- seats (nb sièges)
- arrival & departure : relation avec city Many to One

migration : 
```bin/console make:migration```
```bin/console doctrine:migrations:migrate```

installation des fixtures :
- ```composer require --dev orm-fixtures```

utilisation des fixtures (voir fichier AppFixtures.php):
- création d'une fonction pour générer un numéro de vol aléatoire
- création d'un tableau de villes pour alimenter les tables des entités
- on charge les données créées dans les fixtures : ```bin/console doctrine:fixtures:load```
-  pour tester ```git add /bin/console doctrine query

Pour créer le controller Main et la vue qui va avec : 
```bin/console make:controller```
- On le nomme "Main"
- On renomme la route de "/main" en "/" pour arriver directement par défaut sur la vue index
- on passe ensuite tous les vols à la vue via le controller

- Vue index :
- On créé un tableau qui récupère les infos des vols passées par la controlleur

- On créé un controlleur Admin avec la même commande que précédement.

Pour mettre en forme les formulaires, on va dans config/package/twig.yaml
- on ajoute :     ```form_themes: ['bootstrap_4_layout.html.twig']```

# Scénario de l'application Capital Airways
Une page d'accueil publique avec une table qui permet de voir les différents vols de la compagnie à destination de capitales pour une journée.
## J'ai besoin de 2 entités : 
- Entité pour les vols avec comme informatoions :
    - le numéro
    - l'horaire de départ
    - la ville de départ
    - la ville d'arrivée
    - le prix
    - le nombre de places
    - prix promotionnels
    - l'état du vol (Complet ?)
- Entité pour les villes :
    - nom

## Partie publique avec la page d'accueil
    Une table avec les vols
## Partie privée
    Administration des vols :  
    - des formulaires pour 
        - créer un nouveau vol
        - éditer un vol