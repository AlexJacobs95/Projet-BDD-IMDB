from BaseParser import *


def pretty_print(dico):
    of = open("../SQL_data_files/persons_ok.txt", 'a')
    of_ecrit_par = open("../SQL_data_files/ecritPar.txt", 'w')
    of_auteurs = open("../SQL_data_files/auteurs_ok.txt", 'w')
    for key in dico:
        of.write(
            dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"] + "|" + dico[key]["genre"] + "\n")
        of_auteurs.write(dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"] + "|" + "\n")

        for id_oeuvre in dico[key]["oeuvres"]:
            of_ecrit_par.write(
                dico[key]["prenom"] + "|" + dico[key]["nom"] + "|" + dico[key]["numero"] + "|" + id_oeuvre + "\n")
    of.close()
    of_ecrit_par.close()


def test():
    line_index = 752039

    with open("../IMDB_files/writers.list") as f:
        line_counter = 0
        for line in f:
            if line_counter == line_index:
                print(writer_data)
                return
            line_counter += 1


def parse(file):
    first_line_index = 302
    genre = 'NA'
    writers = {}
    writerID = -1
    current_writer = {}
    writer_done = False

    with open(file) as f:
        line_counter = 0
        for line in f:
            if line == '---------------------------------------------------------------------\n' and line_counter > 10000:
                return writers
            if line_counter >= first_line_index:
                if line[0] != " " and line[0] != "\t" and line[0] != "" and line[0] != "\n":
                    # Si on est sur un nouvel acteur

                    writerID += 1
                    if writer_done and len(current_writer["oeuvres"]) > 0:
                        writers[writerID - 1] = current_writer

                    writer_done = True
                    writer_data = get_nom_prenom(line)
                    current_writer = {"ID": writerID,
                                      "nom":writer_data[0],
                                      "prenom":writer_data[1],
                                      "numero":writer_data[2],
                                      "genre": genre,
                                      "oeuvres": [],
                                      }
                    id_oeuvre = getOeuvreID(line)
                    if isBetween2000and2017(id_oeuvre):
                        current_writer["oeuvres"].append((id_oeuvre))

                elif line[0] != "\n":
                    # Si on est dans la liste des films dans lesquels un acteur a joue
                    id_oeuvre = getOeuvreID(line)
                    if isBetween2000and2017(id_oeuvre):
                        current_writer["oeuvres"].append((id_oeuvre))

            line_counter += 1
    return writers


def main():
    writers = parse("../IMDB_files/writers.list")
    pretty_print(writers)


if __name__ == "__main__":
    main()
