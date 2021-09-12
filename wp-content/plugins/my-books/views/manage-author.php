<?php
global $wpdb;
$getallAuthors = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM " .my_authors_table(). " ORDER BY id DESC ", ""
    )
);  
?>

<div class="container">
    <div class="row">
    <div class="alert alert-info">
        <h5>my author list</h5>
    </div>
    <div class="card">
        <div class="card-header bg-danger">my author lists</div>
        <div class="card-body">
        <table id="my-book" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Fb Link</th>
                <th>About</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(count($getallAuthors) > 0){
            $i = 1;
            foreach($getallAuthors as $key=>$value){
        ?>
        <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $value->name; ?></td>
        <td><?php echo $value->fb_link; ?></td>
        <td><?php echo $value->about; ?></td>
        <td><?php echo $value->created_at; ?></td>
        <td>
            <button class=" btn btn-danger">delete</button>
        </td>
        </tr>
        <?php 
            }
        }
        ?>
        </tbody>
    </table>
        </div>
    </div>
    </div>
</div>