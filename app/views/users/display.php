<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        body {
        background-color: #f8f9fa; 
        }
        table.dataTable {
            width: 100% !important;
        }
        .dataTables_filter {
            margin-bottom: 20px;
        }
        table.dataTable tbody td {
            padding: 15px 10px;
        }
    </style>
</head>

<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reyes_keziah";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, kjur_last_name, kjur_first_name, kjur_email, kjur_gender, kjur_address FROM kjur_users";
    $result = $conn->query($sql);
?>

<body>

   <div class="container mt-3">
        <div class="row">
            <div class="col-md-12"> 
                <h4><?=$name;?></h4>
                <a class="btn btn-warning mb-2" role="button" href="<?=site_url('users/add');?>">Add User</a>
                <?php flash_alert(); ?>
                
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $u): ?>
                        <tr>
                            <td><?=$u['id'];?></td>
                            <td><?=$u['kjur_last_name'];?></td>
                            <td><?=$u['kjur_first_name'];?></td>
                            <td><?=$u['kjur_email'];?></td>
                            <td><?=$u['kjur_gender'];?></td>
                            <td><?=$u['kjur_address'];?></td>
                            <td>
                                <a href="<?=site_url('users/update/'.$u['id']);?>" class="btn btn-success btn-sm">Update</a>
                                <a href="<?=site_url('users/delete/'.$u['id']);?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
   </div>

   <script>
       $(document).ready(function() {
           $('#myTable').DataTable({
               "pageLength": 10 
           });
       });
   </script>

</body>
</html>
