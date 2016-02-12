/*
** asciifun.c for octocat in /home/amira_s/octo/src
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Fri Jan  22 16:23:25 2015 AMIRA Syrine
** Last update Fri Jan  22 16:45:07 2015 AMIRA Syrine
*/

#include "my.h"
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>

void	   createfile(int *fd, char *input)
{
    char	   *yn;

    my_putstr("\033[33m-> Le fichier n'existe pas.\nVoulez vous le creer ?(y/n)\033[0m\n> ");
    yn = readLine();
    if (my_strcmp(yn, "y") == 0)
    {
        *fd = open(input, O_WRONLY | O_CREAT, S_IRUSR | S_IWUSR | S_IRGRP | S_IROTH | S_IWGRP | S_IWOTH);
        my_putstr("\033[32mLe fichier a ete cree.\033[0m\n");
    }
}

char	   *getfilenamesave()
{
	char   *input;

	my_putstr("\033[33mEntrez le chemin/nom du fichier de sauvegarde.\033[0m\n> ");
   input = readLine();
   while (my_strlen(input) < 1)
    {
      my_putstr("\033[91m-> Un nom de fichier s'il vous plait.\033[0m\n> ");
      input = readLine();
    }
  return (input);
}

void	   save(t_map *map)
{
    char   *input;
	int	   fd;
	int    i;
	int    j;
	char   p[2];

	input = getfilenamesave();
	if ((fd = open(input, O_WRONLY)) == -1)
		createfile(&fd, input);
	if (fd != -1)
    {
        for (i = 0; i < map->h - 1; i++)
        {
            for (j = 0; j < map->w; j++)
            {
              p[0] = map->tab[i][j] + 48;
              p[1] = '\0';
              write(fd, p, 1);
            }
        write(fd, "\n", 1);
        }
        write(fd, ";", 1);
        my_putstr("\033[32mLa map a bien ete sauvegardée.\033[0m\n");
    }
    close(fd);
}

void    *ifsave()
{
    char  *input;

    my_putstr("\033[33mVoulez vous sauvegarder la map ?(y/n)\033[0\n$> ");
    input = readLine();
    while (my_strcmp(input, "n") != 0 && my_strcmp(input, "y") != 0 )
    {
        my_putstr("\033[91mMauvaise touche.\n");
        my_putstr("Voulez vous sauvegarder la map ?(y/n)\033[0m\n$> ");
        my_putstr("$> ");
        input = readLine();
    }
    return (input);
}


void checkandsave(t_map *newmap)
{
    if (check_map(newmap) == 1)
        save(newmap);
    else
        my_putstr("\033[91m-> La map que vous essayer de sauvegarder est incomplete ou non valide.\033[0m\n");
}
