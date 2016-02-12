#!/bin/bash

function rules () {
	echo -n "To win this game you have to obtain the number of win you "
	echo -e "will chose after starting a game before the computer does.\n"
	echo -n "Each turn you have to chose a symbole which will be compared "
	echo -e "with a symbole randomly chosen by the computer\n"
	echo -e "The game has only three possible outcomes other than a tie :\n"
	echo "Rock crushes scissors"
	echo "Paper covers rock"
	echo -e "Scissors cut paper\n"

	echo -n "The game in hardcore mode keeps the same rules but with two aditional"
	echo -e " signs and thus seven new possibility other than a tie :\n"
	echo "Lizard eats paper"
	echo "Lizard is crushed by rock"
	echo "Lizard is decapitated by scissors"
	echo "Lizard poisons Spock"
	echo "Spock vaporizes rock"
	echo "Spock smashes scissors"
	echo -e "Spock is disproven by paper\n"
}

function menu_n
{
    echo -e '\033[1;36m         *********'
    echo -e '\033[1;30m     Select your move'
    echo -e '\033[1;36m         1. Rock' 
    echo '          2. Paper'
    echo '          3. Scissors' 
    echo -e '\033[1;30m         w. Withdraw'
    echo -e '\033[1;36m         *********\033[0m'
    echo 
    echo -en "\033[1;32mYour choice: \033[0m"
}

function menu_h
{
    echo -e '\033[1;36m    *********'
    echo -e '\033[1;30m Select your move'
    echo -e '\033[1;36m      1. Rock' 
    echo '       2. Paper'
    echo '     3. Scissors' 
    echo '       4. Lizard' 
    echo '       5. Spock' 
    echo -e '\033[1;30m     w. Withdraw'
    echo -e '\033[1;36m    *********\033[0m'
    echo 
    echo -en "\033[1;32mYour choice: \033[0m"
} 

function gamemenu ()
{
    echo -e '\033[1;36m       ************'
    echo -e '\033[1;30m        ** Menu **'
    echo -e '\033[1;36m   1. Start Normal mode'
    echo -e '\033[1;36m   2. Start Hard mode' 
    echo -e '\033[1;36m 3. Start Multiplayer mode' 
    echo -e '\033[1;36m        4. Rules' 
    echo -e '\033[1;30m        q. Quit'
    echo -e '\033[1;36m      *************\033[0m'
    echo -en "\033[1;32m$> \033[0m"
}
