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

int to_wall()
{
	my_putstr("\033[91mWrong way ! You got yourself stuck in a wall.\033[0m\n");
	youlose();
	sleep(2);
	clearScreen();
	return (0);
}

int to_griever()
{
	my_putstr("\033[91mWrong way ! A griever attacked and killed you.\033[0m\n");
	youlose();
	sleep(2);
	clearScreen();
	return (0);	
}

void to_win()
{
	my_putstr("\033[32mWell Player, You're out !\033[0m\n");
	youwin();
	sleep(1);
	clearScreen();
}
