function add_showMore_link(hideContent, link) {
    link.on("click", function () {

        const $this = $(this);
        const $content = $this.parent().prev("div.content");
        let linkText = $this.text().toUpperCase();

        if (linkText === "SHOW MORE") {
            linkText = "Show less";
            $content.addClass('showContent').removeClass(hideContent);
        } else {
            linkText = "Show more";
            $content.addClass(hideContent).removeClass('showContent');
        }

        $this.text(linkText);
    });

}

function add_resizable_table(number_roles) {


    if (number_roles > 10) {

        const parent = document.getElementById("actors");
        const toWrap = document.getElementById("actors_table");
        const wrapper = document.createElement('div');
        wrapper.className += "content hideContent-actors";
        parent.replaceChild(wrapper, toWrap);
        wrapper.appendChild(toWrap);
        const link_div = document.createElement('div');
        const link = document.createElement('a');
        const linkText = document.createTextNode("Show more");
        link.appendChild(linkText);
        link.href = "#Acteurs";
        link_div.appendChild(link);
        link_div.className += "show-more";
        parent.appendChild(link_div);

    }


}


function add_plots(havePlot) {
    if (havePlot != 0) {
        const parent = document.getElementById("resume_block");
        const link_div = document.createElement('div');
        const link = document.createElement('a');
        const linkText = document.createTextNode("Show more");
        link.appendChild(linkText);
        link.href = "#Resume";
        link_div.appendChild(link);
        link_div.className += "show-more-plot";
        parent.appendChild(link_div);
    } else {

        $('#plot').find('span').text('Aucun résumé disponible');
        $('#plot.content.hideContent-plot').height("auto");

        $('#resume_block').css("padding-bottom", 0);
        $('#resume_block').css("padding-top", 0);

    }

}


function add_dynamic_part_series(havePlot, hideContent) {
    add_plots(havePlot);
    add_showMore_link(hideContent, $(".show-more-plot a"))

}

function add_dynamic_part_filmAndEp(havePlot, number_roles, hideContent_plot, hideContent_actors) {

    add_plots(havePlot);
    add_showMore_link(hideContent_plot, $(".show-more-plot a"));
    add_resizable_table(number_roles);
    add_showMore_link(hideContent_actors, $(".show-more a"))

}

function add_navbar(args) {
    var body = document.getElementsByTagName("body");

    var section = document.createElement("section");
    section.setAttribute("id", "Tabs");
    section.setAttribute("class", "bg-light-gray");

    var div1 = document.createElement("div");
    div1.setAttribute("class", "container");

    var div2 = document.createElement("div");
    div2.setAttribute("class", "col-lg-12 text-center");

    var ul = document.createElement("ul");
    ul.setAttribute("class", "nav nav-pills nav-justified");
    ul.setAttribute("id", "nav_bar");

    for (var arg in args) {
        ul.innerHTML += "<li><a class=\"page-scroll\" href=#" + args[arg][1] + " " + "data-toggle=\"pill\">" + args[arg][0] + "</a></li>"
    }

    div2.appendChild(ul);
    div1.appendChild(div2);
    section.appendChild(div1);
    document.body.insertBefore(section, body.firstChild);


}


// FOR ADMIN

function clearAllInputs(parent) {
    var children = parent.children;
    console.log(children.length);
    for (var i = 0; i < children.length; i++) {
        var child = children[i];
        parent.removeChild(child)

    }
}

