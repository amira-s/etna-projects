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

void    freetab(t_map *map)
{
    int i;

    for (i = 0; i < map->h; i++)
        free(map->tab[i]);
    free(map->tab);
    free(map); 
}

void    filltab(int fd, t_map *map)
{
    int k;
    int j;
    int c;
    char tmp[2];

    j = 0;
    k = 0;
    map->tab = malloc(100 * sizeof(int));
    c = read(fd, tmp, 1);
    tmp[1] = '\0';
    while (my_strcmp(tmp, ";") != 0)
    {
        map->tab[k] = malloc(100 * sizeof(int));
        while (my_strcmp(tmp,"\n") != 0 && my_strcmp(tmp, ";") != 0)
        {
            map->tab[k][j++] = my_getnbr(tmp);
            c = read(fd, tmp, 1);
            tmp[1] = '\0';
            map->w = j;
        }
        k++;
        j = 0;
        c = read(fd, tmp, 1);
        tmp[1] = '\0';
    }
    map->h = k - 1;
}

int    check_map(t_map *map)
{
    int i;
    int j;
    int t;
    int s;
    int e;

    t = 0;
    s = 0;
    e = 0;
    for (i = 0; i < map->h + 1; i++)
    {
        for (j = 0; j < map->w; j++)
        {
            if (map->tab[i][j] == 8)
                e++;
            else if (map->tab[i][j] == 4)
                s++;
            else if (map->tab[i][j] == 7)
                t++;
            else if (map->tab[i][j] == 0)
                return (0);
        }
    }
    if (s >= 1 && (t == 2 || t == 0) && e == 1)
        return (1);
    else
        return (0);
}

char    *getfilename(t_player *player)
{
    char *s;

    s = malloc(20 * sizeof(char));
    my_putstr("\033[35mEntrez le nom du fichier a charger.\n");
    my_putstr("Exp: Maps/map1~map8 (See readme to create maps).\033[0m\n");
    my_putstr(player->name);
    my_putstr(" \033[36m$> \033[0m");
    return (readLine());
}

void    *get_map(char *input)
{
    int   fd;
    t_map *map;

    map = malloc(sizeof(t_map));
    fd = open(input, O_RDWR);
    if (fd == -1)
    {
        my_putstr("\033[91m-> Erreur lors du chargement du fichier.\033[0m\n");
        return (0);
    }
    else
        filltab(fd, map);
    if (check_map(map) == 0)
    {
        my_putstr("\033[91m-> La map que vous essayez de charger est corrompue.\033[0m\n");
        return (0);
    }
    else
        return (map);
    return (map);
}
