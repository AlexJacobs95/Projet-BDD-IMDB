# coding: latin-1

import sys
from BaseParser import *


def pretty_print(dico, name):
    of = open("../SQL_data_files/persons_ok.txt", 'a')
    of_roles = open("../SQL_data_files/roles.txt", 'a')
    of_actors = open("../SQL_data_files/acteurs_ok.txt", 'a')

    for key in dico:
        of.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"] + "|" + dico[key]["genre"] + "\n")
        of_actors.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"] +"\n")
        for id_oeuvre, role in dico[key]["oeuvres"]:
            of_roles.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key][
                "numero"] + "|" + id_oeuvre + "|" + role + "\n")

    of.close()
    of_actors.close()
    of_roles.close()


def getRole(line):
    role = ""
    if "[" in line and "]" in line:
        role += line[line.rindex("[") + 1:line.rindex("]")]


    data = line.split("\t")
    for i in range(1, len(data)):
        if data[i] != "":
            long_id = data[i]

            # Add (uncredited)
            if " (uncredited)" in long_id:
                role += " (uncredited)"
            # Add (credit only)
            if " (credit only)" in long_id:
                role += " (credit conly)"
            # Add (archive footage)
            if "(archive footage)" in long_id:
                role += " (archive footage)"

            # Add (as...)
            if " (as " in long_id:
                index = long_id.index(" (as ")
                to_add = ""
                for i in range(index, len(long_id)):
                    to_add += long_id[i]
                    if long_id[i] == ")":
                        break
                role += to_add

            # Add (also as...)
            also_as_to_add = " (also as " in long_id
            _index = 0
            while also_as_to_add:
                index = long_id.index(" (also as ", _index, len(long_id))
                to_add = ""
                for i in range(index, len(long_id)):
                    to_add += long_id[i]
                    if long_id[i] == ")":
                        _index = i
                        break
                role += to_add
                also_as_to_add = "(also as " in long_id[_index:]

            # Add (voice...)
            if " (voice" in long_id:
                index = long_id.index(" (voice")
                to_add = ""
                for i in range(index, len(long_id)):
                    to_add += long_id[i]
                    if long_id[i] == ")":
                        break
                role += to_add

    return role.strip() if role != "" else "unknown"


def getOeuvreID(line):
    data = line.split("\t")
    for i in range(1, len(data)):
        if data[i] != "":
            long_id = data[i]

            # Remove (uncredited)
            if "(uncredited)" in long_id:
                long_id = long_id.replace("(uncredited)", "")

            if "(credit only)" in long_id:
                long_id = long_id.replace("(credit only)", "")

            # Remove (archive footage)
            if "(archive footage)" in long_id:
                long_id = long_id.replace("(archive footage)", "")

            # Remove (as...)
            if "(as " in long_id:
                index = long_id.index("(as ")
                to_remove = ""
                for i in range(index, len(long_id)):
                    to_remove += long_id[i]
                    if long_id[i] == ")":
                        if long_id[i + 1] == " ":
                            to_remove += " "
                        break
                long_id = long_id.replace(to_remove, "")

            # Remove (also as...)
            also_as_to_delete = "(also as " in long_id
            while also_as_to_delete:
                index = long_id.index("(also as ")
                to_remove = ""
                for i in range(index, len(long_id)):
                    to_remove += long_id[i]
                    if long_id[i] == ")":
                        if long_id[i + 1] == " ":
                            to_remove += " "
                        break
                long_id = long_id.replace(to_remove, "")
                also_as_to_delete = "(also as " in long_id

            # Remove (voice...)
            if "(voice" in long_id:
                index = long_id.index("(voice")
                to_remove = ""
                for i in range(index, len(long_id)):
                    to_remove += long_id[i]
                    if long_id[i] == ")":
                        if long_id[i + 1] == " ":
                            to_remove += " "
                        break
                long_id = long_id.replace(to_remove, "")

            # Remove role and credit position
            if "[" in long_id:
                long_id = long_id.replace(long_id[long_id.rfind("["):long_id.rfind("]") + 1], "")
            if "<" in long_id:
                long_id = long_id.replace(long_id[long_id.find("<"):long_id.find(">") + 1], "")

            return long_id.strip()


def test():
    line_index = 1082

    with open("../IMDB_files/actors.list") as f:
        line_counter = 0
        for line in f:
            if line_counter == line_index:
                print(line.split("\t"))
                return
            line_counter += 1


def parse(file):
    of = open("../SQL_data_files/persons_ok.txt", 'a')
    of_roles = open("../SQL_data_files/roles.txt", 'a')
    of_actors = open("../SQL_data_files/acteurs_ok.txt", 'a')
    first_line_index = 239
    genre = 'm' if file == "../IMDB_files/actors.list" else 'f'

    actors = {}
    actorID = -1
    current_actorID = -1
    current_actor = {}
    actor_done = False

    with open(file) as f:
        line_counter = 0
        for line in f:
            if line == '-----------------------------------------------------------------------------\n' and line_counter > 10000:
                return actors
            if line_counter > first_line_index:
                if line[0] != " " and line[0] != "\t" and line[0] != "" and line[0] != "\n":
                    # Si on est sur un nouvel acteur

                    actorID += 1
                    if actor_done and len(current_actor["oeuvres"]) > 0:
                        of.write(current_actor["prenom"] + "|" + current_actor["nom"] + "|" + current_actor["numero"] + "|" + current_actor["genre"] + "\n")
                        of_actors.write(current_actor["prenom"] + "|" + current_actor["nom"] + "|" + current_actor["numero"] +"\n")
                        for id_oeuvre, role in current_actor["oeuvres"]:
                            of_roles.write(current_actor["prenom"] + "|" + current_actor["nom"] + "|" + current_actor[
                            "numero"] + "|" + id_oeuvre + "|" + role + "\n")


                    actor_done = True
                    actor_data = get_nom_prenom(line)
                    current_actor = {"ID": actorID,
                                     "nom": actor_data[0],
                                     "prenom": actor_data[1],
                                     "numero": actor_data[2],
                                     "genre": genre,
                                     "oeuvres": [],
                                     }
                    id_oeuvre = getOeuvreID(line)
                    if isBetween2000and2017(id_oeuvre):
                        current_actor["oeuvres"].append((id_oeuvre, getRole(line)))

                elif line[0] != "\n":
                    # Si on est dans la liste des films dans lesquels un acteur a joue
                    id_oeuvre = getOeuvreID(line)
                    if isBetween2000and2017(id_oeuvre):
                        current_actor["oeuvres"].append((id_oeuvre, getRole(line)))

            line_counter += 1
    return actors


def main():
    if sys.argv[1] == "-f":
        data = parse("../IMDB_files/actresses.list")

    elif sys.argv[1] == "-m":
        data = parse("../IMDB_files/actors.list")

    else:
        print ("Wrong arguments ! -f for actresses or -m for actors !!!")
        return

    #pretty_print(data, "ACTORS")


if __name__ == '__main__':
    main()
