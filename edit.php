<?php
require_once 'db_config.php';

$first_name = $last_name = $email = $enrollment_date = "";
$id = 0;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    if (empty(trim($_POST["first_name"]))) {
        $errors[] = "First name is required.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    if (empty(trim($_POST["last_name"]))) {
        $errors[] = "Last name is required.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    if (empty(trim($_POST["email"]))) {
        $errors[] = "Email is required.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    $enrollment_date = trim($_POST["enrollment_date"]);

    if (empty($errors)) {
        $sql = "UPDATE students SET first_name = ?, last_name = ?, email = ?, enrollment_date = ? WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssi", $param_first_name, $param_last_name, $param_email, $param_date, $param_id);

            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_date = $enrollment_date;
            $param_id = $id;

            if ($stmt->execute()) {
                header("location: index.php");
                exit();
            } else {
                if ($conn->errno == 1062) {
                    $errors[] = "This email address is already registered by another student.";
                } else {
                    $errors[] = "Something went wrong. Please try again later.";
                }
            }
            
            $stmt->close();
        } else {
            $errors[] = "Database error: Could not prepare statement.";
        }
    }
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM students WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $param_id);
            $param_id = $id;

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $email = $row["email"];
                    $enrollment_date = $row["enrollment_date"];
                } else {
                    $errors[] = "No record found with that ID.";
                }
            } else {
                $errors[] = "Oops! Something went wrong.";
            }
            $stmt->close();
        }
    } else {
        header("location: index.php");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 95%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .back-link { display: block; margin-top: 15px; }
        .error-list { color: #DC3545; list-style-type: none; padding: 0; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Edit Student Record</h2>
        <p>Please edit the form values and submit to update the record.</p>

        <?php
        if (!empty($errors)) {
            echo '<ul class="error-list">';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
        ?>

        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label>Enrollment Date</label>
                <input type="date" name="enrollment_date" value="<?php echo htmlspecialchars($enrollment_date); ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Update">
            </div>
        </form>
        
        <a href="index.php" class="back-link">Back to List</a>
    </div>

</body>
</html>

