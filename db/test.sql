/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `test`;

/*Table structure for table `appointments` */

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `market_id` int(11) DEFAULT NULL,
  `drop_off` enum('yes','no') DEFAULT NULL,
  `request_datetime` datetime DEFAULT NULL,
  `requested_services` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `vehicle_year` year(4) DEFAULT NULL,
  `vehicle_make` varchar(255) DEFAULT NULL,
  `vehicle_model` varchar(255) DEFAULT NULL,
  `vehicle_option` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `preferred_contact_method` enum('email','phone','other') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `appointments` */

insert  into `appointments`(`id`,`location_id`,`dealer_id`,`market_id`,`drop_off`,`request_datetime`,`requested_services`,`comments`,`vehicle_year`,`vehicle_make`,`vehicle_model`,`vehicle_option`,`first_name`,`last_name`,`email`,`phone`,`preferred_contact_method`,`created_at`,`updated_at`) values 
(1,1,1,1,'yes','2024-03-15 09:00:00','Oil Change','No additional comments',2018,'Toyota','Camry','LE','John','Doe','john.doe@example.com','123-456-7890','email','2024-03-15 12:32:52','2024-03-15 12:32:52'),
(2,2,2,2,'no','2024-03-16 10:30:00','Brake Replacement','Please call before starting the service',2019,'Honda','Accord','Sport','Jane','Smith','jane.smith@example.com','234-567-8901','phone','2024-03-15 12:32:52','2024-03-15 12:32:52'),
(3,3,3,3,'yes','2024-03-17 11:15:00','Tire Rotation','N/A',2020,'Ford','Fusion','SE','Alice','Johnson','alice.johnson@example.com','345-678-9012','other','2024-03-15 12:32:52','2024-03-15 12:32:52');

