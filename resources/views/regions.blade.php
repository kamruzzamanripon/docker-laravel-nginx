<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Region Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        button {
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button.edit {
            background-color: #ffc107;
        }

        button.delete {
            background-color: #f44336;
        }

        form {
            margin-top: 20px;
        }

        form input {
            padding: 8px;
            margin-right: 10px;
            width: 300px;
        }

        form button {
            padding: 8px 15px;
            background-color: #007BFF;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Region Management</h1>
        <table id="region-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <h2>Add New Region</h2>
        <form id="add-region-form">
            <input type="text" id="new-region-name" placeholder="Region Name" required>
            <button type="submit">Add Region</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            const apiUrl = "https://localhost/api/regions";

            // Load all data
            function loadRegions() {
                $.get(apiUrl, function(data) {
                    const tbody = $("#region-table tbody");
                    tbody.empty();
                    // Nếu data là một chuỗi JSON, parse nó
                    if (typeof data === "string") {
                        data = JSON.parse(data);
                    }
                    data.forEach(region => {
                        tbody.append(`
                    <tr data-id="${region.region_id}">
                        <td>${region.region_id}</td>
                        <td>${region.region_name}</td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                `);
                    });
                });
            }

            loadRegions();

            // Add new region
            $("#add-region-form").submit(function(e) {
                e.preventDefault();
                const regionName = $("#new-region-name").val();

                $.ajax({
                    url: apiUrl,
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        region_name: regionName
                    }),
                    success: function() {
                        loadRegions();
                        $("#new-region-name").val("");
                    },
                });
            });

            // Edit region
            $("#region-table").on("click", ".edit", function() {
                const row = $(this).closest("tr");
                const regionId = row.data("id");
                const currentName = row.find("td:nth-child(2)").text();

                const newName = prompt("Edit Region Name:", currentName);
                if (newName) {
                    $.ajax({
                        url: `${apiUrl}/${regionId}`,
                        method: "PUT",
                        contentType: "application/json",
                        data: JSON.stringify({
                            region_name: newName
                        }),
                        success: function() {
                            loadRegions();
                        },
                    });
                }
            });

            // Delete region
            $("#region-table").on("click", ".delete", function() {
                const regionId = $(this).closest("tr").data("id");

                if (confirm("Are you sure you want to delete this region?")) {
                    $.ajax({
                        url: `${apiUrl}/${regionId}`,
                        method: "DELETE",
                        success: function() {
                            loadRegions();
                        },
                    });
                }
            });
        });
    </script>
</body>

</html>
