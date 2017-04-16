ENDLINE = "--------------------------------------------------------------------------------\n"


def getLanguageInfo(line):
    big_info = line.split("\t")[-1]
    if len(big_info.split(" ")) > 1:
        return big_info[0]
    return big_info


def getSimpleInfo(line):
    return line.split("\t")[-1]


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
            if line_number > begin_line and line != ENDLINE:
                if infoName == "language":
                    dicEntry = {"OeuvreID": line.split("\t")[0],
                                infoName: getLanguageInfo(line)
                                }

                else:
                    dicEntry = {"OeuvreID": line.split("\t")[0],
                                infoName: getSimpleInfo(line)
                                }

                resDic[ID] = dicEntry

    return resDic


def main():
    print("COUNTRIES")
    countires = parse("../IMDB_files/countries.list", "country", 13)
    pretty_print(countires, "country")

    print("LANAGUAES")
    languages = parse("../IMDB_files/languages.list", "language", 41)
    pretty_print(languages, "language")

    print("GENRES")
    genres = parse("../IMDB_files/genres.list", "genre", 13)
    pretty_print(genres, "genre")


if __name__ == "__main__":
    main()
