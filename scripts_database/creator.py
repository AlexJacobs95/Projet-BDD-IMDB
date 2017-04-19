
import MySQLdb as mdb
import datetime

talbes = ["Personne", "Oeuvre", "Pays", "Genre", "Langue", "Film", "Serie", "Auteur", "Directeur", "Episode", "Acteur"]

def executeScriptsFromFile(filename, cursor):
    # Open and read the file as a single buffer
    fd = open(filename, 'r')
    sqlFile = fd.read()
    fd.close()

    sqlCommands = sqlFile.split(';')

    # Execute every command from the input file
    i = 0

    global_time = datetime.datetime.now()
    print ("Insertion started.")
    for command in sqlCommands:
        table_time = datetime.datetime.now()
        print ("Filling table "  + talbes[i] + " ...")
        try:
            cursor.execute(command)

        except mdb.Error, e:
            pass
        print ("table " + talbes[i] + "filled in " + str(datetime.datetime.now() - table_time) + "s" )

        i+=1

    print ("Insertion done\nDatabase filled in " + str(datetime.datetime.now() - global_time) + "s")
    size = cursor.execute("SELECT table_schema \"IMBD\", Round(Sum(data_length + index_length) / 1024 / 1024, 1) \"DB Size in MB\" FROM   information_schema.tables GROUP  BY table_schema; ")
    print ("The DB size is " + str(size))



conn = mdb.connect("localhost","root","","")
cur = conn.cursor()
cur.execute("CREATE DATABASE IMBD;")
conn.close();

conn = mdb.connect("localhost","root","","IMBD")
cur = conn.cursor()

executeScriptsFromFile("ddl.sql", cur)
executeScriptsFromFile("load_data.sql", cur)

