#!/bin/bash

# Create database directory
mkdir -p storage/database

# Remove existing database file if it exists
rm -f storage/database/database.sqlite

# Create SQLite database file using PHP
php -r "
try {
    \$pdo = new PDO('sqlite:/app/storage/database/database.sqlite');
    \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'SQLite database created successfully\n';
} catch (Exception \$e) {
    echo 'Error creating database: ' . \$e->getMessage() . '\n';
    exit(1);
}
"

# Set proper permissions
chmod 664 storage/database/database.sqlite

# Set database path environment variable
export DB_DATABASE=/app/storage/database/database.sqlite

echo "Database setup completed" 