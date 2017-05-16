alertAdded = false;
function build_advanced_query() {
    const category = $('#category_select').find(":selected").text();
    const title = $('#title').val();
    const year = $('#year').val();
    const actor_n = $('#actor_n').val();
    const director_n = $('#director_n').val();
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

    if (all_fields_empty(genres, langages, countries)) {
        if (!alertAdded) {
            $('#form_section').prepend(
                '<div class="alert alert-danger"><strong>Veuillez remplir au moins un champ !</strong></div>'
            );
            alertAdded = true
        }
        window.scrollTo(0, 0);
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
        query += " WHERE MATCH(Titre) AGAINST( '" + title + "' IN BOOLEAN MODE)";
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

    if ($.trim(actor_n) !== "") {
        var part = " exists ( SELECT Nom From Role r WHERE o.ID = r.OID and MATCH (Prenom, Nom) AGAINST ('" + actor_n + "' IN BOOLEAN MODE))";
        if (!whereAdded) {
            whereAdded = true;
            query += " WHERE" + part;
        } else {
            query += " AND" + part;
        }
    }

    //director

    if ($.trim(director_n) !== "") {
        var part = " exists ( SELECT Nom From DirigePar d WHERE o.ID = d.OID and MATCH (Prenom, Nom) AGAINST ('" + director_n + "' IN BOOLEAN MODE))";
        if (!whereAdded) {
            whereAdded = true;
            query += " WHERE" + part;
        } else {
            query += " AND" + part;
        }
    }

    //writer

    if ($.trim(writer_n) !== "") {

        var part = " exists ( SELECT Nom From EcritPar e WHERE o.ID = e.OID and MATCH (Prenom, Nom) AGAINST ('" + writer_n + "' IN BOOLEAN MODE))";
        if (!whereAdded) {
            whereAdded = true;
            query += " WHERE" + part;
        } else {
            query += " AND" + part;
        }
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
                var part = " exists ( SELECT " + name + " From " + name + " g WHERE o.ID = g.ID and " + name + " = '" + entry + "')";

                if (entry === list[0][0]) {
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
    console.log(query)
    //var redirect = 'advanced_search_result.php';
    //$.redirectPost(redirect, {query: query});

}

function all_fields_empty(genres, langages, countries) {
    const category = $('#category_select').find(":selected").text();

    var cond = ($.trim($('#title').val()) === "") && ($.trim($('#year').val()) === "") && ($.trim($('#actor_n').val()) === "") &&
        ($.trim($('#director_n').val()) === "") && ($.trim($('#writer_n').val()) === "") &&
        category === "Toutes" && genres[0] === null && langages[0] === null && countries[0] === null;
    console.log(cond);

    return cond
}