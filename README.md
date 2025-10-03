
# CRM

A Customer Relationship Management (CRM) application built with the TALL stack: **T**ailwind CSS, **A**lpine.js (via Livewire), **L**aravel, and **L**ivewire. It also utilizes **Rappasoft** for powerful and efficient data tables.

## 🚀 Features

-   **User Management:** Secure user registration, authentication, and roles.
-   **Company Management:** Create, view, and manage company records.
-   **Contact Management:** Track and manage contacts associated with companies.
-   **Livewire Tables:** Fast and easy-to-use data tables powered by Rappasoft.
-   **Modern UI:** A clean and responsive user interface built with Tailwind CSS.

## 🛠️ Tech Stack

-   **Backend:** Laravel (PHP Framework)
-   **Frontend:** Livewire (with Alpine.js), Tailwind CSS
-   **Database:** MySQL (or your preferred database)
-   **Packages:** Rappasoft/Laravel-Livewire-Tables

## ⚙️ Installation

### Prerequisites

Make sure you have the following installed on your machine:
-   PHP >= 8.1
-   Composer
-   Node.js and npm
-   A database server (e.g., MySQL)

### Step-by-step setup

1.  **Clone the repository:**
    ```sh
    git clone https://github.com/EiEiLwinDev/crm.git
    cd crm
    ```

2.  **Install PHP dependencies:**
    ```sh
    composer install
    ```

3.  **Install JavaScript dependencies:**
    ```sh
    npm install
    ```

4.  **Copy the environment file:**
    ```sh
    cp .env.example .env
    ```

5.  **Configure your `.env` file:**
    *   Set your database credentials and other environment variables.
    *   Generate a new application key:
        ```sh
        php artisan key:generate
        ```

6.  **Run database migrations and seeders:**
    This will create the necessary database tables and populate them with initial data.
    ```sh
    php artisan migrate
    php artisan db:seed
    ```

7.  **Generate frontend assets:**
    ```sh
    npm run dev
    ```

## ▶️ How to Run the Application

To start the local development server, run the following command in your terminal:
```sh
php artisan serve

