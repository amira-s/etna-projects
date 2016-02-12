/*
** my_swap.c for swap in /home/amira_s/libmy
** 
** Made by AMIRA Syrine
** Login   <amira_s@etna-alternance.net>
** 
** Started on  Mon Oct  5 10:02:08 2015 AMIRA Syrine
** Last update Mon Oct  5 20:38:06 2015 AMIRA Syrine
*/

void	my_swap(int *a, int *b)
{
  int	c;

  c = *a;
  *a = *b;
  *b = c;
}
