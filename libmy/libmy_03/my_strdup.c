/*
** my_strdup.c for strdup in /home/amira_s/jour07_c/amira_s/my_strdup
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Mon Oct  5 11:19:34 2015 AMIRA Syrine
** Last update Mon Oct  5 20:34:41 2015 AMIRA Syrine
*/

#include <stdlib.h>

int	my_strlen(char *str);

char	*my_strdup(char *str)
{
  int	i;
  char	*nstr;

  nstr = malloc(my_strlen(str) * sizeof(char));
  i = 0;
  while (i < my_strlen(str))
    {
      nstr[i] = str[i];
      i++;
    }
  nstr[i] = '\0';
  return (nstr);
}