/*Table structure for table `contents` */

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `dealeredit` enum('0','1') DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `begindate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `imagealt` varchar(255) DEFAULT NULL,
  `imagelink` varchar(255) DEFAULT NULL,
  `imagelinktarget` enum('0','1') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `buttonlabel` varchar(255) DEFAULT NULL,
  `buttonlink` varchar(255) DEFAULT NULL,
  `buttonlinktarget` enum('0','1') DEFAULT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `participate_locations` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `contents` */

insert  into `contents`(`id`,`title`,`dealeredit`,`status`,`begindate`,`enddate`,`image`,`imagealt`,`imagelink`,`imagelinktarget`,`description`,`buttonlabel`,`buttonlink`,`buttonlinktarget`,`sortorder`,`participate_locations`,`created_at`,`updated_at`) values 
(1,'Car Care One Card','0','1','2024-03-01','2024-03-13',NULL,NULL,'http://www.carx.com/save-up-to-100-on-tires?utm_campaign=Fall%202014%20Tire%20Promotion&utm_source=Web',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-13 14:39:27');

/*Table structure for table `coupons` */

DROP TABLE IF EXISTS `coupons`;

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  `description` text DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `barcode_text` varchar(255) DEFAULT NULL,
  `coupon_footer` text DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `renewal_options` enum('0','1') DEFAULT '0',
  `ppc` enum('0','1') DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `coupons` */

insert  into `coupons`(`id`,`title`,`dealer_id`,`status`,`description`,`service_type`,`barcode_text`,`coupon_footer`,`expiration_date`,`renewal_options`,`ppc`,`created_at`,`updated_at`) values 
(1,'Coupon 1',1,'1','Description for Coupon 1','Service Type 1','123456789','Footer for Coupon 1','2024-03-01','1','0','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(2,'Coupon 2',2,'1','Description for Coupon 2','Service Type 2','987654321','Footer for Coupon 2','2024-03-05','0','1','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(3,'Coupon 3',3,'0','Description for Coupon 3','Service Type 3','ABCDEFGH','Footer for Coupon 3','2024-03-10','1','0','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(4,'Coupon 4',1,'1','Description for Coupon 4','Service Type 1','1A2B3C4D','Footer for Coupon 4','2024-03-15','0','1','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(5,'Coupon 5',2,'0','Description for Coupon 5','Service Type 2','5E6F7G8H','Footer for Coupon 5','2024-03-20','1','0','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(6,'Coupon 6',3,'1','Description for Coupon 6','Service Type 3','9I0J1K2L','Footer for Coupon 6','2024-03-25','0','1','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(7,'Coupon 7',1,'0','Description for Coupon 7','Service Type 1','123ABC456DEF','Footer for Coupon 7','2024-03-30','1','0','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(8,'Coupon 8',2,'1','Description for Coupon 8','Service Type 2','789XYZ321LMN','Footer for Coupon 8','2024-04-01','0','1','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(9,'Coupon 9',3,'0','Description for Coupon 9','Service Type 3','ABCDEFG123456','Footer for Coupon 9','2024-04-05','1','0','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(10,'Coupon 10',1,'1','Description for Coupon 10','Service Type 1','987ZYX654321','Footer for Coupon 10','2024-04-10','0','1','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(11,'Coupon 11',2,'0','Description for Coupon 11','Service Type 2','1A2B3C4D5E6F','Footer for Coupon 11','2024-04-15','1','0','2024-03-07 12:50:41','2024-03-07 12:50:41'),
(12,'test coupon',1,'1','<p>this is description</p>','1','testing00',NULL,'2024-03-11','1','0','2024-03-14 10:53:57','2024-03-14 10:53:57'),
(13,'testing coupon2',1,'1','<p>frjfbrfuhuif</p>','1','testing001',NULL,'2024-03-23','0','0','2024-03-14 10:56:20','2024-03-14 16:04:19');

/*Table structure for table `dealers` */

DROP TABLE IF EXISTS `dealers`;

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `office_phone` varchar(15) NOT NULL,
  `office_address` varchar(255) NOT NULL,
  `office_state` varchar(255) NOT NULL,
  `office_city` varchar(255) NOT NULL,
  `office_zip` varchar(10) NOT NULL,
  `mailchimp_form_action` varchar(255) DEFAULT NULL,
  `holiday_sets` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `dealers` */

insert  into `dealers`(`id`,`first_name`,`last_name`,`email`,`password`,`office_phone`,`office_address`,`office_state`,`office_city`,`office_zip`,`mailchimp_form_action`,`holiday_sets`,`created_at`,`updated_at`) values 
(1,'John','Doe','john.doe@example.com','password123','1234567891','123 Main St','AL','Los Angeles','90001','https://example.com/mailchimp',NULL,NULL,'2024-03-05 11:29:13'),
(2,'Alice','Smith','alice.smith@example.com','password456','0987654321','456 Elm St','New York','New York City','10001','https://example.com/mailchimp',NULL,NULL,NULL),
(3,'Mike','Johnson','mike.johnson@example.com','password789','1112223333','789 Oak St','Texas','Houston','77001','https://example.com/mailchimp',NULL,NULL,NULL),
(4,'Ali','Khan','ali.khan@example.com','password123','03001234567','123 Main Street','Punjab','Lahore','54000','https://example.com/mailchimp',NULL,NULL,NULL),
(5,'Sara','Ahmed','sara.ahmed@example.com','password456','03111234567','456 Park Avenue','Sindh','Karachi','75300','https://example.com/mailchimp',NULL,NULL,NULL),
(6,'Ahmed','Malik','ahmed.malik@example.com','password789','03221234567','789 Crescent Road','Balochistan','Quetta','87300','https://example.com/mailchimp',NULL,NULL,NULL),
(7,'Fatima','Khan','fatima.khan@example.com','password987','03331234567','456 Garden Street','Punjab','Rawalpindi','46000','https://example.com/mailchimp',NULL,NULL,NULL),
(8,'Usman','Ali','usman.ali@example.com','password654','03441234567','789 Lakeview Boulevard','Khyber Pakhtunkhwa','Peshawar','25000','https://example.com/mailchimp',NULL,NULL,NULL),
(9,'Ayesha','Hussain','ayesha.hussain@example.com','password321','03551234567','123 Hillside Avenue','Punjab','Faisalabad','38000','https://example.com/mailchimp',NULL,NULL,NULL),
(10,'Imran','Ahmed','imran.ahmed@example.com','password135','03661234567','456 Forest Road','Sindh','Hyderabad','71000','https://example.com/mailchimp',NULL,NULL,NULL),
(11,'Sadia','Riaz','sadia.riaz@example.com','password246','03771234567','789 Maple Street','Balochistan','Gwadar','92000','https://example.com/mailchimp',NULL,NULL,NULL),
(12,'Kamran','Iqbal','kamran.iqbal@example.com','password579','03881234567','123 Oakwood Drive','Punjab','Multan','60000','https://example.com/mailchimp',NULL,NULL,NULL),
(13,'Fiza','Rehman','fiza.rehman@example.com','password468','03991234567','456 Pine Avenue','Khyber Pakhtunkhwa','Abbottabad','22010','https://example.com/mailchimp',NULL,NULL,NULL),
(14,'Bilal','Khalid','bilal.khalid@example.com','password753','03121234567','789 Rosewood Lane','Sindh','Sukkur','65200','https://example.com/mailchimp',NULL,NULL,NULL),
(15,'Nadia','Hussain','nadia.hussain@example.com','password951','03231234567','123 Cedar Street','Balochistan','Turbat','92600','https://example.com/mailchimp',NULL,NULL,NULL),
(16,'Ali','Malik','ali.malik@example.com','password357','03341234567','456 Elmwood Avenue','Punjab','Gujranwala','52250','https://example.com/mailchimp',NULL,NULL,NULL),
(17,'Sana','Rafique','sana.rafique@example.com','password852','03451234567','789 Ashwood Drive','Khyber Pakhtunkhwa','Haripur','22620','https://example.com/mailchimp',NULL,NULL,NULL),
(18,'Tahir','Iqbal','tahir.iqbal@example.com','password753','03561234567','123 Birch Street','Sindh','Larkana','77150','https://example.com/mailchimp',NULL,NULL,NULL),
(19,'Hina','Aslam','hina.aslam@example.com','password468','03671234567','456 Hickory Lane','Balochistan','Khuzdar','89100','https://example.com/mailchimp',NULL,NULL,NULL),
(20,'Junaid','Khan','junaid.khan@example.com','password159','03781234567','789 Pine Street','Punjab','Sialkot','51310','https://example.com/mailchimp',NULL,NULL,NULL),
(21,'Amna','Saleem','amna.saleem@example.com','password753','03891234567','123 Cherry Lane','Khyber Pakhtunkhwa','Mardan','23200','https://example.com/mailchimp',NULL,NULL,NULL),
(22,'Rizwan','Ali','rizwan.ali@example.com','password246','03901234567','456 Willow Street','Sindh','Mirpur Khas','69000','https://example.com/mailchimp',NULL,NULL,NULL),
(23,'Maryam','Khalid','maryam.khalid@example.com','password579','03131234567','789 Magnolia Avenue','Balochistan','Chaman','86200','https://example.com/mailchimp',NULL,NULL,NULL),
(24,'Asad','Nawaz','asad.nawaz@example.com','password468','03231234567','123 Pineview Drive','Punjab','Bahawalpur','63100','https://example.com/mailchimp',NULL,NULL,NULL),
(25,'Bushra','Asif','bushra.asif@example.com','password753','03331234567','456 Oak Lane','Khyber Pakhtunkhwa','Charsadda','24660','https://example.com/mailchimp',NULL,NULL,NULL),
(26,'Nabeel','Ahmed','nabeel.ahmed@example.com','password246','03431234567','789 Elm Street','Sindh','Jacobabad','79000','https://example.com/mailchimp',NULL,NULL,NULL),
(27,'Amber','Khan','amber.khan@example.com','password579','03531234567','123 Maple Lane','Balochistan','Kharan','88000','https://example.com/mailchimp',NULL,NULL,NULL),
(28,'Faisal','Akhtar','faisal.akhtar@example.com','password468','03631234567','456 Cedar Lane','Punjab','Gujrat','50700','https://example.com/mailchimp',NULL,NULL,NULL),
(29,'Farah','Shah','farah.shah@example.com','password753','03731234567','789 Walnut Street','Khyber Pakhtunkhwa','Nowshera','24100','https://example.com/mailchimp',NULL,NULL,NULL),
(30,'Waqar','Ali','waqar.ali@example.com','password246','03831234567','123 Birch Lane','Sindh','Shikarpur','78100','https://example.com/mailchimp',NULL,NULL,NULL),
(31,'Ayesha','Bashir','ayesha.bashir@example.com','password579','03931234567','456 Spruce Lane','Balochistan','Pasni','92800','https://example.com/mailchimp',NULL,NULL,NULL),
(32,'Imran','Nazir','imran.nazir@example.com','password468','03041234567','789 Willow Lane','Punjab','Sahiwal','57000','https://example.com/mailchimp',NULL,NULL,NULL),
(33,'Sadia','Aslam','sadia.aslam@example.com','password753','03151234567','123 Cedar Lane','Khyber Pakhtunkhwa','Swabi','23430','https://example.com/mailchimp',NULL,NULL,NULL),
(34,'Hamza','Iqbal','hamza.iqbal@example.com','password246','03251234567','456 Maple Lane','Sindh','Sanghar','68100','https://example.com/mailchimp',NULL,NULL,NULL),
(35,'Amina','Malik','amina.malik@example.com','password579','03351234567','789 Oak Lane','Balochistan','Ormara','91500','https://example.com/mailchimp',NULL,NULL,NULL),
(36,'Ahmed','Khan','ahmed.khan@example.com','password468','03451234567','123 Walnut Lane','Punjab','Sargodha','40100','https://example.com/mailchimp',NULL,NULL,NULL),
(37,'Hira','Shah','hira.shah@example.com','password753','03551234567','456 Pine Lane','Khyber Pakhtunkhwa','Tank','24420','https://example.com/mailchimp',NULL,NULL,NULL),
(38,'Bilal','Ahmed','bilal.ahmed@example.com','password246','03651234567','789 Cedar Lane','Sindh','Sukkur','65100','https://example.com/mailchimp',NULL,NULL,NULL),
(39,'Sana','Khalid','sana.khalid@example.com','password579','03751234567','123 Elm Lane','Balochistan','Panjgur','90300','https://example.com/mailchimp',NULL,NULL,NULL),
(40,'Saad','Ali','saad.ali@example.com','password468','03851234567','456 Oakwood Drive','Punjab','Sheikhupura','39350','https://example.com/mailchimp',NULL,NULL,NULL),
(41,'Ayesha','Raza','ayesha.raza@example.com','password753','03951234567','789 Willow Lane','Khyber Pakhtunkhwa','Swat','19130','https://example.com/mailchimp',NULL,NULL,NULL),
(42,'Zain','Ahmed','zain.ahmed@example.com','password246','03061234567','123 Cedar Lane','Sindh','Shahdadpur','67200','https://example.com/mailchimp',NULL,NULL,NULL),
(43,'Amina','Farooq','amina.farooq@example.com','password579','03161234567','456 Birch Lane','Balochistan','Pishin','87400','https://example.com/mailchimp',NULL,NULL,NULL),
(44,'Ahmed','Rashid','ahmed.rashid@example.com','password468','03261234567','789 Pine Lane','Punjab','Sialkot','51310','https://example.com/mailchimp',NULL,NULL,NULL),
(45,'Sadia','Khan','sadia.khan@example.com','password753','03361234567','123 Maple Lane','Khyber Pakhtunkhwa','Taxila','47050','https://example.com/mailchimp',NULL,NULL,NULL),
(46,'Bilal','Malik','bilal.malik@example.com','password246','03461234567','456 Elm Lane','Sindh','Shikarpur','78100','https://example.com/mailchimp',NULL,NULL,NULL),
(47,'Sana','Ahmed','sana.ahmed@example.com','password579','03561234567','789 Cedar Lane','Balochistan','Pasni','92800','https://example.com/mailchimp',NULL,NULL,NULL),
(48,'Faisal','Khan','faisal.khan@example.com','password468','03661234567','123 Oak Lane','Punjab','Faisalabad','38000','https://example.com/mailchimp',NULL,NULL,NULL),
(49,'Hina','Arif','hina.arif@example.com','password753','03761234567','456 Elmwood Drive','Khyber Pakhtunkhwa','Mingora','19200','https://example.com/mailchimp',NULL,NULL,NULL),
(50,'Imran','Raza','imran.raza@example.com','password246','03861234567','789 Maple Lane','Sindh','Sukkur','65200','https://example.com/mailchimp',NULL,NULL,NULL),
(51,'Asma','Ali','asma.ali@example.com','password579','03961234567','123 Cedar Lane','Balochistan','Ormara','91500','https://example.com/mailchimp',NULL,NULL,NULL),
(52,'Tariq','Ahmed','tariq.ahmed@example.com','password468','03071234567','456 Oakwood Drive','Punjab','Gujranwala','52250','https://example.com/mailchimp',NULL,NULL,NULL),
(53,'Sadia','Khalid','sadia.khalid@example.com','password753','03171234567','789 Pineview Drive','Khyber Pakhtunkhwa','Abbottabad','22010','https://example.com/mailchimp',NULL,NULL,NULL),
(54,'Ali','Aslam','ali.aslam@example.com','password246','03271234567','123 Birch Lane','Sindh','Sanghar','68100','https://example.com/mailchimp',NULL,NULL,NULL),
(55,'Sara','Khan','sara.khan@example.com','password579','03371234567','456 Maple Lane','Balochistan','Chaman','86200','https://example.com/mailchimp',NULL,NULL,NULL),
(56,'Noman','Ahmed','noman.ahmed@example.com','password468','03471234567','789 Pine Lane','Punjab','Lahore','54000','https://example.com/mailchimp',NULL,NULL,NULL),
(57,'Ayesha','Rafique','ayesha.rafique@example.com','password753','03571234567','123 Cherry Lane','Khyber Pakhtunkhwa','Peshawar','25000','https://example.com/mailchimp',NULL,NULL,NULL),
(58,'Bilal','Khan','bilal.khan@example.com','password246','03671234567','456 Hillside Drive','Sindh','Karachi','75300','https://',NULL,NULL,NULL),
(59,'Sana','Malik','sana.malik@example.com','password579','03771234567','789 Garden Street','Balochistan','Quetta','87300','https://example.com/mailchimp',NULL,NULL,NULL),
(60,'Amna','Riaz','amna.riaz@example.com','password468','03871234567','123 Lakeview Boulevard','Punjab','Rawalpindi','46000','https://example.com/mailchimp',NULL,NULL,NULL),
(61,'Ahmed','Khalid','ahmed.khalid@example.com','password753','03971234567','456 Hillside Avenue','Khyber Pakhtunkhwa','Haripur','22620','https://example.com/mailchimp',NULL,NULL,NULL),
(62,'Hina','Ali','hina.ali@example.com','password246','03081234567','789 Forest Road','Sindh','Hyderabad','71000','https://example.com/mailchimp',NULL,NULL,NULL),
(63,'Junaid','Aslam','junaid.aslam@example.com','password579','03181234567','123 Crescent Road','Balochistan','Gwadar','92000','https://example.com/mailchimp',NULL,NULL,NULL),
(64,'Amber','Akhtar','amber.akhtar@example.com','password468','03281234567','456 Maple Street','Punjab','Multan','60000','https://example.com/mailchimp',NULL,NULL,NULL),
(65,'Ali','Hussain','ali.hussain@example.com','password753','03381234567','789 Oakwood Lane','Khyber Pakhtunkhwa','Mardan','23200','https://example.com/mailchimp',NULL,NULL,NULL),
(66,'Sana','Shah','sana.shah@example.com','password246','03481234567','123 Magnolia Avenue','Sindh','Larkana','77150','https://example.com/mailchimp',NULL,NULL,NULL),
(67,'Sadia','Khan','sadia.khan@example.com','password579','03581234567','456 Rosewood Lane','Balochistan','Gujrat','50700','https://example.com/mailchimp',NULL,NULL,NULL),
(68,'Ahmed','Ali','ahmed.ali@example.com','password468','03681234567','789 Pine Street','Khyber Pakhtunkhwa','Nowshera','24100','https://example.com/mailchimp',NULL,NULL,NULL),
(69,'Fatima','Raza','fatima.raza@example.com','password753','03781234567','123 Cherry Lane','Sindh','Jacobabad','79000','https://example.com/mailchimp',NULL,NULL,NULL),
(70,'Bilal','Farooq','bilal.farooq@example.com','password246','03881234567','456 Willow Lane','Balochistan','Kharan','88000','https://example.com/mailchimp',NULL,NULL,NULL),
(71,'Sadia','Shah','sadia.shah@example.com','password579','03981234567','789 Cedar Street','Punjab','Gujranwala','52250','https://example.com/mailchimp',NULL,NULL,NULL),
(72,'Asad','Malik','asad.malik@example.com','password468','03091234567','123 Elmwood Drive','Khyber Pakhtunkhwa','Swabi','23430','https://example.com/mailchimp',NULL,NULL,NULL),
(73,'Hira','Iqbal','hira.iqbal@example.com','password753','03191234567','456 Oakwood Lane','Sindh','Shikarpur','78100','https://example.com/mailchimp',NULL,NULL,NULL),
(74,'Noman','Khan','noman.khan@example.com','password246','03291234567','789 Pine Lane','Balochistan','Pasni','92800','https://example.com/mailchimp',NULL,NULL,NULL),
(75,'Ali','Shah','ali.shah@example.com','password579','03391234567','123 Elm Lane','Punjab','Sahiwal','57000','https://example.com/mailchimp',NULL,NULL,NULL),
(76,'Sara','Aslam','sara.aslam@example.com','password468','03491234567','456 Oak Lane','Khyber Pakhtunkhwa','Tank','24420','https://example.com/mailchimp',NULL,NULL,NULL),
(77,'Zain','Khalid','zain.khalid@example.com','password753','03591234567','789 Birch Lane','Sindh','Sukkur','65100','https://example.com/mailchimp',NULL,NULL,NULL),
(78,'Amina','Ali','amina.ali@example.com','password246','03691234567','123 Cedar Lane','Balochistan','Panjgur','90300','https://example.com/mailchimp',NULL,NULL,NULL),
(79,'Ahmed','Aslam','ahmed.aslam@example.com','password579','03791234567','456 Spruce Lane','Punjab','Sheikhupura','39350','https://example.com/mailchimp',NULL,NULL,NULL),
(80,'Hina','Khan','hina.khan@example.com','password468','03891234567','789 Willow Lane','Khyber Pakhtunkhwa','Swat','19130','https://example.com/mailchimp',NULL,NULL,NULL),
(81,'Imran','Ali','imran.ali@example.com','password753','03991234567','123 Cedar Lane','Sindh','Shahdadpur','67200','https://example.com/mailchimp',NULL,NULL,NULL),
(82,'Asma','Raza','asma.raza@example.com','password246','03001234567','456 Maple Lane','Balochistan','Pishin','87400','https://example.com/mailchimp',NULL,NULL,NULL),
(83,'Tariq','Ahmed','tariq.ahmed@example.com','password579','03101234567','789 Pine Lane','Punjab','Sialkot','51310','https://example.com/mailchimp',NULL,NULL,NULL),
(84,'Sadia','Khalid','sadia.khalid@example.com','password468','03201234567','123 Maple Lane','Khyber Pakhtunkhwa','Taxila','47050','https://example.com/mailchimp',NULL,NULL,NULL),
(85,'Ali','Aslam','ali.aslam@example.com','password753','03301234567','456 Elm Lane','Sindh','Shikarpur','78100','https://example.com/mailchimp',NULL,NULL,NULL),
(86,'Michael','Johnson','michael.johnson@example.com','password789','1234567892','789 Crescent Road','Texas','Houston','77001','https://example.com/mailchimp',NULL,NULL,NULL),
(87,'Jennifer','Williams','jennifer.williams@example.com','password987','1234567893','456 Garden Street','Florida','Miami','33101','https://example.com/mailchimp',NULL,NULL,NULL),
(88,'Christopher','Brown','christopher.brown@example.com','password654','1234567894','789 Lakeview Boulevard','Illinois','Chicago','60601','https://example.com/mailchimp',NULL,NULL,NULL),
(89,'Jessica','Jones','jessica.jones@example.com','password321','1234567895','123 Hillside Avenue','Pennsylvania','Philadelphia','19101','https://example.com/mailchimp',NULL,NULL,NULL),
(90,'Matthew','Davis','matthew.davis@example.com','password135','1234567896','456 Forest Road','Ohio','Columbus','43201','https://example.com/mailchimp',NULL,NULL,NULL),
(91,'Amanda','Miller','amanda.miller@example.com','password246','1234567897','789 Maple Street','Michigan','Detroit','48201','https://example.com/mailchimp',NULL,NULL,NULL),
(92,'Daniel','Wilson','daniel.wilson@example.com','password579','1234567898','123 Oakwood Drive','North Carolina','Charlotte','28201','https://example.com/mailchimp',NULL,NULL,NULL),
(93,'Sarah','Moore','sarah.moore@example.com','password468','1234567899','456 Pine Avenue','Georgia','Atlanta','30301','https://example.com/mailchimp',NULL,NULL,NULL),
(94,'David','Taylor','david.taylor@example.com','password753','1234567800','789 Rosewood Lane','New Jersey','Newark','07101','https://example.com/mailchimp',NULL,NULL,NULL),
(95,'Ashley','Anderson','ashley.anderson@example.com','password246','1234567801','123 Cedar Street','Virginia','Virginia Beach','23451','https://example.com/mailchimp',NULL,NULL,NULL),
(96,'James','Thomas','james.thomas@example.com','password579','1234567802','456 Hickory Lane','Washington','Seattle','98101','https://example.com/mailchimp',NULL,NULL,NULL),
(97,'Elizabeth','Jackson','elizabeth.jackson@example.com','password468','1234567803','789 Pineview Drive','Indiana','Indianapolis','46201','https://example.com/mailchimp',NULL,NULL,NULL),
(98,'Joshua','White','joshua.white@example.com','password753','1234567804','123 Cherry Lane','Tennessee','Nashville','37201','https://example.com/mailchimp',NULL,NULL,NULL),
(99,'Megan','Harris','megan.harris@example.com','password246','1234567805','456 Oak Lane','Massachusetts','Boston','02101','https://example.com/mailchimp',NULL,NULL,NULL),
(100,'Ryan','Martin','ryan.martin@example.com','password579','1234567806','789 Willow Lane','Arizona','Phoenix','85001','https://example.com/mailchimp',NULL,NULL,NULL),
(101,'Lauren','Thompson','lauren.thompson@example.com','password468','1234567807','123 Birch Lane','Missouri','Kansas City','64101','https://example.com/mailchimp',NULL,NULL,NULL),
(102,'Kevin','Garcia','kevin.garcia@example.com','password753','1234567808','456 Spruce Lane','Maryland','Baltimore','21201','https://example.com/mailchimp',NULL,NULL,NULL),
(103,'Olivia','Martinez','olivia.martinez@example.com','password246','1234567809','789 Elm Lane','Wisconsin','Milwaukee','53201','https://example.com/mailchimp',NULL,NULL,NULL),
(104,'Justin','Robinson','justin.robinson@example.com','password579','1234567810','123 Walnut Lane','Minnesota','Minneapolis','55401','https://example.com/mailchimp',NULL,NULL,NULL),
(105,'Emma','Walker','emma.walker@example.com','password468','1234567811','456 Pine Lane','South Carolina','Columbia','29201','https://example.com/mailchimp',NULL,NULL,NULL),
(106,'Brandon','Perez','brandon.perez@example.com','password753','1234567812','789 Cedar Lane','Alabama','Birmingham','35201','https://example.com/mailchimp',NULL,NULL,NULL),
(107,'Rachel','Sanchez','rachel.sanchez@example.com','password246','1234567813','123 Elm Lane','Louisiana','New Orleans','70112','https://example.com/mailchimp',NULL,NULL,NULL),
(108,'Andrew','Russell','andrew.russell@example.com','password579','1234567814','456 Oakwood Drive','Kentucky','Louisville','40201','https://example.com/mailchimp',NULL,NULL,NULL),
(109,'Nicole','Ramirez','nicole.ramirez@example.com','password468','1234567815','789 Pine Lane','Oklahoma','Oklahoma City','73101','https://example.com/mailchimp',NULL,NULL,NULL),
(110,'Jacob','Watson','jacob.watson@example.com','password753','1234567816','123 Maple Lane','Connecticut','Bridgeport','06601','https://example.com/mailchimp',NULL,NULL,NULL),
(111,'Haley','Ross','haley.ross@example.com','password246','1234567817','456 Rosewood Lane','Iowa','Des Moines','50301','https://example.com/mailchimp',NULL,NULL,NULL),
(112,'Alexander','Gonzalez','alexander.gonzalez@example.com','password579','1234567818','789 Cedar Lane','Mississippi','Jackson','39201','https://example.com/mailchimp',NULL,NULL,NULL),
(122,'mine','tetsing','john.doe@example.com','password123','1234567890','123 Main St','AL','Los Angeles','90001','https://example.com/mailchimp','6003,6012,8633','2024-03-19 15:51:13','2024-03-21 07:51:40');

/*Table structure for table `dummy_table` */

DROP TABLE IF EXISTS `dummy_table`;

CREATE TABLE `dummy_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `dummy_table` */

