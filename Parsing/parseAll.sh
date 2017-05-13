#!/bin/bash

rm -r -f ../SQL_data_files
mkdir ../SQL_data_files

echo "Parsing..."

echo "Parsing actors..."
python ActorParser.py -m
echo "Parsing actors done."

echo "Parsing actresses..."
python ActorParser.py -f
echo "Parsing actresses done."

echo "Parsing movies..."
python MovieParser.py 
echo "Parsing movies done."

echo "Parsing writers..."
python WriterParser.py > ../SQL_data_files/auteurs_ok.txt
echo "Parsing writers done."

echo "Parsing directors..."
python DirectorParser.py > ../SQL_data_files/directeurs_ok.txt
echo "Parsing directors done."

echo "Parsing Infos..."
python InfosParser.py
echo "Parsing Infos done."

echo "Parsing Ratings..."
python RatingParser.py
echo "Parsing ratings done."

echo "Parsing Plots..."
python PlotParser.py
echo "Parsing plots done."

echo "All parsing done."
