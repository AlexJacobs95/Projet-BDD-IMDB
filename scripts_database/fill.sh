#!/bin/bash
python creator.py
mysql -u root -p IMDB < load_data.sql
mysql -u root -p IMDB < indexes.sql