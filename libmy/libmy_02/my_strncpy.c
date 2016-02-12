/*
** my_strncpy.c for strncpy in /home/amira_s/jour04_C/amira_s
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Thu Oct  1 11:02:23 2015 AMIRA Syrine
** Last update Mon Oct  5 20:35:27 2015 AMIRA Syrine
*/

int	my_strlen(char *str);

char	*my_strncpy(char *dest, char *src, int n)
{
  int	i;

  i = 0;
  while (i < n)
    {
      if (i > my_strlen(src))
	dest[i] = '\0';
      else
	dest[i] = src[i];
      i++;
    }
  return (dest);
}
