#!/bin/bash

function rock ()
{
  echo "
         _____      
       _/__   '---  
      (_               
     (__            
      (__           
       (______.---  "
}

function spock ()
{
echo "
       _            
      (>\       _   
     (>\ \     /<)  
      \ \ \   / /   
       \ \ \ / /<)  
        \ \ V / /   
       /| '   ' |   
      | |       |   
      |         |  
      \         /   
       |       |    
       |       | "

}

function lizard ()
{
 echo "
              _ _
           .-/ / )
           |/ / /
           /.' /
          // .---.
         /   .--._\ 
        /    '--' /
       /     .---'
      /    .'
          / "
}

function do_ascii_hard ()
{
    case $1 in
        1) rock ;;
        2) paper ;;
        3)  scissors ;;
        4)  lizard ;;
        5)  spock ;;
    esac
    case $2 in
        1) rock ;;
        2) paper ;;
        3)  scissors ;;
        4)  lizard ;;
        5)  spock ;;
    esac
}

function do_ascii ()
{
  if [[ ( $1 = 1 && $2 = 3 )  ||  ( $2 = 1 && $1 = 3 ) ]]; then 
    rock_scissors
  elif [[ ( $1 = 1 && $2 = 2 ) || ( $2 = 1 && $1 = 2 ) ]]; then
    rock_paper
  elif [[ ( $1 = 2 && $2 = 3 ) || ( $2 = 2 && $1 = 3 ) ]]; then
    paper_scissors
  fi
}
