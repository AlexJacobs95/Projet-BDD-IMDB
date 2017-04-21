#!/bin/bash
python creator.py
mysql -u root -p IMBD < load_data.sql