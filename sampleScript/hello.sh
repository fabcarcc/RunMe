#!/bin/sh
echo "Ciao Mondo!"
RANDOM=$$
exit $(($RANDOM%2))

