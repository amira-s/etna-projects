/*
** epur_str.c for epurstr in /home/amira_s/jour07_c/amira_s/my_str_to_wordtab
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Mon Oct  5 16:10:39 2015 AMIRA Syrine
** Last update Mon Oct  5 20:32:12 2015 AMIRA Syrine
*/

#include <stdlib.h>

int     isalphanum(char c);

int	my_strlen(char *str);

char	*epur_str(char *str)
{
  int	i;
  int	j;
  char	*nstr;

  i = 0;
  j = 0;
  nstr = malloc(my_strlen(str) * sizeof(char));
  while (!isalphanum(str[i]))
    i++;
  while (str[i])
    {
      while (!isalphanum(str[i]) && !isalphanum(str[i + 1]) && str[i] != '\0')
	++i;
      nstr[j] = str[i];
      i++;
      j++;
    }
  nstr[i] = '\0';
  return (nstr);
}
