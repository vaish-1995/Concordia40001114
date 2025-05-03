# Concordia Student Information System

![Project Banner](https://via.placeholder.com/1200x400?text=Concordia+Student+Information+System)

A web application for managing student information at Concordia University, built with Laravel.

## Features

- Student CRUD operations (Create, Read, Update, Delete)
- City management
- Responsive design with Bootstrap
- Data validation
- Database seeding with factories
- RESTful routing

## Technologies Used

- Laravel 9.x
- PHP 8.0+
- MySQL
- Bootstrap 5
- Composer
- Node.js (for frontend assets)

## Installation

### Prerequisites

- PHP 8.0 or higher
- Composer
- MySQL
- Node.js (for frontend assets)

### Setup Steps

1. Clone the repository:
   
   git clone https://github.com/vaish-1995/Concordia40001114.git
   cd Concordia140001114

2. Install PHP dependencies:
    composer install

3. Install JavaScript dependencies:
    npm install

4.  Create a copy of the .env file:
    cp .env.example .env

5.  Generate application key:
    php artisan key:generate

6. Configure your database in .env:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=concordia_db
    DB_USERNAME=root
    DB_PASSWORD=

7. Run migrations and seeders:
    php artisan migrate --seed
    
8.  Compile frontend assets:
    npm run dev
    
9.  Start the development server:
    php artisan serve
    
10. Access the application at:
    http://localhost:8000


Concordia[40001114]/
├── app/
│   ├── Http/Controllers/StudentController.php
│   ├── Models/
│   │   ├── Student.php
│   │   └── City.php
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── students/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── edit.blade.php
│   │   └── layouts/
│   │       └── app.blade.php
├── routes/
│   └── web.php
└── public/
    ├── css/
    └── js/



## Database Structure

### Tables

#### `cities`
- **id**: Primary key (integer, auto-increment).
- **name**: Name of the city (string).
- **timestamps**: Automatically managed `created_at` and `updated_at` fields.

#### `students`
- **id**: Primary key (integer, auto-increment).
- **name**: Name of the student (string).
- **address**: Address of the student (text).
- **phone**: Phone number of the student (string).
- **email**: Email address of the student (string, unique).
- **date_of_birth**: Date of birth of the student (date).
- **city_id**: Foreign key referencing the `id` field in the `cities` table.
- **timestamps**: Automatically managed `created_at` and `updated_at` fields.



## Contributing
1. Fork the project.
2. Create your feature branch: git checkout -b feature/YourFeature
3. Commit your changes:  git commit -m 'Add some feature'
4. Push to the branch: git push origin feature/YourFeature
5. Open a Pull Request.
