
<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <h5>Author add page</h5>
        </div>
        <div class="card">
            <div class="card-header bg-danger">add new Author</div>
            <div class="card-body">
            <form class="form-horizontal" action="/javascript:void(0)" id="frmAddauthor">
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" required id="name" name="name" placeholder="Enter name">
        </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="fb_link">fb_link:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" required id="fb_link" name="fb_link" placeholder="Enter facebook url">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="about">About:</label>
    <div class="col-sm-10">
      <textarea name="about" id="about" placeholder="enter about" class="form-control"></textarea>
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