from BaseParser import *


def pretty_print(dico):
    of = open("../SQL_data_files/persons_ok.txt", 'a')
    of_directed_by = open("../SQL_data_files/dirigePar.txt", 'w')

    for key in dico:
        of.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"] + "|" + dico[key]["genre"]+ "\n")
        print(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"])
        for id_oeuvre in dico[key]["oeuvres"]:
            of_directed_by.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"] + "|" + id_oeuvre + "\n")



def test():
    line_index = 752039

    with open("../IMDB_files/directors.list") as f:
        line_counter = 0
        for line in f:
            if line_counter == line_index:
                print(getOeuvreID(line))
                return
            line_counter += 1


def parse(file):
    first_line_index = 234
    genre = "NA"
    directors = {}
    directorID = -1
    current_director = {}
    director_done = False

    with open(file) as f:
        line_counter = 0
        for line in f:
            if line == '-----------------------------------------------------------------------------\n' and line_counter > 100000:
                return directors
            if line_counter > first_line_index:
                if line[0] != " " and line[0] != "\t" and line[0] != "" and line[0] != "\n":
                    # Si on est sur un nouvel acteur

                    directorID += 1
                    if director_done and len(current_director["oeuvres"]) > 0:
                        directors[directorID - 1] = current_director

                    director_done = True
                    director_data = get_nom_prenom(line)
                    current_director = {"ID": directorID,
                                      "nom": director_data[0],
                                      "prenom": director_data[1],
                                      "numero": director_data[2],
                                      "genre": genre,
                                      "oeuvres": [],
                                      }
                    id_oeuvre = getOeuvreID(line)
                    if isBetween2000and2017(id_oeuvre):
                        current_director["oeuvres"].append((id_oeuvre))

                elif line[0] != "\n":
                    # Si on est dans la liste des films dans lesquels un acteur a joue
                    id_oeuvre = getOeuvreID(line)
                    if isBetween2000and2017(id_oeuvre):
                        current_director["oeuvres"].append((id_oeuvre))

            line_counter += 1
    return directors


def main():
    directors = parse("../IMDB_files/directors.list")
    pretty_print(directors)


if __name__ == "__main__":
    main()