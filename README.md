# Send Money API

This is the backend API for the Send Money application, built with Laravel 10 and PHP 8. It provides endpoints for user authentication, sending money transactions, viewing transaction history.

### Prerequisites

- PHP (>= 8.0)
- Composer (>= 2.x)
- Laravel CLI (>= 10.x)
- MySQL or your preferred database

### Installation

1. Clone the repository to your local machine:

   ```bash

   git clone https://github.com/hybrus/send-money-api.git

   cd send-money-api

   ```
2. Install the project dependencies using Composer:

   ```bash

   composer install

   ```
3. Copy the `.env.example` file to `.env`:

   ```bash

   cp .env.example .env

   ```
4. Generate a new application key and JWT secret key:

   ```bash

   php artisan key:generate

   php artisan jwt:secret

   ```
5. Configure your database connection in the `.env` file by setting the `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables.
6. Run the database migrations to create the necessary tables:

   ```bash

   php artisan migrate

   ```
7. If you want to include additional data for testing/demo purposes, run the following command to seed the database:

   ```bash

   php artisan db:seed

   ```

   This command will truncate existing data in the bank, user, account, and provider tables and populate them with additional demo data. The is_active and is_disabled columns of the bank and provider tables will have random values but for InstaPay and PesoPay they are always active not disabled.

   If you want to exclude additional data, you can run specific seeders using:

   ```bash

   php artisan db:seed --class=UserSeeder

   php artisan db:seed --class=AccountSeeder

   php artisan db:seed --class=ProviderSeeder

   php artisan db:seed --class=BankSeeder

   php artisan db:seed --class=BankProviderSeeder

   ```

### Running the API

To start the Laravel development server, run the following command:

    php artisan serve

This will start the API on the default port `8000`. You can access the API at `http://localhost:8000`.

### Audit Log Trail

The API includes an audit log trail that traces every route access of the user. It tracks both successful and failed requests, including login attempts. The audit log records the user's IP address and, if available, their email address. This functionality is implemented as middleware to ensure that all routes are logged.

### Validation and Code Design

- Validation for making transactions requires both the bank and provider to be active and not disabled.
- Different validation rules apply based on the type of transaction (bank or user).
- The implementation uses design patterns like Strategy, Factory Method, Adapter (for API integration), and Chain of Responsibility (for formatting transaction history).

### Transaction Constant

The `TransactionConstant` class compiles error messages and constants, enabling API responses to be customized without altering the logic code.

### API Routes
Note: Please be aware that authentication is required to access the routes, with the exception of the login route. Upon successful login, you will receive an access token, which should be added to the authorization bearer header for subsequent authenticated requests.

#### POST: /api/auth/login

- Action: AuthController@login
- Description: Allows users to log in by providing their authentication credentials.

#### POST: /api/auth/logout

- Action: AuthController@logout
- Description: Logs out the authenticated user.

#### Get: /api/auth/me

- Action: AuthController@me
- Description: Retrieves details of the currently authenticated user.

#### Get: /api/provider

- Action: ProviderController@all
- Description: Retrieves a list of providers for sending money (e.g., InstaPay, PESONet).

#### Get: /api/transaction

- Action: TransactionController@all
- Description: Retrieves a list of all transactions, likely for displaying transaction history.

#### Post: /api/transaction

- Action: TransactionController@makeTransaction
- Description: Initiates a new money transaction, allowing users to send money.

### Postman Collection

A Postman collection (`postman_collection.json`) is included in the repository. You can import this collection into Postman to easily test the API endpoints.
