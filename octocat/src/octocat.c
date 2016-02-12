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

int print_result(int c)
{
	if (c == 2)
	{
		my_putstr("\033[32mYOU DID IT!!! YOU'RE OUT \\o/\033[0m\n");
		return (1);
	}
	else
	{
		my_putstr("\033[91mPerdu !\033[0m\n");
		return (0);
	}
	return (0);
}

int hardplay(t_map *map, char *s, t_player *player)
{
	int c;
	int i;
	char tmp[2];

	c = 1;
	i = 0;
	while (s[i] != '\0' && c != 0 && c != 2)
	{
		tmp[0] = s[i];
		tmp[1] = '\0';
		c = play(map, tmp, player);
		if (c == 0)
		{
			my_putstr("\033[91mPerdu !\033[0m\n");
			return (0);
		}
		if (c == 2)
		{
			my_putstr("\033[32mWell Player, You're out !\033[0m\n");
			return (1);
		}
		i++;
	}
	return (print_result(c));
}

void *hard(void (pr)(t_map *, t_player *), t_player *player)
{
	char *s;
	int   c;
	char *q;
	t_map *map;

	q = "y";
	map = get_map(getfilename(player));
	if (map == 0)
		return (0);
	init_player(player, *map);
	while (my_strcmp(q, "n") != 0)
	{
		pr_clean(pr, map, player);
		s = get_hardplay(player->name);
		c = hardplay(map, s, player);
	 	q = get_q(player->name);
		if (my_strcmp(q, "y") == 0)
		{
			free(q);
			map = get_map(getfilename(player));
			if (map == 0)
				return (0);
			init_player(player, *map);
		}
	}
	freetab(map);
	return (0);
}

void 	*casu(void (pr)(t_map *, t_player *), t_player *player)
{
	char *s;
	int   c;
	char *q;
	t_map *map;

	c = 1;
	q = "y";
	map = get_map(getfilename(player));
	if (map == 0)
		return (0);
	init_player(player, *map);
	while (c != 0 && my_strcmp(q, "n") != 0) {
			c = minicasu(map, player, &s, pr);	
			if (c == 2) {
			pr_clean(pr, map, player);
			to_win();
		 	q = get_q(player->name);
			if (my_strcmp(q, "y") == 0) {
				map = get_map(getfilename(player));
				if (map == 0)
					return (0);
				init_player(player, *map);
			}
		}
	}
	freetab(map);
	return (0);
}

int		main()
{
	char *input;
	t_player *player;

	player = malloc(sizeof(t_player));
	clearScreen();
	player->name = getplayername();
	introformenu(player->name);
	menu();
	input = getchoice(player->name);
	while (my_strcmp(input, "q") != 0)
	{
		if (my_strcmp(input, "1") == 0)
			casu(print_map, player);
		else if (my_strcmp(input, "2") == 0)
			hard(print_map, player);
		else if (my_strcmp(input, "3") == 0)
			casu(print_octomap, player);
		else if (my_strcmp(input, "4") == 0)
			casu(print_blindmap, player);
		else if (my_strcmp(input, "5") == 0)
			map_editor(player);
		menu();
		input = getchoice(player->name);
	}
	free(player);
	printocto();
	return (0);
}


