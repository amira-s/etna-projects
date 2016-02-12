/*
** asciifun.c for octocat in /home/amira_s/octo/src
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Fri Jan  22 16:23:25 2015 AMIRA Syrine
** Last update Fri Jan  22 16:45:07 2015 AMIRA Syrine
*/


*Octocat Project*
===================

Bonjour a tous!
Nous allons vous présenter le projet Octocat, 
Le projet Octocat est un jeu, un jeu de labyrinthe auquel vous pouvez jouer très simplement avec les maps que nous avons nous même créées OU avec celles que vous voudrez designer. 
Pour la petite histoire, Octocat est le résultat d'une experience scientifique des années 50. Un scientifique fou eu l'idée (folle) de greffer des tentacules sur un chat !


--------------------
Multi-map
------------
Pour te permettre de jouer comme tu l'entend, nous avons fait en sorte que tu puisse choisir la map que tu souhaite parmi celles que nous te proposons ainsi que celles que tu aura crées ! 
####Taille et conformité des maps
La taille des maps est variable (car la map est stockée sous la forme d'un tableau `int **` ), cependant si ta map ne convient pas à notre norme, le programme la considèrera corrompue. (Et il fait très attention)
Voici un exemple d'une map en fichier txt:
```
11111111111111111111
18221122222222211111
12211121111112211111
12111221111122111111
12222211222222222221
11111111111111112111
11111111222223122111
11111111111112221111
11111111111112111111
11111111111114111111
;
```
- 1 = mur
- 2 = tunnel
- 3 = griever
- 4 = sortie (obligatoirement 1 ou plus)
- 7 = Téléporteur (obligatoirement deux ou zéro)
- 8 = Octocat (obligatoirement 1)


Les modes de jeu
-------------

**Mode Casual**

> - Le mode Casual est simple, vous jouez sur différentes map, que vous choisissez et vous vous déplacez case par case en entrant vos déplacement un par un.

**Mode Hard**

> - Dans ce mode, la map est également celle que vous avez choisi et vous devrez entrer tous vos déplacements en une fois.
> Gare aux murs!
###Bonus
-------------
**Mode Octoview**

> - Ici vous ne voyez qu'à 8 cases à la ronde, attention à ne pas rencontrer de mur et ne vous trompez pas de chemin!
> Vous vous déplacez case par case. 

**Blind Mode**

> - Pour pimenter le plaisir de jouer, vous pouvez jouer au mode Blind. 
> Dans ce mode, vous ne voyez.... RIEN! Il vous faudra essayer et perdre (try and die) afin de découvrir le chemin qui vous mènera à la sortie du labyrinthe.
> Vous jouez case par case et rien ne vous indique le sens de la sortie ;)

**Map Editor**

> - Depuis cette fonctionnalité, vous pouvez éditer vous même une map et jouer ensuite dessus.
Pour créer vos maps, vous pouvez utiliser notre interface, il vous suffit de creuser les tunnels de votre labyrinthe et de suivre les instructions en dessous de la map en tapant le chiffre correspondant à la case souhaitée:
	- 1 = mur 
	- 2 = tunnel
	- 3 = griever (rouge)
	- 4 = sortie (vert)
Par exemple!
> - Tu peux sauvegarder ton fichier après avoir choisi un nom pour ton fichier.
> Une fois que le programme aura vérifié la norme de ton labyrinthe, tu pourra le sauvegarder dans le dossier courant.

**Preview**
> - Cette option te permet d'avoir un aperçu des maps que nous avons déjà crées et que tu peux charger pour jouer. 
> Il te suffit de taper `prev` pour faire apparaitre dans le menu.

**Rules**
> - Les règles sont disponibles dans le jeu via la commande `rules` du menu.

**Les Grievers**

> - Les murs ne sont pas les seuls ennemis du jeu, des grievers assoiffés du sang de votre Octocat sont postés un peu partout sur les maps. Soyez vigilants, car si vous ne les voyez pas, sachez qu'eux vous voient!

**Les Téléporteurs**

> - Rassurez vous, le jeu ne vous déteste pas (et nous non plus) et des Téléporteurs vous aideront à rejoindre la sortie, si toutefois vous les trouvez. 


![Bye Bye!](https://raw.githubusercontent.com/lgarron/folderify/master/examples/src/octocat.png)


 
