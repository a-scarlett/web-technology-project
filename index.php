<?php
session_start();
$count = 0;
// Connect to the database

$title = "Home";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
$conn = db_connect();

// Function to retrieve the latest books from the database
function getLatestBooks($conn) {
    $query = "SELECT * FROM books ORDER BY created_at DESC LIMIT 9";
    $result = mysqli_query($conn, $query);
    $latest_books = array();

    while ($book = mysqli_fetch_assoc($result)) {
        $latest_books[] = $book;
    }

    return $latest_books;
}

// Function to retrieve the latest books for each genre from the database
function getLatestBooksBygenre($conn) {
    $query = "SELECT DISTINCT genre_id FROM books";
    $result = mysqli_query($conn, $query);
    $latest_books_by_genre = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $genre_id = $row['genre_id'];
            $query = "SELECT * FROM books WHERE genre_id = '$genre_id' ORDER BY created_at DESC LIMIT 12";
            $books_result = mysqli_query($conn, $query);
            $books = array();

            while ($book = mysqli_fetch_assoc($books_result)) {
                $books[] = $book;
            }

            $latest_books_by_genre[$genre_id] = $books;
        }
    }

    return $latest_books_by_genre;
}

$latest_books = getLatestBooks($conn);
$latest_books_by_genre = getLatestBooksBygenre($conn);
?>

<!-- Display the carousel of latest books -->
<div class="lead text-center text-dark fw-bolder mt-4 h4">Latest books</div>
<center>
    <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
</center>
<div class="row">
    <div class="col-12">
        <div id="latest-books-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($latest_books as $index => $book) { ?>
                    <?php if ($index % 4 === 0) { ?>
                        <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                        <div class="row">000000000
                    <?php } ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 py-2 mb-2">
                        <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>" class="card rounded-0 shadow book-item text-reset text-decoration-none">
                            <div class="img-holder overflow-hidden">
                                <img class="img-top" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
                            </div>
                            <div class="card-body">
                                <div class="card-title fw-bolder h5 text-center"><?= $book['book_title'] ?></div>
                            </div>
                        </a>
                    </div>
                    <?php if ($index % 4 === 3) { ?>
                        </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#latest-books-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#latest-books-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<!-- Display a carousel for each genre --><?php foreach ($latest_books_by_genre as $genre_id => $books) { ?>
    <?php if (count($books) > 0) { ?>
        <div class="lead text-center text-dark fw-bolder h4 mt-4"><?php echo getPubName($conn, $genre_id); ?></div>
        <center>
            <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
        </center>
        <div class="row">
            <?php foreach ($books as $book) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 py-2 mb-2">
                    <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>" class="card rounded-0 shadow book-item text-reset text-decoration-none">
                        <div class="img-holder overflow-hidden">
                            <img class="img-top" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
                        </div>
                        <div class="card-body">
                            <div class="card-title fw-bolder h5 text-center"><?= $book['book_title'] ?></div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>

<?php
if (isset($conn)) { mysqli_close($conn); }
require_once "./template/footer.php";
?>
