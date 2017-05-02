function getImagesFromAPI(title, date) {
    theMovieDb.search.getMovie({"query": encodeURI(title), "year": date}, function (data) {
        data = JSON.parse(data); // parse the data
        const data_ok = data['results'];
        const posterPath = "https://image.tmdb.org/t/p/w500" + data_ok[0]["poster_path"];
        const backDropPath = "https://image.tmdb.org/t/p/w1000" + data_ok[0]["backdrop_path"];

        $('img').attr('src', posterPath);
        $('header').css("background-image", backDropPath);
        console.log(posterPath)
        console.log(backDropPath)

    }, function (error) {
    })
}
