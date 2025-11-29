# Laravue Market

A Laravel-based backend API for a marketplace application. This repository contains the server-side logic, database migrations, and API endpoints for managing users, stores, balances, and withdrawals.

## Features

- **User Management**: API endpoints for managing users.
- **Store Management**: Create, update, and verify stores.
- **Financials**:
  - Track store balances.
  - View balance history.
  - Manage withdrawal requests.
- **Buyer Management**: Manage buyer profiles.
- **Pagination**: Dedicated endpoints for paginated data retrieval.

## Tech Stack

- **Framework**: [Laravel 12.x](https://laravel.com)
- **Language**: PHP 8.2+
- **Frontend Assets**: Vite + Tailwind CSS 4.0
- **Authentication**: Laravel Sanctum
- **Testing**: Pest PHP

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP >= 8.2
- Composer
- Node.js & NPM

## Installation

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd laravue-market
   ```

2. **Run the setup script**

   The project includes a convenient setup script in `composer.json` that installs dependencies, sets up the environment file, generates keys, runs migrations, and builds assets.

   ```bash
   composer run setup
   ```

   Alternatively, you can run the steps manually:

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   npm install
   npm run build
   ```

3. **Start the development server**

   ```bash
   composer run dev
   ```

   This command runs Laravel Sail/Serve, Queue listener, and Vite concurrently.

## API Endpoints

The application exposes the following API resources (defined in `routes/api.php`):

| Resource | Method | Endpoint | Description |
|----------|--------|----------|-------------|
| **User** | GET | `/api/user` | List users |
| | GET | `/api/user/all/paginated` | List users with pagination |
| **Store** | GET | `/api/store` | List stores |
| | POST | `/api/store/{id}/verified` | Verify a store |
| **Balance** | GET | `/api/store-balance` | View store balances |
| | GET | `/api/store-balance-history` | View balance history |
| **Withdrawal** | GET | `/api/withdrawal` | List withdrawals |
| | POST | `/api/withdrawal/{id}/approve` | Approve a withdrawal |
| **Buyer** | GET | `/api/buyer` | List buyers |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
