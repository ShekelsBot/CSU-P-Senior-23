DROP TABLE IF EXISTS ledgers;

CREATE TABLE ledgers (
  member_id INT NOT NULL PRIMARY KEY,
  last_name VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  receipt VARCHAR(50) NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  joinDate DATE NOT NULL,
  renewalDate DATE NOT NULL,
  level VARCHAR(25) NOT NULL,
  reason VARCHAR(255) NOT NULL
);