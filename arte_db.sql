
CREATE DATABASE arte_db

USE arte_db;


CREATE TABLE tblappointments (
    appointment_id INT NOT NULL AUTO_INCREMENT,
    customer_id INT DEFAULT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    srv_id INT NOT NULL,
    unique_code VARCHAR(50) NOT NULL UNIQUE,
    message VARCHAR(400) DEFAULT NULL,
    PRIMARY KEY (appointment_id),
    CONSTRAINT customerID_FK
    FOREIGN KEY (customer_id) REFERENCES tblcustomer(customer_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT serviceID_Fk
    FOREIGN KEY (srv_id) REFERENCES tblService(srv_id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE tblService (
    srv_id INT AUTO_INCREMENT PRIMARY KEY,
    srv_type VARCHAR(50) NOT NULL,
    srv_name VARCHAR(50) NOT NULL,
    srv_price VARCHAR(20) NOT NULL
);

CREATE TABLE `tblcustomer` (
  `customer_id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) 

CREATE TABLE `status_table` (
  `unique_code` VARCHAR(20) NOT NULL,
  `status_type` ENUM('Pending','Done','Cancelled') DEFAULT 'Pending'
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tblreviews` (
  `ReviewID` INT(11) NOT NULL,
  `appointment_id` VARCHAR(255) NOT NULL,
  `customer_id` VARCHAR(20) NOT NULL,
  `Rating` INT(11) NOT NULL CHECK (`Rating` BETWEEN 1 AND 5),
  `ReviewText` TEXT DEFAULT NULL,
  `ShowName` VARCHAR(20) NOT NULL DEFAULT 'anonymous',
  `ReviewDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
)
		


INSERT INTO tblservice (srv_id, srv_type, srv_name, srv_price) VALUES
(1, 'Hair Care', 'Classic Bob Cut', '120'),
(2, 'Hair Care', 'Balayage Highlights', '800'),
(3, 'Facial Care', 'Deep Cleansing Facial', '650'),
(4, 'Facial Care', 'Microdermabrasion', '900'),
(5, 'Nail Care', 'Gel Manicure', '350'),
(6, 'Nail Care', 'Acrylic Extensions', '500'),
(7, 'Body Care', 'Swedish Massage', '700'),
(8, 'Body Care', 'Hot Stone Therapy', '850'),
(9, 'Hair Care', 'Men\'s Fade Haircut', '150'),
(10, 'Facial Care', 'Anti-Aging Facial', '1000'),
(11, 'Nail Care', 'Pedicure with Callus Removal', '400'),
(12, 'Body Care', 'Aromatherapy Massage', '750'),
(13, 'Hair Care', 'Perming', '600'),
(14, 'Body Care', 'Full Body Scrub', '900');

