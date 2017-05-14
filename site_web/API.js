function getImagesMovie(title, date) {
    theMovieDb.search.getMovie({"query": encodeURI(title), "year": date}, function (data) {
        data = JSON.parse(data); // parse the data
        const data_ok = data['results'];
        const posterPath = "https://image.tmdb.org/t/p/w500" + data_ok[0]["poster_path"];
        const backDropPath = "https://image.tmdb.org/t/p/w1000" + data_ok[0]["backdrop_path"];

        if (data_ok[0]["poster_path"] != null) {
            $('.poster').attr('src', posterPath);
            $('.poster').css("height", 600);
            $('.poster').css("width", 'auto');


        }
        if (data_ok[0]["backdrop_path"] != null) {
            const path = 'linear-gradient(to bottom, rgba(0,0,0,0.9) 0%,rgba(0,0,0,0.6) 100%), url(' + backDropPath + ')';
            $("header").css("background-image", path);
        }

    }, function (error) {
    })
}

function getTrailersMovie(title, date) {
    theMovieDb.search.getMovie({"query": encodeURI(title), "year": date}, function(data) {
        data = JSON.parse(data); //parse the data
        const id = data["results"][0]["id"];
        theMovieDb.movies.getTrailers({"id": id}, function(datat){
            data = JSON.parse(datat); //parse the data
            const videoPath = "https://www.youtube.com/embed/"+ data["youtube"][0]["source"]+"?controls=1";
            if (data["youtube"][0]["source"] != null) {
                $("iframe").attr("src", videoPath);
                $("iframe").attr("height", '500');
                $("iframe").attr("width", "800");
                $("iframe").attr("align", "middle");
            }
        }, function (error) {})
    }, function (error) {
    })
}

function getImagesTvShow(title, date) {
    theMovieDb.search.getTv({"query": encodeURI(title), "year": date}, function (data) {
        data = JSON.parse(data); // parse the data
        const data_ok = data['results'];
        const posterPath = "https://image.tmdb.org/t/p/w500" + data_ok[0]["poster_path"];
        const backDropPath = "https://image.tmdb.org/t/p/w1000" + data_ok[0]["backdrop_path"];

        if (data_ok[0]["poster_path"] != null) {
            $('.poster').attr('src', posterPath);
            $('.poster').css("height", 600);
            $('.poster').css("width", 'auto');


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
        if (data_ok[0]["profile_path"] != null) {
            const profilePic = "https://image.tmdb.org/t/p/w500" + data_ok[0]["profile_path"];
            $('.profil_pic').attr('src', profilePic);
            $(".profil_pic").css("height", 300);
            $(".profil_pic").css("width", 'auto');
        }

    }, function (error) {
    })

}


