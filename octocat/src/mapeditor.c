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

void 	print_colors(int to_p)
{
	if (to_p == 1)
		my_putstr("\033[40m \033[0m");
	else if (to_p == 2)
		my_putstr("\033[107m \033[0m");
	else if (to_p == 7)
		my_putstr("\033[106m \033[0m");
	else if (to_p == 3)
		my_putstr("\033[101m \033[0m");
	else if (to_p == 4)
		my_putstr("\033[42m \033[0m");
	else if (to_p == 8)
		my_putstr("\033[1;107;95m8\033[0m");
	else
		my_putstr("\033[107m\033[0m");
}

void print_editor(t_map *map, t_player *player)
{
	int i;
	int j;

	i = 0;
	j = 0;
	clearScreen();
	my_putstr("\t  \033[1;36m  ------ Map Editor ------- \033[0m\n");
	while (i < map->h + 1)
	{
	    while (j < map->w)
	    {
	    	if (i == player->p_x && j == player->p_y)
	    		print_cursor(map->tab[i][j]);
	    	else
	    		print_colors(map->tab[i][j]);
	    	j++;
	    }
    	my_putstr("\n");
    	i++;
    	j = 0;
	}
}

void move(t_player *player, char *s, t_map *map)
{
	int tmp_x;
	int tmp_y;

	tmp_x = player->p_x;
	tmp_y = player->p_y;
	if (my_strcmp(s, "a") == 0)
	{
		player->p_x = tmp_x;
		player->p_y = tmp_y - 1;
	}
	else if (my_strcmp(s, "w") == 0)
	{
		player->p_x = tmp_x - 1;
		player->p_y = tmp_y;
	}
	else if (my_strcmp(s, "d") == 0)
	{
		player->p_x = tmp_x;
		player->p_y = tmp_y + 1;
	}
	else if (my_strcmp(s, "s") == 0)
	{
		player->p_x = tmp_x + 1;
		player->p_y = tmp_y;
	}
	verif_border(player, map);
}

void *getdraw(char *player, t_map *newmap)
{
	char  *input;

	editor_help();
	my_putstr(player);
	my_putstr(" : ");
	input = readLine();
	while (verifdraw(input) == 0)
	{
		if (my_strcmp(input, "save") == 0)
			checkandsave(newmap);
		else if (my_strcmp(input, "help") == 0)
			help();
		else
			my_putstr("\033[91mMauvaise touche.(type help to get help.)\033[0m\n");
		my_putstr(player);
		my_putstr(" : ");
		input = readLine();
	}
	return (input);
}

int map_editor(t_player *player)
{
	t_map *newmap;
	char *input;

	player->p_x = 0;
	player->p_y = 0;
	newmap = malloc(sizeof(t_map));
	init_map(newmap);
	print_editor(newmap, player);
	input = getdraw(player->name, newmap);
	while (my_strcmp(input, "q") != 0)
	{
		if (my_getnbr(input) != 0)
			newmap->tab[player->p_x][player->p_y] = my_getnbr(input);
		else
			move(player, input, newmap);
		print_editor(newmap, player);
		input = getdraw(player->name, newmap);
	}
	if (my_strcmp("y", ifsave()) == 0)
		checkandsave(newmap);
	else
		return (0);
	free(newmap);
	return (0);
}
