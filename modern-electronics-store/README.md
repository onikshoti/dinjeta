# Modern Electronics Store

Welcome to the Modern Electronics Store project! This application is designed to manage electronic products, allowing users to add, remove, and view products in a modern web interface.

## Project Structure

The project is organized as follows:

```
modern-electronics-store
├── public
│   ├── index.php          # Entry point for the application
│   ├── router.php         # Handles routing for the application
│   ├── css
│   │   └── style.css      # CSS styles for the application
│   └── js
│       └── app.js         # JavaScript for client-side functionality
├── src
│   ├── Controllers
│   │   └── ProductController.php  # Handles product-related actions
│   ├── Models
│   │   └── Product.php    # Represents the product data model
│   ├── Views
│   │   ├── layouts
│   │   │   └── main.php   # Main layout template
│   │   └── products
│   │       ├── list.php   # Displays a list of products
│   │       ├── add.php    # Form for adding new products
│   │       └── remove.php # Functionality for removing products
│   └── Helpers
│       └── Database.php   # Helper functions for database operations
├── config
│   └── config.php         # Configuration settings for the application
├── migrations
│   └── 001_create_products_table.sql # Migration script for products table
├── seeders
│   └── products_seeder.sql # Seeder script for initial product data
├── storage
│   └── logs
│       └── app.log        # Log file for application events and errors
├── vendor                  # Third-party libraries (excluded from repo)
├── composer.json           # Composer configuration file
├── .env.example            # Example environment configuration file
└── README.md               # Project documentation
```

## Installation

1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Install dependencies using Composer:
   ```
   composer install
   ```
4. Configure your environment variables by copying `.env.example` to `.env` and updating the values as needed.
5. Run the migration to create the database tables:
   ```
   php artisan migrate
   ```
6. Seed the database with initial data:
   ```
   php artisan db:seed
   ```

## Usage

- Access the application by navigating to `http://localhost/modern-electronics-store/public` in your web browser.
- Use the interface to add, view, and remove electronic products.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue for any enhancements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for more details.