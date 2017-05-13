alertAdded = false;
function build_advanced_query() {
    const category = $('#category_select').find(":selected").text();
    const title = $('#title').val();
    const year = $('#year').val();
    const actor_fn = $('#actor_fn').val();
    const actor_n = $('#actor_n').val();
    const director_fn = $('#director_fn').val();
    const director_n = $('#director_n').val();
    const writer_fn = $('#writer_fn').val();
    const writer_n = $('#writer_n').val();

    var genres = [];
    var langages = [];
    var countries = [];
    $("#genre_select").each(function () {
        genres.push($(this).val());
    });
    $("#langage_select").each(function () {
        langages.push($(this).val());
    });
    $("#country_select").each(function () {
        countries.push($(this).val());
    });

    if (all_fields_empty(genres, langages, countries)){
        if (!alertAdded) {
            $('#form_section').prepend(
                '<div class="alert alert-danger"><strong>Veuillez remplir au moins un champ !</strong></div>'
            );
            alertAdded=true
        }
        window.scrollTo(0,0);
        return;
    }

    const category_ID = {"Film": "FilmID", "Serie": "SerieID", "Episode": "EpisodeID"}
    console.log(category_ID);

    whereAdded = false;
    var query = "SELECT ID, Titre, AnneeSortie FROM Oeuvre o";
    if (category != "Toutes") {
        query += " INNER JOIN " + category + " ON " + category_ID[category] + " = o.ID";
    }
    if ($.trim(title) !== "") {
        whereAdded = true;
        query += " WHERE Titre = '" + title + "'";
    }
    if ($.trim(year) !== "") {
        if (!whereAdded) {
            whereAdded = true;
            query += " WHERE AnneeSortie = " + year;
        } else {
            query += " AND AnneeSortie = " + year;
        }
    }

    //actor
    var actor_fn_added = false;
    if ($.trim(actor_fn) !== "") {
        actor_fn_added = true;
        var part = " exists ( SELECT Prenom From Role r WHERE o.ID = r.OID and r.Prenom = '" + actor_fn + "'"
        if (!whereAdded) {
            whereAdded = true;
            query += " WHERE" + part
        } else {
            query += " AND" + part
        }
    }
    if ($.trim(actor_n) !== "") {
        if (!actor_fn_added) {
            var part = " exists ( SELECT Nom From Role r WHERE o.ID = r.OID and r.Nom = '" + actor_n + "')"
            if (!whereAdded) {
                whereAdded = true;
                query += " WHERE" + part;
            } else {
                query += " AND" + part;
            }
        } else {
            query += " AND r.Nom = '" + actor_n + "')";
        }
    } else if (actor_fn_added) {
        query += ")";
    }

    //director
    var director_fn_added = false;
    if ($.trim(director_fn) !== "") {
        director_fn_added = true;
        var part = " exists ( SELECT Prenom From DirigePar d WHERE o.ID = d.OID and d.Prenom = '" + director_fn + "'"
        if (!whereAdded) {
            whereAdded = true;
            query += " WHERE" + part
        } else {
            query += " AND" + part
        }
    }
    if ($.trim(director_n) !== "") {
        if (!director_fn_added) {
            var part = " exists ( SELECT Nom From DirigePar d WHERE o.ID = d.OID and d.Nom = '" + director_n + "')"
            if (!whereAdded) {
                whereAdded = true;
                query += " WHERE" + part;
            } else {
                query += " AND" + part;
            }
        } else {
            query += " AND d.Nom = '" + director_n + "')";
        }
    } else if (director_fn_added) {
        query += ")";
    }

    //writer
    var writer_fn_added = false;
    if ($.trim(writer_fn) !== "") {
        writer_fn_added = true;
        var part = " exists ( SELECT Prenom From EcritPar e WHERE o.ID = e.OID and e.Prenom = '" + writer_fn + "'"
        if (!whereAdded) {
            whereAdded = true;
            query += " WHERE" + part
        } else {
            query += " AND" + part
        }
    }
    if ($.trim(writer_n) !== "") {
        if (!writer_fn_added) {
            var part = " exists ( SELECT Nom From EcritPar e WHERE o.ID = e.OID and e.Nom = '" + writer_n + "')"
            if (!whereAdded) {
                whereAdded = true;
                query += " WHERE" + part;
            } else {
                query += " AND" + part;
            }
        } else {
            query += " AND e.Nom = '" + writer_n + "')";
        }
    } else if (writer_fn_added) {
        query += ")";
    }

    query = addListOfElemToQuery(genres, "Genre", query, whereAdded);
    query = addListOfElemToQuery(langages, "Langue", query, whereAdded);
    query = addListOfElemToQuery(countries, "Pays", query, whereAdded);

    console.log(query);

    launch_advanced_search(query);

}

function addListOfElemToQuery(list, name, query) {
    if (list[0] !== null) {
        list.forEach(function (entry) {
            entry.forEach(function (entry) {
                var part = " exists ( SELECT "+ name +" From " +name+ " g WHERE o.ID = g.ID and " +name+ " = '" + entry + "')";

                if (entry === list[0][0]){
                    if (!whereAdded) {
                        whereAdded = true;
                        query += " WHERE" + part;
                    } else {
                        query += " AND" + part;
                    }

                } else {
                    query += " AND" + part;
                }
            });
        });

    }
    return query;
}

function launch_advanced_search(query) {
    //var redirect = 'advanced_search_result.php';
    //$.redirectPost(redirect, {query: query});

}

function all_fields_empty(genres, langages, countries) {
    const category = $('#category_select').find(":selected").text();

    var cond = ($.trim($('#title').val() )=== "") && ($.trim($('#year').val()) === "") && ($.trim($('#actor_fn').val()) === "") && ($.trim($('#actor_n').val()) === "") &&
        ($.trim($('#director_fn').val()) === "") && ($.trim($('#director_n').val()) === "") && ($.trim($('#writer_fn').val()) === "") && ($.trim($('#writer_n').val()) === "") &&
        category === "Toutes" && genres[0] === null && langages[0] === null && countries[0] === null;
    console.log(cond);

    return cond
}