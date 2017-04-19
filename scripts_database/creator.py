import MySQLdb as mdb

talbes = ["Personne", "Oeuvre", "Pays", "Genre", "Langue", "Film", "Serie", "Auteur", "Directeur", "Episode", "Acteur"]


def executeDDLFromFile(filename, cursor):
    # Open and read the file as a single buffer
    fd = open(filename, 'r')
    sqlFile = fd.read()
    fd.close()

    sqlCommands = sqlFile.split(';')

    # Execute every command from the input file

    print ("Table creation started.")
    for command in sqlCommands:
        try:
            cursor.execute(command)

        except mdb.Error, e:
            pass

    print("Table creation Done.")


conn = mdb.connect("localhost", "root", "", "")
cur = conn.cursor()
cur.execute("CREATE DATABASE IMBD;")
conn.close();

conn = mdb.connect("localhost", "root", "", "IMBD")
cur = conn.cursor()
executeDDLFromFile("ddl.sql", cur)

conn.close();
