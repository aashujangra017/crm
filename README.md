CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    itemname VARCHAR(255) NOT NULL,      
    price DECIMAL(10, 2) NOT NULL,      
    description TEXT,                   
    image VARCHAR(255)                  
);

CREATE TABLE user(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    last VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(10) NOT NULL
)

CREATE TABLE addclient (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT null,
     phone VARCHAR(10) UNIQUE,
    address VARCHAR(255) NOT NULL ,
     city VARCHAR(255) NOT NULL ,
     state VARCHAR(255) NOT NULL,
     pin VARCHAR(6) NOT NULL UNIQUE
)



INSERT INTO state (sname) VALUES
('Andhra Pradesh'),
('Arunachal Pradesh'),
('Assam'),
('Bihar'),
('Chhattisgarh'),
('Goa'),
('Gujarat'),
('Haryana'),
('Himachal Pradesh'),
('Jharkhand'),
('Karnataka'),
('Kerala'),
('Madhya Pradesh'),
('Maharashtra'),
('Manipur'),
('Meghalaya'),
('Mizoram'),
('Nagaland'),
('Odisha'),
('Punjab'),
('Rajasthan'),
('Sikkim'),
('Tamil Nadu'),
('Telangana'),
('Tripura'),
('Uttar Pradesh'),
('Uttarakhand'),
('West Bengal');


CREATE TABLE state (
    sid INT AUTO_INCREMENT PRIMARY KEY,
    sname VARCHAR(255) NOT NULL
    )

    CREATE TABLE clientinsert (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    phone VARCHAR(10),
    address VARCHAR(255),
    state_id INT,
    city VARCHAR(255),
    pincode VARCHAR(6),

    FOREIGN KEY (state_id) REFERENCES states(id)
);

CREATE TABLE clientinsert (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    phone VARCHAR(10),
    address VARCHAR(255),
    state_id INT,
    city VARCHAR(255),
    pincode VARCHAR(6),

    FOREIGN KEY (state_id) REFERENCES states(id)
);

