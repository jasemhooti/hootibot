CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    chat_id BIGINT UNIQUE,
    balance BIGINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vpn_configs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    config TEXT,
    expiry_date DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- جداول دیگر برای بازی، تراکنش‌ها، تیکت‌ها و...