function addAdminElements(section) {
    /*create the "add" link*/
    const button = document.createElement('button');
    button.className += "addButton";
    button.id += section.id;
    const add = document.createElement('img');
    if (section.id == "resume-title") {
        add.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAA50lEQVRYR82XQQ7DIAwEycvbvLyVoxBBMbDYa9RccgFmbEDZHGnP874x+f1Qjw18gb5uzplSqiSiBUp4rrWSiBTQ4I1ElMAIXklECCDwR4ItsAIXiZMpsAyXG8ESMMGlBQwBM5wh4IJ7BdxwjwAFbhWgwS0CVPiqAB2+IhACRwXC4IhAKHwmEA5nCjRRC416s28B0gUzvNcBgZbBEYpWaMW/47QOfCQoABKuyrNIT+BKKwMJCry3BdIBNUIXQs0PBnsLyvVo1WqSoy3YIjG7htbOwvP+UqA8hHAlwEC1WPQMAOtPh6gCX5L0PiE3hQmGAAAAAElFTkSuQmCC";
    } else {
        add.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADvUlEQVRYhbWWX0xaZxTAzxtrneCSsixtlplO6/6kky1Z19UF05JZtUO7roBQtYCKVVEKKbXMgvingjrTLf2LwfmwJbVdU13YVgQu6J5MfJhDkS6ZyN4aWq4vQyc0OXtoNGtzddyvepLf083vO+c733fvPQDpB1dwOFchOS9y6hyy6U6XJt5LaZO9lDbZ4dI81jlk05LzIud7R3LlAMBlse7mkbk7M0/SKhq2eRtXvvq1BdOhx9OwfNIoGuLyObkvknvnZw2HBuz+pif9k81Igp1qTJXUf9wPADvY7XoXZ59hWB7qm9TiVqD/Vhbk8jk5aSXf9QbvA8uP6kd9k024lVhGVTF+dpbgf3duHlM96p1oxO3APKqMbdaJDP2wLGSfaMDtRDckCTLeieKGgwP2iTPIhrHQIN6bu8nKsU+cwWLNgb7nW5/X7at7YgvUIxv+WvoDF+l5Vo4tUI/d3trUM0dxwlg43BPQIFueFhBm7fUENHj83CfOp9lfAZ7VrVq5FKhDtqwVQOK231cmACAT9h/eq7jkr0MS1gsg9N8WZsvguKHA2e2vRRLW7gCpLz57yAH118qmu/w1SEJ06QFG6Hkit8tfg5qr4ikwjSriXZQaSVgvgNBvvSuPgcVdneykVMjED7PXMEqHMbr0gJF/Usu4kkps+DxKh/FO8Arj2p2UCi3u6lUwu6uSHZQSmbgdvIIL8RBGaGZWUglcTv694fOFeAhv/f4149odlBLN7qpVMN6TPrZSp5GE6FIYI3SIyLVSp/HcXWkMaq+WTlt91UhClA5jJB4icq2+alR/UzIFYv1BZ7uvCklYpMO4EJ8jctt9VXjs7EcOeKvwdbnFV4kkrBVA6ucV7JECAHBNropli7cS2bJeAIF7wSVLAMDLAABwzHBgyOw9hWxZpOdxIT7H2jN7T2GJ7sPB9b8hl8/JNd2vSF30KpANEXoe/4zPsnIuehVo+kWW5LzKefOZmeBIjaC/zSNHNnw/M4Df/dbPymnzyFGo3G9jGsl21t48OtvmqcDtpObG0RkAeIlxKOTwOTm6O2WxLz0y3A5aRsoe8ni8vRsNpQAAkJWdIWi5LY6ZxqW4lTTfEj/M2pORv2ny/3ZCfePToGlcgluB+rpohseDzXfOEDsK1e/2GX8+kbowfhJJMP70eVKofMe24Zmn241i3ftO/Vh5otX9BaaDfqw8UdQsGOTwnnvVXjAy9xXslhVp8x2Vl4VTTSOlMYOrfNXgKl9tGimNVV4WThVp8x05Ba9JYe0Ll0b8CxNQdU/XcVuxAAAAAElFTkSuQmCC";

    }
    button.appendChild(add);
    section.insertBefore(button, section.children[1]);
    button.addEventListener("click", function () {

        if (section.id === "actor-title") {
            document.getElementById('formContainerActor').style.display = "block";
        } else if (section.id === "director-title") {
            document.getElementById('formContainerDirector').style.display = "block";
        } else if (section.id === "writer-title") {
            document.getElementById('formContainerWriter').style.display = "block";
        } else if (section.id === "detail-title") {
            document.getElementById('formContainerDetails').style.display = "block";
        } else { //resume
            document.getElementById('formContainerResume').style.display = "block";
        }

    });


}


