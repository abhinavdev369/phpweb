PHP CRUD Application

This is a simple PHP project for managing student records. It connects to a MySQL database and supports Create, Read, Update, and Delete operations.
This was created as a course assignment.

Features
Create: Add new students to the database.

Read: View a list of all students.

Update: Edit information for an existing student.

Delete: Remove a student from the database.

Setup Instructions
Database Setup:

Use a tool like phpMyAdmin or the MySQL command line.
Run the dynamic_project.sql file to create the dynamic_project database and the students table. This file also inserts a few sample records.

Application Setup:
Place all the .php files in your web server's directory (like htdocs for XAMPP or www for WAMP).
Make sure your services are running.
Open db_config.php and check that the database username ($db_user) and password ($db_pass) match your local MySQL setup. The default is with no password.
Run the Application:

Open your web browser and go to http://localhost/your_project_folder_name/
This will open index.php and you should see the list of students.

Files in this Project:
index.php: The main page that shows all student records.

create.php: The form to add a new student.

edit.php: The form to update an existing student.

delete.php: The script that handles deleting a record.

db_config.php: Handles the database connection.

dynamic_project.sql: The database schema and sample data.
