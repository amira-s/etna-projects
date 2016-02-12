##
## Makefile for Makefile in /home/amira_s/jour07_c
## 
## Made by AMIRA Syrine
## Login   <amira_s@etna-alternance.net>
## 
## Started on  Mon Oct  5 10:05:07 2015 AMIRA Syrine
## Last update Mon Oct  5 20:23:42 2015 AMIRA Syrine
##

NAME		=	libmy.a

SRC		=	$(wildcard *.c)

INC_DIR		=	.

OBJ		=	$(SRC:.c=.o)

TMP		=	$(SRC:.c=.c~)

CFLAGS		=	-ansi -pedantic -W -Werror -Wall

CC		=	gcc

RM		=	rm -f

all:			$(NAME)

$(NAME):		$(OBJ)
			ar r $(NAME) $(OBJ)
			ranlib $(NAME)
clean:			
			$(RM) $(OBJ)
			$(RM) $(TMP)

fclean:			clean
			$(RM) $(NAME)

re:			fclean all

.PHONY:			all clean fclean re