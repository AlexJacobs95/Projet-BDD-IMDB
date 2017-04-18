# coding: latin-1

from BaseParser import *


def pretty_print(dico, name):
    of = open("../SQL_data_files/persons_ok.txt", 'a')
    of_actors = open("../SQL_data_files/acteurs_ok.txt", 'a')

    for key in dico:
        of.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["genre"] + "\n")
        for id_oeuvre, role in dico[key]["oeuvres"]:
            of_actors.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + id_oeuvre + "|" + role + "\n")


def getRole(line):
    if "[" in line and "]" in line:
        return line[line.index("[") + 1:line.index("]")]
    else:
        return "unknown"


def getOeuvreID(line):
    data = line.split("\t")
    for i in range(1, len(data)):
        if data[i] != "":
            long_id = data[i]

            # Remove (uncredited)
            if "(uncredited)" in long_id:
                long_id = long_id.replace("(uncredited)", "")

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
                long_id = long_id.replace(long_id[long_id.find("["):long_id.find("]") + 1], "")
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
                        actors[actorID - 1] = current_actor

                    actor_done = True
                    current_actor = {"ID": actorID,
                                     "nom": get_nom_prenom(line)[0],
                                     "prenom": get_nom_prenom(line)[1],
                                     "genre": genre,
                                     "oeuvres": [],
                                     }
                    if isBetween2000and2010(getOeuvreID(line)):
                        current_actor["oeuvres"].append((getOeuvreID(line), getRole(line)))

                elif line[0] != "\n":
                    # Si on est dans la liste des films dans lesquels un acteur a joue
                    if isBetween2000and2010(getOeuvreID(line)):
                        current_actor["oeuvres"].append((getOeuvreID(line), getRole(line)))

            line_counter += 1
    return actors


def main():
    actors = parse("../IMDB_files/actors.list")
    #actresses = parse("../IMDB_files/actresses.list")
    pretty_print(actors, "ACTORS")


if __name__ == '__main__':
    main()
