<!DOCTYPE html>
<html lang="en">
<head>
    <title>Movie Search App</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .movie-container { display: flex; flex-wrap: wrap; justify-content: center; }
        .movie { margin: 15px; padding: 10px; border: 1px solid #ddd; width: 200px; cursor: pointer; }
        img { width: 100%; }
    </style>
</head>
<body>
    <h1>Movie Search</h1>
    <input type="text" id="search" placeholder="Enter movie title">
    <button onclick="searchMovies()">Search</button>

    <div class="movie-container" id="movieList"></div>

    <script>
        function searchMovies() {
            const apiKey = "a31e53e7";
            const searchTerm = document.getElementById("search").value;
            const url = `http://www.omdbapi.com/?apikey=${apiKey}&s=${searchTerm}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let movies = data.Search;
                    let output = "";
                    if (movies) {
                        movies.forEach(movie => {
                            output += `
                                <div class="movie" onclick="getMovieDetails('${movie.imdbID}')">
                                    <img src="${movie.Poster}" alt="${movie.Title}">
                                    <h4>${movie.Title} (${movie.Year})</h4>
                                </div>
                            `;
                        });
                    } else {
                        output = "<p>No movies found!</p>";
                    }
                    document.getElementById("movieList").innerHTML = output;
                });
        }

        function getMovieDetails(imdbID) {
            const apiKey = "a31e53e7";
            const url = `http://www.omdbapi.com/?apikey=${apiKey}&i=${imdbID}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    alert(`
                        Title: ${data.Title}
                        Year: ${data.Year}
                        Genre: ${data.Genre}
                        Director: ${data.Director}
                        Plot: ${data.Plot}
                    `);
                });
        }
    </script>
</body>
</html>
