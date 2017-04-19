#!/bin/bash

#create db and tables
python creator.py

#fill tables
pv load_data.sql | mysql -u root -p IMBD 