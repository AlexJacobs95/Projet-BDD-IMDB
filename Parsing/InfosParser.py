ENDLINE = "--------------------------------------------------------------------------------\n"
from BaseParser import *

def output_langues(dico):
    of = open("../SQL_data_files/langues_ok.txt", 'w')
    for key in dico:
        of.write(dico[key]["OeuvreID"] + "|" + dico[key]["language"]+ "\n")

    of.close()


def output_genres(dico):
    of = open("../SQL_data_files/genres_ok.txt", 'w')
    for key in dico:
        of.write(dico[key]["OeuvreID"] + "|" + dico[key]["genre"]+ "\n")

    of.close()


def output_pays(dico):
    of = open("../SQL_data_files/pays_ok.txt", 'w')
    for key in dico:
        of.write(dico[key]["OeuvreID"] + "|" + dico[key]["country"]+ "\n")

    of.close()


def getLanguageInfo(line):
    big_info = line.split("\t")[-1].strip()
    if big_info[0] == '(':
        return line.split("\t")[-2].strip()
    return big_info


def getSimpleInfo(line):
    return line.split("\t")[-1].strip()


def pretty_print(infoDic, infoName):
    for key in infoDic:
        print (infoDic[key]["OeuvreID"] + "|" + infoDic[key][infoName])


def parse(infIle, infoName, begin_line):
    resDic = {}
    ID = -1
    with open(infIle, 'r') as f:
        line_number = 0
        for line in f:
            ID += 1
            dicEntry = {}
            if line_number > begin_line:
                if line != ENDLINE:
                    if infoName == "language":
                        dicEntry = {"OeuvreID": line.split("\t")[0],
                                    infoName: getLanguageInfo(line)
                                    }

                    else:
                        dicEntry = {"OeuvreID": line.split("\t")[0],
                                    infoName: getSimpleInfo(line)
                                    }

                    if isBetween2000and2017(dicEntry["OeuvreID"]):
                        resDic[ID] = dicEntry
            line_number += 1

    return resDic


def main():
    countires = parse("../IMDB_files/countries.list", "country", 13)
    languages = parse("../IMDB_files/language.list", "language", 41)
    genres = parse("../IMDB_files/genres.list", "genre", 382)

    output_pays(countires)
    output_langues(languages)
    output_genres(genres)

if __name__ == "__main__":
    main()
