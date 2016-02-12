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

void youlose()
{
    my_putstr("\033[91m__   __            _                  _ \n");
    my_putstr("\\ \\ / /           | |                | |\n");
    my_putstr(" \\ V /___  _   _  | | ___  ___  ___  | |\n");
    my_putstr("  \\ // _ \\| | | | | |/ _ \\/ __|/ _ \\ | |\n");
    my_putstr("  | | (_) | |_| | | | (_) \\__ \\  __/ |_|\n");
    my_putstr("  \\_/\\___/ \\__,_| |_|\\___/|___/\\___| (_)\033[0m\n");
} 


void youwin() 
{
    my_putstr("\033[32m__   __            _    _ _         _ \n");
    my_putstr("\\ \\ / /           | |  | (_)       | |\n");
    my_putstr(" \\ V /___  _   _  | |  | |_ _ __   | |\n");
    my_putstr("  \\ // _ \\| | | | | |/\\| | | '_ \\  | |\n");
    my_putstr("  | | (_) | |_| | \\  /\\  / | | | | |_|\n");
    my_putstr("  \\_/\\___/ \\__,_|  \\/  \\/|_|_| |_| (_)\033[0m\n");
}


void intro()
{
    my_putstr("\033[1;34m  _                                                                                      \n");
    my_putstr(" / ) _ _)_ _   _  _  _)_   o  _    \n");
    my_putstr("(_/ (_ (_ (_) (_ (_( (_    ( ) )   \n\n");
    my_putstr("\t                    _)_ ( _   _     )   _ ( _        _ o  _  _)_ ( _   \n");
    my_putstr("\t                    (_   ) ) )_)   (__ (_( )_) (_(  )  ( ) ) (_   ) )  \n");
    my_putstr("\t                            (_                   _)                    \033[0m\n");
}

void printocto()
{
    my_putstr("           \033[100m   \033[0m.           .\033[100m   \033[0m \n");
    my_putstr("           \033[100;2m                   \033[0m \n");
    my_putstr("           \033[100m                   \033[0m     \n"); 
    my_putstr("          \033[100m                     \033[0m      \n");
    my_putstr("         \033[100m                       \033[0m     \n");
    my_putstr("        \033[100m                        \033[0m     \n");
    my_putstr("        \033[100m    \033[107m                \033[100m    \033[0m    \n");
    my_putstr("         \033[100m  \033[107m   \033[106m   \033[107m       \033[106m   \033[107m   \033[100m  \033[0m\n");
    my_putstr("       \033[100m     \033[107m  \033[106m   \033[107m   ^   \033[106m   \033[107m  \033[100m     \033[0m\n");
    my_putstr("           \033[100m  \033[107m      \033[95m._.\033[107m      \033[100m  \033[0m.  \n");
    my_putstr("             \033[100m    \033[107m;     ;\033[100m    \033[0m   \n");
    my_putstr("       \033[100m  \033[0m        \033[100m       \033[0m   \n");
    my_putstr("         \033[100m \033[0m+     \033[100m         \033[0m  \n");
    my_putstr("          \033[100m       \033[0m \033[100m  \033[0m \033[100m  \033[0m \033[100m  \033[0m   \n");
    my_putstr("               \033[100m  \033[0m \033[100m  \033[0m \033[100m  \033[0m \033[100m  \033[0m   \n");
    my_putstr("               \033[100m  \033[0m \033[100m  \033[0m \033[100m  \033[0m \033[100m  \033[0m   \n");
    my_putstr("            .\033[46;34m  \033[0m\033[100m  \033[46;34m \033[100m  \033[46;34m \033[100m");
    my_putstr("  \033[0m\033[46;34m \033[100m  \033[0m\033[46;34m   \033[0m  \n");
    my_putstr("         \033[46;34m    \033[100m  \033[0m\033[46;34m: \033[100m  \033[0m\033[46;34m");
    my_putstr("   \033[100m  \033[46;34m  \033[100m  \033[0m\033[46;34m    \033[0m   \n");
    my_putstr("        \033[46;34m                         \033[0m  \n");
    my_putstr("         \033[46;34m                       \033[0m   \n");
    my_putstr("             \033[46;34m:              \033[0m   \n");
}

void introformenu(char *name)
{
    clearScreen();
    my_putstr("\033[34mWelcome \033[0m");
    my_putstr(name);
    my_putstr("\033[34m ! :)\nYou may choose something from the menu\033[0m\n");
}
