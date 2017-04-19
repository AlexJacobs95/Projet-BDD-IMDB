
import MySQLdb as mdb
import datetime

talbes = ["Personne", "Oeuvre", "Pays", "Genre", "Langue", "Film", "Serie", "Auteur", "Directeur", "Episode", "Acteur"]

def executeScriptsFromFile(filename, cursor):
    # Open and read the file as a single buffer
    fd = open(filename, 'r')
    sqlFile = fd.read()
    fd.close()

    sqlCommands = sqlFile.strip().split(';')

    # Execute every command from the input file
    i = 0

    global_time = datetime.datetime.now()

    for command in sqlCommands:
        command = command.strip()
        table_time = datetime.datetime.now()

        try:
            cursor.execute(command)

        except mdb.Error, e:
            pass

        i+=1


conn = mdb.connect("localhost","root","!lanA01","")
cur = conn.cursor()
cur.execute("CREATE DATABASE IMBD;")
conn.close();

conn = mdb.connect("localhost","root","!lanA01","IMBD")
cur = conn.cursor()

executeScriptsFromFile("ddl.sql", cur)
executeScriptsFromFile("load_data.sql", cur)

