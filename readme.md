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


