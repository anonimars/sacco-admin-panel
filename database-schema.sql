-- SACCO Microfinance Management System Database Schema
-- This file provides the MySQL database schema for production deployment

-- Create database
CREATE DATABASE IF NOT EXISTS sacco_management;
USE sacco_management;

-- Microfinances table
CREATE TABLE microfinances (
    id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_name (name),
    INDEX idx_email (email)
);

-- Members table
CREATE TABLE members (
    id VARCHAR(36) PRIMARY KEY,
    microfinance_id VARCHAR(36) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    id_number VARCHAR(20) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    status ENUM('Pending', 'Active') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (microfinance_id) REFERENCES microfinances(id) ON DELETE CASCADE,
    INDEX idx_microfinance_id (microfinance_id),
    INDEX idx_status (status),
    INDEX idx_id_number (id_number),
    INDEX idx_full_name (first_name, last_name)
);

-- Loans table
CREATE TABLE loans (
    id VARCHAR(36) PRIMARY KEY,
    member_id VARCHAR(36) NOT NULL,
    loan_type ENUM('Emergency', 'Development', 'Business', 'Education') NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    repayment_period INT NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE,
    INDEX idx_member_id (member_id),
    INDEX idx_status (status),
    INDEX idx_loan_type (loan_type),
    INDEX idx_amount (amount),
    CONSTRAINT chk_amount_positive CHECK (amount > 0),
    CONSTRAINT chk_repayment_period_positive CHECK (repayment_period > 0)
);

-- Create views for common queries

-- View: Members with microfinance details
CREATE VIEW members_with_microfinance AS
SELECT 
    m.id,
    m.microfinance_id,
    m.first_name,
    m.last_name,
    CONCAT(m.first_name, ' ', m.last_name) AS full_name,
    m.id_number,
    m.phone,
    m.email,
    m.address,
    m.status,
    m.created_at,
    mf.name AS microfinance_name,
    mf.description AS microfinance_description
FROM members m
JOIN microfinances mf ON m.microfinance_id = mf.id;

-- View: Loans with member and microfinance details
CREATE VIEW loans_with_details AS
SELECT 
    l.id,
    l.member_id,
    l.loan_type,
    l.amount,
    l.repayment_period,
    l.status,
    l.created_at,
    CONCAT(m.first_name, ' ', m.last_name) AS member_name,
    m.id_number AS member_id_number,
    m.phone AS member_phone,
    mf.name AS microfinance_name,
    mf.id AS microfinance_id
FROM loans l
JOIN members m ON l.member_id = m.id
JOIN microfinances mf ON m.microfinance_id = mf.id;

-- View: Dashboard statistics
CREATE VIEW dashboard_stats AS
SELECT 
    (SELECT COUNT(*) FROM microfinances) AS total_microfinances,
    (SELECT COUNT(*) FROM members WHERE status = 'Active') AS active_members,
    (SELECT COUNT(*) FROM members WHERE status = 'Pending') AS pending_members,
    (SELECT COUNT(*) FROM loans WHERE status = 'Pending') AS pending_loans,
    (SELECT COUNT(*) FROM loans WHERE status = 'Approved') AS approved_loans,
    (SELECT COUNT(*) FROM loans WHERE status = 'Rejected') AS rejected_loans,
    (SELECT COALESCE(SUM(amount), 0) FROM loans WHERE status = 'Approved') AS total_approved_amount;

-- Insert sample data for testing

-- Sample microfinances
INSERT INTO microfinances (id, name, description, address, phone, email) VALUES
('mf1', 'Umoja SACCO', 'Community-based savings and credit cooperative serving the Umoja area', '123 Umoja Street, Nairobi', '+254700123456', 'info@umojasacco.co.ke'),
('mf2', 'Harambee Financial', 'Microfinance institution focused on small business development', '456 Harambee Avenue, Mombasa', '+254700789012', 'contact@harambee.co.ke'),
('mf3', 'Kilimo SACCO', 'Agricultural-focused SACCO supporting farmers and agribusiness', '789 Farm Road, Nakuru', '+254700345678', 'support@kilimosacco.co.ke');

