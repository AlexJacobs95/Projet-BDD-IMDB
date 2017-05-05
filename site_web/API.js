function getImagesMovie(title, date) {
    theMovieDb.search.getMovie({"query": encodeURI(title), "year": date}, function (data) {
        data = JSON.parse(data); // parse the data
        const data_ok = data['results'];
        console.log(data);
        const posterPath = "https://image.tmdb.org/t/p/w500" + data_ok[0]["poster_path"];
        const backDropPath = "https://image.tmdb.org/t/p/w1000" + data_ok[0]["backdrop_path"];

        if (data_ok[0]["poster_path"] != null) {
            $('img').attr('src', posterPath);
            $("img").css("height", 600);
            $("img").css("width", 'auto');

            const path = 'linear-gradient(to bottom, rgba(0,0,0,0.9) 0%,rgba(0,0,0,0.6) 100%), url(' + backDropPath + ')';
            $("header").css("background-image", path);
        }

    }, function (error) {
    })
}

function getTrailersMovie(title, date) {
    theMovieDb.search.getTrailers({"query": encodeURI(title), "year": date}, function(data) {
        data = JSON.parse(data); //parse the data
        const data_ok = data["results"];
        console.log(data);
        const videoPath = "https://www.youtube.com/embed/"+ data_ok["key"]+"?controls=1";
        if (data_ok[0]["key"] != null) {
            //mettre dans la page
        }
    }, function (error) {
    })
}

function getImagesTvShow(title, date) {
    theMovieDb.search.getTv({"query": encodeURI(title), "year": date}, function (data) {
        data = JSON.parse(data); // parse the data
        const data_ok = data['results'];
        const posterPath = "https://image.tmdb.org/t/p/w500" + data_ok[0]["poster_path"];
        const backDropPath = "https://image.tmdb.org/t/p/w1000" + data_ok[0]["backdrop_path"];
        console.log(backDropPath);
        console.log(data_ok[0]["poster_path"]);

        if (data_ok[0]["poster_path"] != null) {
            $('img').attr('src', posterPath);
            $("img").css("height", 600);
            $("img").css("width", 'auto');


        } if (data_ok[0]["backdrop_path"] != null) {
            const path = 'linear-gradient(to bottom, rgba(0,0,0,0.9) 0%,rgba(0,0,0,0.6) 100%), url(' + backDropPath + ')';
            $("header").css("background-image", path);
        }


    }, function (error) {
    })
}

function getPersonPic(firstname, lastname) {
    theMovieDb.search.getPerson({"query": encodeURI(firstname + ' ' + lastname)}, function (data) {
        data = JSON.parse(data); // parse the data
        const data_ok = data['results'];
        console.log(data_ok)
        if (data_ok[0]["profile_path"] != null) {
            const profilePic = "https://image.tmdb.org/t/p/w500" + data_ok[0]["profile_path"];
            $('img').attr('src', profilePic);
            $("img").css("height", 600);
            $("img").css("width", 'auto');
        }

    }, function (error) {
    })

}