
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

</head>
<body>

<?php
//si on veut ajouter des bouts de code venant de add_shortcode()
//ailleurs que sur une page , on peu direct dans un fichier avec do_shortcode
echo do_shortcode("[custom-plugin]"); 
//pour ajouter avec des parametres dynamiquement 1ere methode
echo do_shortcode("[custom-plugin-parameter name='prevost' author='kevin']"); ?>
?>

<div class="container">
  <h2>Formulaire</h2>
  <form action="#" id="frmpostOtherPage">
    <div class="form-group">
      <label for="email">Name for other page:</label>
      <input type="text" class="form-control" id="txtname" placeholder="Enter Name" name="txtname">
    </div>
    <div class="form-group">
      <label for="pwd">Email for other page:</label>
      <input type="email" class="form-control" id="txtEmail" placeholder="Enter email" name="txtEmail">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
