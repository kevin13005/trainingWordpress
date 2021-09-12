
<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <h5>Student add page</h5>
        </div>
        <div class="card">
            <div class="card-header bg-danger">add new Student</div>
            <div class="card-body">
            <form class="form-horizontal" action="/javascript:void(0)" id="frmAddstudent">
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" required id="name" name="name" placeholder="Enter name">
        </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">email :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" required id="email" name="email" placeholder="Enter email">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-10">
      <textarea name="username" required id="username" placeholder="enter username" class="form-control"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="password">Password:</label>
    <div class="col-sm-10">
      <textarea name="password" required id="password" placeholder="enter password" class="form-control"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="conf_password">Confirmation Password:</label>
    <div class="col-sm-10">
      <textarea name="conf_password" required id="conf_password" placeholder="enter confirm password" class="form-control"></textarea>
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