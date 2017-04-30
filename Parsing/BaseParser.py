def get_nom_prenom(line):
    nom = "unknown"
    prenom = "unknown"
    numero = "NA"

    data = line.strip().split('\t')
    nom_prenom = data[0]

    if len(nom_prenom.split(',')) == 1:
        # Si il y a que un nom
        nom = nom_prenom
    else:
        if len(nom_prenom.split(',')) == 2:
            nom, prenom = nom_prenom.split(',')
        else:
            nom = nom_prenom.split(',')[0]
            prenom = nom_prenom.split(',')[2]

        if '(' in prenom and ')' in prenom:
            # Si plusieurs personnes avec le meme nom et que donc il y a un chiffre romain en plus
            # ex : Herry, thierry (IV)
            begin = prenom.index('(')
            end = prenom.index(')')
            numero = prenom[begin+1:end]
            prenom = prenom.replace(prenom[begin:end + 1], "")

    return nom.strip(), prenom.strip(), numero.strip()


def getOeuvreID(line):
    data = line.split("\t")
    for i in range(1, len(data)):
        if data[i] != "":
            long_id = data[i]
            if long_id[0] == '"' and '{' in long_id and '}' in long_id :
                # Si l oeuvre est une serie (le nom des series commence par des guillemets
                index = long_id.index('}')
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
                    endIndex = long_id.index("(VG)") + 3
                    long_id = long_id[0:endIndex]
                else:
                    long_id = long_id[0:getIndexOfDateEnd(long_id) + 1]

            return long_id.strip()


def getIndexOfDateEnd(long_id):
    index = 999
    i = 0
    for char in long_id:
        if char == '(':
            begin_index = i
            end_index = i + 5
            if (long_id[begin_index + 1:end_index].isdigit() or long_id[begin_index + 1:end_index] == '????') and (long_id[
                end_index] in ("/", ")")):
                # Si on a une une date
                if long_id[end_index] == '/':
                    return long_id.index(')', end_index, len(long_id))
                else:
                    return end_index
        i += 1


def isBetween2000and2010(oeuvreID):
    date = ""
    i = 0
    date_found = False
    for char in oeuvreID:
        if char == '(' and oeuvreID[i + 1:i + 5].isdigit() and oeuvreID[i + 5] == ')':
            date = oeuvreID[i + 1:i + 5]
            return 2000 <= int(date) <= 2010

        i += 1

    return False