insert  into `dummy_table`(`id`,`name`,`age`) values 
(1,'John Doe',30),
(2,'Jane Doe',25),
(3,'Alice',35),
(4,'Bob',40);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `holiday_sets` */

DROP TABLE IF EXISTS `holiday_sets`;

CREATE TABLE `holiday_sets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9687 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `holiday_sets` */

insert  into `holiday_sets`(`id`,`post_title`,`created_at`,`updated_at`) values 
(5952,'test062019','2024-03-21 12:15:06',NULL),
(5997,'Holiday Hours Franchise','2024-03-21 12:15:06',NULL),
(6003,'Holiday Hours Corporate','2024-03-21 12:15:06',NULL),
(6012,'Holiday Hours Corporate Open Independence Day','2024-03-21 12:15:06',NULL),
(7414,'Temporarily closed','2024-03-21 12:15:06',NULL),
(7546,'COVID-19 Buten Glen Este construction','2024-03-21 12:15:06',NULL),
(8633,'Kelly Tires','2024-03-21 12:15:06',NULL),
(8711,'Des Plaines Grand Opening','2024-03-21 12:15:06',NULL),
(8728,'Milford closed Monday','2024-03-21 12:15:06',NULL),
(8730,'July 5, 2021','2024-03-21 12:15:06',NULL),
(8732,'July 3, 2021','2024-03-21 12:15:06',NULL),
(8979,'Express Oil Change','2024-03-21 12:15:06',NULL),
(9213,'Memorial Day Des Moines','2024-03-21 12:15:06',NULL),
(9684,'Springdale temporarily closed','2024-03-21 12:15:06',NULL),
(9686,'Jefferson St Springfield temporarily closed','2024-03-21 12:15:06',NULL);

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `market_id` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `locations` */

insert  into `locations`(`id`,`market_id`,`dealer_id`,`title`,`address1`,`address2`,`neighborhood`,`city`,`state`,`status`,`created_at`,`updated_at`) values 
(1,1,1,'Cincinnati','9326 Colerain Ave','','Downtown','City A','State A','Active','2024-03-06 17:28:28','2024-03-18 15:20:30'),
(2,1,2,'Schaumburg','423 W Golf Rd','','Suburbia','City B','State B','Active','2024-03-06 17:28:28','2024-03-18 15:21:53'),
(3,1,3,'Hazelwood','8100 Lindbergh North','','Rural','City C','State C','Active','2024-03-06 17:28:28','2024-03-18 15:22:21'),
(4,1,4,'University City','7720 Olive Blvd','','Urban','City D','State D','Active','2024-03-06 17:28:28','2024-03-18 15:24:51'),
(5,1,5,'Location 5','202 Maple St','','City Center','City E','State E','Active','2024-03-06 17:28:28','2024-03-06 19:15:19'),
(6,1,6,'Location 6','303 Cedar St','','Downtown','City F','State F','Active','2024-03-06 17:28:28','2024-03-06 19:15:21'),
(7,1,7,'Location 7','404 Walnut St','','Suburbia','City G','State G','Active','2024-03-06 17:28:28','2024-03-06 19:15:20'),
(8,1,8,'Location 8','505 Birch St','','Rural','City H','State H','Active','2024-03-06 17:28:28','2024-03-06 19:15:22'),
(9,1,9,'Location 9','606 Ash St','','Urban','City I','State I','Active','2024-03-06 17:28:28','2024-03-06 19:15:23'),
(10,1,10,'Location 10','707 Sycamore St','','City Center','City J','State J','Active','2024-03-06 17:28:28','2024-03-06 19:15:23'),
(11,21,11,'Location 11','808 Pineapple St','','Downtown','City K','State K','Active','2024-03-06 17:28:28','2024-03-06 19:15:54'),
(12,21,12,'Location 12','909 Banana St','','Suburbia','City L','State L','Active','2024-03-06 17:28:28','2024-03-06 19:15:55'),
(13,0,13,'Location 13','111 Apple St','','Rural','City M','State M','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(14,0,14,'Location 14','222 Orange St','','Urban','City N','State N','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(15,0,15,'Location 15','333 Mango St','','City Center','City O','State O','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(16,0,16,'Location 16','444 Papaya St','','Downtown','City P','State P','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(17,0,17,'Location 17','555 Kiwi St','','Suburbia','City Q','State Q','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(18,0,18,'Location 18','666 Guava St','','Rural','City R','State R','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(19,0,19,'Location 19','777 Durian St','','Urban','City S','State S','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(20,0,20,'Location 20','888 Dragonfruit St','','City Center','City T','State T','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(21,0,21,'Location 21','999 Lychee St','','Downtown','City U','State U','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(22,0,22,'Location 22','121 Avocado St','','Suburbia','City V','State V','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(23,0,23,'Location 23','232 Pineapple St','','Rural','City W','State W','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(24,0,24,'Location 24','343 Coconut St','','Urban','City X','State X','Active','2024-03-06 17:28:28','2024-03-06 17:28:28'),
(25,2,25,'Location 25','454 Mango St','','City Center','City Y','State Y','Active','2024-03-06 17:28:28','2024-03-06 19:40:46');

/*Table structure for table `markets` */

DROP TABLE IF EXISTS `markets`;

CREATE TABLE `markets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `markets` */

