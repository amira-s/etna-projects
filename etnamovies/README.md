Welcome to ETNA_Movies !
===================


Bonjour, ce README va vous aider à utiliser **etna_movies** correctement et en toute simplicité. Le sujet a été respecté entièrement ainsi que la norme. Après avoir installé MongoDB sur nos VMs Debian, nous avons commencé à travailler. Le projet a été découpé en 3 étapes que nous allons expliquer maintenant :

----------


Étape 1
-------------

Pour cette première partie, nous devions nous occuper de l'enregistrement des étudiants et des différentes interactions avec la base de données

> **Commandes disponibles :**

> - `./etna_movies.php add_student login`  permet d'ajouter un étudiant, vous devez ensuite remplir plusieurs informations concernant celui-ci.
> -  `./etna_movies.php del_student login`  permet de supprimer un étudiant. Une confirmation vous sera toute fois demandée.
> -  `./etna_movies.php show_student [login]` permet d'afficher toutes les informations d'un étudiant ou de tout les étudiants si le login n'est pas renseigné.
> - `./etna_movies.php update_student login` permet de mettre a jour les informations de l'étudiant choisi.

Une gestion d'erreur complète est présente, tout les champs doivent donc être rempli proprement.

----------

Étape 2
-------------

Pour la seconde étape, nous avons du parser le fichier csv fourni pour pouvoir remplir la base de données, et ainsi pouvoir interagir avec celle-ci grâce à diverses commandes.

> **Commandes disponibles :**

> - `./etna_movies.php movies_storing [name.csv]`  permet d'ajouter tout les films du fichier name.csv dans le cas où c'est précisé (disponible dans la version bonus uniquement) sinon movies.csv par défaut dans la base de donnée.
> -  `./etna_movies.php show_movies [desc]` permet d'afficher tout les films présents dans la base dans l'ordre alphabétique ou ordre alphabétique inverse lorsque 'desc' est précisé.
> -  `./etna_movies.php show_movies year _xxxx_` permet d'afficher tout les films dont l'année de sortie correspond a xxxx.
> - `./etna_movies.php show_movies genre _xxxx_` permet d'afficher tout les films dont le genre correspond a xxxx, cette option est insensible à la casse.
> - `./etna_movies.php show_movies rate _xxxx_` permet d'afficher les films selon leurs note (doit être un entier entre 0 et 10).

L'affichage des films dépend de l'option choisie. Comme il y a au total 850 films, pour le show_movies [desc] nous avons préféré un affichage simplifié ligne par ligne tandis que lors d'une recherche filtrée nous avons choisi un affichage plus détaillé. Le nombre de films trouvés est toujours affiché à la fin de l'exécution de la commande.

----------

Étape 3
-------------

Pour cette dernière étape, nous devions gérer la location des films par les étudiants. Il était demandé de créer deux clés dans la base, une pour les films loués et une pour les étudiants qui ont loué des films. Le but ici étant de montrer quels films ont été loués et par quels étudiants.

> **Commandes disponibles :**

> - `./etna_movies.php rent_movie login imdb_code` permet de louer un film en spécifiant le login de l'étudiant et le film désiré.
> -  `./etna_movies.php return_movie _login_ _imdb_code_` permet de rendre le film loué.
> -  `./etna_movies.php show_rented_movies` permet d'afficher tout les films loués.

Voilà donc toutes les commandes possibles utilisables dans notre programme, avec (selon nous), une bonne gestion d'erreur. En espérant que celui-ci vous plaira !


Bonus
-------------
Dans la version avec bonus, nous avons procéder a l'amelioration de certaine commande ainsi qu'a l'ajout de quelques autres.

> -  `./etna_movies.php show_rented_movies` permet d'afficher tout les films loués avec la liste des logins des étudiants qui les louent.
> - `./etna_movies.php show_stat` permet d'afficher le top 20 (s'il y en a) des films les plus loués.
	```
	$cursor = $collection->find(array('rented' => array( '$gt' => 0)));
	$cursor = $cursor->sort(array("rented" => -1));
	$cursor = $cursor->limit(20);
	```

> - `./etna_movies.php show_renting_students` permet d'afficher les étudiants qui louent actuellement un film avec la liste des imdb_code des films loués.
> - De plus nous avons decidée d'afficher dans le cas ou il y en a la liste des film que les étudiants loué en ce moment lors de la commande show_student.
