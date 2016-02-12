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

void    *getchoice(char *player)
{
    char  *input;

    input = "";
    while (verif_choice(input) != 1)
    {
        my_putstr("\033[34mChoisissez une option dans le menu.\033[0m\n");
        my_putstr(player);
        my_putstr(" \033[35m$>\033[0m ");
        input = readLine();
        if (my_strcmp("prev", input) == 0)
        {    
            preview();
            menu();        
        }
        else if (my_strcmp("rules", input) == 0)
            rules();
        if (verif_choice(input) != 1)
            free(input);
    }
    return (input);
}

void    *getplayername()
{
    char  *input;

    intro();
    printocto();
    my_putstr("\033[32mVeuillez entrer votre nom.\033[0m\n");
    my_putstr("\033[35m$>\033[0m ");
    input = readLine();
    while (my_strcmp(input, "") == 0 || my_strcmp(input, " ") == 0)
    {
        my_putstr("\033[35mAller, je suis sure que tu as un petit nom. ;)\033[0m\n");
        my_putstr("\033[35m$>\033[0m ");
        input = readLine();
        if (my_strcmp(input, "") == 0 && my_strcmp(input, " ") == 0)
            free(input);
    }
    return (input);
}

void    *get_q(char *player)
{
  char  *input;
  
  input = "";
  while (my_strcmp(input, "n") != 0 && my_strcmp(input, "y") != 0)
  {
      my_putstr("\033[34m-> Voulez vous continuer sur une nouvelle map ?(y/n)\033[0m\n");
      my_putstr(player);
      my_putstr(" \033[35m$>\033[0m ");
      input = readLine();
      if (my_strcmp(input, "n") != 0 && my_strcmp(input, "y") != 0)
        free(input);
  }
  return (input);
}

void    *getplay(char *player)
{
    char  *input;

    my_putstr(player);
    my_putstr("(wasd) \033[35m$>\033[0m ");
    input = readLine();
    while (my_strcmp(input, "w") != 0 && my_strcmp(input, "s") != 0 &&
       my_strcmp(input, "a") != 0 && my_strcmp(input, "d") && my_strcmp(input, "q"))
    {
        if (my_strcmp(input, "help") == 0)
            help();
        else
            my_putstr("\033[91m-> Désolé mais je ne comprend que wasd (->help)\033[0m\n");
        my_putstr(player);
        my_putstr("(wasd) \033[35m$>\033[0m ");
        input = readLine();
        if (my_strcmp(input, "w") != 0 && my_strcmp(input, "s") != 0 &&
         my_strcmp(input, "a") != 0 && my_strcmp(input, "d") && my_strcmp(input, "q"))
            free(input);
    }
    return (input);
}

void    *get_hardplay(char *player)
{
    char  *input;

    my_putstr("\033[36mEntrez une suite de deplacement par exemple: \033[0m");
    my_putstr("\033[36mddsssdddwwwddddssdddssdd\033[0m\n");
    my_putstr("\033[36mAttention ! Vous n'avez droit qu'a un seul essai.\033[0m\n");
    my_putstr("\033[36mBonne chance.\033[0m\n");
    my_putstr(player);
    my_putstr(" : ");
    input = readLine();
    return (input);
}
