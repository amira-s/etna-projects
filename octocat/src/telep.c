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

void	*telep_spot(t_map *map, int i, int j, t_player *player)
{
	if (map->tab[i][j - 1] == 2)
	{	
		player->p_x = i;
		player->p_y = j - 1;
		return (&map->tab[i][j - 1]);	
	}
	else if (map->tab[i + 1][j] == 2)
		{
			player->p_x = i + 1;
			player->p_y = j;
			return (&map->tab[i + 1][j]);
		}
	else if (map->tab[i][j + 1] == 2)
		{
			player->p_x = i;
			player->p_y = j + 1;
			return (&map->tab[i][j + 1]);
		}
	else if (map->tab[i - 1][j] == 2)
	{
		player->p_x = i - 1;
		player->p_y = j;
		return (&map->tab[i - 1][j]);
	}
	return (&map->tab[i][j]);
}

void 	*find_telep(t_map *map, int x, int y, t_player *player)
{	
	int i;
	int j;

	i = 0;
	j = 0;
	while (i < map->h)
    {
        while (j < map->w)
        {
        	if (map->tab[i][j] == 7 && (i != x || j != y))
				return (telep_spot(map, i, j, player));
        	j++;
        }
       	i++;
       	j = 0;
    }
    return (0);
}

/**complement pour octocat.c*/


void	pr_clean(void (pr)(t_map *, t_player *), t_map *map, t_player *player)
{
	clearScreen();
	pr(map, player);
}

int 	minicasu(t_map *map, t_player *player, char **s, void (pr)(t_map *, t_player *))
{
	pr_clean(pr, map, player);
	*s = getplay(player->name);
	return (play(map, *s, player));
}
