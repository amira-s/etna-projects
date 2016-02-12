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

SRC		=	epur_str.c		\
			my_getnbr.c		\
			my_isneg.c		\
			my_put_nbr.c		\
			my_putchar.c		\
			my_putstr.c		\
			my_str_to_wordtab.c	\
			my_strcat.c		\
			my_strcmp.c		\
			my_strcpy.c		\
			my_strdup.c		\
			my_strlen.c		\
			my_strncat.c		\
			my_strncmp.c		\
			my_strncpy.c		\
			my_strstr.c		\
			my_swap.c

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