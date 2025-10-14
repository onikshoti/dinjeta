# Electronic Store

This project is a modern web application designed for selling electronic devices. It includes features for managing products, offers, and a shopping cart, providing users with a seamless shopping experience.

## Project Structure

```
electronic-store
├── src
│   ├── index.php          # Main entry point for the webpage
│   ├── cart.php           # Manages shopping cart functionality
│   ├── products.php       # Lists available electronic devices
│   ├── offers.php         # Displays current offers and promotions
│   ├── add_item.php       # Handles addition of new items
│   ├── remove_item.php    # Manages removal of items
│   ├── change_price.php    # Allows updating of product prices
│   ├── create_offer.php    # Enables creation of new offers
│   └── includes
│       ├── db.php        # Database connection logic
│       └── functions.php  # Utility functions
├── public
│   ├── css
│   │   └── style.css      # CSS styles for the webpage
│   └── js
│       └── main.js        # JavaScript functionality
└── README.md              # Project documentation
```

## Features

- **Product Management**: Add, remove, and update electronic devices.
- **Shopping Cart**: Users can add items to their cart and proceed to checkout.
- **Offers and Promotions**: Create and manage discounts on products.
- **Responsive Design**: The webpage is designed to be modern and user-friendly.

## Setup Instructions

1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Set up a database and update the `db.php` file with your database credentials.
4. Open `index.php` in your web browser to view the application.

## Usage Guidelines

- Use the navigation links to browse products, view offers, and manage your shopping cart.
- Admin users can add new items, change prices, and create offers through the respective pages.

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.