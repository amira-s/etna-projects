/*
** asciifun.c for octocat in /home/amira_s/octo/src
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Fri Jan  22 16:23:25 2015 AMIRA Syrine
** Last update Fri Jan  22 16:45:07 2015 AMIRA Syrine
*/

#ifndef __MY__
# define __MY__

#include <stdlib.h>
#include <unistd.h>
#include "my_struct.h"

void		my_putchar(char c);
int			my_getnbr();
void		my_put_nbr();
void		my_putstr(char *);
int			my_strlen(char *);
int			my_strcmp(char *, char *);
char		*my_strcat(char *, char *);
char		*my_strdup(char *);
char		*readLine();
/*getstuff.c*/
void    	*getchoice(char *);
void    	*getplayername();
void    	*getplay(char *);
void    	*get_hardplay(char *);
void 		*get_q(char *);
/*menu.c*/
void		clearScreen();
void		menu();
void		help();
void    	rules();
void 		editor_help();
/*asciifun*/
void		printocto();
void 		intro();
void 		youwin();
void 		youlose(); 
void 		introformenu(char *);
/*printmap.c*/
void 		print_octomap(t_map *, t_player *);
void 		print_map(t_map *, t_player *);
void 		print_blindmap(t_map *, t_player *);
/*playandswap.c*/
void 		init_player(t_player *, t_map map);
int 		my_swap(int *, int *) ;
int 		play(t_map *, char *s, t_player *);
/*main.c*/
void 		*casu(void (pr)(t_map *, t_player *), t_player *);
void 		*hard(void (pr)(t_map *, t_player *), t_player *);
int 		hardplay(t_map *, char *, t_player *);
/*editor.c*/
int 		map_editor(t_player *);
/*getmap.c*/
void    	freetab(t_map *);
int    		check_map(t_map *);
void    	*get_map(char *input);
char 		*getfilename();
/*preview.c*/
void 		preview();
/*telep.c*/
void		*telep_spot(t_map *, int , int , t_player *);
void 		*find_telep(t_map *, int , int , t_player *);
void		pr_clean(void (pr)(t_map *, t_player *), t_map *, t_player *);
int 		minicasu(t_map *, t_player *, char **s, void (pr)(t_map *, t_player *));
/*savemap.c*/
void		createfile(int *fd, char *input);
char		*getfilenamesave();
void		save(t_map *);
void 		*ifsave();
void 		checkandsave(t_map *);
/*editor_2.c*/
int 		verif_choice(char *);
int 		verifdraw(char *);
void 		verif_border(t_player *, t_map *);
void 		init_map(t_map *);
void 		print_cursor(int);
/*outcome.c*/
int 		to_wall();
int 		to_griever();
void 		to_win();
#endif