insert  into `markets`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Austin','2024-03-05 19:46:30',NULL),
(2,'Chicago','2024-03-05 19:46:39',NULL),
(3,'Dayton','2024-03-06 12:35:54',NULL),
(4,'Evansville','2024-03-06 12:35:55',NULL),
(5,'Iowa City	','2024-03-06 12:36:09',NULL),
(6,'Lafayette','2024-03-06 12:36:17',NULL),
(7,'Macomb','2024-03-06 12:36:21',NULL),
(8,'Minneapolis','2024-03-06 12:36:29',NULL),
(9,'Peoria','2024-03-06 12:36:34',NULL),
(10,'Quad Cities	','2024-03-06 12:36:39',NULL),
(11,'Rochester','2024-03-06 12:36:45',NULL),
(12,'San Antonio	','2024-03-06 12:36:50',NULL),
(13,'South Bend	','2024-03-06 12:36:54',NULL),
(14,'Murfreesboro','2024-03-06 12:37:01',NULL),
(15,'Springfield MO	','2024-03-06 12:37:07',NULL),
(16,'Bloomington','2024-03-06 14:23:05',NULL),
(17,'Central IL	','2024-03-06 14:23:12',NULL),
(18,'Des Moines','2024-03-06 14:23:31',NULL),
(19,'Eau Claire','2024-03-06 14:23:49','2024-03-06 14:23:49'),
(20,'Fox Cities','2024-03-06 14:24:05',NULL),
(21,'Green Bay','2024-03-06 14:24:15',NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

insert  into `password_reset_tokens`(`email`,`token`,`created_at`) values 
('ali@gmail.com','$2y$12$raBiVN4eqdpPYzkSxs56/eWuO0hpf/aTt0OObVVeCzWEslv5FFF7.','2024-02-26 12:59:29');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=524 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'ali','tariq','ali tariq','ali@gmail.com',NULL,'$2y$12$gvjHQryphU7uJu2Oj9Fh0uOsA3iOSegnrm7nw0tpVkbDJzuCrXhR2',NULL,'2024-02-19 08:37:25','2024-02-19 08:37:25'),
(4,'usman','gmail','usman1','usman@gmail.com',NULL,'$2y$12$pqLsuuXvYBSghZSm4XUFfem0DQtbXGmL3WjeIpoFirbWoSRXQtinS',NULL,'2024-02-19 13:03:08','2024-02-19 13:03:08'),
(6,'taimoor','feb28','test28','feb28@gmail.com',NULL,'',NULL,NULL,NULL),
(7,'usman2','bhoom','usman2','usman1@gmail.com',NULL,'',NULL,NULL,NULL),
(285,'Ahmed','Khan','','ahmed.khan@example.com',NULL,'',NULL,NULL,NULL),
(286,'Ali','Abbasi','','ali.abbasi@example.com',NULL,'',NULL,NULL,NULL),
(287,'Hassan','Raza','','hassan.raza@example.com',NULL,'',NULL,NULL,NULL),
(288,'Hussain','Hussain','','hussain.hussain@example.com',NULL,'',NULL,NULL,NULL),
(289,'Mohammad','Malik','','mohammad.malik@example.com',NULL,'',NULL,NULL,NULL),
(290,'Omar','Ahmed','','omar.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(291,'Fahad','Shaikh','','fahad.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(292,'Bilal','Butt','','bilal.butt@example.com',NULL,'',NULL,NULL,NULL),
(293,'Zain','Mirza','','zain.mirza@example.com',NULL,'',NULL,NULL,NULL),
(294,'Zohaib','Siddiqui','','zohaib.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(295,'Ayesha','Khan','','ayesha.khan@example.com',NULL,'',NULL,NULL,NULL),
(296,'Sana','Ali','','sana.ali@example.com',NULL,'',NULL,NULL,NULL),
(297,'Fatima','Raza','','fatima.raza@example.com',NULL,'',NULL,NULL,NULL),
(298,'Maryam','Hussain','','maryam.hussain@example.com',NULL,'',NULL,NULL,NULL),
(299,'Amina','Malik','','amina.malik@example.com',NULL,'',NULL,NULL,NULL),
(300,'Saima','Ahmed','','saima.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(301,'Bushra','Shaikh','','bushra.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(302,'Nazia','Butt','','nazia.butt@example.com',NULL,'',NULL,NULL,NULL),
(303,'Alishba','Mirza','','alishba.mirza@example.com',NULL,'',NULL,NULL,NULL),
(304,'Hira','Siddiqui','','hira.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(305,'Imran','Khan','','imran.khan@example.com',NULL,'',NULL,NULL,NULL),
(306,'Saeed','Ali','','saeed.ali@example.com',NULL,'',NULL,NULL,NULL),
(307,'Khalid','Raza','','khalid.raza@example.com',NULL,'',NULL,NULL,NULL),
(345,'Naveed','Hussain','','naveed.hussain@example.com',NULL,'',NULL,NULL,NULL),
(346,'Tariq','Malik','','tariq.malik@example.com',NULL,'',NULL,NULL,NULL),
(347,'Faisal','Ahmed','','faisal.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(348,'Rashid','Shaikh','','rashid.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(349,'Usman','Butt','','usman.butt@example.com',NULL,'',NULL,NULL,NULL),
(350,'Kamran','Mirza','','kamran.mirza@example.com',NULL,'',NULL,NULL,NULL),
(351,'Saad','Siddiqui','','saad.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(352,'Farah','Khan','','farah.khan@example.com',NULL,'',NULL,NULL,NULL),
(353,'Nida','Ali','','nida.ali@example.com',NULL,'',NULL,NULL,NULL),
(354,'Sobia','Raza','','sobia.raza@example.com',NULL,'',NULL,NULL,NULL),
(355,'Tahira','Hussain','','tahira.hussain@example.com',NULL,'',NULL,NULL,NULL),
(356,'Seema','Malik','','seema.malik@example.com',NULL,'',NULL,NULL,NULL),
(357,'Gulshan','Ahmed','','gulshan.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(358,'Rukhsana','Shaikh','','rukhsana.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(359,'Parveen','Butt','','parveen.butt@example.com',NULL,'',NULL,NULL,NULL),
(360,'Najma','Mirza','','najma.mirza@example.com',NULL,'',NULL,NULL,NULL),
(361,'Shabana','Siddiqui','','shabana.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(362,'Sajjad','Khan','','sajjad.khan@example.com',NULL,'',NULL,NULL,NULL),
(363,'Tahir','Ali','','tahir.ali@example.com',NULL,'',NULL,NULL,NULL),
(364,'Aamir','Raza','','aamir.raza@example.com',NULL,'',NULL,NULL,NULL),
(365,'Arif','Hussain','','arif.hussain@example.com',NULL,'',NULL,NULL,NULL),
(366,'Zia','Malik','','zia.malik@example.com',NULL,'',NULL,NULL,NULL),
(367,'Qasim','Ahmed','','qasim.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(368,'Haroon','Shaikh','','haroon.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(369,'Majid','Butt','','majid.butt@example.com',NULL,'',NULL,NULL,NULL),
(370,'Azhar','Mirza','','azhar.mirza@example.com',NULL,'',NULL,NULL,NULL),
(371,'Nadir','Siddiqui','','nadir.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(372,'Asma','Khan','','asma.khan@example.com',NULL,'',NULL,NULL,NULL),
(373,'Yasmin','Ali','','yasmin.ali@example.com',NULL,'',NULL,NULL,NULL),
(374,'Rukhsar','Raza','','rukhsar.raza@example.com',NULL,'',NULL,NULL,NULL),
(375,'Fariha','Hussain','','fariha.hussain@example.com',NULL,'',NULL,NULL,NULL),
(376,'Lubna','Malik','','lubna.malik@example.com',NULL,'',NULL,NULL,NULL),
(377,'Nazish','Ahmed','','nazish.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(378,'Fozia','Shaikh','','fozia.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(379,'Shahida','Butt','','shahida.butt@example.com',NULL,'',NULL,NULL,NULL),
(380,'Khadija','Siddiqui','','khadija.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(381,'Zubair','Khan','','zubair.khan@example.com',NULL,'',NULL,NULL,NULL),
(382,'Raza','Ali','','raza.ali@example.com',NULL,'',NULL,NULL,NULL),
(383,'Nadeem','Raza','','nadeem.raza@example.com',NULL,'',NULL,NULL,NULL),
(384,'Ali','Hussain','','ali.hussain@example.com',NULL,'',NULL,NULL,NULL),
(385,'Imtiaz','Malik','','imtiaz.malik@example.com',NULL,'',NULL,NULL,NULL),
(386,'Mujahid','Ahmed','','mujahid.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(387,'Taimur','Shaikh','','taimur.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(388,'Gulzar','Butt','','gulzar.butt@example.com',NULL,'',NULL,NULL,NULL),
(389,'Nasir','Mirza','','nasir.mirza@example.com',NULL,'',NULL,NULL,NULL),
(390,'Sikandar','Siddiqui','','sikandar.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(391,'Aijaz','Khan','','aijaz.khan@example.com',NULL,'',NULL,NULL,NULL),
(392,'Safdar','Ali','','safdar.ali@example.com',NULL,'',NULL,NULL,NULL),
(393,'Tayyab','Raza','','tayyab.raza@example.com',NULL,'',NULL,NULL,NULL),
(394,'Babar','Hussain','','babar.hussain@example.com',NULL,'',NULL,NULL,NULL),
(395,'Irfan','Malik','','irfan.malik@example.com',NULL,'',NULL,NULL,NULL),
(396,'Naseer','Ahmed','','naseer.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(397,'Usama','Shaikh','','usama.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(398,'Ahmed','Butt','','ahmed.butt@example.com',NULL,'',NULL,NULL,NULL),
(399,'Arshad','Mirza','','arshad.mirza@example.com',NULL,'',NULL,NULL,NULL),
(400,'Iqbal','Siddiqui','','iqbal.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(401,'Khalida','Khan','','khalida.khan@example.com',NULL,'',NULL,NULL,NULL),
(402,'Shaista','Ali','','shaista.ali@example.com',NULL,'',NULL,NULL,NULL),
(403,'Zahida','Raza','','zahida.raza@example.com',NULL,'',NULL,NULL,NULL),
(404,'Rizwana','Hussain','','rizwana.hussain@example.com',NULL,'',NULL,NULL,NULL),
(405,'Fareeha','Malik','','fareeha.malik@example.com',NULL,'',NULL,NULL,NULL),
(406,'Mushtaq','Ahmed','','mushtaq.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(407,'Salman','Shaikh','','salman.shaikh@example.com',NULL,'',NULL,NULL,NULL),
(408,'Aftab','Butt','','aftab.butt@example.com',NULL,'',NULL,NULL,NULL),
(409,'Sarfraz','Mirza','','sarfraz.mirza@example.com',NULL,'',NULL,NULL,NULL),
(410,'Mubashir','Siddiqui','','mubashir.siddiqui@example.com',NULL,'',NULL,NULL,NULL),
(468,'John','Doe','','john.doe@example.com',NULL,'',NULL,NULL,NULL),
(469,'Jane','Smith','','jane.smith@example.com',NULL,'',NULL,NULL,NULL),
(470,'Michael','Johnson','','michael.johnson@example.com',NULL,'',NULL,NULL,NULL),
(471,'Emily','Brown','','emily.brown@example.com',NULL,'',NULL,NULL,NULL),
(472,'William','Jones','','william.jones@example.com',NULL,'',NULL,NULL,NULL),
(473,'Olivia','Taylor','','olivia.taylor@example.com',NULL,'',NULL,NULL,NULL),
(474,'James','Anderson','','james.anderson@example.com',NULL,'',NULL,NULL,NULL),
(475,'Sophia','Wilson','','sophia.wilson@example.com',NULL,'',NULL,NULL,NULL),
(476,'Benjamin','Davis','','benjamin.davis@example.com',NULL,'',NULL,NULL,NULL),
(477,'Emma','Martinez','','emma.martinez@example.com',NULL,'',NULL,NULL,NULL),
(478,'Liam','Garcia','','liam.garcia@example.com',NULL,'',NULL,NULL,NULL),
(479,'Isabella','Rodriguez','','isabella.rodriguez@example.com',NULL,'',NULL,NULL,NULL),
(480,'Alexander','Lopez','','alexander.lopez@example.com',NULL,'',NULL,NULL,NULL),
(481,'Mia','Hernandez','','mia.hernandez@example.com',NULL,'',NULL,NULL,NULL),
(482,'Ethan','Gonzalez','','ethan.gonzalez@example.com',NULL,'',NULL,NULL,NULL),
(483,'Amelia','Perez','','amelia.perez@example.com',NULL,'',NULL,NULL,NULL),
(484,'Daniel','Sanchez','','daniel.sanchez@example.com',NULL,'',NULL,NULL,NULL),
(485,'Harper','Ramirez','','harper.ramirez@example.com',NULL,'',NULL,NULL,NULL),
(486,'Sophie','Torres','','sophie.torres@example.com',NULL,'',NULL,NULL,NULL),
(487,'Matthew','Flores','','matthew.flores@example.com',NULL,'',NULL,NULL,NULL),
(488,'Ava','Kim','','ava.kim@example.com',NULL,'',NULL,NULL,NULL),
(489,'Logan','Nguyen','','logan.nguyen@example.com',NULL,'',NULL,NULL,NULL),
(490,'Layla','Choi','','layla.choi@example.com',NULL,'',NULL,NULL,NULL),
(491,'Charlotte','Wong','','charlotte.wong@example.com',NULL,'',NULL,NULL,NULL),
(492,'Jackson','Patel','','jackson.patel@example.com',NULL,'',NULL,NULL,NULL),
(493,'Luna','Sharma','','luna.sharma@example.com',NULL,'',NULL,NULL,NULL),
(494,'Jack','Gupta','','jack.gupta@example.com',NULL,'',NULL,NULL,NULL),
(495,'Avery','Kumar','','avery.kumar@example.com',NULL,'',NULL,NULL,NULL),
(496,'Madison','Shah','','madison.shah@example.com',NULL,'',NULL,NULL,NULL),
(497,'Liam','Patel','','liam.patel@example.com',NULL,'',NULL,NULL,NULL),
(498,'Chloe','Srivastava','','chloe.srivastava@example.com',NULL,'',NULL,NULL,NULL),
(499,'Ryan','Khan','','ryan.khan@example.com',NULL,'',NULL,NULL,NULL),
(500,'Ella','Joshi','','ella.joshi@example.com',NULL,'',NULL,NULL,NULL),
(501,'David','Singh','','david.singh@example.com',NULL,'',NULL,NULL,NULL),
(502,'Grace','Malhotra','','grace.malhotra@example.com',NULL,'',NULL,NULL,NULL),
(503,'Mason','Reddy','','mason.reddy@example.com',NULL,'',NULL,NULL,NULL),
(504,'Aria','Verma','','aria.verma@example.com',NULL,'',NULL,NULL,NULL),
(505,'Elijah','Gupta','','elijah.gupta@example.com',NULL,'',NULL,NULL,NULL),
(506,'Lily','Choudhury','','lily.choudhury@example.com',NULL,'',NULL,NULL,NULL),
(507,'Michael','Ahmed','','michael.ahmed@example.com',NULL,'',NULL,NULL,NULL),
(508,'Nora','Das','','nora.das@example.com',NULL,'',NULL,NULL,NULL),
(509,'Logan','Kumar','','logan.kumar@example.com',NULL,'',NULL,NULL,NULL),
(510,'Zoe','Chakraborty','','zoe.chakraborty@example.com',NULL,'',NULL,NULL,NULL),
(511,'Ethan','Mukherjee','','ethan.mukherjee@example.com',NULL,'',NULL,NULL,NULL),
(512,'Evelyn','Patil','','evelyn.patil@example.com',NULL,'',NULL,NULL,NULL),
(513,'Oliver','Rao','','oliver.rao@example.com',NULL,'',NULL,NULL,NULL),
(514,'Aurora','Ghosh','','aurora.ghosh@example.com',NULL,'',NULL,NULL,NULL),
(515,'Mia','Nair','','mia.nair@example.com',NULL,'',NULL,NULL,NULL),
(516,'Aiden','Jain','','aiden.jain@example.com',NULL,'',NULL,NULL,NULL),
(517,'Luna','Sinha','','luna.sinha@example.com',NULL,'',NULL,NULL,NULL),
(518,'Alexander','Dutta','','alexander.dutta@example.com',NULL,'',NULL,NULL,NULL),
(519,'Sophia','Rathore','','sophia.rathore@example.com',NULL,'',NULL,NULL,NULL),
(520,'Lucas','Singh','','lucas.singh@example.com',NULL,'',NULL,NULL,NULL),
(521,'Scarlett','Dewan','','scarlett.dewan@example.com',NULL,'',NULL,NULL,NULL),
(522,'Jacob','Kumar','','jacob.kumar@example.com',NULL,'',NULL,NULL,NULL),
(523,'Ava','Sharma','','ava.sharma@example.com',NULL,'',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
