import MySQLdb as mdb
import subprocess


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
    conn = mdb.connect("localhost", "root", "", "")
    cur = conn.cursor()
    cur.execute("CREATE DATABASE IMBD;")
    conn.close();


def fillDB():
    # calling bash script
    subprocess.call("fill.sh", shell=True)


if __name__ == '__main__':
    createDB()

    # Create Tables
    conn = mdb.connect("localhost", "root", "", "IMBD")
    cur = conn.cursor()
    executeDDLFromFile("ddl.sql", cur)
    conn.close();

    # Fill Tables
    fillDB()
