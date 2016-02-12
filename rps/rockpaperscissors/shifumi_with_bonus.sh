#!/bin/bash

# Bonus: we added a hard mode inspired form the Big bang theory TV show and 
# a multiplayer mode as well as a pretty interface with ascii art, there's also a game menu with an option to dislpay 
# the game rules. We have an overall pretty good error checking system and we also added a score 
# counting system for the computer so that the game seems a bit more fair 
# All this while respecting as much as possible the "norme" restrictions inspite the fact that this is shell scripting...
# Hope you'll enjoy it :) 

source ascii.sh
source ascii2.sh
source shifumi_with_bonus_add.sh
source shifumi_with_bonus_plus.sh
source multiplayermode.sh

#check user's input
function getscore ()
{
	echo -e "Enter the score necessary to win"
	echo -en "\033[1;32m$> \033[0m"
	read  nb
	until [[ ($nb =~ ^[0-9]+$ && $nb != 0) ]]; do
		echo "You have to enter a positive number as a parameter" >&2
		echo -en "\033[1;32m$> \033[0m"
		read nb
	done
	return $nb
}
#main menu
function home ()
{
	echo -e -n "\033cDisclaimer: This shifumi doesn't take parameters "
	echo "and doesn't care if there's any."
	echo -e "\033[1;36m	Welcome to Shifumi"
	MCHOICE=0
	while [[ $MCHOICE != q ]]; do
		gamemenu
		read MCHOICE
		case $MCHOICE in
			1)  getscore
				nb=$?
				shifumi_n $nb
				echo "Want to play again ?" ;;
			2)  getscore
				nb=$?
				shifumi_h $nb
				echo "Want to play again ?" ;;
			3)  getscore
				nb=$?
				shifumi_multi $nb
				echo -e "\nWant to play again ?" ;;
			4) rules ;;
		    q)  echo "Thanks for playing ! See you." ;;
			*)  echo -e "\033[31mError: Please select something from the menu\033[0m" ;;
		esac
	done
}

home