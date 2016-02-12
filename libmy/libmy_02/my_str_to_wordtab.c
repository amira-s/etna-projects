/*
** my_str_to_wordtab.c for strtowordtab in /home/amira_s/jour07_c/amira_s/my_str_to_wordtab
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Mon Oct  5 11:32:15 2015 AMIRA Syrine
** Last update Mon Oct  5 20:49:58 2015 AMIRA Syrine
*/

#include <stdlib.h>

char	*epur_str(char *str);

int	isalphanum(char c)
{
  if ((c <= 'z' && c >= 'a') || (c <= 'Z' && c >= 'A') ||
      (c <= '9' && c >= '0'))
    return (1);
  else
    return (0);
}

int	count_word(char *str)
{
  int	i;
  int	k;

  i = 0;
  k = 0;
  while (str[i] != '\0')
    {
      while (isalphanum(str[i]))
	i++;
      if (isalphanum(str[i - 1]))
	k++;
      i++;
    }
  return (k);
}

char	**my_str_to_wordtab(char *str)
{
  int	i;
  int	j;
  int	k;
  char	**tab;
  char	*s;

  i = 0;
  j = 0;
  k = 0;
  tab = malloc(count_word(str) * sizeof(char *));
  s = epur_str(str);
  while (s[i] != '\0')
    {
      tab[k] = malloc(256 * sizeof(char));
      while (isalphanum(s[i]))
	tab[k][j++] = s[i++];
	
      k++;
      i++;
      j = 0;
    }
  tab[k] = '\0';
  return (tab);
}
