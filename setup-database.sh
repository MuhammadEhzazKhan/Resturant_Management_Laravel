#!/bin/bash

# Create database directory
mkdir -p storage/database

# Create SQLite database file
touch storage/database/database.sqlite

# Set proper permissions
chmod 664 storage/database/database.sqlite

# Set database path environment variable
export DB_DATABASE=/app/storage/database/database.sqlite

echo "Database setup completed" 