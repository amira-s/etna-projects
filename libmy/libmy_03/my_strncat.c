/*
** my_strncat.c for strncat in /home/amira_s/jour04_C/amira_s
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Thu Oct  1 14:33:31 2015 AMIRA Syrine
** Last update Mon Oct  5 20:46:54 2015 AMIRA Syrine
*/

int	my_strlen(char *str);

char	*my_strncat(char *str1, char *str2, int n)
{
  int	i;
  int	j;

  i = 0;
  j = my_strlen(str1);
  while (i < n)
    str1[j++] = str2[i++];
  str1[j] = '\0';
  return (str1);
}
