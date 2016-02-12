##
## asciifun.c for octocat in /home/amira_s/octo/src
## 
## Made by AMIRA Syrine
## Login   <amira_s@etna-alternance.net>
## 
## Started on  Fri Jan  22 12:23:25 2015 AMIRA Syrine
## Last update Fri Jan  22 16:45:07 2015 AMIRA Syrine
##

NAME		=	octocat

SRC 		=	lib/my_putchar.c 		\
				lib/my_putstr.c 		\
				lib/my_put_nbr.c 		\
				lib/my_getnbr.c 		\
				lib/my_strlen.c 		\
				lib/my_strcmp.c 		\
				lib/my_strcat.c 		\
				src/print_map.c 		\
				src/get_input.c 		\
				src/menu.c 				\
				src/readline.c 			\
				src/getmap.c 			\
				src/play_and_swap.c 	\
				src/mapeditor.c 		\
				src/preview.c 			\
				src/telep.c 			\
				src/mapeditor_2.c 		\
				src/savemap.c 			\
				src/asciifun.c      	\
				src/outcome.c 			\
				src/octocat.c

INC_DIR		=	.

OBJ			=	$(SRC:%.c=%.o)

CFLAGS		=   -W -Wall -Werror -pedantic -ansi -Wextra

CC			=	gcc

RM			=	rm -f

all:			$(NAME)

$(NAME):		$(OBJ)
				$(CC) $(CFLAGS) $(SRC) -o $(NAME)

clean:
				$(RM) $(OBJ)

fclean:			clean
				$(RM) $(NAME)

re:				fclean all

.PHONY:			all clean fclean re