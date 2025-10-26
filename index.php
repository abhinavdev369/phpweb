<?php

require_once 'db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Roster</title>
 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color:#f4f4f4;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color:#fff;
            box-shadow: 0 2px 4pxrgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid#ddd;
            text-align: left;
        }
        th {
            background-color:#007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color:#f9f9f9;
        }
        .action-links a {
            color:#007BFF;
            text-decoration: none;
            margin-right: 10px;
        }
        .action-links a.delete {
            color:#DC3545;
        }
        .add-link {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color:#28A745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1>Student Roster</h1>

    <a href="create.php" class="add-link">Add New Student</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Enrollment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // SQL query to select all students
            $sql = "SELECT id, first_name, last_name, email, enrollment_date FROM students";
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Loop through each row and display the data
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['enrollment_date']) . "</td>";
                    echo "<td class='action-links'>";
                    echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a>";
                    /
                    echo "<a href='delete.php?id=" . $row['id'] . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // If no records are found
                echo "<tr><td colspan='6' style='text-align:center;'>No students found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>
