#!/bin/bash

SCORE1=0
SCORE2=0

#function to display result and count score
function do_result_m () {
	if [[  $1 = "W" ]]; then
		echo -e '\n\n\033[1;32m'${@:2}
		SCORE1=$((SCORE1 + 1))
	elif [[  $1 = "L" ]]; then
		echo -e '\n\n\033[1;35m'${@:2}
		SCORE2=$((SCORE2 + 1))
	else
		echo -e '\n\n\033[1;33m'${@:2}
	fi
}

function menu_m
{
    echo -e '\033[1;36m         *********'
    echo -e '\033[1;30m     Select your move'
    echo -e '\033[1;36m         1. Rock' 
    echo '          2. Paper'
    echo '          3. Scissors' 
    echo -e '\033[1;30m         4. Withdraw'
    echo -e '\033[1;36m         *********\033[0m'
    echo 
    echo -e -n "\033[1;32mPlayer1's choice: \033[0m"
}
#function to initialize result tabs and find cases (it's the alternative we found to not use multiple if/elif)
function multi ()
{
	result=(["11"]="E" ["12"]="L" ["13"]="W" 
		["21"]="W" ["22"]="E" ["23"]="L" 
		["31"]="L" ["32"]="W" ["33"]="E") ;

	resultaff=(["11"]="Equality !\n" ["12"]="Paper covers rock\n" 
		["13"]="Rock crushes scissors\n" 
		["21"]="Paper covers rock\n" ["22"]="Equality !\n" 
		["23"]="Scissors cut paper\n" 
		["31"]="Rock crushes scissors\n" 
		["32"]="Scissors cut paper\n" ["33"]="Equality !\n") ;

	elem=$1$2
	do_result_m ${result[${elem}]} ${resultaff[${elem}]}
	do_ascii $1 $2
}
#loop to check input
function check_choice ()
{
	nb=$1
	while [[ $nb != 1 && $nb != 2 && $nb != 3 && $nb != 4 ]]; do
		echo -e "\n\033[31mError: Please select something from the menu\033[0m"
		read -s nb
	done
	return $nb
}
#main loop for the multiplayer mode
function shifumi_multi ()
{
	SCORE1=0
	SCORE2=0
	echo -e '    \033[4;1;5;36mReady to play shifumi? Here we go!\033[0m'
	echo -e -n '\033[1;32mGreen\033[0m player one won, \033[1;35mMagenta\033[0m'
	echo -e ' :player two won, \033[1;33mYellow\033[0m : Tie'
	while [[ ( "$SCORE1" -ne "$1" && "$SCORE2" -ne "$1" ) 
			&& ( $CHOICE1 != 4 && $CHOICE2 != 4 ) ]]; do
		echo -e "\033[1;34m\nPlayer 1's score: $SCORE1\033[0m"
		echo -e "\033[1;34mPlayer 2's score: $SCORE2\033[0m\n"
		menu_m
		read -s CHOICE1
		check_choice $CHOICE1
		CHOICE1=$?
	    echo -e -n "\n\033[1;32mPlayer2's choice: \033[0m"
		read -s CHOICE2
		check_choice $CHOICE2
		CHOICE2=$?
		if [[ $CHOICE1 != 4 && $CHOICE2 != 4 ]]; then
			multi $CHOICE1 $CHOICE2
		fi
	done	
	if [[ $P1SCORE = $1 ]]; then
		echo "Congratulations Player 1, you won!"
	elif [[ $P2SCORE = $1 ]]; then
		echo "Congratulations Player 2, you won!"
	fi
}