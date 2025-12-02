# Laravel Client Portal AI Support Chatbot

A modern, responsive Client Portal and AI-powered Support Chatbot application built with Laravel 12. This application allows clients to manage their accounts, view their subscription packs, and submit support tickets. Administrators can manage clients, tickets, and utilize AI to generate ticket replies.

## Author Information

- **Author:** vulct174
- **Email:** vulct.it@gmail.com
- **Repository:** [https://github.com/vulct174/laravel-client-portal-ai-support-chatbot.git](https://github.com/vulct174/laravel-client-portal-ai-support-chatbot.git)

## Features

### Client Portal
- **Dashboard:** View account information and current subscription pack details.
- **Ticket System:**
  - Open new support tickets with file attachments.
  - View ticket history and status.
  - Reply to tickets and communicate with support agents.
- **Profile Management:** Update user profile information.

### Admin Interface
- **Dashboard:** Overview of system status and ticket metrics.
- **Ticket Management:**
  - View all tickets.
  - Change ticket status (Open, In Progress, Closed).
  - Reply to tickets.
  - **AI Integration:** Generate AI-powered replies for tickets to speed up support.
- **Client Management:**
  - View list of all clients.
  - Manage client details and update their subscription packs.

### Authentication & Security
- Secure Login and Registration using Laravel Breeze.
- Role-based access control (Admin vs. Client).
- Password reset functionality.

## Technology Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Build Tool:** Vite
- **Database:** MySQL

## Installation

Follow these steps to set up the project locally:

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/vulct174/laravel-client-portal-ai-support-chatbot.git
    cd laravel-client-portal-ai-support-chatbot
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node.js dependencies:**
    ```bash
    npm install
    ```

4.  **Environment Configuration:**
    Copy the example environment file and configure your database settings:
    ```bash
    cp .env.example .env
    ```
    Update the `.env` file with your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations and Seeders:**
    Set up the database tables and seed default data (Packs and Admin User).
    ```bash
    php artisan migrate
    php artisan db:seed --class=PackSeeder
    php artisan db:seed --class=AdminSeeder
    ```

7.  **Build Frontend Assets:**
    ```bash
    npm run build
    ```
    Or for development:
    ```bash
    npm run dev
    ```

8.  **Start the Server:**
    ```bash
    php artisan serve
    ```

## Usage

### Admin Access
- **URL:** `http://localhost:8000/login`
- **Email:** `admin@example.com`
- **Password:** `password`

### Client Access
- Clients can register a new account via the registration page: `http://localhost:8000/register`.
- Default packs (Free, Essential, Standard, Managed, Enterprise) are available upon setup.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
