create database steeringWheel;

use steeringWheel;

CREATE TABLE steeringWheelList(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    current_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dynamicSelect(
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

delete from dynamicSelect where id >= 0;
delete from users where id >= 0;