-- Sample members
INSERT INTO members (id, microfinance_id, first_name, last_name, id_number, phone, email, address, status) VALUES
('mem1', 'mf1', 'John', 'Kamau', '12345678', '+254701234567', 'john.kamau@email.com', '10 Kenyatta Road, Nairobi', 'Active'),
('mem2', 'mf1', 'Mary', 'Wanjiku', '23456789', '+254702345678', 'mary.wanjiku@email.com', '20 Uhuru Street, Nairobi', 'Pending'),
('mem3', 'mf2', 'Peter', 'Ochieng', '34567890', '+254703456789', 'peter.ochieng@email.com', '30 Moi Avenue, Mombasa', 'Active'),
('mem4', 'mf3', 'Grace', 'Njeri', '45678901', '+254704567890', 'grace.njeri@email.com', '40 Agricultural Lane, Nakuru', 'Active');

-- Sample loans
INSERT INTO loans (id, member_id, loan_type, amount, repayment_period, status) VALUES
('loan1', 'mem1', 'Business', 50000.00, 12, 'Approved'),
('loan2', 'mem3', 'Emergency', 15000.00, 6, 'Pending'),
('loan3', 'mem4', 'Development', 100000.00, 24, 'Approved');

-- Create stored procedures for common operations

DELIMITER //

-- Procedure to activate a member
CREATE PROCEDURE ActivateMember(IN member_id VARCHAR(36))
BEGIN
    DECLARE member_exists INT DEFAULT 0;
    DECLARE current_status VARCHAR(10);
    
    -- Check if member exists and get current status
    SELECT COUNT(*), status INTO member_exists, current_status 
    FROM members 
    WHERE id = member_id;
    
    IF member_exists = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Member not found';
    ELSEIF current_status = 'Active' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Member is already active';
    ELSE
        UPDATE members SET status = 'Active' WHERE id = member_id;
        SELECT 'Member activated successfully' AS message;
    END IF;
END //

-- Procedure to check loan eligibility
CREATE PROCEDURE CheckLoanEligibility(IN member_id VARCHAR(36))
BEGIN
    DECLARE member_exists INT DEFAULT 0;
    DECLARE member_status VARCHAR(10);
    DECLARE pending_loans INT DEFAULT 0;
    
    -- Check member status
    SELECT COUNT(*), status INTO member_exists, member_status 
    FROM members 
    WHERE id = member_id;
    
    -- Check for pending loans
    SELECT COUNT(*) INTO pending_loans 
    FROM loans 
    WHERE member_id = member_id AND status = 'Pending';
    
    IF member_exists = 0 THEN
        SELECT 'Member not found' AS eligibility_status, FALSE AS eligible;
    ELSEIF member_status != 'Active' THEN
        SELECT 'Member must be active to apply for loans' AS eligibility_status, FALSE AS eligible;
    ELSEIF pending_loans > 0 THEN
        SELECT 'Member already has a pending loan application' AS eligibility_status, FALSE AS eligible;
    ELSE
        SELECT 'Member is eligible for loan application' AS eligibility_status, TRUE AS eligible;
    END IF;
END //

DELIMITER ;

-- Create triggers for audit logging

-- Trigger for member status changes
CREATE TABLE member_status_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id VARCHAR(36) NOT NULL,
    old_status VARCHAR(10),
    new_status VARCHAR(10),
    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_member_id (member_id)
);

DELIMITER //

CREATE TRIGGER member_status_change_log
AFTER UPDATE ON members
FOR EACH ROW
BEGIN
    IF OLD.status != NEW.status THEN
        INSERT INTO member_status_log (member_id, old_status, new_status)
        VALUES (NEW.id, OLD.status, NEW.status);
    END IF;
END //

DELIMITER ;

-- Performance optimization indexes
CREATE INDEX idx_members_microfinance_status ON members(microfinance_id, status);
CREATE INDEX idx_loans_member_status ON loans(member_id, status);
CREATE INDEX idx_loans_created_at ON loans(created_at DESC);
CREATE INDEX idx_members_created_at ON members(created_at DESC);

-- Grant permissions (adjust as needed for your environment)
-- CREATE USER 'sacco_admin'@'localhost' IDENTIFIED BY 'secure_password';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON sacco_management.* TO 'sacco_admin'@'localhost';
-- FLUSH PRIVILEGES;
