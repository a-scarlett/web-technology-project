<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM genre ORDER BY genre_id";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty genre ! Something wrong! check again";
		exit;
	}

	$title = "List Of genres";
	require "./template/header.php";
?>
	<hr>
	<div class="list-group">
		<a class="list-group-item list-group-item-action" href="books.php">
			All Books
		</a>
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT genre_id FROM books";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			while ($pubInBook = mysqli_fetch_assoc($result2)){
				if($pubInBook['genre_id'] == $row['genre_id']){
					$count++;
				}
			}
	?>
		<a class="list-group-item list-group-item-action" href="bookPerGenre.php?pubid=<?php echo $row['genre_id']; ?>">
			<span class="badge badge-primary bg-primary rounded-pill"><?php echo $count; ?></span>
			<?php echo $row['genre_name']; ?>
		</a>
	<?php } ?>
	</div>
<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>