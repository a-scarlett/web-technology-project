<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "List book";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
?>
    <div class="mt-4">
        <h4 class="fw-bolder text-center">Book List</h4>
    </div>
	<center>
	<hr class="bg-warning" style="width:5em;height:3px;opacity:1">
	</center>
	<?php if(isset($_SESSION['book_success'])): ?>
		<div class="alert alert-success rounded-0">
			<?= $_SESSION['book_success'] ?>
		</div>
	<?php 
		unset($_SESSION['book_success']);
		endif;
	?>
	<div class="card rounded-0">
		<div class="card-body">
			<div class="container-fluid">
                <!-- Add Book Button -->
                <div class="text-center my-3">
                    <a href="admin_add_book.php" class="btn btn-primary">Add New Book</a>
                </div>
				<table class="table table-striped table-bordered" >
					<thead>
					<tr>
						<th>ISBN</th>
						<th>Title</th>
						<th>Author</th>
						<th>Description</th>
						<th>Price</th>
						<th>Genre</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php while($row = mysqli_fetch_assoc($result)){ ?>
					<tr>
						<td class="px-2 py-1 align-middle"><?php echo $row['book_isbn']; ?></td>
						<td class="px-2 py-1 align-middle"><a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>" target="_blank"><?php echo $row['book_title']; ?></a></td>
						<td class="px-2 py-1 align-middle"><?php echo $row['book_author']; ?></td>
						<td class="px-2 py-1 align-middle"><p class="text-truncate" style="width:15em"><?php echo $row['book_descr']; ?></p></td>
						<td class="px-2 py-1 align-middle"><?php echo $row['book_price']; ?></td>
						<td class="px-2 py-1 align-middle"><?php echo getPubName($conn, $row['genre_id']); ?></td>
						<td class="px-2 py-1 align-middle text-center">
							<div class="btn-group btn-group-sm">
								<a href="admin_edit_book.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-sm rounded-0 btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
								<a href="admin_delete_book.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-sm rounded-0 btn-danger" title="Delete" onclick="if(confirm('Are you sure to delete this book?') === false) event.preventDefault()"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>