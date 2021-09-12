<?php
global $wpdb;
$allstudents = $wpdb->get_results(
    $wpdb->prepare(
        " SELECT * FROM " .my_students_table(). " ORDER BY id desc ", ""
    )
);
?>

<div class="container">
    <div class="row">
    <div class="alert alert-info">
        <h5>my student list</h5>
    </div>
    <div class="card">
        <div class="card-header bg-danger">my student lists</div>
        <div class="card-body">
        <table id="my-book" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           <?php
           if(count($allstudents) > 0){
            $i = 1;
            foreach($allstudents as $key=>$value){
                $userdetails = get_userdata($value->user_login_id); 
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->email; ?></td>
                <td><?php echo $userdetails->user_login; ?></td>
                <td><?php echo $value->created_at; ?></td>
                <td>
                    <button class="btn btn-danger">delete</button>
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