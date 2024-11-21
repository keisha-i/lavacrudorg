<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Update</h2>
                <?php flash_alert(); ?>
                
                <!-- Form Container -->
                <div class="card shadow-sm p-4">
                    <form id="updateForm">
                        <input type="hidden" id="user_id" name="user_id" value="<?=$ui['id'];?>">
                        <div class="mb-3">
                            <label for="lastname">Last Name:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?=$ui['kjur_last_name'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="firstname">First Name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?=$ui['kjur_first_name'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?=$ui['kjur_email'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="gender">Gender:</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?=$ui['kjur_gender'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=$ui['kjur_address'];?>">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>

                <!-- Response Message Container -->
                <div id="responseMessage" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#updateForm').submit(function(e) {
                e.preventDefault(); // Prevent normal form submission

                // Get form data
                var formData = $(this).serialize();

                // Perform AJAX request
                $.ajax({
                    url: '<?=site_url('users/update/'.$ui['id']);?>', // Your controller method to handle the update
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response);
                        
                        // Show success or error message based on the response
                        if (data.status === 'success') {
                            $('#responseMessage').html('<div class="alert alert-success">User updated successfully!</div>');
                        } else {
                            $('#responseMessage').html('<div class="alert alert-danger">Error: ' + data.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#responseMessage').html('<div class="alert alert-danger">An error occurred. Please try again later.</div>');
                    }
                });
            });
        });
    </script>

</body>
</html>
