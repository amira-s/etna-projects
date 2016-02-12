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

void    clearScreen()
{
  my_putstr("\033[1;1H\033[2J");
}

void  menu()
{
    my_putstr("\033[1;36m       =^..^=  =^..^=   =^..^=   =^..^=   =^..^=   \033[0m\n\n");
    my_putstr("\t\t\033[1;95m         Menu \033[0m                  \n");
    my_putstr("\t\t                                \n");
    my_putstr("\t\t\033[1;95m  1 \033[0m\033[34m: Casual mode.\033[0m              \n");
    my_putstr("\t\t\033[1;95m  2 \033[0m\033[34m: Hard mode.\033[0m                \n");
    my_putstr("\t\t\033[1;95m  3 \033[0m\033[34m: Octoview mode.\033[0m            \n");
    my_putstr("\t\t\033[1;95m  4 \033[0m\033[34m: Blind mode.\033[0m               \n");
    my_putstr("\t\t\033[1;95m  5 \033[0m\033[34m: Map Editor.  \033[0m              \n");
    my_putstr("\t\t\033[1;95mprev\033[0;34m: to see the maps. \033[0 \n");
    my_putstr("\t\t\033[1;95mrules\033[0;34m: To see the rules.\033[0 \n");
    my_putstr("\t\t\033[1;95m  q \033[0m\033[34m: Leave the game.\033[0m           \n\n");
    my_putstr("\033[1;36m        =^..^=  =^..^=   =^..^=   =^..^=   =^..^=   \033[0m\n\n");
}

void editor_help()
{
    my_putstr("\n");
    my_putstr("\033[1;34m  w \033[0m   : Go forward.\n");
    my_putstr("\033[1;34m  a \033[0m   : Go Left.\n");
    my_putstr("\033[1;34m  s \033[0m   : Go back.\n");
    my_putstr("\033[1;34m  d \033[0m   : Go right.\n");
    my_putstr("\033[1;30m  1 \033[0m   : Mur\n");
    my_putstr("\033[1;37m  2 \033[0m   : Tunel\n");
    my_putstr("\033[1;91m  3 \033[0m   : Griever\n");
    my_putstr("\033[1;92m  4 \033[0m   : Sortie (>= 1)\n");
    my_putstr("\033[1;96m  7 \033[0m   : Teleporter (x0 ou x2)\n");
    my_putstr("\033[1;95m  8 \033[0m   : Octocat (x1)\n");
    my_putstr("\033[1;32m save \033[0m : Save map (it has to be complete).\n");  
    my_putstr("\033[1;34m  q  \033[0m  : Leave editor.\n");
    my_putstr("\n");
}

void	help()
{
    my_putstr("\n");
    my_putstr("\t \033[1;32m w\033[0m \033[1;34m: Go forward.\033[0m\n");
    my_putstr("\t \033[1;32m a\033[0m \033[1;34m: Go Left.\033[0m\n");
    my_putstr("\t \033[1;32m s\033[0m \033[1;34m: Go back.\033[0m\n");
    my_putstr("\t \033[1;32m d\033[0m \033[1;34m: Go right.\033[0m\n");
    my_putstr("\t \033[1;32m q\033[0m \033[1;34m: Leave the game.\033[0m\n");
    my_putstr("\n");
}

void    rules()
{
    my_putstr("\n");
    my_putstr("\033[34;1;4mMode Casu\033[0;34m: Tu te déplace tour par tour.\033[0m\n");
    my_putstr("\033[94mLes murs ne sont pas tes amis\033[0m\n");
    my_putstr("\033[36;1;4mHard Mode\033[0;36m: Tu rentre tous tes déplacements en une fois.\033[0m\n");
    my_putstr("\033[96mRéfléchis bien, ne te trompe pas de chemin.\033[0m\n");
    my_putstr("\033[92;1;4mBlind Mode\033[0;92m: Try and Die\033[0m\n");
    my_putstr("\033[32;1;4mMode Octoview\033[0;32m: Octocat ne voit qu'à 8 cases de distance\033[0m\n");
    my_putstr("\033[34;1;4mMap Editor:\033[0;34m Creez vos maps dans le map editor");
    my_putstr(", il peut egalement servir de paint.\033[0m\n\n");
}

