<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-3">
        <h2>Add User</h2>
        <!-- Flash messages will be dynamically updated -->
        <div id="flash-alert"></div>

        <!-- Form for adding a new user -->
        <form id="add-user-form">
            <div class="mb-3 mt-3">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="gender">Gender:</label>
                <input type="text" class="form-control" id="gender" name="gender" required>
            </div>
            <div class="mb-3">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-warning">Add</button>
            <a class="btn btn-success mb-0.5" role="button" href="<?= site_url('users/read'); ?>">Show Users</a>
        </form>
    </div> 

    <script>
        $(document).ready(function () {
            // Handle form submission via AJAX
            $('#add-user-form').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                
                // Serialize form data
                const formData = $(this).serialize();

                // Send AJAX POST request to the create endpoint
                $.ajax({
                    url: '<?= site_url("/users/create"); ?>', // Replace with your controller endpoint
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            // Display success message
                            $('#flash-alert').html(`
                                <div class="alert alert-success">${res.message}</div>
                            `);
                            // Clear the form fields
                            $('#add-user-form')[0].reset();
                        } else {
                            // Display error message
                            $('#flash-alert').html(`
                                <div class="alert alert-danger">${res.message}</div>
                            `);
                        }
                    },
                    error: function () {
                        // Display generic error message
                        $('#flash-alert').html(`
                            <div class="alert alert-danger">An error occurred while adding the user. Please try again.</div>
                        `);
                    }
                });
            });
        });
    </script>
</body>
</html>