function addAdminElementsFilmEpisode(plot) {
    console.log("hi")
    addAdminElements(document.getElementById("actor-title"));
    addAdminElements(document.getElementById("director-title"));
    addAdminElements(document.getElementById("writer-title"));
    addAdminElements(document.getElementById("detail-title"));
    addAdminElements(document.getElementById("resume-title"));
    $('#resume').val($('#resume').val() + plot);
}

function modifyRows() {
    $('.row_t').attr('class', "clickable-row");

    $(".clickable-row").append(
        $('<td></td>')
            .append(
                $('<button class = "deleteButton"></button>')
                    .append(
                        $('<img src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAC6klEQVRYhbWWO08bQRCAtwwkISWNC5QccQGY42aGCoRcgs1hGhD8ISQQPwDOiJ6OBikVIsDtRrawRZQag4+HHCiNDUTaFLEtP/Z86wuMNN3tft/Nzj4Y04wDwxhwAVY5QNolygjEB070XMt7lyjDAdIu4sqBYQzozhsYJ7FYlBPtCsTKj8lJqZMC8VEg7hyZ5nBocBagnyNuCsQ/umCFyIsA2NiLRPp6gh+Pj38VAL/CghUi54eWZWjBvwNYnOj3a8HryYlKp6ZpBv75W8CbJXwr8W1w8L1f2TMzMz3DsvG473Ioe4IjbqoGeI4jq54nc7atDc+nUvLp9lZ6juMnsd4CP4nFoqpu9xxH1kNXog6vh0pCIL60LAUn2lWVvXp9LZsjSCK/sCCrTXAppaxcXMjM1FRnPwCkGWOMZQE++R0yOdvWlvCDn83O+jVkeT8a/chcgNVuJdWRyNu2rN7ctMILBV94Q8KylhkHSAeuqwJQl1AJVi4v5dncXGC/CMQt5hJltDrbR0IFz2nAawKCCcQH7e2lkGiBX11pw2t9UGKc6Fl3gF+zSSllpViUuURCe56awNPrCiSToQTuteGplBIeVoITlfSbUAGvFIuyWiyGlhCIQm8bth2vjYZLJGQumQwt8W8bIq50hS8udsLbtlpYCW5ZS+zAMAYE4mNYeENifl5WPU9bghOV90ZGPjDGGBOIO+0fZOPxTnih0PWE85NQvSc40XbjNjwyzWGB+NL+UfN1HAT3k1Bdx5zo+XR09EvLm0AAbKgm9Byn662mlLBtWfU83weJS7TW8SLKAvS7RD9VA1T3eVBmpqfVnQ+Q3x0aeqd8Fx5alsGJSr3CdFMg3h2PjX1WwutxaprmW0gIxLvjiYnxrvDmSgjE81eDA+QD/7w99iKRPoG4rtodusmJnl2iNd81160GB0hzonIP4DIn2u7Yav8T+9HoR25ZywJxSyAKTlTiRE+1LAlEIRC3uGUtNU44jfgLUwkn+JzAd8QAAAAASUVORK5CYII=">')
                    )
            )
    );


    $(".deleteButton").click(function () {
        const table = $(this).parent().parent().parent().parent().attr('id');
        const id = $(this).parent().prev().text();
        const id_element = id.split(';');
        const row = $(this).parent().parent();
        console.log(table);
        if (table === "actors_table") {
            remove_person_from_work(id_element[1], id_element[0], id_element[2], 'actor', row);

        } else if (table === "directors_table") {
            remove_person_from_work(id_element[1], id_element[0], id_element[2], 'director', row);

        } else if (table === "writers_table") {
            remove_person_from_work(id_element[1], id_element[0], id_element[2], 'writer', row);
        }

    });
}

