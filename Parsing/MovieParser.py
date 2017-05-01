def output_oeuvres(dico):
    of = open("../SQL_data_files/oeuvres_ok.txt", 'a')
    for key in dico:
        of.write(dico[key]["realID"] + "|" + dico[key]["titre"] + "|" + dico[key]["dateSortie"] + "|" + "-1" + "\n")

    of.close()


def output_films(dico):
    of = open("../SQL_data_files/films_ok.txt", 'w')
    for key in dico:
        of.write(dico[key]["realID"]+ "\n")

    of.close()


def output_series(dico):
    of = open("../SQL_data_files/series_ok.txt", 'w')
    for key in dico:
        of.write(dico[key]["realID"] + "|" + dico[key]["dateFin"]+ "\n")

    of.close()


def output_episodes(dico):
    of = open("../SQL_data_files/episodes_ok.txt", 'w')
    for key in dico:
        of.write(
        dico[key]["realID"] + "|" + dico[key]["titreS"] + "|" + dico[key]["numero"] + "|" +
        dico[key]["saison"] + "|" + dico[key]["dateSortie"] + "|" + dico[key]["SID"]+ "\n")

    of.close()


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

    if date_fin == '????':
        date_fin = '0'
    if date_sortie == '????':
        date_fin = '0'

    return name, date_sortie, date_fin


def extract_episode_infos(line):
    title = "unknown"
    saison = "-1"
    numero = "-1"
    date = '0'

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
            saison = infos[infos.index('(#') + 2: infos.index('.', infos.index('(#'), index_end_infos)]
            numero = infos[infos.index('.', infos.index('(#'), index_end_infos) + 1: infos.index(')', infos.index('(#'),
                                                                                                index_end_infos)]
            if infos.index('(#') != 0:
                title = infos[0:infos.index('(#') - 1]
        else:
            title = infos

        date = line.strip().split("\t")[-1]

        if date == "????":
            date = '0'

    return title, saison, numero, date


def test():
    with open("../IMDB_files/movies.list") as f:
        line_counter = 0
        for line in f:
            if line_counter == 2569138:
                print(getShortID(line))

            line_counter += 1


def getRealID(line):
    long_id = line.split('\t')[0]
    if long_id[0] == '"' and '{' in long_id and '}' in long_id:
        # Si l oeuvre est une serie (le nom des series commence par des guillemets
        if '"' in long_id[long_id.index('{'):]:
            long_id = long_id[0:getIndexOfDateEnd(long_id) + 1]
        else:
            index = long_id.rindex('}')
            long_id = long_id[0:index + 1]
    elif long_id[0] != '"' and '{' in long_id and '}' in long_id:
        index = long_id.rindex('}')
        long_id = long_id[0:index + 1]

    else:
        if "(V)" in long_id:
            endIndex = long_id.index("(V)") + 3
            long_id = long_id[0:endIndex]
        elif "(TV)" in long_id:
            endIndex = long_id.index("(TV)") + 4
            long_id = long_id[0:endIndex]
        elif "(mini)" in long_id:
            endIndex = long_id.index("(mini)") + 6
            long_id = long_id[0:endIndex]
        elif "(VG)" in long_id:
            endIndex = long_id.index("(VG)") + 4
            long_id = long_id[0:endIndex]
        else:
            long_id = long_id[0:getIndexOfDateEnd(long_id) + 1]

    return long_id.strip()

def getShortID(line):
    short_id = line.split('\t')[0]
    if '{' in short_id:
        if '"' in short_id[short_id.index('{'):]:
            short_id = short_id[0:getIndexOfDateEnd(short_id) + 1]
        else:
            short_id = short_id[0:short_id.index('{')]
        short_id = short_id[0:short_id.rindex(')') + 1]
    return short_id

def getIndexOfDateEnd(long_id):
    index = 999
    i = 0
    for char in long_id:
        if char == '(':
            begin_index = i
            end_index = i + 5
            if (long_id[begin_index + 1:end_index].isdigit() or long_id[begin_index + 1:end_index] == '????') and (
                long_id[
                    end_index] in ("/", ")")):
                # Si on a une une date
                if long_id[end_index] == '/':
                    return long_id.index(')', end_index, len(long_id))
                else:
                    return end_index
        i += 1


def main():
    SerieID = -1
    shortSerieId = -1
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

                    if getShortID(line) != shortSerieId:
                        new_oeuvre = True

                    elif getShortID(line) == shortSerieId and date_ok:
                        ID += 1
                        current_episode = {"realID": getRealID(line),
                                           "SID": SerieID,
                                           "titreS": serie_name,
                                           "titre": extract_episode_infos(line)[0],
                                           "saison": extract_episode_infos(line)[1],
                                           "numero": extract_episode_infos(line)[2],
                                           "dateSortie": extract_episode_infos(line)[3]
                                           }
                        episodes[ID] = current_episode



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
                        shortSerieId = getShortID(line)
                        current_serie = {"realID": getRealID(line),
                                         "titre": get_name_date_serie(line)[0],
                                         "dateSortie": get_name_date_serie(line)[1],
                                         "dateFin": get_name_date_serie(line)[2]
                                         }

                        if current_serie["dateSortie"].isdigit() and 2000 <= int(current_serie["dateSortie"]) <= 2010:
                            series[ID] = current_serie
                            date_ok = True

                        serie_name = current_serie["titre"]
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

    for oeuvre in [films, series, episodes]:
        output_oeuvres(oeuvre)

    output_films(films)
    output_series(series)
    output_episodes(episodes)


if __name__ == '__main__':
    main()
