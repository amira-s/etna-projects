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

/* getchoice.c */
int verif_choice(char *input)
{
    if (my_strcmp(input, "1") == 0 || my_strcmp(input, "2") == 0)
        return (1);
    else if (my_strcmp(input, "q") == 0 || my_strcmp(input, "3") == 0) 
        return (1);
    else if (my_strcmp(input, "4") == 0 || my_strcmp(input, "5") == 0)
        return (1);
    else 
        return (0);
}

/* mapeditor: getdraw*/
int verifdraw(char *input)
{
	if (my_strcmp(input, "w") != 0 && my_strcmp(input, "s") != 0 &&
		my_strcmp(input, "a") != 0 && my_strcmp(input, "d") && my_strcmp(input, "q"))
	{
		if (my_strcmp(input, "1") != 0 && my_strcmp(input, "2") != 0 &&
			my_strcmp(input, "7") != 0 && my_strcmp(input, "3") && my_strcmp(input, "4") && my_strcmp(input, "8"))
			return (0);
	}
	return (1);
}

/* mapeditor: move*/
void verif_border(t_player *player, t_map *map)
{
	if (player->p_x < 0)
		player->p_x = 0;
	if (player->p_x > map->h)
		player->p_x = map->h;
	if (player->p_y < 0)
		player->p_y = 0;
	if (player->p_y > map->w - 1)
		player->p_y = map->w - 1;
}

/* mapeditor: mapeditor*/
void init_map(t_map *map)
{
	int i;
	int j;

	i = 0;
	j = 0;
	map->w = 50;
	map->h = 22;
	map->tab = malloc(100 * sizeof(int));
	while (i < map->h + 1)
	{
		map->tab[i] = malloc(100 * sizeof(int));
		while (j < map->w)
		{
			map->tab[i][j] = 1;
			j++;
		}
		j = 0;
		i++;
	}
}

/* mapeditor: printeditor*/
void print_cursor(int to_p)
{
	if (to_p == 1)
		my_putstr("\033[40;97m*\033[0m");
	else if (to_p == 2)
		my_putstr("\033[107;30m*\033[0m");
	else if (to_p == 7)
		my_putstr("\033[106;30m*\033[0m");
	else if (to_p == 3)
		my_putstr("\033[41;30m*\033[0m");
	else if (to_p == 4)
		my_putstr("\033[42;30m*\033[0m");
	else if (to_p == 8)
		my_putstr("\033[107;30m*\033[0m");
}
