def output(dico):
    of = open("../SQL_data_files/plots_ok.txt", 'w')

    for key in dico:
        of.write(dico[key]["ID"] + "|" + dico[key]["plot"].strip() + "\n")


def test():
    with open("../IMDB_files/plot.list") as f:
        line_counter = 0
        for line in f:
            if line_counter == 17 or line_counter == 18:
                print line
                print get_text(line)

            line_counter += 1


def is_new_mv(line):
    return line[0:2] == "MV"


def get_text(line):
    return line[4:].strip()


def is_plot(line):
    return line[0:2] == "PL"


def main():
    plots = {}
    current_plot = {}
    plot_counter = 0
    ID = 0

    with open("../IMDB_files/plot.list") as f:
        line_counter = 0
        for line in f:
            if line_counter >= 15:

                if is_new_mv(line):
                    ID += 1

                    if plot_counter > 0:
                        plots[ID] = current_plot

                    current_plot = {"ID": get_text(line),
                                    "plot": ""
                                    }
                    plot_counter += 1

                elif is_plot(line):
                    current_plot["plot"] += get_text(line) + " "

                else:
                    pass
                    # On prend pas tous le charabia genre celui qui a ecrit la plot

            line_counter += 1

    return plots


if __name__ == "__main__":
    plots = main()
    output(plots)
