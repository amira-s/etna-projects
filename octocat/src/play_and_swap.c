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

void 	init_player(t_player *player, t_map map)
{
	int i;
	int j;

	i = 0;
	j = 0;
	while (i < map.h)
	{
	    while (j < map.w && map.tab[i][j] != 8)
	    {
	    	if (map.tab[i + 1][j + 1] == 8)
	    	{
	    		player->p_x = i + 1;
	    		player->p_y = j + 1;
	    	}	
	    	j++;
	    }
	    i++;
	    j = 0;
	}
}

int 	my_swap(int *i, int *j) 
{
   	int t;

	if (*j == 1)
		return (to_wall());
	else if (*j == 3)
		return (to_griever());	
	else if (*j == 4)
	{	
		*i = 2;
		return (2);	
	}
	else if (*j == 2)
	{
		t = *i;
		*i = *j;
		*j = t;
		return (1);
	}
	return (0);
}

int 	play_aw(t_map *map, char *s, t_player *player)
{
	int tmp_x;
	int tmp_y;

	tmp_x = player->p_x;
	tmp_y = player->p_y;
	if (my_strcmp(s, "a") == 0)
	{
		player->p_x = tmp_x;
		player->p_y = tmp_y - 1;
		if (map->tab[tmp_x][tmp_y - 1] == 7)
			return (my_swap(&map->tab[tmp_x][tmp_y], find_telep(map, tmp_x, tmp_y - 1, player)));
		else
			return (my_swap(&map->tab[tmp_x][tmp_y], &map->tab[tmp_x][tmp_y - 1]));
	}
	else if (my_strcmp(s, "w") == 0)
	{
		player->p_x = tmp_x - 1;
		player->p_y = tmp_y;
		if (map->tab[tmp_x - 1][tmp_y] == 7)
			return (my_swap(&map->tab[tmp_x][tmp_y], find_telep(map, tmp_x -1, tmp_y, player)));
		else
			return (my_swap(&map->tab[tmp_x][tmp_y], &map->tab[tmp_x - 1][tmp_y]));
	}
	return (0);
}

int 	play_ds(t_map *map, char *s, t_player *player)
{
	int tmp_x;
	int tmp_y;

	tmp_x = player->p_x;
	tmp_y = player->p_y;
	if (my_strcmp(s, "d") == 0)
	{	
		player->p_x = tmp_x;
		player->p_y = tmp_y + 1;
		if (map->tab[tmp_x][tmp_y + 1] == 7)
			return (my_swap(&map->tab[tmp_x][tmp_y], find_telep(map, tmp_x, tmp_y + 1, player)));
		else
			return (my_swap(&map->tab[tmp_x][tmp_y], &map->tab[tmp_x][tmp_y + 1]));
	}
	else if (my_strcmp(s, "s") == 0)
	{
		player->p_x = tmp_x + 1;
		player->p_y = tmp_y;
		if (map->tab[tmp_x + 1][tmp_y] == 7)
			return (my_swap(&map->tab[tmp_x][tmp_y], find_telep(map, tmp_x + 1, tmp_y, player)));
		else
			return (my_swap(&map->tab[tmp_x][tmp_y], &map->tab[tmp_x + 1][tmp_y]));
	}
	return (0);
}

int 	play(t_map *map, char *s, t_player *player)
{
	if (my_strcmp(s, "a") == 0 || my_strcmp(s, "w") == 0)
			return (play_aw(map, s, player));
	else if (my_strcmp(s, "d") == 0 || my_strcmp(s, "s") == 0)
			return (play_ds(map, s, player));
	return (0);
}
