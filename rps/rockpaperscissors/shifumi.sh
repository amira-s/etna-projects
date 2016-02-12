#!/bin/bash

function menu
{
	echo "	   *********"
	echo "	Select your move"
    echo "	     1. Rock" 
    echo "	     2. Paper"
    echo "	   3. Scissors" 
    echo "	     q. Quit"
	echo "	   *********"
    echo 
    echo -n "Your choice: "
} 

function getscore ()
{
	SCORE=$2
	OP=$(( ( RANDOM % 3 ) + 1 ))
	echo "Computer's choice: $OP"
	
	result=(["11"]="E" ["12"]="L" ["13"]="W" 
		["21"]="W" ["22"]="E" ["23"]="L" 
		["31"]="L" ["32"]="W" ["33"]="E") ;

	resultaff=(["11"]="Equality !\n" ["12"]="Paper covers rock\nYou lose\n" 
		["13"]="Rock crushes scissors\nYou win\n" 
		["21"]="Paper covers rock\nYou win\n" 
		["22"]="Equality !\n" ["23"]="Scissors cut paper\nYou lose\n" 
		["31"]="Rock crushes scissors\nYou lose\n" 
		["32"]="Scissors cut paper\nYou win\n" ["33"]="Equality !\n") ;

	elem=$1$OP
	if [[  ${result[${elem}]} = "W" ]]; then
		echo -e ${resultaff[${elem}]}
		SCORE=$(( SCORE + 1 ))
	elif [[  ${result[${elem}]} = "L" ]]; then
		echo -e ${resultaff[${elem}]}
	else
		echo -e ${resultaff[${elem}]}
	fi
	return $SCORE
}

function shifumi ()
{
	clear
	SCORE=0
	CHOICE=0
	echo "Ready to play shifumi? Here we go!"
	echo
	while [[ $SCORE < $1 && $CHOICE != q ]]; do
		menu
		read CHOICE
		if [[ $CHOICE = 1 || $CHOICE = 2 || $CHOICE = 3 ]]; then
			getscore $CHOICE $SCORE
			SCORE=$?
			echo "Score: $SCORE"
		elif [[  $CHOICE = q ]]; then
			echo "Thanks for playing ! See you."
		else 
			echo "Error: Please select something from the menu"
		fi
	done
	echo "Congratulations, you won!"
	echo "Goodbye"
}

function main {
	if [[ $# > 1 ]]; then
		echo "shifumi requires no more than one parameter" >&2
	elif [[ $# < 1 ]]; then	
		echo "No parameter" >&2
	elif [[ $1 =~ ^[0-9]+$ && $1 != 0 ]]; then
		shifumi $1
	else 
		echo "You have to enter a positive number as a parameter" >&2
	fi
}
main $@
