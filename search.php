<?php
session_start();
$title = "Search Results";
require_once "./template/header.php";
require_once "./functions/database_functions.php";

// Get the search query from the form submission
if (isset($_GET["q"])) {
    $search_query = $_GET["q"];
    $conn = db_connect();

    // Perform the search in the database
    $query = "SELECT * FROM books WHERE book_title LIKE '%$search_query%' OR book_author LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);

    // Check if any results were found
    if (mysqli_num_rows($result) > 0) {
        // Display the search results in a table
        ?>
        <div class="container mt-4">
            <h2>Search Results for "<?php echo $search_query; ?>"</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($book = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $book['book_title']; ?></td>
                        <td><?php echo $book['book_author']; ?></td>
                        <td><?php echo "$" . $book['book_price']; ?></td>
                        <td>
                            <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>" class="btn btn-primary btn-sm">View Details</a>
                            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
                                <form action="cart.php" method="post" style="display: inline;">
                                    <input type="hidden" name="bookisbn" value="<?php echo $book['book_isbn']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm" name="cart">Add to Cart</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        // No results found
        ?>
        <div class="container mt-4">
            <h2>No results found for "<?php echo $search_query; ?>"</h2>
        </div>
        <?php
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If no search query is provided, redirect to the home page
    header("Location: index.php");
    exit;
}

require_once "./template/footer.php";
?>
