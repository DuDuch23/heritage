const reg = /[\d]+/g;

// Section Album
let displayAlbum = true;
const btnAlbum = document.getElementById('btn-album');
const tableauAlbum = document.getElementById('album');

btnAlbum.addEventListener('click', function () {
    if(displayAlbum)
    {
        tableauAlbum.style.display = "none";
        displayAlbum = false;
    }
    else{
        tableauAlbum.style.display = "table";
        displayAlbum = true;
    }
})

$(document).ready(function() {
    $('.btn-delete-album').on('click', function() {
        const album = $(this).closest('.data-album');
        const albumId = album.data('id');

        $.ajax({
            url: '/album/deleteAlbum.php',
            type: 'GET',
            data: { id: albumId },
            success: function(response) {
                album.find('.resultat-action').html(response);

                if (response.includes("Album supprimé avec succès"))
                {
                    album.remove();
                }
            },
            error: function() {
                album.find('.resultat-action').html("Une erreur est survenue lors de la suppression");
            }
        });
    });
});

// Section Movie
let displayFilm = true;
const btnFilm = document.getElementById('btn-film');
const tableauFilm = document.getElementById('film');

btnFilm.addEventListener('click', function () {
    if(displayFilm)
    {
        tableauFilm.style.display = "none";
        displayFilm = false;
    }
    else{
        tableauFilm.style.display = "table";
        displayFilm = true;
    }
})

$(document).ready(function() {
    $('.btn-delete-movie').on('click', function() {
        const movie = $(this).closest('.data-movie');
        const movieId = movie.data('id');

        $.ajax({
            url: '/movie/deleteMovie.php',
            type: 'GET',
            data: { id: movieId },
            success: function(response) {
                movie.find('.resultat-action').html(response);

                if (response.includes("Film supprimé avec succès"))
                {
                    movie.remove();
                }
            },
            error: function() {
                movie.find('.resultat-action').html("Une erreur est survenue lors de la suppression");
            }
        });
    });
});

// Section Book
let displayBook = true;
const btnLivre = document.getElementById('btn-livre');
const tableauLivre = document.getElementById('livre');

btnLivre.addEventListener('click', function () {
    if(displayBook)
    {
        tableauLivre.style.display = "none";
        displayBook = false;
    }
    else{
        tableauLivre.style.display = "table";
        displayBook = true;
    }
})

$(document).ready(function() {
    $('.btn-delete-book').on('click', function() {
        const book = $(this).closest('.data-book');
        const bookId = book.data('id');

        $.ajax({
            url: '/book/deleteBook.php',
            type: 'GET',
            data: { id: bookId },
            success: function(response) {
                book.find('.resultat-action').html(response);

                if (response.includes("Livre supprimé avec succès"))
                {
                    book.remove();
                }
            },
            error: function() {
                book.find('.resultat-action').html("Une erreur est survenue lors de la suppression");
            }
        });
    });
});