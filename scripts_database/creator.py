import MySQLdb as mdb


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


def createDB():
    conn = mdb.connect("localhost", "root", "imdb", "")
    cur = conn.cursor()
    cur.execute("CREATE DATABASE IMDB;")
    conn.close();

if __name__ == '__main__':
    createDB()

    # Create Tables
    conn = mdb.connect("localhost", "root", "imdb", "IMDB")
    cur = conn.cursor()
    executeDDLFromFile("ddl.sql", cur)
    conn.close();

