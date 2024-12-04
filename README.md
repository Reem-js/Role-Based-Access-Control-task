# Laravel Project with Docker

This is a Laravel project setup using Docker for local development. This project includes PHPUnit unit tests for basic functionality such as a simple calculator and user registration feature.

## Prerequisites

Before you begin, make sure you have the following installed on your local machine:

- **Docker**: [Install Docker](https://www.docker.com/get-started)
- **Docker Compose**: [Install Docker Compose](https://docs.docker.com/compose/install/)

## Setup Instructions

### Step 1: Clone the Repository

First, clone this repository to your local machine:

```bash
git clone 
cd 
```

### Step 2: Build Docker Containers

The project includes a `docker-compose.yml` file to set up all necessary services (e.g., PHP, MySQL, etc.). Build the Docker containers with the following command:

```bash
docker-compose up --build -d
```

This will build the containers in the background and start the services.

### Step 3: Install Dependencies

Once the containers are up, you need to install the project dependencies. Execute the following command:

```bash
docker-compose exec app composer install
```

This command installs the required PHP dependencies for Laravel.

### Step 4: Set Up Environment Variables

Laravel requires some environment variables, like the database connection. Copy the example `.env` file and configure it:

```bash
docker-compose exec app cp .env.example .env
```

Make sure the database-related settings (such as `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`) are properly configured in the `.env` file.

### Step 5: Generate Application Key

Laravel requires an application key for encryption. Generate it by running:

```bash
docker-compose exec app php artisan key:generate
```

### Step 6: Run Database Migrations and Seeders

To set up your database schema and seed it with initial data, you need to run the migration and seeding commands. Run the following commands:

#### Run Migrations:
```bash
docker-compose exec app php artisan migrate
```

This command will apply all pending database migrations.

#### Seed the Database:
```bash
docker-compose exec app php artisan db:seed
```

This command will populate your database with sample data (as defined in your seeders).

You can also run both migration and seeding in a single command:

```bash
docker-compose exec app php artisan migrate --seed
```

### Step 7: Run Tests

To run the PHPUnit tests for the project, including the unit tests we wrote (such as the Calculator and User Registration tests), you can use the following command:

```bash
docker-compose exec app php artisan test
```



```

```

### Step 8: Access the Application

Once the Docker containers are running, you can access the Laravel application in your browser. By default, it will be available at:

```
http://localhost:8000
```

### Step 9: Stop Docker Containers

When you're done working with the application, you can stop the Docker containers with the following command:

```bash
docker-compose down
```

---

## File Structure

Here’s a quick overview of the project file structure:

```
.
├── app/                       # Laravel application files
├── bootstrap/                  # Laravel bootstrap files
├── config/                     # Configuration files
├── database/                   # Database migrations and seeders
├── docker-compose.yml          # Docker Compose configuration file
├── .env                        # Environment variables
├── .gitignore                  # Git ignore file
├── public/                     # Public directory for assets and index.php
├── resources/                  # Views and other resources
├── routes/                     # Route definitions
├── tests/                      # Test files (unit and feature)
└── vendor/                     # Composer dependencies
```

---
