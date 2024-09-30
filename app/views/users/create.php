<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <h2>Add User</h2>
        <?php flash_alert(); ?>
        <form action="<?=site_url('/users/add');?>" method="POST">
            <div class="mb-3 mt-3">
            <label for="lastname">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
            <div class="mb-3">
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
            <div class="mb-3">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
            <label for="gender">Gender:</label>
            <input type="text" class="form-control" id="gender" name="gender">
            </div>
            <div class="mb-3">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <a class="btn btn-primary mb-0.5" role="button" href="<?=site_url('users/read');?>">Show Users</a>
        </form>
    </div> 
</body>
</html>