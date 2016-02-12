/*
** my_strcpy.c for strcpy in /home/amira_s/jour04_C/amira_s
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Thu Oct  1 10:35:20 2015 AMIRA Syrine
** Last update Mon Oct  5 20:34:26 2015 AMIRA Syrine
*/

int	my_strlen(char *str);

char	*my_strcpy(char *dest, char *src)
{
  int	i;

  i = 0;
  while (i < my_strlen(src))
    {
      dest[i] = src[i];
      i++;
    }
  dest[i] = '\0';
  return (dest);
}
