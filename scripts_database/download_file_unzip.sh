#!/bin/bash
# Script pour ddl les fichiers depuis le site et les unzip directement 
# et supprime aussi les fichier non nécessaire.
rm -f ../IMDB_files/*
FILETODELETE=" quotes.list.gz cinematographers.list.gz complete-cast.list.gz complete-crew.list.gz composers.list.gz distributors.list.gz editors.list.gz italian-aka-titles.list.gz locations.list.gz movie-links.list.gz mpaa-ratings-reasons.list.gz producers.list.gz production-companies.list.gz production-designers.list.gz release-dates.list.gz running-times.list.gz sound-mix.list.gz soundtracks.list.gz aka-names.list.gz aka-titles.list.gz alternate-versions.list.gz biographies.list.gz business.list.gz certificates.list.gz color-info.list.gz costume-designers.list.gz crazy-credits.list.gz german-aka-titles.list.gz goofs.list.gz iso-aka-titles.list.gz italians-aka-titles.list.gz keywords.list.gz laserdisc.list.gz literature.list.gz miscellaneous-companies.list.gz miscellaneous.list.gz special-effects-companies.list.gz taglines.list.gz technical.list.gz trivia.list.gz"
wget -r --accept="*.gz" --no-directories --no-host-directories --level 1 ftp://ftp.fu-berlin.de/pub/misc/movies/database/

rm -f $FILETODELETE
gunzip *.gz
mv *.list ../IMDB_files