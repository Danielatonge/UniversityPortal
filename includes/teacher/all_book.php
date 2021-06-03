<!-- ---------- only 'teacher' can use this page ----------------> 
<?php if($_SESSION['role'] != 'teacher'):?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
        // if delete button is pressed (only an teacher can do this)
        if(isset($_GET['del'])) {
            if($_SESSION['role'] == 'teacher') {		
                $uid = mysqli_real_escape_string($con, $_GET['del']);
            
                $q = "DELETE FROM books WHERE book_id = $uid";
            
                $del_result = mysqli_query($con, $q);
                    
                $div_info   = confirmQuery($del_result, 'delete');
                $div_class 	= $div_info['div_class'];
                $div_msg 	= $div_info['div_msg'];
            }
        }
?>	

<?php
	// display an alert message from result of $_GET or $_POST;
	// this row is not displayed if both $_GET and $_POST are not set
	if(isset($div_msg)):?>
        <div class="col-md-12">
            <div class="alert alert-<?php echo $div_class;?>">
                <?php echo $div_msg;?>
            </div>
        </div>
<?php endif; ?>


    
    <div class="section-top-border col-lg-12 col-md-12">
    <a href="teacher-books.php?source=add_book" 
    class="genric-btn primary radius mb-10" role="button">Add Book</a>
        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">#</div>
                    <div class="visit">Title</div>
                    <div class="visit">Book Cover</div>
                    <div class="visit">Book</div>
                    <div class="visit">Author</div>
                    <div class="visit">Content</div>
                    <div class="country">Actions</div>
                </div>
                <?php
                    $q =    "SELECT * FROM books";

                    $books = mysqli_query($con, $q);
                ?>
                <?php foreach($books as $book):?>

                <div class="table-row">
                    <div class="serial"><?php echo $book['book_id'];?></div>
                    <div class="visit"><?php echo $book['book_title'];?></div>
                    <div class="visit"><?php echo $book['book_preview'];?></div>
                    <div class="visit"><?php echo $book['book'];?></div>
                    <div class="visit"><?php echo $book['book_author'];?></div>
                    <div class="visit"><?php echo $book['book_note'];?></div>
                    <div class="country">
                        <a href="teacher-books.php?source=edit_book&id=<?php echo $book['book_id'];?>" 
                        class="genric-btn primary circle small" role="button">Edit
                        </a>
                        <hr>
                        <a onclick="return confirm('Are you sure you want to delete this book?');" 
                        href="teacher-books.php?del=<?php echo $book['book_id'];?>" class="genric-btn danger circle small" role="button">
                        Delete
                        </a>
                    </div>
                </div>
                
                <?php endforeach;?>

            </div>
        </div>
    </div>

<?php endif; ?>
