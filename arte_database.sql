/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - arte_database
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`arte_database` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `arte_database`;

/*Table structure for table `tblappointments` */

DROP TABLE IF EXISTS `tblappointments`;

CREATE TABLE `tblappointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `srv_id` int(11) NOT NULL,
  `unique_code` varchar(50) NOT NULL,
  `message` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`appointment_id`),
  UNIQUE KEY `unique_code` (`unique_code`),
  KEY `customerID_FK` (`customer_id`),
  KEY `serviceID_Fk` (`srv_id`),
  CONSTRAINT `customerID_FK` FOREIGN KEY (`customer_id`) REFERENCES `tblcustomer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `serviceID_Fk` FOREIGN KEY (`srv_id`) REFERENCES `tblservice` (`srv_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblappointments` */

insert  into `tblappointments`(`appointment_id`,`customer_id`,`appointment_date`,`appointment_time`,`srv_id`,`unique_code`,`message`) values 
(30,28,'2025-03-25','17:00:00',14,'35A3EBCC','I want to book an appointment.'),
(32,30,'2025-03-26','10:00:00',10,'4EC34D05','test');

/*Table structure for table `tblcustomer` */

DROP TABLE IF EXISTS `tblcustomer`;

CREATE TABLE `tblcustomer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblcustomer` */

insert  into `tblcustomer`(`customer_id`,`firstname`,`lastname`,`phone`) values 
(28,'Benjamin','Mahinay','09123456789'),
(29,'Irish','Mendoza','0999999990'),
(30,'Test','test','09876543212');

/*Table structure for table `tblreviews` */

DROP TABLE IF EXISTS `tblreviews`;

CREATE TABLE `tblreviews` (
  `ReviewID` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(255) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `Rating` int(11) NOT NULL,
  `ReviewText` text DEFAULT NULL,
  `ShowName` varchar(20) NOT NULL DEFAULT 'anonymous',
  `ReviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ReviewID`),
  CONSTRAINT `tblreviews_chk_1` CHECK (`Rating` between 1 and 5)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblreviews` */

insert  into `tblreviews`(`ReviewID`,`appointment_id`,`customer_id`,`Rating`,`ReviewText`,`ShowName`,`ReviewDate`) values 
(11,'30','28',3,'The Service is Great!','showName','2025-03-20 18:46:43');

/*Table structure for table `tblservice` */

DROP TABLE IF EXISTS `tblservice`;

CREATE TABLE `tblservice` (
  `srv_id` int(11) NOT NULL AUTO_INCREMENT,
  `srv_type` varchar(50) NOT NULL,
  `srv_name` varchar(50) NOT NULL,
  `srv_price` varchar(20) NOT NULL,
  PRIMARY KEY (`srv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblservice` */

insert  into `tblservice`(`srv_id`,`srv_type`,`srv_name`,`srv_price`) values 
(1,'Hair Care','Classic Bob Cut','100'),
(2,'Hair Care','Balayage Highlights','800'),
(3,'Facial Care','Deep Cleansing Facial','650'),
(4,'Facial Care','Microdermabrasion','900'),
(5,'Nail Care','Gel Manicure','350'),
(6,'Nail Care','Acrylic Extensions','500'),
(7,'Body Care','Swedish Massage','700'),
(8,'Body Care','Hot Stone Therapy','850'),
(9,'Hair Care','Men\'s Fade Haircut','150'),
(10,'Facial Care','Anti-Aging Facial','1000'),
(11,'Nail Care','Pedicure with Callus Removal','400'),
(12,'Body Care','Aromatherapy Massage','750'),
(13,'Hair Care','Perming','600'),
(14,'Body Care','Full Body Scrub','900'),
(15,'Body Care','Unlimited Warts Removal','1500'),
(17,'Nail Care','Manicure','250');

/*Table structure for table `tblstatus` */

DROP TABLE IF EXISTS `tblstatus`;

CREATE TABLE `tblstatus` (
  `unique_code` varchar(20) NOT NULL,
  `status_type` enum('Pending','Done','Cancelled') DEFAULT 'Pending',
  PRIMARY KEY (`unique_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblstatus` */

insert  into `tblstatus`(`unique_code`,`status_type`) values 
('35A3EBCC','Done'),
('3A414D8F','Pending'),
('4EC34D05','Cancelled');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
