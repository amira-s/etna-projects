#!/bin/bash

MYSCORE=0
CPSCORE=0
#=
function do_result () {
	if [[  $1 = "W" ]]; then
		echo -e '\033[1;32m'${@:2}
		MYSCORE=$((MYSCORE + 1))
	elif [[  $1 = "L" ]]; then
		echo -e '\033[1;35m'${@:2}
		CPSCORE=$((CPSCORE + 1))
	else
		echo -e '\033[1;33m'${@:2}
	fi
}
#intialize tables for normal mode (our alternative to avoid multiple elif) call function to calculate score and display ascii art
function normal ()
{
	OP=$(( ( RANDOM % 3 ) + 1 ))
	echo -e "\033[1;35mComputer's choice:\033[0m $OP\n"
	
	result=(["11"]="E" ["12"]="L" ["13"]="W" 
		["21"]="W" ["22"]="E" ["23"]="L" 
		["31"]="L" ["32"]="W" ["33"]="E") ;

	resultaff=(["11"]="Equality !\n" ["12"]="Paper covers rock\nYou lost\n" 
		["13"]="Rock crushes scissors\nYou won\n" 
		["21"]="Paper covers rock\nYou won\n" ["22"]="Equality !\n" 
		["23"]="Scissors cut paper\nYou lost\n" 
		["31"]="Rock crushes scissors\nYou lost\n" 
		["32"]="Scissors cut paper\nYou won\n" ["33"]="Equality !\n") ;

	elem=$1$OP
	do_result ${result[${elem}]} ${resultaff[${elem}]}
	do_ascii $1 $OP
}
#intialize tables for hard mode (our alternative to avoid multiple elif), call function to calculate score and display ascii art
function hard ()
{
	OP=$(( ( RANDOM % 5 ) + 1 ))
	echo -e "\033[1;35mComputer's choice:\033[0m $OP\n"
	
	result=(["11"]="E" ["12"]="L" ["13"]="W" ["14"]="W" ["15"]="L" 
		["21"]="W" ["22"]="E" ["23"]="L" ["24"]="L" ["25"]="W" 
		["31"]="L" ["32"]="W" ["33"]="E" ["34"]="W" ["35"]="L" 
		["41"]="L" ["42"]="W" ["43"]="L" ["44"]="E" ["45"]="W"
		["51"]="W" ["52"]="L" ["53"]="W" ["54"]="L" ["55"]="E") ;

	resultaff=(["11"]="Equality !\n" ["12"]="Paper covers rock\nYou lost\n"
	["13"]="Rock crushes scissors\nYou won\n" ["14"]="Lizard is crushed by rock\nYou won\n"
	["15"]="Spock vaporizes rock\nYou lost\n" ["21"]="Paper covers rock\nYou won\n" 
	["22"]="Equality !\n" ["23"]="Scissors cut paper\nYou lost\n" 
	["24"]="Lizard eats paper\nYou lost\n" ["25"]="Spock is disproven by paper\nYou won\n" 
	["31"]="Rock crushes scissors\nYou lost\n" ["32"]="Scissors cut paper\nYou won\n" 
	["33"]="Equality !\n" ["34"]="Lizard is decapitated by scissors\nYou won\n" 
	["35"]="Spock smashes scissors\nYou lost\n" 
	["41"]="Lizard is crushed by rock\nYou lost\n" ["42"]="Lizard eats paper\nYou won\n" 
	["43"]="Lizard is decapitated by scissors\nYou lost\n" ["44"]="Equality !\n" 
	["45"]="Lizard poisons Spock\nYou won\n" ["51"]="Spock vaporizes rock\nYou won\n" 
	["52"]="Spock is disproven by paper\nYou lost\n" 
	["53"]="Spock smashes scissors\nYou won\n" 
	["54"]="Lizard poisons Spock\nYou lost\n" ["55"]="Equality !\n" ) ;

	elem=$1$OP
	do_result ${result[${elem}]} ${resultaff[${elem}]}
	do_ascii_hard $1 $OP
}
#loop for normal mode
function shifumi_n ()
{
	MYSCORE=0
	CPSCORE=0
	CHOICE=0
	echo -e '    \033[4;1;5;36mReady to play shifumi? Here we go!\033[0m'
	echo -e -n '\033[1;32mGreen\033[0m you won, \033[1;35mMagenta\033[0m : Computer won, '
	echo -e '\033[1;33mYellow\033[0m : Tie'
	while [[ ( "$MYSCORE" -ne "$1" && "$CPSCORE" -ne "$1" ) && $CHOICE != w ]]; do
		menu_n
		read CHOICE
		if [[ $CHOICE = 1 || $CHOICE = 2 || $CHOICE = 3 ]]; then
			normal $CHOICE
			echo -e "\033[1;34m\nYour score: $MYSCORE\033[0m"
			echo -e "\033[1;34mComputer's score: $CPSCORE\033[0m\n"
		elif [[  $CHOICE = w ]]; then
			echo "Computer says: Hah, looser."
		else 
			echo -e "\033[31mError: Please select something from the menu\033[0m"
		fi
	done
	
	if [[ $MYSCORE = $1 ]]; then
		echo "Congratulations, you won!"

	elif [[ $CPSCORE = $1 ]]; then
		echo "Boo! you lost!"
	fi
}
#loop for hard mode
function shifumi_h ()
{
	MYSCORE=0
	CPSCORE=0
	CHOICE=0
	echo -e '    \033[4;1;5;36mReady to play shifumi? Here we go!\033[0m'
	echo -e -n '\033[1;32mGreen\033[0m you won, \033[1;35mMagenta\033[0m : Computer won, '
	echo -e '\033[1;33mYellow\033[0m : Tie'
	while [[ ( "$MYSCORE" -ne "$1" && "$CPSCORE" -ne "$1" ) && $CHOICE != w ]]; do
		menu_h
		read CHOICE
		if [[ $CHOICE = 1 || $CHOICE = 2 || $CHOICE = 3 || $CHOICE = 4 || $CHOICE = 5 ]]; 
			then hard $CHOICE
			echo -e "\033[1;34m\nYour score: $MYSCORE\033[0m"
			echo -e "\033[1;34mComputer's score: $CPSCORE\033[0m\n"
		elif [[  $CHOICE = w ]]; then
			echo "Computer says: Hah, looser."
		else 
			echo -e "\033[31mError: Please select something from the menu\033[0m"
		fi
	done
	
	if [[ $MYSCORE = $1 ]]; then
		echo "Congratulations, you won!"

	elif [[ $CPSCORE = $1 ]]; then
		echo "Boo! you lost!"
	fi
}
