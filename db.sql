-- Create Users table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'PropertyOwner', 'Client') NOT NULL
);

-- Create Property Owners table
CREATE TABLE PropertyOwners (
    owner_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    phone_number VARCHAR(15),
    owner_type ENUM('Private', 'Business'),
    address VARCHAR(255)
);

-- Create Clients table
CREATE TABLE Clients (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    phone_number VARCHAR(15),
    preferences VARCHAR(255)
);

-- Create Staff table
CREATE TABLE Staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    position VARCHAR(100),
    supervisor_id INT,
    branch_id INT,
    FOREIGN KEY (supervisor_id) REFERENCES Staff(staff_id) ON DELETE SET NULL
);

-- Create Branches table
CREATE TABLE Branches (
    branch_id INT AUTO_INCREMENT PRIMARY KEY,
    branch_name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    manager_id INT,
    FOREIGN KEY (manager_id) REFERENCES Staff(staff_id) ON DELETE SET NULL
);

-- Create Properties table
CREATE TABLE Properties (
    property_id INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(255) NOT NULL,
    property_type ENUM('Residential', 'Commercial'),
    rooms INT,
    price DECIMAL(15, 2) NOT NULL,
    branch_id INT,
    manager_id INT,
    FOREIGN KEY (branch_id) REFERENCES Branches(branch_id) ON DELETE CASCADE,
    FOREIGN KEY (manager_id) REFERENCES Staff(staff_id) ON DELETE SET NULL
);

-- Link table for Properties and Owners (many-to-many relationship)
CREATE TABLE PropertyOwnerLink (
    property_id INT,
    owner_id INT,
    PRIMARY KEY (property_id, owner_id),
    FOREIGN KEY (property_id) REFERENCES Properties(property_id) ON DELETE CASCADE,
    FOREIGN KEY (owner_id) REFERENCES PropertyOwners(owner_id) ON DELETE CASCADE
);

-- Create Transactions table
CREATE TABLE Transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    property_id INT,
    transaction_date DATE NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    status ENUM('Pending', 'Completed', 'Cancelled') NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES Properties(property_id) ON DELETE CASCADE
);

-- Create Appointments table
CREATE TABLE Appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    property_id INT,
    appointment_date DATE NOT NULL,
    time_slot TIME NOT NULL,
    agent_id INT,
    FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES Properties(property_id) ON DELETE CASCADE,
    FOREIGN KEY (agent_id) REFERENCES Staff(staff_id) ON DELETE SET NULL
);

-- Create User Roles Link table
CREATE TABLE UserRoles (
    user_id INT,
    associated_id INT,
    PRIMARY KEY (user_id, associated_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (associated_id) REFERENCES PropertyOwners(owner_id) ON DELETE CASCADE
);

-- Create Property Viewing table
CREATE TABLE PropertyViewing (
    viewing_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    property_id INT NOT NULL,
    viewing_date DATE NOT NULL,
    time_slot TIME NOT NULL,
    status ENUM('Scheduled', 'Completed', 'Cancelled') DEFAULT 'Scheduled',
    agent_id INT,
    feedback TEXT,
    FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES Properties(property_id) ON DELETE CASCADE,
    FOREIGN KEY (agent_id) REFERENCES Staff(staff_id) ON DELETE SET NULL
);
