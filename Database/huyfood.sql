
CREATE TABLE IF NOT EXISTS manager (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(50),
    email VARCHAR(50),
    contact VARCHAR(20),
    address VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(50),
    email VARCHAR(100),
    Telephone VARCHAR(15),
    address VARCHAR(200)
);


CREATE TABLE food (
    food_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description VARCHAR(200),
    images_path VARCHAR(200),
    manager_id INT,
    CONSTRAINT fk_food_manager FOREIGN KEY (manager_id) 
        REFERENCES manager(manager_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    food_id INT,
    manager_id INT,
    quantity INT,
    price DECIMAL(10,2),
    order_date DATE,
    CONSTRAINT fk_order_customer FOREIGN KEY (customer_id) 
        REFERENCES customer(customer_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_order_food FOREIGN KEY (food_id) 
        REFERENCES food(food_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_order_manager FOREIGN KEY (manager_id) 
        REFERENCES manager(manager_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NULL,
    subject VARCHAR(150),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_message_customer FOREIGN KEY (customer_id) 
        REFERENCES customer(customer_id)
        ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE statistics (
    stat_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    stat_date DATE NOT NULL,
    total_orders INT DEFAULT 0,
    total_quantity INT DEFAULT 0,
    total_revenue DECIMAL(15,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);

