/*
** my_strstr.c for strstr in /home/amira_s/jour04_C/amira_s
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Thu Oct  1 17:13:33 2015 AMIRA Syrine
** Last update Mon Oct  5 20:35:51 2015 AMIRA Syrine
*/

int	my_strlen(char *str);

int	my_strncmp(char *s1, char *s2, int n);

char	*my_strstr(char *str, char *to_find)
{
  int	i;

  i = 0;
  while (str[i])
    {
      if (my_strncmp(str + i, to_find, my_strlen(to_find)) == 0)
	return (str + i);
      i++;
    }
  return ("null");
}
