#!/bin/bash
# Script pour ddl les fichiers depuis le site et les unzip directement 
# et supprime aussi les fichier non nécessaire.
rm -f *.list
FILETODELETE="aka-names.list.gz aka-titles.list.gz alternate-versions.list.gz biographies.list.gz business.list.gz certificates.list.gz color-info.list.gz costume-designers.list.gz crazy-credits.list.gz german-aka-titles.list.gz goofs.list.gz iso-aka-titles.list.gz italians-aka-titles.list.gz keywords.list.gz laserdisc.list.gz literature.list.gz miscellaneous-companies.list.gz miscellaneous.list.gz special-effects-companies.list.gz taglines.list.gz technical.list.gz trivia.list.gz"

wget -r --accept="*.gz" --no-directories --no-host-directories --level 1 ftp://ftp.fu-berlin.de/pub/misc/movies/database/

rm -f $FILETODELETE