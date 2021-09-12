<?php wp_enqueue_media(); ?>

<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <h5>Book add page</h5>
        </div>
        <div class="card">
            <div class="card-header bg-danger">add new book</div>
            <div class="card-body">
            <form class="form-horizontal" action="/javascript:void(0)" id="frmAddBook">
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" required id="name" name="name" placeholder="Enter name">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="author">Author:</label>
    <div class="col-sm-10">
      <select class="form-control" id="author" name="author" >
        <option value="-1">-- choose un author --</option>
        
        <?php
        global $wpdb;
        $getallAuthors = $wpdb->get_results(
        $wpdb->prepare(
        "SELECT * FROM " .my_authors_table(). " ORDER BY id DESC ", ""
        )
        );  

        foreach ($getallAuthors as $index=>$authors){
        ?>
          <option value="<?php echo $authors->id; ?>"><?php echo $authors->name; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="about">About:</label>
    <div class="col-sm-10">
      <textarea name="about" id="about" placeholder="enter about" class="form-control"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="upload">upload book image:</label>
    <div class="col-sm-10">
      <input type="button" id="btn-upload" class="btn btn-info" value="upload image">
      <span id="show-image"></span>
      <input type="hidden" id="image-name" name="image-name"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger">Submit</button>
    </div>
  </div>
</form>
            </div>
        </div>
    </div>
</div>