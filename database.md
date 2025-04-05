CREATE DATABASE IAMS;

-- Users table
CREATE TABLE users (
    user_id INT PRIMARY KEY,
    username VARCHAR(50)
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    roles_id INT
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

-- Interests table
CREATE TABLE interests (
    interest_id INT PRIMARY KEY,
    name VARCHAR(50)
);

-- Junction table to link users and interests
CREATE TABLE user_interests (
    user_id INT,
    interest_id INT,
    PRIMARY KEY (user_id, interest_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (interest_id) REFERENCES interests(interest_id)
);

CREATE TABLE roles (
    role_id INT PRIMARY KEY,
    name VARCHAR(50)
);
