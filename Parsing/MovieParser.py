def pretty_print_films(dico):
    print("FILMS")
    for key in dico:
        print(dico[key]["realID"] + "|" + dico[key]["titre"] + "|" + dico[key]["dateSortie"])


def pretty_print_series(dico):
    print("SERIES")
    for key in dico:
        print(
        dico[key]["realID"] + "|" + dico[key]["titre"] + "|" + dico[key]["dateSortie"] + "|" + dico[key]["dateFin"])


def pretty_print_episodes(dico):
    print("EPISODES")
    for key in dico:
        print(
        dico[key]["realID"] + "|" + dico[key]["SID"] + "|" + dico[key]["titreS"] + "|" + dico[key]["titre"] + "|" +
        dico[key]["saison"] + "|" + dico[key]["numero"] + "|" + dico[key]["date"])


def get_name(line):
    name = ""
    counter = 0

    for i in range(0, line.__len__()):
        if (i > 0):
            ch = line[i]
            if ch == '"':
                break
            name += ch
        counter += 1
    return name


def get_name_date_film(line):
    date = line.strip().split("\t")[-1]
    name = ""

    for char in line:
        if char == '(':
            name = name[:name.__len__() - 1]
            break
        name += char

    return name, date


def get_name_date_serie(line):
    name = ""
    date_sortie = ""
    date_fin = ""
    dates = line.strip().split("\t")[-1]

    # Si il y a une date de debut et une date de fin
    if '-' in dates:
        date_sortie = dates[:dates.index('-')]
        date_fin = dates[dates.index('-') + 1:]

    else:
        date_sortie = dates

    counter = 0
    for i in range(0, line.__len__()):
        if (i > 0):
            ch = line[i]
            if ch == '"':
                break
            name += ch
        counter += 1

    return name, date_sortie, date_fin


def extract_episode_infos(line):
    title = "unknown"
    saison = "unknown"
    numero = "unknown"
    date = "unknown"

    index_begin_infos = 99999
    for char in line:
        if char == "{":
            index_begin_infos = line.index(char) + 1

        if char == "}":
            index_end_infos = line.index(char)
    if index_begin_infos != 99999:
        # Si y a des infos
        infos = line[index_begin_infos:index_end_infos]

        if infos.find("(#") != -1 and infos[infos.index("(#") + 2].isdigit():
            saison = infos[infos.index('(#') + 2: infos.index('.', infos.index('#'), index_end_infos)]
            numero = infos[infos.index('.', infos.index('#'), index_end_infos) + 1: infos.index(')', infos.index('#'),
                                                                                                index_end_infos)]
            if infos.index('(#') != 0:
                title = infos[0:infos.index('(#') - 1]
        else:
            title = infos

        date = line.strip().split("\t")[-1]

    return title, saison, numero, date


def test():
    with open("../IMDB_files/movies.list") as f:
        line_counter = 0
        for line in f:
            if line_counter == 2914756:
                print(line)

            line_counter += 1


def getRealID(line):
    return line.split('\t')[0]


def main():
    SerieID = -1
    ID = -1
    series = {}
    films = {}
    episodes = {}
    # num_lines = sum(1 for line in open("../IMDB_files/movies.list"))

    with open("../IMDB_files/movies.list") as f:
        serie_name = ""
        line_counter = 0
        new_oeuvre = True
        extracting_episodes = False

        content = f.readlines()
        content.pop()

        date_ok = True
        for line in content:
            if (line_counter >= 15):
                if extracting_episodes:
                    if get_name(line) == serie_name and date_ok:
                        ID += 1
                        current_episode = {"realID": getRealID(line),
                                           "SID": SerieID,
                                           "titreS": serie_name,
                                           "titre": extract_episode_infos(line)[0],
                                           "saison": extract_episode_infos(line)[1],
                                           "numero": extract_episode_infos(line)[2],
                                           "date": extract_episode_infos(line)[3]
                                           }
                        episodes[ID] = current_episode

                    elif get_name(line) != serie_name:
                        new_oeuvre = True

                    else:
                        # Ici on est dans le cas ou on extrait pas les episodes de la serie
                        # elle n'a pas ete tournee entre 2000 et 2010
                        # donc on passe jute les lignes
                        pass

                if new_oeuvre:
                    date_ok = False
                    ID += 1
                    if line_counter < 2914756:
                        # Si c est une serie
                        SerieID = getRealID(line)
                        current_serie = {"realID": getRealID(line),
                                         "titre": get_name_date_serie(line)[0],
                                         "dateSortie": get_name_date_serie(line)[1],
                                         "dateFin": get_name_date_serie(line)[2]
                                         }

                        if current_serie["dateSortie"].isdigit() and 2000 <= int(current_serie["dateSortie"]) <= 2010:
                            serie_name = current_serie["titre"]
                            series[ID] = current_serie
                            date_ok = True

                        extracting_episodes = True
                        new_oeuvre = False


                    else:
                        # Si c'est juste un film
                        current_film = {"realID": getRealID(line),
                                        "titre": get_name_date_film(line)[0],
                                        "dateSortie": get_name_date_film(line)[1],
                                        }
                        if current_film["dateSortie"].isdigit() and 2000 <= int(current_film["dateSortie"]) <= 2010:
                            films[ID] = current_film
                        extracting_episodes = False

            line_counter += 1

    pretty_print_films(films)
    pretty_print_series(series)
    pretty_print_episodes(episodes)


if __name__ == '__main__':
    main()
