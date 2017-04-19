
import mysql.connector
import os

def executeScriptsFromFile(filename, cursor):
    # Open and read the file as a single buffer
    fd = open(filename, 'r')
    sqlFile = fd.read()
    fd.close()

    sqlCommands = sqlFile.split(';')

    # Execute every command from the input file
    for command in sqlCommands:
        try:
            cursor.execute(command)
        except OperationalError, msg:
            print "Command skipped: ", msg



conn = mysql.connector(host="localhost",user="root",password="XXX", database="")
cur = conn.cursor()
cur.execute('CREATE DATABASE IMBD;')
conn.close();

conn = mysql.connector("localhost","root","XXX","IMBD")
cur = conn.cursor()

executeScriptsFromFile("ddl.sql", cur)
executeScriptsFromFile("load_data.sql", cur)

