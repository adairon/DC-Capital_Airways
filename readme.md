on défini l'accès à la bdd dans fichier .env
- id = root
- pw = root
- port (sur MacOs) =  8889

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




