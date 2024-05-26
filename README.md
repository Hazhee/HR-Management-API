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
- `POST /api/v1/login`: Login and receive an access token.
- `POST /api/v1/logout`: Logout and invalidate the access token.

### Employee Endpoints
- `GET /api/v1/employees`: Get a list of all employees.
- `POST /api/v1/employees`: Create a new employee.
- `DELETE /api/v1/employees/{employee}`: Delete an employee.
- `GET /api/v1/employees/{employee}/managers`: Get the managers of an employee.
- `GET /api/v1/employees/average-salary`: Get the average salary of employees by age group.
- `GET /api/v1/employees/top-completed-projects/{department}`: Get the top 10 employees with the most completed projects in a department.
- `GET /api/v1/employees/never-changed-department`: Get employees who have never changed their department.
- `POST /api/v1/employees/{employee}/change-department`: Change the department of an employee.

### Department Endpoints
- `GET /api/v1/departments`: Get a list of all departments.
- `POST /api/v1/departments`: Create a new department.
- `POST /api/v1/departments/{department}/assign-manager`: Assign a manager to a department.

### Project Endpoints
- `GET /api/v1/projects`: Get a list of all projects.
- `POST /api/v1/projects`: Create a new project.
- `GET /api/v1/projects/search`: Search for projects by name, description, or assigned employee.
- `GET /api/v1/projects/average-duration`: Get the average duration of projects by department.


   


