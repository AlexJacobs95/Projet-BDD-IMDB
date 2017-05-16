function build_graph_nb_movies_series_epsiodes(res) {

    var ctx = $("#compare_nb_work");

    var option = {
        responsive: true,
        maintainAspectRatio: true
    }

    var data = {
        labels: [
            "Film ",
            "Episode",
            "Serie"
        ],
        datasets: [
            {
                data: res,
                backgroundColor: [
                    "#ff4050",
                    "#FFCE56",
                    "rgba(75,192,192,1)"
                ],
                hoverBackgroundColor: [
                    "#ff4050",
                    "#FFCE56",
                    "rgba(75,192,192,1)"
                ]
            }]
    };

    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        option: option
    });

}


function build_graph_cmp_sex(res) {

    var ctx = $("#compare_sex");

    var option = {
        responsive: true,
        maintainAspectRatio: true
    }

    var data = {
        labels: [
            "Femmes",
            "Hommes"
        ],
        datasets: [
            {
                data: res,
                backgroundColor: [
                    "#FF6384",
                    "#36A2EB"
                ],
                hoverBackgroundColor: [
                    "#FF6384",
                    "#36A2EB",
                ]
            }]
    };

    var myDoughnutChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        option: option
    });

}


function build_graph_evolution(nb_movies, nb_series) {

    var ctx = $("#evolution");

    var option = {
        responsive: true,
        maintainAspectRatio: true
    };

    var data = {
        labels: [
            "2000",
            "2001",
            "2002",
            "2003",
            "2004",
            "2005",
            "2006",
            "2007",
            "2008",
            "2009",
            "2010",
            "2011",
            "2012",
            "2013",
            "2014",
            "2015",
            "2016",
        ],
        datasets: [
            {
                label: "Series",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(75,192,192,1)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: nb_series,
                spanGaps: false,
            },

            {
                label: "Films",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "red",
                borderColor: "red",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "red",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "red",
                pointHoverBorderColor: "red",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: nb_movies,
                spanGaps: false,

            }
        ]
    };


    var lineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        option: option
    });

}

function build_graph_notes_evolution(absx, ord) {

    var ctx = $("#note_evolution");

    var option = {
        responsive: true,
        maintainAspectRatio: true
    };

    var data = {
        labels: absx,
        datasets: [
            {
                label: "Note moyenne",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#51ffc1",
                borderColor: "#51ffc1",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "#51ffc1",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#51ffc1",
                pointHoverBorderColor: "#51ffc1",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: ord,
                spanGaps: false,
            }
        ]
    };


    var lineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        option: option
    });

}


function build_graph_movies_by_country(absx, ord) {

    var ctx = $("#movies-by-country");

    var option = {
        responsive: true,
        maintainAspectRatio: true
    };

    var data = {
        labels: absx,
        datasets: [
            {
                label: "Oeuvre",
                backgroundColor: "#1696ff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 2,

                data: ord,
            }
        ]
    };


    var lineChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        option: option
    });

}


//GRAPHIQUE NB ACTEUR HOMMES VS FEMMES
function get_nb_man_and_womman() {

    $('#loader_act').show();


    $.ajax({
        url: "statRequests.php?type=nb_man_and_women",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            var res = [];
            data.forEach(function (entry) {
                res.push(entry[1])
            });
            $('#loader_act').css("display", "none");
            build_graph_cmp_sex(res);
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });
}

//GRAPHIQUE DONUT COMPARAISON FILM SERIE EPISODE

function get_nb_movies_series_episodes() {
    $('#loader_oeuvres').show();

    $.ajax({
        url: "statRequests.php?type=nb_movies_series_episodes",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            var res = [];
            for (i = 0; i < (data[0].length); i++) {
                res.push(data[0][i])
            }
            $('#loader_oeuvres').css("display", "none");
            build_graph_nb_movies_series_epsiodes(res);
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });
}

//GRAPHIQUE BATONETS NB FILM EN FONCTION DU PAYS

function get_nb_movies_by_country() {
    $('#loader_movies_by_country').show();

    $.ajax({
        url: "statRequests.php?type=nb_movies_by_country",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            var absx = [];
            var ord = [];
            data.forEach(function (entry) {
                absx.push(entry[0])
                ord.push(entry[1])
            });
            $('#loader_movies_by_country').css("display", "none");
            build_graph_movies_by_country(absx.slice(0, 30), ord);
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });
}

//GRAPHIQUE NOTE MOYENNE EN FONCTION DU TEMPS

function get_notes_evolution() {
    $('#loader_note_evol').show();

    $.ajax({
        url: "statRequests.php?type=notes_evolution",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            var absx = [];
            var ord = [];
            data.forEach(function (entry) {
                absx.push(entry[0])
                ord.push(entry[1])
            });
            $('#loader_note_evol').css("display", "none");
            build_graph_notes_evolution(absx, ord);
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });
}

//GRAPHIQUE FILM SERIE EN FCT DU TEMPS

function get_nb_movies_between_2000_2016() {
    $('#loader_evol').show();

    $.ajax({
        url: "statRequests.php?type=nb_movies",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            fetch_movies_nb(data);
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });
}

function get_nb_series_between_2000_2016() {

    $.ajax({
        url: "statRequests.php?type=nb_series",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            fetch_series_nb(data);
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });
}

function fetch_movies_nb(data) {
    res_movie = [];
    data.forEach(function (entry) {
        res_movie.push(entry[1])
    });
    console.log(res_movie);

    $.ajax({
        url: "statRequests.php?type=nb_series",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            get_nb_series_between_2000_2016();
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });

}

function fetch_series_nb(data) {
    res_series = [];
    data.forEach(function (entry) {
        res_series.push(entry[1])
    });
    console.log(res_series)

    $.ajax({
        url: "statRequests.php?type=nb_series",
        dataType: 'json',
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            console.log("hey");
            $('#loader_evol').css("display", "none");

            build_graph_evolution(res_movie, res_series);
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });

}



