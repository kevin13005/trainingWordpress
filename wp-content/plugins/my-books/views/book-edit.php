<?php wp_enqueue_media(); ?>
<?php
$book_id = isset($_GET['edit'])? intval($_GET['edit']): 0;
global $wpdb;
$book_detail = $wpdb->get_row(
  $wpdb->prepare(
    "SELECT * FROM " .my_book_table()." WHERE id = %d ", $book_id
  ),ARRAY_A
)
?>

<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <h5>Book update page</h5>
        </div>
        <div class="card">
            <div class="card-header bg-danger">update book</div>
            <div class="card-body">
            <form class="form-horizontal" action="/javascript:void(0)" id="frmEditBook">
    <input type="hidden" name="book-id" value="<?php echo isset($_GET['edit'])? intval($_GET['edit']): 0; ?>"/>
    <div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $book_detail['name']; ?>" class="form-control" required id="name" placeholder="Enter name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="author">Author:</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $book_detail['author']; ?>" class="form-control" required id="author" name="author" placeholder="Enter author">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="about">About:</label>
    <div class="col-sm-10">
      <textarea name="about" id="about" placeholder="enter about" class="form-control">value="<?php echo $book_detail['about']; ?>"</textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="upload">upload book image:</label>
    <div class="col-sm-10">
      <input type="button" id="btn-upload" class="btn btn-info" value="upload image">
      <span id="show-image">
        <img src="<?php echo $book_detail['book_image'] ?>" style="height:50px;width:50px;"/>
      </span>
      <input type="hidden" id="image-name" name="image-name" value="<?php echo $book_detail['book_image'] ?>"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger">update</button>
    </div>
  </div>
</form>
            </div>
        </div>
    </div>
</div>