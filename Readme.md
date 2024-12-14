# E-Library Admin Panel

The admin panel for the E-Library application allows administrators to manage users, books, rentals, and view income summaries and charts. It is built using HTML, CSS, jQuery, and PHP.

## Features

- **User Management**: view registered users.
- **Book Management**: Add, update, and remove books from the library.
- **Rental Management**: View and manage rental transactions.
- **Income Summaries and Charts**: View summarized rental income data and visualize trends using charts.
- **Admin Authentication**: Secure login for administrators to access the panel.
- **API Communication**: Basic API built with PHP to allow communication between the admin panel and the mobile app.

## Technologies Used

- **Frontend**: HTML, CSS, jQuery
- **Backend**: PHP (API)
- **Database**: MySQL

## API Communication

This project contains an `api` folder that defines the backend API using PHP. The API is designed for communication between the **E-Library Admin Panel** and the **Mobile App**.

## Getting Started

### Prerequisites

- Install a local development environment such as **XAMPP** or **Laragon** for hosting the admin panel, MySQL database, and PHP API.
- Ensure that your server can process PHP requests and handle communication with the mobile app.

### Setup Instructions

1. Clone the repository:

    ```bash
    git clone https://github.com/prajwaldahal/elibrary-admin.git
    cd elibrary-admin
    ```

2. Place the `elibrary-admin` folder in the **htdocs** directory if using XAMPP or the appropriate folder in your chosen local server environment.

3. **Database Setup**:  
   - Create a MySQL database for the admin panel, for example, `elibrary_db`.
   - Import the provided SQL file from the `database` folder to set up the required tables in the database.

4. Update the database connection settings in `config.php` with your local database credentials.

    ```php
    <?php
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = ''; // Set the password if any
    $dbName = 'elibrary_db'; // Your database name
    ?>
    ```

5. **Start the Local Server**:  
   Open **XAMPP** or **Laragon**, start the Apache and MySQL services.

6. Access the admin panel by navigating to `http://localhost/elibrary-admin/` in your browser.

### Authentication

- The default **username** is `admin` and the **password** is `pwd`. Use these credentials to log in to the admin panel initially. You can change the password after logging in.

