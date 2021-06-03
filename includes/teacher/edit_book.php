<!-- only 'teacher' can access this page -->
<?php if($_SESSION['role'] != 'teacher'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add book' is submitted -------------------
            if(isset($_POST['edit_book_submit'])) {
                // get all input data
                $book_id = $_POST['book_id'];
                $book_title				= mysqli_real_escape_string($con, $_POST['book_title']);
                $book_preview           = $_FILES['book_preview']['name'];
                $book                   = $_FILES['book']['name'];
                $book_author            = mysqli_real_escape_string($con, $_POST['book_author']);
                $book_note            = mysqli_real_escape_string($con, $_POST['book_note']);
                
                // check if booktitle is already in use in the books table
                $q = "SELECT books.book_title FROM books 
                            WHERE book_title = '$book_title'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($book_title) || empty($book_preview) || empty($book) || empty($book_author) || empty($book_note) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that booktitle is already in use. Please choose another.';
                } else { 
                    if($book_preview != "" && $book != "") { 
                        $prev_tmp = $_FILES['book_preview']['tmp_name'];
                        $book_tmp = $_FILES['book']['tmp_name'];
                        move_uploaded_file($prev_tmp, "img/$book_preview");
                        move_uploaded_file($book_tmp, "img/$book");
                    }
                    $q = "UPDATE books SET book_title = '$book_title', book_preview = '$book_preview', book = '$book', 
                        book_author = '$book_author', book_note = '$book_note' WHERE book_id = $book_id";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'update');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $book_title = '';
                    $book_author = '';
                    $book_note = '';
                }
            }
?>
        <?php
            // ---------- if there is a book to be edited from $_GET -------------
            if(isset($_GET['id'])) {

                $edit_book_id = mysqli_real_escape_string($con, $_GET['id']);
                
                $q = "SELECT * FROM books WHERE book_id = $edit_book_id";
                $result = mysqli_query($con, $q);
                $edit_book = mysqli_fetch_array($result);
                
                // this is a special case, so it does not book confirmQuery()
                // $div_msg may already exist, so don't overwrite it
                if(!$edit_book) {
                    $div_class = "danger";
                    $div_msg = "Database failed: ".mysqli_error($con);
                } elseif(empty($div_msg)) {
                    $div_class = "success";
                    $div_msg = 'book ready for edit.';
                }
            }
            
        ?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Edit book</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="book_id" value="<?php echo $edit_book['book_id'];?>">
                <div class="mt-10">
                    <input type="text" name="book_title" placeholder="Book Title"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Book Title'" required
                        class="single-input" value="<?php echo $edit_book['book_title']; ?>">
                </div>
                <div class="mt-10">
                    <input type="file" name="book_preview" placeholder="Picture Preview"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Picture Preview'"
                        required class="single-input">
                </div>
                <div class="mt-10">
                    <input type="file" name="book" placeholder="Book" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Book'" required class="single-input">
                </div>
                <div class="mt-10">
                    <input type="text" name="book_author" placeholder="Author"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Author'" required
                        class="single-input" value="<?php echo $edit_book['book_author']; ?>">
                </div>

                <div class="mt-10">
                    <textarea class="single-textarea" name="book_note" placeholder="Message" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Message'" required> <?php echo $edit_book['book_note']; ?></textarea>
                </div>
                <button type="submit" name="edit_book_submit" class="primary-btn text-uppercase mt-10">Update</button>
                <a href="teacher-books.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'Teachers' can access this page -->