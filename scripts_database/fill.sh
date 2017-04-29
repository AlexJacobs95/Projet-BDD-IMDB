#!/bin/bash
python creator.py
cat load_data.sql indexes.sql | mysql -u root -p IMDB
