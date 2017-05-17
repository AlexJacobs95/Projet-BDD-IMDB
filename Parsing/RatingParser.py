def output_ratings(dico):
    of = open("../SQL_data_files/ratings_ok.txt", 'w')
    for key in dico:
        of.write(dico[key]["ID"] + "|" + dico[key]["note"] + "\n")

    of.close()


def is_oeuvre(line):
    splitted = line.split()
    if len(splitted) == 0:
        return False
    return splitted[0][0].isdigit() or splitted[0][0] == '.'


def get_note(line):
    return line.split()[2]


def get_id(line):
    return ' '.join(line.split()[3:])


def test():
    with open("../IMDB_files/ratings.list") as f:
        line_counter = 0
        for line in f:
            if line_counter == 284:
                print(get_id(line))


            line_counter +=1


def parse():
    ratings = {}
    ID = -1
    with open("../IMDB_files/ratings.list") as f:
        line_counter = 0
        for line in f:
            ID += 1
            if line_counter > 27:
                if line == "------------------------------------------------------------------------------\n" and \
                   line_counter > 1000:
                    return ratings
                else:
                    if is_oeuvre(line):
                        note = {"ID": get_id(line),
                                "note": get_note(line)
                                }
                        ratings[ID] = note
            line_counter +=1


if __name__ =="__main__":
    ratings = parse()
    output_ratings(ratings)