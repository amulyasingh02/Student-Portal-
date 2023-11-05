# Student-Portal-
PHP application to run on local apache server 

# Web Application README

This web application was created by Amulya Singh and is intended to perform signup,login , add student details, view profile and sub,it feedback.

## Prerequisites

Before running this application, you'll need to ensure you have the following set up:

- [XAMPP Server](https://www.apachefriends.org/index.html) installed
- MySQL running on port 3306
- [Your Web Application Folder](#folder-structure) placed in the `C:\xampp\htdocs` directory

## Getting Started

1. **Install XAMPP Server**: Make sure you have XAMPP Server installed on your computer. You can download it from [https://www.apachefriends.org](https://www.apachefriends.org).

2. **Run XAMPP's MySQL**: Ensure that XAMPP's MySQL is running on port 3306. If port 3306 is blocked, kill any processes that might be using it.

3. **Move Your Web Application Folder**: Move the folder containing your web application code (e.g., "web4") to the `C:\xampp\htdocs` directory.

4. **Start XAMPP Services**: Open XAMPP's control panel and start the Apache and MySQL services.

5. **Access the Application**: Open your web browser and navigate to the following URL: [http://localhost/web4/index.php](http://localhost/web4/index.php). This will run your web application locally.

## Folder Structure

Your folder structure should look like this:

C:
└── xampp
└── htdocs
└── web4
├── ... (Your application files)
└── index.php

## Table Creation

To set up the required database tables, you can follow these instructions:

1. **Create the Database**:

   - Open your web browser and navigate to [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Log in to phpMyAdmin with the appropriate credentials.
   - Create a new database named `lgdb`.

2. **Create Tables**:

   - In phpMyAdmin, select the `lgdb` database.
   - Go to the "SQL" tab.
   - Copy and paste the SQL code provided in the "Table creation mysql" file.
   - Execute the SQL queries to create the necessary tables: `users`, `details`, `pfp`, and `feedback`.


## Contact

This application was coded by Amulya Singh. If you need any assistance or have questions, you can contact Amulya at [mynameisgainamulya@gmail.com](mailto:mynameisgainamulya@gmail.com).

Feel free to open issues or contribute to this project on GitHub: [(https://github.com/amulyasingh02/Student-Portal-)https://github.com/amulyasingh02/Student-Portal-](#).

---

[License: MIT](LICENSE)