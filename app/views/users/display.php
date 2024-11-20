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
                    <tbody id="userTableBody">
                        <!-- Data will be inserted here dynamically via AJAX -->
                    </tbody>
                </table>

                <div id="pagination"></div>
            </div>
        </div>
   </div>

   <script>
$(document).ready(function() {
    // Function to fetch users with pagination
    function fetchUsers(page = 1, limit = 10) {
        $.ajax({
            url: "your_controller_method_url_here", // Replace with your controller method URL
            method: "GET",
            data: {
                page: page,
                limit: limit
            },
            success: function(data) {
                let users = data.users;
                let totalPages = data.totalPages;
                let currentPage = data.currentPage;
                
                // Clear the existing table rows
                let html = '';
                $.each(users, function(index, user) {
                    html += '<tr>';
                    html += '<td>' + user.id + '</td>';
                    html += '<td>' + user.kjur_last_name + '</td>';
                    html += '<td>' + user.kjur_first_name + '</td>';
                    html += '<td>' + user.kjur_email + '</td>';
                    html += '<td>' + user.kjur_gender + '</td>';
                    html += '<td>' + user.kjur_address + '</td>';
                    html += '<td>';
                    html += '<a href="update_url_here" class="btn btn-success btn-sm">Update</a>';
                    html += '<a href="delete_url_here" class="btn btn-danger btn-sm">Delete</a>';
                    html += '</td>';
                    html += '</tr>';
                });

                // Update the table with new rows
                $('#myTable tbody').html(html);

                // Update pagination links
                updatePagination(currentPage, totalPages);
            }
        });
    }

    // Function to update the pagination links
    function updatePagination(currentPage, totalPages) {
        let paginationHtml = '';
        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += '<a class="page-link" data-page="' + i + '" href="#">' + i + '</a> ';
        }

        // Update pagination container (adjust this based on your HTML structure)
        $('#pagination').html(paginationHtml);
    }

    // Initial fetch of users
    fetchUsers();

    // Handle pagination (e.g., when a page number is clicked)
    $('#pagination').on('click', 'a', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        fetchUsers(page);
    });
});
</script>

</body>
</html>