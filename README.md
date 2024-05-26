# HR Management API

This is a Laravel-based API for managing HR-related tasks, including employee management, department tracking, and project assignments. The API uses Laravel Sanctum for authentication.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Running Tests](#running-tests)
- [API Documentation](#api-documentation)
- [Contributing](#contributing)
- [License](#license)

## Requirements

- PHP 7.4 or higher
- Composer
- MySQL

## Installation

1. **Clone the repository:**

   ```sh
   git clone https://github.com/yourusername/hr-management-api.git
   cd hr-management-api


# Project Setup

## Install PHP dependencies:
```sh
composer install
```

## Environment Variables
Copy the `.env.example` file to `.env`:
```sh
cp .env.example .env
```

Update the `.env` file with your environment settings:
- Database configuration
- Other necessary environment variables

## Database Setup

### Create a database:
Create a new MySQL database for your application.

### Run the database migrations and seeders:
```sh
php artisan migrate --seed
```

## Running the Application

### Start the local development server:
```sh
php artisan serve
```

### Access the application:
Open your web browser and navigate to `http://localhost:8000`.

## Running Tests

### Run the PHPUnit tests:
```sh
php artisan test
```

## API Documentation

### Authentication Endpoints
- `POST /api/login`: Login and receive an access token.
- `POST /api/logout`: Logout and invalidate the access token.

### Employee Endpoints
- `GET /api/employees`: Get a list of all employees.
- `POST /api/employees`: Create a new employee.
- `DELETE /api/employees/{employee}`: Delete an employee.
- `GET /api/employees/{employee}/managers`: Get the managers of an employee.
- `GET /api/employees/average-salary`: Get the average salary of employees by age group.
- `GET /api/employees/top-completed-projects/{department}`: Get the top 10 employees with the most completed projects in a department.
- `GET /api/employees/never-changed-department`: Get employees who have never changed their department.
- `POST /api/employees/{employee}/change-department`: Change the department of an employee.

### Department Endpoints
- `GET /api/departments`: Get a list of all departments.
- `POST /api/departments`: Create a new department.
- `POST /api/departments/{department}/assign-manager`: Assign a manager to a department.

### Project Endpoints
- `GET /api/projects`: Get a list of all projects.
- `POST /api/projects`: Create a new project.
- `GET /api/projects/search`: Search for projects by name, description, or assigned employee.
- `GET /api/projects/average-duration`: Get the average duration of projects by department.

## Contributing
If you would like to contribute to this project, please follow these steps:

### Fork the repository.

### Create a new branch:
```sh
git checkout -b feature/YourFeature
```

### Commit your changes:
```sh
git commit -am 'Add some feature'
```

### Push to the branch:
```sh
git push origin feature/YourFeature
```

### Create a new Pull Request.

   

   


