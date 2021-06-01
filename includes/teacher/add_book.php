<!-- only 'Admin' can access this page -->
<?php if($_SESSION['role'] != 'preview'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add book' is submitted -------------------
            if(isset($_POST['add_book_submit'])) {
                // get all input data
                $book_title				= mysqli_real_escape_string($con, $_POST['book_title']);
                $book_preview           = mysqli_real_escape_string($con, $_POST['book_preview']);
                $book                   = mysqli_real_escape_string($con, $_POST['book']);
                $book_author            = mysqli_real_escape_string($con, $_POST['book_author']);
                $book_content            = mysqli_real_escape_string($con, $_POST['book_message']);
                
                
                // check if booktitle is already in use in the books table
                $q = "SELECT books.book_title FROM books 
                            WHERE book_title = '$book_title'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($book_title) || empty($book_preview) || empty($book) || empty($book_author) || empty($book_content) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that booktitle is already in use. Please choose another.';
                } else { 
                    
                    $q = "INSERT INTO books
                            (book_title, book_preview)
                            VALUES ('$book_title', '$book_preview')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $book_title = '';
                    $book_preview = '';
                }
            // start with a blank form
            } else {
                $book_title = '';
                $book_preview = '';
            }
?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Add book</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mt-10" title="book_title" placeholder="book title"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'book title'" value="<?php echo $book_title; ?>">
                <input type="text" class="form-control mt-10" title="book_preview" placeholder="book Instructor"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'book Instructor'" value="<?php echo $book_preview; ?>">
                <button type="submit" title="add_book_submit" class="primary-btn text-uppercase mt-10">Add</button>
                <a href="admin-books.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'Admin' can access this page -->