function remove_person_from_work(_name, _fn, _num, type, row) {

    console.log(_name, _fn, _num, type);
    console.log("adminRequests.php?type=remove_" + type + "_from_work");

    $.ajax({
        url: "adminRequests.php?type=remove_" + type + "_from_work", //This is the current doc
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({name: _name, fn: _fn, num: _num}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            row.remove();
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });


}


//form pop_up
function check_empty() {
    if (document.getElementById('name').value == "" || document.getElementById('firstName').value == "" || document.getElementById('role').value == "") {
        alert("Completer tous les champs S.V.P");
    } else {
        document.getElementById('form').submit();
        alert("Opération réussie");
    }
}

//for details form
function check_valid() {
    if (document.getElementById('genre').value == "" && document.getElementById('language').value == "") {
        alert("Completer au moins un champ  S.V.P");
    } else {
        document.getElementById('form').submit();
        alert("Opération réussie");
    }
}

//hidePopup
function div_hide(id) {
    console.log(id)
    document.getElementById(id).style.display = "none";
}


function update_resume() {
    //$('#plot').update($('#resume').val());

}


function edit_plot(havePlot) {
    var text = $('#resume').val();
    console.log(havePlot);

    if (havePlot !== 0) {
        $.ajax({
            url: "adminRequests.php?type=edit_plot", //This is the current doc
            type: "POST",
            dataType: 'json', // add json datatype to get json
            data: ({content: text}),
            error: function (xhr, status) {
                alert(status);
            },
            success: function () {
                $('#formContainerResume').css("display", "none");
                $("#text_plot").html(text);
            },
            fail: function () {
                alert("Une erreur est survenue")

            },
            always: function () {
                $('#load_spinner').hide()

            }
        });
    } else {
        $.ajax({
            url: "adminRequests.php?type=add_plot", //This is the current doc
            type: "POST",
            dataType: 'json', // add json datatype to get json
            data: ({content: text}),
            error: function (xhr, status) {
                alert(status);
            },
            success: function (data) {
                console.log(data)
                $('#formContainerResume').css("display", "none");
                $("#text_plot").html(text);
            },
            fail: function () {
                alert("Une erreur est survenue")

            },
            always: function () {
                $('#load_spinner').hide()

            }
        });

    }
}

function add_role(name, fn, num) {
    var role = $('#actor_role').val();
    $.ajax({
        url: "adminRequests.php?type=add_role",
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn, role: role, num: num}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            console.log(data);
            alert(fn + " " + name + " a bien été ajouté dans les acteurs.\nRole : " + role)
            $('#formContainerActor').css("display", "none");
            location.reload();

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}

function add_in_tb(name, fn, num, tbName) {
    console.log("add_in_tb: ", name, fn, num)
    $.ajax({
        url: "adminRequests.php?type=add_in_tb_" + tbName,
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn, num: num}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            if (tbName == "directedBy"){
                alert(fn + " " + name + " a bien été ajouté dans les directeurs.");
                $('#formContainerDirector').css("display", "none");
                location.reload();

            } else if (tbName == "writtenBy") {
                alert(fn + " " + name + " a bien été ajouté dans les auteurs.");
                $('#formContainerWriter').css("display", "none");
                location.reload();

            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}


function add_person(name, fn, genre, callback) {
    $.ajax({
        url: "adminRequests.php?type=add_person",
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn, genre: genre}),
        error: function (xhr, status) {
            alert(status);

        },
        success: function (numero) {
            console.log("add_peson_OK")
            console.log(numero);
            callback(name, fn, numero);

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}

function add_actor_role(name, fn, number) {
    add_in_tb(name, fn, number, "actor");
    add_role(name, fn, number);
}

function add_director_directedBy(name, fn, number) {
    add_in_tb(name, fn, number, "director");
    add_in_tb(name, fn, number, "directedBy");

}

function add_writer_writtenBy(name, fn, number) {
    add_in_tb(name, fn, number, "writer");
    add_in_tb(name, fn, number, "writtenBy");

}

function edit_actors() {

    var name = $('#actor_name').val();
    var fn = $('#actor_fn').val();
    var genre = $('#actor_genre').find(":selected").text();

    console.log(name, fn);

    $.ajax({
        url: "adminRequests.php?type=check_person",
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                if (confirm("Cette personne n'est pas encore enregistrée.\nVoulez vous ajouter " + fn + " " + name + " à la base de donnée ?")){
                    add_person(name, fn, genre, add_actor_role);
                } else {
                    //TODO

                }

            } else {
                createPersonList(data, "actor");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }

    });

}

function edit_directors() {

    var name = $('#director_name').val();
    var fn = $('#director_fn').val();
    var genre = $('#director_genre').find(":selected").text();
    console.log(name, fn);

    $.ajax({
        url: "adminRequests.php?type=check_person",
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                if (confirm("Cette personne n'est pas encore enregistrée.\nVoulez vous ajouter " + fn + " " + name + " à la base de donnée ?")){
                    add_person(name, fn, genre, add_director_directedBy);
                }

            } else {
                createPersonList(data, "director");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }

    });

}

function edit_writers() {

    var name = $('#writer_name').val();
    var fn = $('#writer_fn').val();
    var genre = $('#writer_genre').find(":selected").text();

    console.log(name, fn);

    $.ajax({
        url: "adminRequests.php?type=check_person",
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                if (confirm("Cette personne n'est pas encore enregistrée.\nVoulez vous ajouter " + fn + " " + name + " à la base de donnée ?")){
                    add_person(name, fn, genre, add_writer_writtenBy);
                }

            } else {
                createPersonList(data, "writer");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }

    });

}

function createPersonList(data, person_type) {
    console.log(data);

    $("body").append(
        $('<div class="listContainer" id="persons_list_container" </div>').append(
            $('<div class="popupAdd form_popup" id="popupAddList"</div>').append(
                $('<h2 class="h2popup">Sélectionnez une personne dans la liste</h2>')
            )
        )
    );

    $('#popupAddList').append(
        $('<hr class="hrpopup"></hr>')

    );

    $('#popupAddList').append(
        $('<ul class="list-group" id="persons_list"></ul>')

    );

    $('#popupAddList').append(
        $('<button class="submit_form" id="cancel_button" onclick="cancel_persons_list()">Annuler</button>')

    );

    for (var person in data) {
        const nom = data[person][1];
        const prenom = data[person][0];
        const numero = data[person][2];

        if (data[person][2] == "NA"){
            $("#persons_list").append(
                $('<button type="button" class="list-group-item list_person_elem">' + prenom + " " + nom + '</button>').data({"prenom": prenom, "nom": nom, "numero":numero, "personType":person_type})
            );
        } else {
            $("#persons_list").append(
                $('<button type="button" class="list-group-item list_person_elem">' + prenom + " " + nom + " " + numero+ '</button>').data({"prenom": prenom, "nom": nom, "numero":numero})
            );
        }

    }
    $("#persons_list").append(
        $('<button type="button" class="list-group-item" id="new_person_button">Ajouter une nouvelle personne</button>')
    );

    $('.list_person_elem').click(function () {
        if ($(this).data("person_type") === "actor") {
            add_actor_role($(this).data("nom"), $(this).data("prenom"), $(this).data("numero"));

        } else if ($(this).data("person_type") === "director") {
            add_director_directedBy($(this).data("nom"), $(this).data("prenom"), $(this).data("numero"));

        } else if ($(this).data("person_type") === "writer") {
            add_writer_writtenBy($(this).data("nom"), $(this).data("prenom"), $(this).data("numero"));


        }
        cancel_persons_list();

    })

    $('#new_person_button').click(function () {
        var name = $('#actor_name').val();
        var fn = $('#actor_fn').val();
        var genre = $('#actor_genre').find(":selected").text();
        add_person(name, fn, genre, add_actor_role);
        cancel_persons_list();
    })

}

function cancel_persons_list() {
    $('#persons_list_container').remove();

}




/*
function createPersonList(destination, data) {
    console.log(data);
    console.log(destination);

    $('<div class="dialog" title="Choisisez une personne dans la liste" </div>').dialog().append(
        $('<ul class="list-group" id="persons_list"></ul>')
    );
    for (var person in data) {
        if (data[person][2] == "NA"){
            $("#persons_list").append(
                $('<button type="button" class="list-group-item">' +data[person][0] + " " + data[person][1] + '</button>')
            );
        } else {
            $("#persons_list").append(
                $('<button type="button" class="list-group-item">' +data[person][0] + " " + data[person][1] + " " + data[person][2]+ '</button>')
            );
        }

    }

}
*/