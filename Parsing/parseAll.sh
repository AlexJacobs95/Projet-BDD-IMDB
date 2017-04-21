#!/bin/bash

rm -r -f ../SQL_data_files
mkdir ../SQL_data_files

echo "Parsing..."

echo "Parsing movies..."
python MovieParser.py 
echo "Parsing movies done."

echo "Parsing actors..."
python ActorParser.py -f
echo "Parsing actors done."

echo "Parsing actresses..."
python ActorParser.py -m
echo "Parsing actresses done."

echo "Parsing writers..."
python WriterParser.py > ../SQL_data_files/auteurs_ok.txt
echo "Parsing writers done."

echo "Parsing directors..."
python DirectorParser.py > ../SQL_data_files/directeurs_ok.txt
echo "Parsing directors done."

echo "Parsing Infos..."
python InfosParser.py
echo "Parsing Infos done."

echo "All parsing done."