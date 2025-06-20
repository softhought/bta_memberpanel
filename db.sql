/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.32-MariaDB : Database - task_management
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `chat_dtl` */

DROP TABLE IF EXISTS `chat_dtl`;

CREATE TABLE `chat_dtl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  CONSTRAINT `chat_dtl_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

/*Data for the table `chat_dtl` */

insert  into `chat_dtl`(`id`,`chat_id`,`text`,`sender_id`,`time`,`created_at`,`updated_at`) values (43,1,'Good evening',6,'2024-10-29 13:18:52','2024-10-29 13:18:52','2024-10-29 13:18:52'),(44,1,'Good evening....',1,'2024-10-29 13:19:43','2024-10-29 13:19:43','2024-10-29 13:19:43'),(45,1,'Good Evening',4,'2024-10-29 13:20:01','2024-10-29 13:20:01','2024-10-29 13:20:01');

/*Table structure for table `chat_master` */

DROP TABLE IF EXISTS `chat_master`;

CREATE TABLE `chat_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_title` varchar(255) DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `is_parent_chat` enum('Y','N') DEFAULT 'N',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `chat_master_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `chat_master` */

insert  into `chat_master`(`id`,`chat_title`,`created_user_id`,`project_id`,`is_parent_chat`,`created_at`,`updated_at`) values (1,'Dialysis Auditing',3,1,'Y','2024-10-17 16:21:31','2024-10-17 16:21:33');

/*Table structure for table `department_master` */

DROP TABLE IF EXISTS `department_master`;

CREATE TABLE `department_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `department_master` */

insert  into `department_master`(`id`,`department_name`,`is_active`,`created_at`,`updated_at`) values (1,'Dialysis','Y','2024-09-27 08:30:29','2024-09-30 12:30:16');

/*Table structure for table `doc_share_dtl` */

DROP TABLE IF EXISTS `doc_share_dtl`;

CREATE TABLE `doc_share_dtl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `extension` enum('EXCEL','PDF','WORD','IMAGE','OTHER') DEFAULT 'OTHER',
  `ocr_content` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`doc_id`),
  KEY `doc_id` (`doc_id`),
  CONSTRAINT `doc_share_dtl_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `doc_share_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `doc_share_dtl` */

insert  into `doc_share_dtl`(`id`,`doc_id`,`file_name`,`file`,`extension`,`ocr_content`,`created_at`,`updated_at`) values (9,10,'Meeting 86919070647 (2)','doc11730268606.ics','OTHER',NULL,'2024-10-30 06:10:06','2024-10-30 06:10:06');

/*Table structure for table `doc_share_master` */

DROP TABLE IF EXISTS `doc_share_master`;

CREATE TABLE `doc_share_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `doc_share_master` */

insert  into `doc_share_master`(`id`,`project_id`,`title`,`description`,`sender_id`,`datetime`,`created_at`,`updated_at`) values (10,1,'djgjasg','jhjjh',1,'2024-10-30 06:10:06','2024-10-30 06:10:06','2024-10-30 06:10:06');

/*Table structure for table `doc_share_user_dtl` */

DROP TABLE IF EXISTS `doc_share_user_dtl`;

CREATE TABLE `doc_share_user_dtl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doc_id` (`doc_id`),
  KEY `employee_id` (`user_id`),
  CONSTRAINT `doc_share_user_dtl_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `doc_share_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `doc_share_user_dtl` */

insert  into `doc_share_user_dtl`(`id`,`doc_id`,`user_id`,`created_at`,`updated_at`) values (14,10,4,'2024-10-30 06:10:06','2024-10-30 06:10:06'),(15,10,6,'2024-10-30 06:10:06','2024-10-30 06:10:06');

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

/*Table structure for table `frequency` */

DROP TABLE IF EXISTS `frequency`;

CREATE TABLE `frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frequency` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `frequency` */

insert  into `frequency`(`id`,`frequency`,`time`,`created_at`,`updated_at`) values (1,'Daily','+1 days',NULL,'2024-10-01 12:10:06'),(2,'Weekly','+1 week','2024-10-01 12:10:04','2024-10-01 12:10:06'),(3,'Monthly','+1 month','2024-10-01 12:10:04','2024-10-01 12:10:06'),(4,'Half Yearly','+6 month',NULL,'2024-10-01 12:14:38'),(5,'Yearly','+1 year',NULL,'2024-10-01 12:14:38');

/*Table structure for table `human_resource` */

DROP TABLE IF EXISTS `human_resource`;

CREATE TABLE `human_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_master_id` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `location_id` (`location_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `human_resource_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_master` (`id`),
  CONSTRAINT `human_resource_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location_master` (`id`),
  CONSTRAINT `human_resource_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `human_resource` */

insert  into `human_resource`(`id`,`name`,`mobile`,`email`,`designation`,`department_id`,`location_id`,`project_id`,`user_master_id`,`is_active`,`created_at`,`updated_at`) values (1,'Pallav','8944961893','pallav@gmail.com','Maintenance Executive',1,1,1,4,'Y','2024-09-30 10:58:42','2024-10-03 06:13:32'),(2,'Aratrika Khatun','7458997896','aratrika@gmail.com','Dialysis Manager',1,1,1,5,'Y','2024-09-30 12:32:20','2024-10-03 06:13:01'),(3,'Suman Mukherjee','9831024741','admin@softhought.com','9831024741',1,1,1,6,'Y','2024-10-23 19:38:51','2024-10-23 19:38:51');

/*Table structure for table `location_master` */

DROP TABLE IF EXISTS `location_master`;

CREATE TABLE `location_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `location_master` */

insert  into `location_master`(`id`,`location_name`,`is_active`,`created_at`,`updated_at`) values (1,'JC','Y','2024-09-26 19:32:25','2024-09-27 08:04:48'),(2,'Howrah','Y','2024-09-27 08:16:08','2024-09-27 08:16:23'),(3,'Chandannagar','Y','2024-09-27 08:16:08','2024-09-27 08:16:23'),(4,'DAD','Y','2024-09-27 08:16:08','2024-09-27 08:16:23');

/*Table structure for table `log_table` */

DROP TABLE IF EXISTS `log_table`;

CREATE TABLE `log_table` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `row_id` bigint(20) unsigned DEFAULT NULL,
  `table_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `data_array` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_browser` varchar(255) DEFAULT NULL,
  `user_platform` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `member_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `log_table_chk_1` CHECK (json_valid(`data_array`))
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `log_table` */

insert  into `log_table`(`id`,`log_date`,`row_id`,`table_name`,`action`,`data_array`,`user_browser`,`user_platform`,`ip_address`,`member_id`,`user_id`,`created_at`,`updated_at`) values (1,'2024-10-24 12:34:36',1,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hii\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:04:36.962844Z\",\"updated_at\":\"2024-10-24T07:04:36.000000Z\",\"created_at\":\"2024-10-24T07:04:36.000000Z\",\"id\":1}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 12:34:36','2024-10-24 12:34:36'),(2,'2024-10-24 12:35:57',2,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hii\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:05:57.052888Z\",\"updated_at\":\"2024-10-24T07:05:57.000000Z\",\"created_at\":\"2024-10-24T07:05:57.000000Z\",\"id\":2}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 12:35:57','2024-10-24 12:35:57'),(3,'2024-10-24 12:36:46',3,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hii\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:06:46.292148Z\",\"updated_at\":\"2024-10-24T07:06:46.000000Z\",\"created_at\":\"2024-10-24T07:06:46.000000Z\",\"id\":3}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 12:36:46','2024-10-24 12:36:46'),(4,'2024-10-24 12:36:53',4,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hellow\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:06:53.849674Z\",\"updated_at\":\"2024-10-24T07:06:53.000000Z\",\"created_at\":\"2024-10-24T07:06:53.000000Z\",\"id\":4}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 12:36:53','2024-10-24 12:36:53'),(5,'2024-10-24 12:43:05',6,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"jyyt\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:13:05.562152Z\",\"updated_at\":\"2024-10-24T07:13:05.000000Z\",\"created_at\":\"2024-10-24T07:13:05.000000Z\",\"id\":6}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 12:43:05','2024-10-24 12:43:05'),(6,'2024-10-24 12:47:33',8,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"jyt\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:17:33.753826Z\",\"updated_at\":\"2024-10-24T07:17:33.000000Z\",\"created_at\":\"2024-10-24T07:17:33.000000Z\",\"id\":8}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 12:47:33','2024-10-24 12:47:33'),(7,'2024-10-24 13:05:36',9,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"jh\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:35:36.333963Z\",\"updated_at\":\"2024-10-24T07:35:36.000000Z\",\"created_at\":\"2024-10-24T07:35:36.000000Z\",\"id\":9}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 13:05:36','2024-10-24 13:05:36'),(8,'2024-10-24 13:23:42',11,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hii\",\"sender_id\":\"3\",\"time\":\"2024-10-24T07:53:42.520231Z\",\"updated_at\":\"2024-10-24T07:53:42.000000Z\",\"created_at\":\"2024-10-24T07:53:42.000000Z\",\"id\":11}','Firefox','Windows','223.185.31.190',NULL,3,'2024-10-24 13:23:42','2024-10-24 13:23:42'),(9,'2024-10-24 13:24:07',12,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hellow\",\"sender_id\":\"1\",\"time\":\"2024-10-24T07:54:07.344430Z\",\"updated_at\":\"2024-10-24T07:54:07.000000Z\",\"created_at\":\"2024-10-24T07:54:07.000000Z\",\"id\":12}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:24:07','2024-10-24 13:24:07'),(10,'2024-10-24 13:24:54',14,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hii\",\"sender_id\":\"1\",\"time\":\"2024-10-24T07:54:54.112424Z\",\"updated_at\":\"2024-10-24T07:54:54.000000Z\",\"created_at\":\"2024-10-24T07:54:54.000000Z\",\"id\":14}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:24:54','2024-10-24 13:24:54'),(11,'2024-10-24 13:26:58',19,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"jjb\",\"sender_id\":\"1\",\"time\":\"2024-10-24T07:56:58.798062Z\",\"updated_at\":\"2024-10-24T07:56:58.000000Z\",\"created_at\":\"2024-10-24T07:56:58.000000Z\",\"id\":19}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:26:58','2024-10-24 13:26:58'),(12,'2024-10-24 13:32:16',22,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"Hi Good Afternoon\",\"sender_id\":\"1\",\"time\":\"2024-10-24T08:02:16.558729Z\",\"updated_at\":\"2024-10-24T08:02:16.000000Z\",\"created_at\":\"2024-10-24T08:02:16.000000Z\",\"id\":22}','Chrome','Windows','223.185.31.190',NULL,1,'2024-10-24 13:32:16','2024-10-24 13:32:16'),(13,'2024-10-24 13:43:08',25,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"hii\",\"sender_id\":\"1\",\"time\":\"2024-10-24T08:13:08.952838Z\",\"updated_at\":\"2024-10-24T08:13:08.000000Z\",\"created_at\":\"2024-10-24T08:13:08.000000Z\",\"id\":25}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:43:08','2024-10-24 13:43:08'),(14,'2024-10-24 13:47:46',26,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"Good Afternoon Everyone\",\"sender_id\":\"1\",\"time\":\"2024-10-24T08:17:46.205599Z\",\"updated_at\":\"2024-10-24T08:17:46.000000Z\",\"created_at\":\"2024-10-24T08:17:46.000000Z\",\"id\":26}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:47:46','2024-10-24 13:47:46'),(15,'2024-10-24 13:53:13',29,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"Okay\",\"sender_id\":\"1\",\"time\":\"2024-10-24T08:23:13.838386Z\",\"updated_at\":\"2024-10-24T08:23:13.000000Z\",\"created_at\":\"2024-10-24T08:23:13.000000Z\",\"id\":29}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:53:13','2024-10-24 13:53:13'),(16,'2024-10-24 13:58:41',2,'doc_share_master','Insert','{\"project_id\":\"1\",\"title\":\"Test\",\"description\":null,\"sender_id\":\"1\",\"datetime\":\"2024-10-24T08:28:41.356487Z\",\"updated_at\":\"2024-10-24T08:28:41.000000Z\",\"created_at\":\"2024-10-24T08:28:41.000000Z\",\"id\":2}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:58:41','2024-10-24 13:58:41'),(17,'2024-10-24 13:58:41',1,'doc_share_dtl','Insert','{\"doc_id\":2,\"file_name\":\"1706120514591\",\"file\":\"doc11729758521.jpeg\",\"extension\":\"IMAGE\",\"updated_at\":\"2024-10-24T08:28:41.000000Z\",\"created_at\":\"2024-10-24T08:28:41.000000Z\",\"id\":1}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:58:41','2024-10-24 13:58:41'),(18,'2024-10-24 13:58:41',3,'doc_share_user_dtl','Insert','{\"doc_id\":2,\"user_id\":\"5\",\"updated_at\":\"2024-10-24T08:28:41.000000Z\",\"created_at\":\"2024-10-24T08:28:41.000000Z\",\"id\":3}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:58:41','2024-10-24 13:58:41'),(19,'2024-10-24 13:59:34',3,'doc_share_master','Insert','{\"project_id\":\"1\",\"title\":\"rdgyrd\",\"description\":null,\"sender_id\":\"1\",\"datetime\":\"2024-10-24T08:29:34.839635Z\",\"updated_at\":\"2024-10-24T08:29:34.000000Z\",\"created_at\":\"2024-10-24T08:29:34.000000Z\",\"id\":3}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:59:34','2024-10-24 13:59:34'),(20,'2024-10-24 13:59:34',4,'doc_share_user_dtl','Insert','{\"doc_id\":3,\"user_id\":\"6\",\"updated_at\":\"2024-10-24T08:29:34.000000Z\",\"created_at\":\"2024-10-24T08:29:34.000000Z\",\"id\":4}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 13:59:34','2024-10-24 13:59:34'),(21,'2024-10-24 14:09:10',4,'doc_share_master','Insert','{\"project_id\":\"1\",\"title\":\"ytrfytr\",\"description\":null,\"sender_id\":\"1\",\"datetime\":\"2024-10-24T08:39:10.398660Z\",\"updated_at\":\"2024-10-24T08:39:10.000000Z\",\"created_at\":\"2024-10-24T08:39:10.000000Z\",\"id\":4}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:10','2024-10-24 14:09:10'),(22,'2024-10-24 14:09:10',2,'doc_share_dtl','Insert','{\"doc_id\":4,\"file_name\":\"Truck Cranes\",\"file\":\"doc11729759150.zip\",\"extension\":\"OTHER\",\"updated_at\":\"2024-10-24T08:39:10.000000Z\",\"created_at\":\"2024-10-24T08:39:10.000000Z\",\"id\":2}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:10','2024-10-24 14:09:10'),(23,'2024-10-24 14:09:10',5,'doc_share_user_dtl','Insert','{\"doc_id\":4,\"user_id\":\"5\",\"updated_at\":\"2024-10-24T08:39:10.000000Z\",\"created_at\":\"2024-10-24T08:39:10.000000Z\",\"id\":5}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:10','2024-10-24 14:09:10'),(24,'2024-10-24 14:09:10',6,'doc_share_user_dtl','Insert','{\"doc_id\":4,\"user_id\":\"6\",\"updated_at\":\"2024-10-24T08:39:10.000000Z\",\"created_at\":\"2024-10-24T08:39:10.000000Z\",\"id\":6}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:10','2024-10-24 14:09:10'),(25,'2024-10-24 14:09:47',5,'doc_share_master','Insert','{\"project_id\":\"1\",\"title\":\"fdtgdf\",\"description\":null,\"sender_id\":\"1\",\"datetime\":\"2024-10-24T08:39:47.685549Z\",\"updated_at\":\"2024-10-24T08:39:47.000000Z\",\"created_at\":\"2024-10-24T08:39:47.000000Z\",\"id\":5}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:47','2024-10-24 14:09:47'),(26,'2024-10-24 14:09:47',3,'doc_share_dtl','Insert','{\"doc_id\":5,\"file_name\":\"Truck Cranes\",\"file\":\"doc11729759187.zip\",\"extension\":\"OTHER\",\"updated_at\":\"2024-10-24T08:39:47.000000Z\",\"created_at\":\"2024-10-24T08:39:47.000000Z\",\"id\":3}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:47','2024-10-24 14:09:47'),(27,'2024-10-24 14:09:47',7,'doc_share_user_dtl','Insert','{\"doc_id\":5,\"user_id\":\"5\",\"updated_at\":\"2024-10-24T08:39:47.000000Z\",\"created_at\":\"2024-10-24T08:39:47.000000Z\",\"id\":7}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:47','2024-10-24 14:09:47'),(28,'2024-10-24 14:09:47',8,'doc_share_user_dtl','Insert','{\"doc_id\":5,\"user_id\":\"6\",\"updated_at\":\"2024-10-24T08:39:47.000000Z\",\"created_at\":\"2024-10-24T08:39:47.000000Z\",\"id\":8}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 14:09:47','2024-10-24 14:09:47'),(29,'2024-10-24 16:54:00',6,'doc_share_master','Insert','{\"project_id\":\"1\",\"title\":\"Landing Page Share\",\"description\":null,\"sender_id\":\"1\",\"datetime\":\"2024-10-24T11:24:00.488138Z\",\"updated_at\":\"2024-10-24T11:24:00.000000Z\",\"created_at\":\"2024-10-24T11:24:00.000000Z\",\"id\":6}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 16:54:00','2024-10-24 16:54:00'),(30,'2024-10-24 16:54:00',4,'doc_share_dtl','Insert','{\"doc_id\":6,\"file_name\":\"Landing Page   Pick And Carry Cranes\",\"file\":\"doc11729769040.docx\",\"extension\":\"WORD\",\"updated_at\":\"2024-10-24T11:24:00.000000Z\",\"created_at\":\"2024-10-24T11:24:00.000000Z\",\"id\":4}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 16:54:00','2024-10-24 16:54:00'),(31,'2024-10-24 16:54:00',5,'doc_share_dtl','Insert','{\"doc_id\":6,\"file_name\":\"Shareholding Pattern As On 30 09 2024\",\"file\":\"doc11729769040.pdf\",\"extension\":\"PDF\",\"updated_at\":\"2024-10-24T11:24:00.000000Z\",\"created_at\":\"2024-10-24T11:24:00.000000Z\",\"id\":5}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 16:54:00','2024-10-24 16:54:00'),(32,'2024-10-24 16:54:00',9,'doc_share_user_dtl','Insert','{\"doc_id\":6,\"user_id\":\"6\",\"updated_at\":\"2024-10-24T11:24:00.000000Z\",\"created_at\":\"2024-10-24T11:24:00.000000Z\",\"id\":9}','Firefox','Windows','223.185.31.190',NULL,1,'2024-10-24 16:54:00','2024-10-24 16:54:00'),(33,'2024-10-25 14:21:25',1,'onetime_task_master','Update','{\"id\":1,\"task_title\":\"Onetime\",\"description\":\"Documents Collection\",\"project_id\":\"1\",\"created_user_id\":1,\"due_date\":\"2024-10-24\",\"created_at\":\"2024-10-24T17:53:06.000000Z\",\"updated_at\":\"2024-10-25T08:51:25.000000Z\"}','Firefox','Windows','223.185.35.102',NULL,1,'2024-10-25 14:21:25','2024-10-25 14:21:25'),(34,'2024-10-25 14:21:25',1,'onetime_task_master','Insert','{\"id\":1,\"task_title\":\"Onetime\",\"description\":\"Documents Collection\",\"project_id\":\"1\",\"created_user_id\":1,\"due_date\":\"2024-10-24\",\"created_at\":\"2024-10-24T17:53:06.000000Z\",\"updated_at\":\"2024-10-25T08:51:25.000000Z\"}','Firefox','Windows','223.185.35.102',NULL,1,'2024-10-25 14:21:25','2024-10-25 14:21:25'),(35,'2024-10-25 15:29:49',31,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"Good Afternoon\",\"sender_id\":\"1\",\"time\":\"2024-10-25T09:59:49.476635Z\",\"updated_at\":\"2024-10-25T09:59:49.000000Z\",\"created_at\":\"2024-10-25T09:59:49.000000Z\",\"id\":31}','Firefox','Windows','223.185.35.102',NULL,1,'2024-10-25 15:29:49','2024-10-25 15:29:49'),(36,'2024-10-25 17:44:36',32,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"Hello Everyone\",\"sender_id\":\"1\",\"time\":\"2024-10-25T12:14:36.120178Z\",\"updated_at\":\"2024-10-25T12:14:36.000000Z\",\"created_at\":\"2024-10-25T12:14:36.000000Z\",\"id\":32}','Firefox','Windows','223.185.35.102',NULL,1,'2024-10-25 17:44:36','2024-10-25 17:44:36'),(37,'2024-10-25 18:33:40',1,'onetime_task_master','Update','{\"id\":1,\"task_title\":\"Onetime\",\"description\":\"Documents Collection\",\"project_id\":\"1\",\"created_user_id\":1,\"due_date\":\"2024-10-24\",\"created_at\":\"2024-10-24T17:53:06.000000Z\",\"updated_at\":\"2024-10-25T13:03:40.000000Z\"}','Firefox','Windows','223.185.35.102',NULL,1,'2024-10-25 18:33:40','2024-10-25 18:33:40'),(38,'2024-10-25 18:33:40',1,'onetime_task_master','Insert','{\"id\":1,\"task_title\":\"Onetime\",\"description\":\"Documents Collection\",\"project_id\":\"1\",\"created_user_id\":1,\"due_date\":\"2024-10-24\",\"created_at\":\"2024-10-24T17:53:06.000000Z\",\"updated_at\":\"2024-10-25T13:03:40.000000Z\"}','Firefox','Windows','223.185.35.102',NULL,1,'2024-10-25 18:33:40','2024-10-25 18:33:40'),(39,'2024-10-29 18:39:24',38,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"Good Evening\",\"sender_id\":\"1\",\"time\":\"2024-10-29T13:09:24.121409Z\",\"updated_at\":\"2024-10-29T13:09:24.000000Z\",\"created_at\":\"2024-10-29T13:09:24.000000Z\",\"id\":38}','Firefox','Windows','223.185.31.9',NULL,1,'2024-10-29 18:39:24','2024-10-29 18:39:24'),(40,'2024-10-29 18:44:46',40,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"i\'m fine !!\",\"sender_id\":\"1\",\"time\":\"2024-10-29T13:14:46.634029Z\",\"updated_at\":\"2024-10-29T13:14:46.000000Z\",\"created_at\":\"2024-10-29T13:14:46.000000Z\",\"id\":40}','Firefox','Windows','223.185.31.9',NULL,1,'2024-10-29 18:44:46','2024-10-29 18:44:46'),(41,'2024-10-29 18:49:43',44,'chat_dtl','Insert','{\"chat_id\":\"1\",\"text\":\"Good evening....\",\"sender_id\":\"1\",\"time\":\"2024-10-29T13:19:43.381626Z\",\"updated_at\":\"2024-10-29T13:19:43.000000Z\",\"created_at\":\"2024-10-29T13:19:43.000000Z\",\"id\":44}','Firefox','Windows','223.185.31.9',NULL,1,'2024-10-29 18:49:43','2024-10-29 18:49:43'),(42,'2024-10-30 11:40:06',10,'doc_share_master','Insert','{\"project_id\":\"1\",\"title\":\"djgjasg\",\"description\":\"jhjjh\",\"sender_id\":\"1\",\"datetime\":\"2024-10-30T06:10:06.209931Z\",\"updated_at\":\"2024-10-30T06:10:06.000000Z\",\"created_at\":\"2024-10-30T06:10:06.000000Z\",\"id\":10}','Chrome','OS X','103.242.196.214',NULL,1,'2024-10-30 11:40:06','2024-10-30 11:40:06'),(43,'2024-10-30 11:40:06',9,'doc_share_dtl','Insert','{\"doc_id\":10,\"file_name\":\"Meeting 86919070647 (2)\",\"file\":\"doc11730268606.ics\",\"extension\":\"OTHER\",\"updated_at\":\"2024-10-30T06:10:06.000000Z\",\"created_at\":\"2024-10-30T06:10:06.000000Z\",\"id\":9}','Chrome','OS X','103.242.196.214',NULL,1,'2024-10-30 11:40:06','2024-10-30 11:40:06'),(44,'2024-10-30 11:40:06',14,'doc_share_user_dtl','Insert','{\"doc_id\":10,\"user_id\":\"4\",\"updated_at\":\"2024-10-30T06:10:06.000000Z\",\"created_at\":\"2024-10-30T06:10:06.000000Z\",\"id\":14}','Chrome','OS X','103.242.196.214',NULL,1,'2024-10-30 11:40:06','2024-10-30 11:40:06'),(45,'2024-10-30 11:40:06',15,'doc_share_user_dtl','Insert','{\"doc_id\":10,\"user_id\":\"6\",\"updated_at\":\"2024-10-30T06:10:06.000000Z\",\"created_at\":\"2024-10-30T06:10:06.000000Z\",\"id\":15}','Chrome','OS X','103.242.196.214',NULL,1,'2024-10-30 11:40:06','2024-10-30 11:40:06'),(46,'2024-11-04 12:33:57',4,'message_comment_dtl','Insert','{\"message_id\":\"1\",\"sender_id\":\"3\",\"comment\":\"<p>yty<br><\\/p>\",\"datetime\":\"2024-11-04T07:03:57.515582Z\",\"updated_at\":\"2024-11-04T07:03:57.000000Z\",\"created_at\":\"2024-11-04T07:03:57.000000Z\",\"id\":4}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 12:33:57','2024-11-04 12:33:57'),(47,'2024-11-04 13:57:38',2,'message_master','Insert','{\"project_id\":\"1\",\"title\":\"Lorem Ipsum is simply dummy text\",\"description\":\"<p><strong>Lorem Ipsum<\\/strong> is simply dummy text of the \\r\\nprinting and typesetting industry. Lorem Ipsum has been the industry\'s \\r\\nstandard dummy text ever since the 1500s, when an unknown printer took a\\r\\n galley of type and scrambled it to make a type specimen book. It has \\r\\nsurvived not only five centuries, but also the leap into electronic \\r\\ntypesetting, remaining essentially unchanged. It was popularised in the \\r\\n1960s with the release of Letraset sheets containing Lorem Ipsum \\r\\npassages, and more recently with desktop publishing software like Aldus \\r\\nPageMaker including versions of Lorem Ipsum.<\\/p>\\r\\n<div>\\r\\n<h2>Why do we use it?<\\/h2>\\r\\n<p>It is a long established fact that a reader will be distracted by the\\r\\n readable content of a page when looking at its layout. The point of \\r\\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \\r\\nletters, as opposed to using \'Content here, content here\', making it \\r\\nlook like readable English. Many desktop publishing packages and web \\r\\npage editors now use Lorem Ipsum as their default model text, and a \\r\\nsearch for \'lorem ipsum\' will uncover many web sites still in their \\r\\ninfancy. Various versions have evolved over the years, sometimes by \\r\\naccident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n<\\/div><p><\\/p>\",\"sender_id\":\"3\",\"datetime\":\"2024-11-04T08:27:38.875932Z\",\"like_count\":0,\"diss_like_count\":0,\"updated_at\":\"2024-11-04T08:27:38.000000Z\",\"created_at\":\"2024-11-04T08:27:38.000000Z\",\"id\":2}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 13:57:38','2024-11-04 13:57:38'),(48,'2024-11-04 13:57:38',3,'message_share_with','Insert','{\"message_id\":2,\"user_id\":\"6\",\"updated_at\":\"2024-11-04T08:27:38.000000Z\",\"created_at\":\"2024-11-04T08:27:38.000000Z\",\"id\":3}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 13:57:38','2024-11-04 13:57:38'),(49,'2024-11-04 13:59:57',3,'message_master','Insert','{\"project_id\":\"1\",\"title\":\"Lorem Ipsum is simply dummy\",\"description\":\"<p><strong>Lorem Ipsum<\\/strong> is simply dummy text of the printing and \\r\\ntypesetting industry. Lorem Ipsum has been the industry\'s standard dummy\\r\\n text ever since the 1500s, when an unknown printer took a galley of \\r\\ntype and scrambled it to make a type specimen book. It has survived not \\r\\nonly five centuries, but also the leap into electronic typesetting, \\r\\nremaining essentially unchanged. It was popularised in the 1960s with \\r\\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\\r\\n recently with desktop publishing software like Aldus PageMaker \\r\\nincluding versions of Lorem Ipsum.<\\/p>\",\"sender_id\":\"3\",\"datetime\":\"2024-11-04T08:29:57.142337Z\",\"like_count\":0,\"diss_like_count\":0,\"updated_at\":\"2024-11-04T08:29:57.000000Z\",\"created_at\":\"2024-11-04T08:29:57.000000Z\",\"id\":3}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 13:59:57','2024-11-04 13:59:57'),(50,'2024-11-04 13:59:57',4,'message_share_with','Insert','{\"message_id\":3,\"user_id\":\"6\",\"updated_at\":\"2024-11-04T08:29:57.000000Z\",\"created_at\":\"2024-11-04T08:29:57.000000Z\",\"id\":4}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 13:59:57','2024-11-04 13:59:57'),(51,'2024-11-04 14:02:37',5,'message_comment_dtl','Insert','{\"message_id\":\"3\",\"sender_id\":\"6\",\"comment\":\"<p> Lorem Ipsum has been the industry\'s standard dummy\\n text ever since the 1500s, when an unknown printer took a galley of \\ntype and scrambled it to make a type specimen book. <\\/p>\",\"datetime\":\"2024-11-04T08:32:37.627156Z\",\"updated_at\":\"2024-11-04T08:32:37.000000Z\",\"created_at\":\"2024-11-04T08:32:37.000000Z\",\"id\":5}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 14:02:37','2024-11-04 14:02:37'),(52,'2024-11-04 14:12:25',6,'message_comment_dtl','Insert','{\"message_id\":\"3\",\"sender_id\":\"3\",\"datetime\":\"2024-11-04T08:42:25.745103Z\",\"comment\":\"<p>Fine its good comments<br><\\/p>\",\"updated_at\":\"2024-11-04T08:42:25.000000Z\",\"created_at\":\"2024-11-04T08:42:25.000000Z\",\"id\":6}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 14:12:25','2024-11-04 14:12:25'),(53,'2024-11-04 14:22:00',4,'message_master','Insert','{\"project_id\":\"1\",\"title\":\"jftghty\",\"description\":\"<p>fghfgh<br><\\/p>\",\"sender_id\":\"4\",\"datetime\":\"2024-11-04T08:52:00.053007Z\",\"like_count\":0,\"diss_like_count\":0,\"updated_at\":\"2024-11-04T08:52:00.000000Z\",\"created_at\":\"2024-11-04T08:52:00.000000Z\",\"id\":4}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 14:22:00','2024-11-04 14:22:00'),(54,'2024-11-04 14:22:00',5,'message_share_with','Insert','{\"message_id\":4,\"user_id\":\"5\",\"updated_at\":\"2024-11-04T08:52:00.000000Z\",\"created_at\":\"2024-11-04T08:52:00.000000Z\",\"id\":5}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 14:22:00','2024-11-04 14:22:00'),(55,'2024-11-04 14:22:00',6,'message_share_with','Insert','{\"message_id\":4,\"user_id\":\"6\",\"updated_at\":\"2024-11-04T08:52:00.000000Z\",\"created_at\":\"2024-11-04T08:52:00.000000Z\",\"id\":6}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 14:22:00','2024-11-04 14:22:00'),(56,'2024-11-04 15:56:51',1,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:26:51.000000Z\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"id\":1}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 15:56:51','2024-11-04 15:56:51'),(57,'2024-11-04 15:56:53',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:26:51.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 15:56:53','2024-11-04 15:56:53'),(58,'2024-11-04 15:56:54',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:26:51.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 15:56:54','2024-11-04 15:56:54'),(59,'2024-11-04 15:56:57',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:26:51.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 15:56:57','2024-11-04 15:56:57'),(60,'2024-11-04 15:57:16',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:27:16.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 15:57:16','2024-11-04 15:57:16'),(61,'2024-11-04 15:57:24',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:27:24.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 15:57:24','2024-11-04 15:57:24'),(62,'2024-11-04 15:57:32',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:27:24.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 15:57:32','2024-11-04 15:57:32'),(63,'2024-11-04 16:01:33',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:27:24.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:01:33','2024-11-04 16:01:33'),(64,'2024-11-04 16:01:34',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:31:34.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:01:34','2024-11-04 16:01:34'),(65,'2024-11-04 16:01:36',1,'message_feedback_dtl','Insert','{\"id\":1,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:26:51.000000Z\",\"updated_at\":\"2024-11-04T10:31:36.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:01:36','2024-11-04 16:01:36'),(66,'2024-11-04 16:01:40',2,'message_feedback_dtl','Insert','{\"message_id\":\"1\",\"user_id\":\"3\",\"status\":\"DISLIKE\",\"updated_at\":\"2024-11-04T10:31:40.000000Z\",\"created_at\":\"2024-11-04T10:31:40.000000Z\",\"id\":2}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:01:40','2024-11-04 16:01:40'),(67,'2024-11-04 16:01:42',2,'message_feedback_dtl','Insert','{\"id\":2,\"message_id\":1,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:31:40.000000Z\",\"updated_at\":\"2024-11-04T10:31:41.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:01:42','2024-11-04 16:01:42'),(68,'2024-11-04 16:01:43',2,'message_feedback_dtl','Insert','{\"id\":2,\"message_id\":1,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:31:40.000000Z\",\"updated_at\":\"2024-11-04T10:31:43.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:01:43','2024-11-04 16:01:43'),(69,'2024-11-04 16:01:45',2,'message_feedback_dtl','Insert','{\"id\":2,\"message_id\":1,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:31:40.000000Z\",\"updated_at\":\"2024-11-04T10:31:45.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:01:45','2024-11-04 16:01:45'),(70,'2024-11-04 16:03:48',3,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:33:48.000000Z\",\"created_at\":\"2024-11-04T10:33:48.000000Z\",\"id\":3}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:03:48','2024-11-04 16:03:48'),(71,'2024-11-04 16:04:15',4,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:34:15.000000Z\",\"created_at\":\"2024-11-04T10:34:15.000000Z\",\"id\":4}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:15','2024-11-04 16:04:15'),(72,'2024-11-04 16:04:27',5,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:34:27.000000Z\",\"created_at\":\"2024-11-04T10:34:27.000000Z\",\"id\":5}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:27','2024-11-04 16:04:27'),(73,'2024-11-04 16:04:40',6,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:34:40.000000Z\",\"created_at\":\"2024-11-04T10:34:40.000000Z\",\"id\":6}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:40','2024-11-04 16:04:40'),(74,'2024-11-04 16:04:43',7,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:34:43.000000Z\",\"created_at\":\"2024-11-04T10:34:43.000000Z\",\"id\":7}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:43','2024-11-04 16:04:43'),(75,'2024-11-04 16:04:44',7,'message_feedback_dtl','Insert','{\"id\":7,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:34:43.000000Z\",\"updated_at\":\"2024-11-04T10:34:44.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:44','2024-11-04 16:04:44'),(76,'2024-11-04 16:04:50',8,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:34:50.000000Z\",\"created_at\":\"2024-11-04T10:34:50.000000Z\",\"id\":8}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:50','2024-11-04 16:04:50'),(77,'2024-11-04 16:04:53',9,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:34:53.000000Z\",\"created_at\":\"2024-11-04T10:34:53.000000Z\",\"id\":9}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:53','2024-11-04 16:04:53'),(78,'2024-11-04 16:04:54',9,'message_feedback_dtl','Insert','{\"id\":9,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:34:53.000000Z\",\"updated_at\":\"2024-11-04T10:34:54.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:54','2024-11-04 16:04:54'),(79,'2024-11-04 16:04:58',10,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:34:58.000000Z\",\"created_at\":\"2024-11-04T10:34:58.000000Z\",\"id\":10}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:58','2024-11-04 16:04:58'),(80,'2024-11-04 16:04:59',10,'message_feedback_dtl','Insert','{\"id\":10,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:34:58.000000Z\",\"updated_at\":\"2024-11-04T10:34:59.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:04:59','2024-11-04 16:04:59'),(81,'2024-11-04 16:05:00',10,'message_feedback_dtl','Insert','{\"id\":10,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:34:58.000000Z\",\"updated_at\":\"2024-11-04T10:35:00.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:05:00','2024-11-04 16:05:00'),(82,'2024-11-04 16:05:03',11,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:35:03.000000Z\",\"created_at\":\"2024-11-04T10:35:03.000000Z\",\"id\":11}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:05:03','2024-11-04 16:05:03'),(83,'2024-11-04 16:05:04',11,'message_feedback_dtl','Insert','{\"id\":11,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:35:03.000000Z\",\"updated_at\":\"2024-11-04T10:35:04.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:05:04','2024-11-04 16:05:04'),(84,'2024-11-04 16:05:41',11,'message_feedback_dtl','Insert','{\"id\":11,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:35:03.000000Z\",\"updated_at\":\"2024-11-04T10:35:41.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:05:41','2024-11-04 16:05:41'),(85,'2024-11-04 16:05:47',12,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:35:47.000000Z\",\"created_at\":\"2024-11-04T10:35:47.000000Z\",\"id\":12}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:05:47','2024-11-04 16:05:47'),(86,'2024-11-04 16:06:53',13,'message_feedback_dtl','Insert','{\"message_id\":\"1\",\"user_id\":\"3\",\"status\":\"DISLIKE\",\"updated_at\":\"2024-11-04T10:36:53.000000Z\",\"created_at\":\"2024-11-04T10:36:53.000000Z\",\"id\":13}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:06:53','2024-11-04 16:06:53'),(87,'2024-11-04 16:06:56',14,'message_feedback_dtl','Insert','{\"message_id\":\"1\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:36:56.000000Z\",\"created_at\":\"2024-11-04T10:36:56.000000Z\",\"id\":14}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:06:56','2024-11-04 16:06:56'),(88,'2024-11-04 16:06:58',15,'message_feedback_dtl','Insert','{\"message_id\":\"1\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:36:58.000000Z\",\"created_at\":\"2024-11-04T10:36:58.000000Z\",\"id\":15}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:06:58','2024-11-04 16:06:58'),(89,'2024-11-04 16:06:59',15,'message_feedback_dtl','Insert','{\"id\":15,\"message_id\":1,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:36:58.000000Z\",\"updated_at\":\"2024-11-04T10:36:59.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:06:59','2024-11-04 16:06:59'),(90,'2024-11-04 16:07:00',15,'message_feedback_dtl','Insert','{\"id\":15,\"message_id\":1,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:36:58.000000Z\",\"updated_at\":\"2024-11-04T10:37:00.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:07:00','2024-11-04 16:07:00'),(91,'2024-11-04 16:07:06',16,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:37:06.000000Z\",\"created_at\":\"2024-11-04T10:37:06.000000Z\",\"id\":16}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:07:06','2024-11-04 16:07:06'),(92,'2024-11-04 16:07:08',16,'message_feedback_dtl','Insert','{\"id\":16,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:37:06.000000Z\",\"updated_at\":\"2024-11-04T10:37:08.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:07:08','2024-11-04 16:07:08'),(93,'2024-11-04 16:07:10',16,'message_feedback_dtl','Insert','{\"id\":16,\"message_id\":3,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:37:06.000000Z\",\"updated_at\":\"2024-11-04T10:37:10.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:07:10','2024-11-04 16:07:10'),(94,'2024-11-04 16:09:27',16,'message_feedback_dtl','Update','{\"id\":16,\"message_id\":3,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:37:06.000000Z\",\"updated_at\":\"2024-11-04T10:39:27.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:09:27','2024-11-04 16:09:27'),(95,'2024-11-04 16:09:46',17,'message_feedback_dtl','Insert','{\"message_id\":\"3\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:39:46.000000Z\",\"created_at\":\"2024-11-04T10:39:46.000000Z\",\"id\":17}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:09:46','2024-11-04 16:09:46'),(96,'2024-11-04 16:14:16',15,'message_feedback_dtl','Delete','{\"id\":15,\"message_id\":1,\"user_id\":3,\"status\":\"LIKE\",\"created_at\":\"2024-11-04T10:36:58.000000Z\",\"updated_at\":\"2024-11-04T10:37:00.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:14:16','2024-11-04 16:14:16'),(97,'2024-11-04 16:14:28',18,'message_feedback_dtl','Insert','{\"message_id\":\"1\",\"user_id\":\"3\",\"status\":\"LIKE\",\"updated_at\":\"2024-11-04T10:44:28.000000Z\",\"created_at\":\"2024-11-04T10:44:28.000000Z\",\"id\":18}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:14:28','2024-11-04 16:14:28'),(98,'2024-11-04 16:14:41',18,'message_feedback_dtl','Update','{\"id\":18,\"message_id\":1,\"user_id\":3,\"status\":\"DISLIKE\",\"created_at\":\"2024-11-04T10:44:28.000000Z\",\"updated_at\":\"2024-11-04T10:44:41.000000Z\"}','Firefox','Windows','127.0.0.1',NULL,3,'2024-11-04 16:14:41','2024-11-04 16:14:41');

/*Table structure for table `menu_permissions` */

DROP TABLE IF EXISTS `menu_permissions`;

CREATE TABLE `menu_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `add` int(11) NOT NULL DEFAULT 0,
  `edit` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `print` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `menu_permissions_role_id_foreign` (`role_id`),
  KEY `menu_permissions_menu_id_foreign` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menu_permissions` */

insert  into `menu_permissions`(`permission_id`,`role_id`,`menu_id`,`add`,`edit`,`delete`,`print`,`created_at`,`updated_at`) values (1,1,1,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(2,1,2,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(3,1,3,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(4,1,4,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(5,1,5,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(6,1,6,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(7,1,7,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(8,2,8,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(10,2,9,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(12,2,10,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(13,1,11,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(14,1,12,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(15,1,13,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(16,1,14,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(17,1,15,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(18,1,16,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(19,1,17,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(20,2,18,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(21,2,19,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(22,2,20,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(23,2,21,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(24,2,22,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(25,2,23,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57'),(26,1,24,0,0,0,0,'2024-07-11 20:46:55','2024-07-11 20:46:57');

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `is_parent` enum('Y','N') NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_srl` int(11) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `menu_for` enum('Admin','Employee') NOT NULL DEFAULT 'Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`url`,`route`,`controller`,`method`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`icon`,`menu_for`,`created_at`,`updated_at`) values (1,'TMS','dashboard','dashboard','DashboardController','index','Y',NULL,1,'Y','<i class=\"icon-laptop_windows\"></i>','Admin','2024-07-11 20:46:30','2024-07-11 20:46:32'),(2,'Data Management',NULL,NULL,'MasterController',NULL,'Y',NULL,2,'Y','<i class=\"icon-settings\"></i>','Admin','2024-07-11 20:46:30','2024-07-11 20:46:32'),(3,'Locations','location','location','MasterController','location','N',2,2,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-07-11 20:46:30','2024-07-11 20:46:32'),(4,'Departments','department','department','MasterController','department','N',2,3,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-07-11 20:46:30','2024-07-11 20:46:32'),(5,'Projects','project','project','MasterController','project','N',2,1,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-07-11 20:46:30','2024-07-11 20:46:32'),(6,'Human Resource','humanresource','humanresource','MasterController','humanresource','N',2,4,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-07-11 20:46:30','2024-07-11 20:46:32'),(7,'Task','task','task','TaskController','task','N',12,1,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-09-28 04:20:11','2024-09-28 04:20:12'),(8,'Dashboard','dashboard','dashboard','EmployeeController','index','Y',NULL,1,'Y','<i class=\"icon-laptop_windows\"></i>','Employee','2024-10-02 01:57:15','2024-10-02 01:52:55'),(9,'Task List','task-list','task-list','EmployeeTaskController','task','N',18,1,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Employee','2024-10-02 01:57:17','2024-10-02 01:52:55'),(10,'Task History','task-history','task-history','EmployeeTaskController','taskHistory','N',18,2,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Employee','2024-10-02 01:57:17','2024-10-02 01:52:55'),(11,'Task History','task-history','task-history','TaskController','taskHistory','N',12,3,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-10-02 01:57:17','2024-10-02 01:52:55'),(12,'Schedule',NULL,NULL,'TaskController',NULL,'Y',NULL,3,'Y','<i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>\r\n','Admin','2024-10-24 01:01:50','2024-10-24 01:01:52'),(13,'Communication',NULL,NULL,'TaskController',NULL,'Y',NULL,4,'Y','<i class=\"fa-solid fa-comments\"></i>','Admin','2024-10-24 01:01:50','2024-10-24 01:01:52'),(14,'Documents',NULL,NULL,'TaskController',NULL,'Y',NULL,5,'Y','<i class=\"fa-solid fa-file\"></i>','Admin','2024-10-24 01:11:53','2024-10-24 01:11:54'),(15,'Chat','chat','chat','ChatController','chatScreen','N',13,1,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-10-02 01:57:17','2024-10-02 01:52:55'),(16,'Message Board','message-board','message-board','MessageController','messageScreen','N',13,2,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-10-02 01:57:17','2024-10-02 01:52:55'),(17,'Doc Repository','doc-share','doc-share','DocRepositoryController','index','N',14,1,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-10-02 01:57:17','2024-10-02 01:52:55'),(18,'Schedule',NULL,NULL,'TaskController',NULL,'Y',NULL,3,'Y','<i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>','Employee','2024-10-24 01:01:50','2024-10-24 01:01:52'),(19,'Communication',NULL,NULL,'TaskController',NULL,'Y',NULL,4,'Y','<i class=\"fa-solid fa-comments\"></i>','Employee','2024-10-24 01:01:50','2024-10-24 01:01:52'),(20,'Chat','chat','chat','ChatController','chatScreen','N',19,1,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Employee','2024-10-02 01:57:17','2024-10-02 01:52:55'),(21,'Message Board','message-board','message-board','MessageController','messageScreen','N',19,2,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Employee','2024-10-02 01:57:17','2024-10-02 01:52:55'),(22,'Documents',NULL,NULL,'TaskController',NULL,'Y',NULL,5,'Y','<i class=\"fa-solid fa-file\"></i>','Employee','2024-10-24 01:11:53','2024-10-24 01:11:54'),(23,'Doc Repository','doc-share','doc-share','DocRepositoryController','index','N',22,1,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Employee','2024-10-02 01:57:17','2024-10-02 01:52:55'),(24,'Onetime Task','onetime-task','onetime-task','OneTaskController','index','N',12,2,'Y','<i class=\"nav-icon far fa-dot-circle ?>\"></i>','Admin','2024-10-02 01:57:17','2024-10-02 01:52:55');

/*Table structure for table `message_comment_dtl` */

DROP TABLE IF EXISTS `message_comment_dtl`;

CREATE TABLE `message_comment_dtl` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `message_id` int(10) NOT NULL,
  `sender_id` int(10) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  CONSTRAINT `message_comment_dtl_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `message_comment_dtl` */

insert  into `message_comment_dtl`(`id`,`message_id`,`sender_id`,`comment`,`datetime`,`created_at`,`updated_at`) values (1,1,5,' <p>I completely forgot about that.. Noob question, thank you I appreciate the\r\n                        response,\r\n                        very\r\n                        neat.</p>','2024-11-01 18:45:10','2024-11-01 18:45:15','2024-11-01 18:41:51'),(5,3,6,'<p> Lorem Ipsum has been the industry\'s standard dummy\n text ever since the 1500s, when an unknown printer took a galley of \ntype and scrambled it to make a type specimen book. </p>','2024-11-04 14:02:37','2024-11-04 14:02:37','2024-11-04 14:02:37');

/*Table structure for table `message_feedback_dtl` */

DROP TABLE IF EXISTS `message_feedback_dtl`;

CREATE TABLE `message_feedback_dtl` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `message_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `status` enum('LIKE','DISLIKE') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  CONSTRAINT `message_feedback_dtl_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `message_feedback_dtl` */

insert  into `message_feedback_dtl`(`id`,`message_id`,`user_id`,`status`,`created_at`,`updated_at`) values (18,1,3,'DISLIKE','2024-11-04 16:14:28','2024-11-04 16:14:41');

/*Table structure for table `message_master` */

DROP TABLE IF EXISTS `message_master`;

CREATE TABLE `message_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `sender_id` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `like_count` int(10) DEFAULT NULL,
  `diss_like_count` int(10) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `sender_id` (`sender_id`),
  CONSTRAINT `message_master_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `message_master` */

insert  into `message_master`(`id`,`project_id`,`sender_id`,`title`,`description`,`like_count`,`diss_like_count`,`datetime`,`created_at`,`updated_at`) values (1,1,4,'TIL Important Notice','<p>The grid right now is being handled by the Bootstrap grid system. You can get as many\r\n                rows as\r\n                you\r\n                want, but as far as columns you are limited to what Bootstrap\'s framework can offer. 12\r\n                columns\r\n                would make the images a bit too small I think, but you could easily do 6 columns by\r\n                using\r\n                col-md-2 instead of col-md-3!</p>',1,1,'2024-11-01 18:33:46','2024-11-01 18:33:51','2024-11-01 18:28:54'),(3,1,3,'Lorem Ipsum is simply dummy','<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and \r\ntypesetting industry. Lorem Ipsum has been the industry\'s standard dummy\r\n text ever since the 1500s, when an unknown printer took a galley of \r\ntype and scrambled it to make a type specimen book. It has survived not \r\nonly five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>',0,0,'2024-11-04 13:59:57','2024-11-04 13:59:57','2024-11-04 13:59:57');

/*Table structure for table `message_share_with` */

DROP TABLE IF EXISTS `message_share_with`;

CREATE TABLE `message_share_with` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `message_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  CONSTRAINT `message_share_with_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `message_share_with` */

insert  into `message_share_with`(`id`,`message_id`,`user_id`,`created_at`,`updated_at`) values (1,1,5,'2024-11-04 13:26:10','2024-11-01 18:29:51'),(2,1,6,'2024-11-04 13:26:11','2024-11-01 18:29:55'),(4,3,6,'2024-11-04 13:59:57','2024-11-04 13:59:57');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (26,'2014_10_12_100000_create_password_reset_tokens_table',1),(27,'2019_08_19_000000_create_failed_jobs_table',1),(28,'2019_12_14_000001_create_personal_access_tokens_table',1),(29,'2024_01_09_100000_create_roles_table',1),(30,'2024_01_10_000000_create_users_table',1),(31,'2024_01_10_095519_create_menus_table',1),(32,'2024_01_10_095545_create_menu_permissions_table',1),(33,'2024_01_10_131445_create_user_account_activitys_table',1),(36,'2024_07_10_075348_create_employees_table',2);

/*Table structure for table `onetime_task_dtl` */

DROP TABLE IF EXISTS `onetime_task_dtl`;

CREATE TABLE `onetime_task_dtl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onetime_task_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `is_completed` enum('Y','N') DEFAULT 'N',
  `complete_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onetime_task_id` (`onetime_task_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `onetime_task_dtl_ibfk_1` FOREIGN KEY (`onetime_task_id`) REFERENCES `onetime_task_master` (`id`),
  CONSTRAINT `onetime_task_dtl_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `human_resource` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `onetime_task_dtl` */

insert  into `onetime_task_dtl`(`id`,`onetime_task_id`,`employee_id`,`is_completed`,`complete_date`,`created_at`,`updated_at`) values (9,1,3,'N',NULL,'2024-10-25 08:51:25','2024-10-25 08:51:25'),(10,1,1,'N',NULL,'2024-10-25 13:03:40','2024-10-25 13:03:40');

/*Table structure for table `onetime_task_master` */

DROP TABLE IF EXISTS `onetime_task_master`;

CREATE TABLE `onetime_task_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `onetime_task_master` */

insert  into `onetime_task_master`(`id`,`task_title`,`description`,`project_id`,`created_user_id`,`due_date`,`created_at`,`updated_at`) values (1,'Onetime','Documents Collection',1,1,'2024-10-24 00:00:00','2024-10-24 17:53:06','2024-10-25 13:03:40');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

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

/*Table structure for table `project_master` */

DROP TABLE IF EXISTS `project_master`;

CREATE TABLE `project_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `project_master` */

insert  into `project_master`(`id`,`project_name`,`description`,`is_active`,`created_at`,`updated_at`) values (1,'Dialysis Auditing',NULL,'Y','2024-09-27 09:35:31','2024-10-24 12:01:43');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `is_active` enum('1','0') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`role`,`is_active`) values (1,'Admin','1'),(2,'Employee','1');

/*Table structure for table `task_capture_dtl` */

DROP TABLE IF EXISTS `task_capture_dtl`;

CREATE TABLE `task_capture_dtl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_management_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `report_to_id` int(11) DEFAULT NULL,
  `frequency_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `task_time` varchar(255) DEFAULT NULL,
  `task_date` date DEFAULT NULL,
  `is_supervisor_approved` enum('Y','N') DEFAULT 'N',
  `supervisor_capture_datetime` datetime DEFAULT NULL,
  `is_manager_approved` enum('Y','N') DEFAULT 'N',
  `manager_capture_datetime` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_management_id` (`task_management_id`),
  KEY `employee_id` (`employee_id`),
  KEY `report_to_id` (`report_to_id`),
  KEY `frequency_id` (`frequency_id`),
  KEY `location_id` (`location_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `task_capture_dtl_ibfk_1` FOREIGN KEY (`task_management_id`) REFERENCES `task_management_master` (`id`),
  CONSTRAINT `task_capture_dtl_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `human_resource` (`id`),
  CONSTRAINT `task_capture_dtl_ibfk_3` FOREIGN KEY (`report_to_id`) REFERENCES `human_resource` (`id`),
  CONSTRAINT `task_capture_dtl_ibfk_4` FOREIGN KEY (`frequency_id`) REFERENCES `frequency` (`id`),
  CONSTRAINT `task_capture_dtl_ibfk_5` FOREIGN KEY (`location_id`) REFERENCES `location_master` (`id`),
  CONSTRAINT `task_capture_dtl_ibfk_6` FOREIGN KEY (`task_id`) REFERENCES `task_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `task_capture_dtl` */

insert  into `task_capture_dtl`(`id`,`task_management_id`,`employee_id`,`report_to_id`,`frequency_id`,`location_id`,`task_id`,`task_time`,`task_date`,`is_supervisor_approved`,`supervisor_capture_datetime`,`is_manager_approved`,`manager_capture_datetime`,`created_at`,`updated_at`) values (8,7,2,1,1,1,3,'09:00 AM','2024-10-03','N',NULL,'N',NULL,'2024-10-03 07:17:09','2024-10-03 07:17:09'),(10,8,2,1,1,1,10,'09:00 AM','2024-10-03','N',NULL,'N',NULL,'2024-10-03 07:18:03','2024-10-03 07:18:03'),(12,9,2,1,1,1,32,NULL,'2024-10-03','N',NULL,'N',NULL,'2024-10-03 07:24:46','2024-10-03 07:24:46'),(13,10,2,1,5,1,35,NULL,'2024-10-03','N',NULL,'N',NULL,'2024-10-03 07:25:27','2024-10-03 07:25:27'),(14,11,2,1,2,1,38,NULL,'2024-10-03','N',NULL,'N',NULL,'2024-10-03 07:25:59','2024-10-03 07:25:59'),(15,12,2,1,1,1,50,NULL,'2024-10-03','N',NULL,'N',NULL,'2024-10-03 07:27:13','2024-10-03 07:27:13'),(16,13,2,1,2,1,97,NULL,'2024-10-03','N',NULL,'N',NULL,'2024-10-03 07:28:42','2024-10-03 07:28:42'),(17,7,2,1,1,1,3,'09:00 AM','2024-10-04','Y','2024-10-04 10:09:25','Y','2024-10-04 10:10:11','2024-10-04 00:00:02','2024-10-04 10:10:11'),(18,8,2,1,1,1,10,'09:00 AM','2024-10-04','Y','2024-10-04 12:44:01','Y','2024-10-04 12:44:47','2024-10-04 00:00:02','2024-10-04 12:44:47'),(19,9,2,1,1,1,32,NULL,'2024-10-04','N',NULL,'N',NULL,'2024-10-04 00:00:02','2024-10-04 00:00:02'),(20,12,2,1,1,1,50,NULL,'2024-10-04','N',NULL,'N',NULL,'2024-10-04 00:00:02','2024-10-04 00:00:02'),(21,7,2,1,1,1,3,'09:00 AM','2024-10-05','N',NULL,'N',NULL,'2024-10-05 00:00:02','2024-10-05 00:00:02'),(22,8,2,1,1,1,10,'09:00 AM','2024-10-05','N',NULL,'N',NULL,'2024-10-05 00:00:02','2024-10-05 00:00:02'),(23,9,2,1,1,1,32,NULL,'2024-10-05','N',NULL,'N',NULL,'2024-10-05 00:00:02','2024-10-05 00:00:02'),(24,12,2,1,1,1,50,NULL,'2024-10-05','N',NULL,'N',NULL,'2024-10-05 00:00:02','2024-10-05 00:00:02'),(25,7,2,1,1,1,3,'09:00 AM','2024-10-06','N',NULL,'N',NULL,'2024-10-06 00:00:02','2024-10-06 00:00:02'),(26,8,2,1,1,1,10,'09:00 AM','2024-10-06','N',NULL,'N',NULL,'2024-10-06 00:00:02','2024-10-06 00:00:02'),(27,9,2,1,1,1,32,NULL,'2024-10-06','N',NULL,'N',NULL,'2024-10-06 00:00:02','2024-10-06 00:00:02'),(28,12,2,1,1,1,50,NULL,'2024-10-06','N',NULL,'N',NULL,'2024-10-06 00:00:02','2024-10-06 00:00:02'),(29,7,2,1,1,1,3,'09:00 AM','2024-10-07','N',NULL,'N',NULL,'2024-10-07 00:00:02','2024-10-07 00:00:02'),(30,8,2,1,1,1,10,'09:00 AM','2024-10-07','N',NULL,'N',NULL,'2024-10-07 00:00:02','2024-10-07 00:00:02'),(31,9,2,1,1,1,32,NULL,'2024-10-07','N',NULL,'N',NULL,'2024-10-07 00:00:02','2024-10-07 00:00:02'),(32,12,2,1,1,1,50,NULL,'2024-10-07','N',NULL,'N',NULL,'2024-10-07 00:00:02','2024-10-07 00:00:02'),(33,7,2,1,1,1,3,'09:00 AM','2024-10-08','N',NULL,'N',NULL,'2024-10-08 00:00:02','2024-10-08 00:00:02'),(34,8,2,1,1,1,10,'09:00 AM','2024-10-08','N',NULL,'N',NULL,'2024-10-08 00:00:02','2024-10-08 00:00:02'),(35,9,2,1,1,1,32,NULL,'2024-10-08','N',NULL,'N',NULL,'2024-10-08 00:00:02','2024-10-08 00:00:02'),(36,12,2,1,1,1,50,NULL,'2024-10-08','N',NULL,'N',NULL,'2024-10-08 00:00:02','2024-10-08 00:00:02'),(37,7,2,1,1,1,3,'09:00 AM','2024-10-09','N',NULL,'N',NULL,'2024-10-09 00:00:02','2024-10-09 00:00:02'),(38,8,2,1,1,1,10,'09:00 AM','2024-10-09','N',NULL,'N',NULL,'2024-10-09 00:00:02','2024-10-09 00:00:02'),(39,9,2,1,1,1,32,NULL,'2024-10-09','N',NULL,'N',NULL,'2024-10-09 00:00:02','2024-10-09 00:00:02'),(40,12,2,1,1,1,50,NULL,'2024-10-09','N',NULL,'N',NULL,'2024-10-09 00:00:02','2024-10-09 00:00:02'),(41,7,2,1,1,1,3,'09:00 AM','2024-10-10','N',NULL,'N',NULL,'2024-10-10 00:00:02','2024-10-10 00:00:02'),(42,8,2,1,1,1,10,'09:00 AM','2024-10-10','N',NULL,'N',NULL,'2024-10-10 00:00:02','2024-10-10 00:00:02'),(43,9,2,1,1,1,32,NULL,'2024-10-10','N',NULL,'N',NULL,'2024-10-10 00:00:02','2024-10-10 00:00:02'),(44,12,2,1,1,1,50,NULL,'2024-10-10','N',NULL,'N',NULL,'2024-10-10 00:00:02','2024-10-10 00:00:02'),(45,11,2,1,2,1,38,NULL,'2024-10-10','N',NULL,'N',NULL,'2024-10-10 00:00:02','2024-10-10 00:00:02'),(46,13,2,1,2,1,97,NULL,'2024-10-10','N',NULL,'N',NULL,'2024-10-10 00:00:02','2024-10-10 00:00:02'),(47,7,2,1,1,1,3,'09:00 AM','2024-10-11','N',NULL,'N',NULL,'2024-10-11 00:00:01','2024-10-11 00:00:01'),(48,8,2,1,1,1,10,'09:00 AM','2024-10-11','N',NULL,'N',NULL,'2024-10-11 00:00:01','2024-10-11 00:00:01'),(49,9,2,1,1,1,32,NULL,'2024-10-11','N',NULL,'N',NULL,'2024-10-11 00:00:01','2024-10-11 00:00:01'),(50,12,2,1,1,1,50,NULL,'2024-10-11','N',NULL,'N',NULL,'2024-10-11 00:00:01','2024-10-11 00:00:01'),(51,7,2,1,1,1,3,'09:00 AM','2024-10-12','N',NULL,'N',NULL,'2024-10-12 00:00:02','2024-10-12 00:00:02'),(52,8,2,1,1,1,10,'09:00 AM','2024-10-12','N',NULL,'N',NULL,'2024-10-12 00:00:02','2024-10-12 00:00:02'),(53,9,2,1,1,1,32,NULL,'2024-10-12','N',NULL,'N',NULL,'2024-10-12 00:00:02','2024-10-12 00:00:02'),(54,12,2,1,1,1,50,NULL,'2024-10-12','N',NULL,'N',NULL,'2024-10-12 00:00:02','2024-10-12 00:00:02'),(55,7,2,1,1,1,3,'09:00 AM','2024-10-13','N',NULL,'N',NULL,'2024-10-13 00:00:02','2024-10-13 00:00:02'),(56,8,2,1,1,1,10,'09:00 AM','2024-10-13','N',NULL,'N',NULL,'2024-10-13 00:00:02','2024-10-13 00:00:02'),(57,9,2,1,1,1,32,NULL,'2024-10-13','N',NULL,'N',NULL,'2024-10-13 00:00:02','2024-10-13 00:00:02'),(58,12,2,1,1,1,50,NULL,'2024-10-13','N',NULL,'N',NULL,'2024-10-13 00:00:02','2024-10-13 00:00:02'),(59,7,2,1,1,1,3,'09:00 AM','2024-10-14','N',NULL,'N',NULL,'2024-10-14 00:00:02','2024-10-14 00:00:02'),(60,8,2,1,1,1,10,'09:00 AM','2024-10-14','N',NULL,'N',NULL,'2024-10-14 00:00:02','2024-10-14 00:00:02'),(61,9,2,1,1,1,32,NULL,'2024-10-14','N',NULL,'N',NULL,'2024-10-14 00:00:02','2024-10-14 00:00:02'),(62,12,2,1,1,1,50,NULL,'2024-10-14','N',NULL,'N',NULL,'2024-10-14 00:00:02','2024-10-14 00:00:02'),(63,7,2,1,1,1,3,'09:00 AM','2024-10-15','N',NULL,'N',NULL,'2024-10-15 00:00:02','2024-10-15 00:00:02'),(64,8,2,1,1,1,10,'09:00 AM','2024-10-15','N',NULL,'N',NULL,'2024-10-15 00:00:02','2024-10-15 00:00:02'),(65,9,2,1,1,1,32,NULL,'2024-10-15','N',NULL,'N',NULL,'2024-10-15 00:00:02','2024-10-15 00:00:02'),(66,12,2,1,1,1,50,NULL,'2024-10-15','N',NULL,'N',NULL,'2024-10-15 00:00:02','2024-10-15 00:00:02'),(67,7,2,1,1,1,3,'09:00 AM','2024-10-16','N',NULL,'N',NULL,'2024-10-16 00:00:01','2024-10-16 00:00:01'),(68,8,2,1,1,1,10,'09:00 AM','2024-10-16','N',NULL,'N',NULL,'2024-10-16 00:00:01','2024-10-16 00:00:01'),(69,9,2,1,1,1,32,NULL,'2024-10-16','N',NULL,'N',NULL,'2024-10-16 00:00:01','2024-10-16 00:00:01'),(70,12,2,1,1,1,50,NULL,'2024-10-16','N',NULL,'N',NULL,'2024-10-16 00:00:01','2024-10-16 00:00:01'),(71,7,2,1,1,1,3,'09:00 AM','2024-10-17','N',NULL,'N',NULL,'2024-10-17 00:00:01','2024-10-17 00:00:01'),(72,8,2,1,1,1,10,'09:00 AM','2024-10-17','N',NULL,'N',NULL,'2024-10-17 00:00:01','2024-10-17 00:00:01'),(73,9,2,1,1,1,32,NULL,'2024-10-17','N',NULL,'N',NULL,'2024-10-17 00:00:01','2024-10-17 00:00:01'),(74,12,2,1,1,1,50,NULL,'2024-10-17','N',NULL,'N',NULL,'2024-10-17 00:00:01','2024-10-17 00:00:01'),(75,11,2,1,2,1,38,NULL,'2024-10-17','N',NULL,'N',NULL,'2024-10-17 00:00:01','2024-10-17 00:00:01'),(76,13,2,1,2,1,97,NULL,'2024-10-17','N',NULL,'N',NULL,'2024-10-17 00:00:01','2024-10-17 00:00:01'),(77,7,2,1,1,1,3,'09:00 AM','2024-10-18','N',NULL,'N',NULL,'2024-10-18 00:00:02','2024-10-18 00:00:02'),(78,8,2,1,1,1,10,'09:00 AM','2024-10-18','N',NULL,'N',NULL,'2024-10-18 00:00:02','2024-10-18 00:00:02'),(79,9,2,1,1,1,32,NULL,'2024-10-18','N',NULL,'N',NULL,'2024-10-18 00:00:02','2024-10-18 00:00:02'),(80,12,2,1,1,1,50,NULL,'2024-10-18','N',NULL,'N',NULL,'2024-10-18 00:00:02','2024-10-18 00:00:02'),(81,7,2,1,1,1,3,'09:00 AM','2024-10-19','N',NULL,'N',NULL,'2024-10-19 00:00:01','2024-10-19 00:00:01'),(82,8,2,1,1,1,10,'09:00 AM','2024-10-19','N',NULL,'N',NULL,'2024-10-19 00:00:01','2024-10-19 00:00:01'),(83,9,2,1,1,1,32,NULL,'2024-10-19','N',NULL,'N',NULL,'2024-10-19 00:00:01','2024-10-19 00:00:01'),(84,12,2,1,1,1,50,NULL,'2024-10-19','N',NULL,'N',NULL,'2024-10-19 00:00:02','2024-10-19 00:00:02'),(85,7,2,1,1,1,3,'09:00 AM','2024-10-20','N',NULL,'N',NULL,'2024-10-20 00:00:02','2024-10-20 00:00:02'),(86,8,2,1,1,1,10,'09:00 AM','2024-10-20','N',NULL,'N',NULL,'2024-10-20 00:00:02','2024-10-20 00:00:02'),(87,9,2,1,1,1,32,NULL,'2024-10-20','N',NULL,'N',NULL,'2024-10-20 00:00:02','2024-10-20 00:00:02'),(88,12,2,1,1,1,50,NULL,'2024-10-20','N',NULL,'N',NULL,'2024-10-20 00:00:02','2024-10-20 00:00:02'),(89,7,2,1,1,1,3,'09:00 AM','2024-10-21','N',NULL,'N',NULL,'2024-10-21 00:00:02','2024-10-21 00:00:02'),(90,8,2,1,1,1,10,'09:00 AM','2024-10-21','N',NULL,'N',NULL,'2024-10-21 00:00:02','2024-10-21 00:00:02'),(91,9,2,1,1,1,32,NULL,'2024-10-21','Y','2024-10-21 15:31:25','N',NULL,'2024-10-21 00:00:02','2024-10-21 15:31:25'),(92,12,2,1,1,1,50,NULL,'2024-10-21','N',NULL,'N',NULL,'2024-10-21 00:00:02','2024-10-21 00:00:02'),(93,14,1,NULL,1,1,32,NULL,'2024-10-21','Y','2024-10-21 15:30:52','N',NULL,'2024-10-21 15:01:54','2024-10-21 15:30:52'),(94,7,2,1,1,1,3,'09:00 AM','2024-10-22','N',NULL,'N',NULL,'2024-10-22 11:21:05','2024-10-22 11:21:05'),(95,8,2,1,1,1,10,'09:00 AM','2024-10-22','N',NULL,'N',NULL,'2024-10-22 11:21:05','2024-10-22 11:21:05'),(96,9,2,1,1,1,32,NULL,'2024-10-22','N',NULL,'N',NULL,'2024-10-22 11:21:05','2024-10-22 11:21:05'),(97,12,2,1,1,1,50,NULL,'2024-10-22','N',NULL,'N',NULL,'2024-10-22 11:21:05','2024-10-22 11:21:05'),(98,14,1,NULL,1,1,32,NULL,'2024-10-22','N',NULL,'N',NULL,'2024-10-22 11:21:05','2024-10-22 11:21:05'),(99,7,2,1,1,1,3,'09:00 AM','2024-10-23','N',NULL,'N',NULL,'2024-10-23 11:28:55','2024-10-23 11:28:55'),(100,8,2,1,1,1,10,'09:00 AM','2024-10-23','N',NULL,'N',NULL,'2024-10-23 11:28:55','2024-10-23 11:28:55'),(101,9,2,1,1,1,32,NULL,'2024-10-23','N',NULL,'N',NULL,'2024-10-23 11:28:55','2024-10-23 11:28:55'),(102,12,2,1,1,1,50,NULL,'2024-10-23','N',NULL,'N',NULL,'2024-10-23 11:28:55','2024-10-23 11:28:55'),(103,14,1,NULL,1,1,32,NULL,'2024-10-23','N',NULL,'N',NULL,'2024-10-23 11:28:55','2024-10-23 11:28:55'),(104,7,2,1,1,1,3,'09:00 AM','2024-10-24','Y','2024-10-24 11:36:52','N',NULL,'2024-10-24 11:15:12','2024-10-24 11:36:52'),(105,8,2,1,1,1,10,'09:00 AM','2024-10-24','N',NULL,'N',NULL,'2024-10-24 11:15:12','2024-10-24 11:15:12'),(106,9,2,1,1,1,32,NULL,'2024-10-24','N',NULL,'N',NULL,'2024-10-24 11:15:12','2024-10-24 11:15:12'),(107,12,2,1,1,1,50,NULL,'2024-10-24','N',NULL,'N',NULL,'2024-10-24 11:15:12','2024-10-24 11:15:12'),(108,14,1,NULL,1,1,32,NULL,'2024-10-24','Y','2024-10-24 11:31:26','N',NULL,'2024-10-24 11:15:12','2024-10-24 11:31:26'),(109,11,2,1,2,1,38,NULL,'2024-10-24','N',NULL,'N',NULL,'2024-10-24 11:15:12','2024-10-24 11:15:12'),(110,13,2,1,2,1,97,NULL,'2024-10-24','N',NULL,'N',NULL,'2024-10-24 11:15:12','2024-10-24 11:15:12'),(111,15,3,NULL,1,1,11,'06:00 PM','2024-10-24','Y','2024-10-24 11:25:24','N',NULL,'2024-10-24 11:58:08','2024-10-24 11:25:24'),(112,7,2,1,1,1,3,'09:00 AM','2024-10-25','N',NULL,'N',NULL,'2024-10-25 00:00:02','2024-10-25 00:00:02'),(113,8,2,1,1,1,10,'09:00 AM','2024-10-25','N',NULL,'N',NULL,'2024-10-25 00:00:02','2024-10-25 00:00:02'),(114,9,2,1,1,1,32,NULL,'2024-10-25','N',NULL,'N',NULL,'2024-10-25 00:00:02','2024-10-25 00:00:02'),(115,12,2,1,1,1,50,NULL,'2024-10-25','N',NULL,'N',NULL,'2024-10-25 00:00:02','2024-10-25 00:00:02'),(116,14,1,NULL,1,1,32,NULL,'2024-10-25','N',NULL,'N',NULL,'2024-10-25 00:00:02','2024-10-25 00:00:02'),(117,15,3,NULL,1,1,11,'06:00 PM','2024-10-25','N',NULL,'N',NULL,'2024-10-25 00:00:02','2024-10-25 00:00:02'),(118,7,2,1,1,1,3,'09:00 AM','2024-10-26','N',NULL,'N',NULL,'2024-10-26 00:00:02','2024-10-26 00:00:02'),(119,8,2,1,1,1,10,'09:00 AM','2024-10-26','N',NULL,'N',NULL,'2024-10-26 00:00:02','2024-10-26 00:00:02'),(120,9,2,1,1,1,32,NULL,'2024-10-26','N',NULL,'N',NULL,'2024-10-26 00:00:02','2024-10-26 00:00:02'),(121,12,2,1,1,1,50,NULL,'2024-10-26','N',NULL,'N',NULL,'2024-10-26 00:00:02','2024-10-26 00:00:02'),(122,14,1,NULL,1,1,32,NULL,'2024-10-26','N',NULL,'N',NULL,'2024-10-26 00:00:02','2024-10-26 00:00:02'),(123,15,3,NULL,1,1,11,'06:00 PM','2024-10-26','N',NULL,'N',NULL,'2024-10-26 00:00:02','2024-10-26 00:00:02'),(124,7,2,1,1,1,3,'09:00 AM','2024-10-27','N',NULL,'N',NULL,'2024-10-27 00:00:01','2024-10-27 00:00:01'),(125,8,2,1,1,1,10,'09:00 AM','2024-10-27','N',NULL,'N',NULL,'2024-10-27 00:00:01','2024-10-27 00:00:01'),(126,9,2,1,1,1,32,NULL,'2024-10-27','N',NULL,'N',NULL,'2024-10-27 00:00:01','2024-10-27 00:00:01'),(127,12,2,1,1,1,50,NULL,'2024-10-27','N',NULL,'N',NULL,'2024-10-27 00:00:01','2024-10-27 00:00:01'),(128,14,1,NULL,1,1,32,NULL,'2024-10-27','N',NULL,'N',NULL,'2024-10-27 00:00:01','2024-10-27 00:00:01'),(129,15,3,NULL,1,1,11,'06:00 PM','2024-10-27','N',NULL,'N',NULL,'2024-10-27 00:00:01','2024-10-27 00:00:01'),(130,7,2,1,1,1,3,'09:00 AM','2024-10-28','N',NULL,'N',NULL,'2024-10-28 00:00:02','2024-10-28 00:00:02'),(131,8,2,1,1,1,10,'09:00 AM','2024-10-28','N',NULL,'N',NULL,'2024-10-28 00:00:02','2024-10-28 00:00:02'),(132,9,2,1,1,1,32,NULL,'2024-10-28','N',NULL,'N',NULL,'2024-10-28 00:00:02','2024-10-28 00:00:02'),(133,12,2,1,1,1,50,NULL,'2024-10-28','N',NULL,'N',NULL,'2024-10-28 00:00:02','2024-10-28 00:00:02'),(134,14,1,NULL,1,1,32,NULL,'2024-10-28','N',NULL,'N',NULL,'2024-10-28 00:00:02','2024-10-28 00:00:02'),(135,15,3,NULL,1,1,11,'06:00 PM','2024-10-28','N',NULL,'N',NULL,'2024-10-28 00:00:02','2024-10-28 00:00:02'),(136,7,2,1,1,1,3,'09:00 AM','2024-10-29','N',NULL,'N',NULL,'2024-10-29 00:00:01','2024-10-29 00:00:01'),(137,8,2,1,1,1,10,'09:00 AM','2024-10-29','N',NULL,'N',NULL,'2024-10-29 00:00:01','2024-10-29 00:00:01'),(138,9,2,1,1,1,32,NULL,'2024-10-29','N',NULL,'N',NULL,'2024-10-29 00:00:01','2024-10-29 00:00:01'),(139,12,2,1,1,1,50,NULL,'2024-10-29','N',NULL,'N',NULL,'2024-10-29 00:00:01','2024-10-29 00:00:01'),(140,14,1,NULL,1,1,32,NULL,'2024-10-29','N',NULL,'N',NULL,'2024-10-29 00:00:01','2024-10-29 00:00:01'),(141,15,3,NULL,1,1,11,'06:00 PM','2024-10-29','N',NULL,'N',NULL,'2024-10-29 00:00:01','2024-10-29 00:00:01'),(142,7,2,1,1,1,3,'09:00 AM','2024-10-30','N',NULL,'N',NULL,'2024-10-30 00:00:01','2024-10-30 00:00:01'),(143,8,2,1,1,1,10,'09:00 AM','2024-10-30','N',NULL,'N',NULL,'2024-10-30 00:00:01','2024-10-30 00:00:01'),(144,9,2,1,1,1,32,NULL,'2024-10-30','N',NULL,'N',NULL,'2024-10-30 00:00:01','2024-10-30 00:00:01'),(145,12,2,1,1,1,50,NULL,'2024-10-30','N',NULL,'N',NULL,'2024-10-30 00:00:01','2024-10-30 00:00:01'),(146,14,1,NULL,1,1,32,NULL,'2024-10-30','N',NULL,'N',NULL,'2024-10-30 00:00:01','2024-10-30 00:00:01'),(147,15,3,NULL,1,1,11,'06:00 PM','2024-10-30','N',NULL,'N',NULL,'2024-10-30 00:00:01','2024-10-30 00:00:01'),(148,7,2,1,1,1,3,'09:00 AM','2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:02','2024-10-31 00:00:02'),(149,8,2,1,1,1,10,'09:00 AM','2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:02','2024-10-31 00:00:02'),(150,9,2,1,1,1,32,NULL,'2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:02','2024-10-31 00:00:02'),(151,12,2,1,1,1,50,NULL,'2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:02','2024-10-31 00:00:02'),(152,14,1,NULL,1,1,32,NULL,'2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:02','2024-10-31 00:00:02'),(153,15,3,NULL,1,1,11,'06:00 PM','2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:02','2024-10-31 00:00:02'),(154,11,2,1,2,1,38,NULL,'2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:03','2024-10-31 00:00:03'),(155,13,2,1,2,1,97,NULL,'2024-10-31','N',NULL,'N',NULL,'2024-10-31 00:00:03','2024-10-31 00:00:03'),(156,7,2,1,1,1,3,'09:00 AM','2024-11-01','N',NULL,'N',NULL,'2024-11-01 00:00:02','2024-11-01 00:00:02'),(157,8,2,1,1,1,10,'09:00 AM','2024-11-01','N',NULL,'N',NULL,'2024-11-01 00:00:02','2024-11-01 00:00:02'),(158,9,2,1,1,1,32,NULL,'2024-11-01','N',NULL,'N',NULL,'2024-11-01 00:00:02','2024-11-01 00:00:02'),(159,12,2,1,1,1,50,NULL,'2024-11-01','N',NULL,'N',NULL,'2024-11-01 00:00:02','2024-11-01 00:00:02'),(160,14,1,NULL,1,1,32,NULL,'2024-11-01','N',NULL,'N',NULL,'2024-11-01 00:00:02','2024-11-01 00:00:02'),(161,15,3,NULL,1,1,11,'06:00 PM','2024-11-01','N',NULL,'N',NULL,'2024-11-01 00:00:02','2024-11-01 00:00:02'),(162,7,2,1,1,1,3,'09:00 AM','2024-11-02','N',NULL,'N',NULL,'2024-11-02 00:00:02','2024-11-02 00:00:02'),(163,8,2,1,1,1,10,'09:00 AM','2024-11-02','N',NULL,'N',NULL,'2024-11-02 00:00:02','2024-11-02 00:00:02'),(164,9,2,1,1,1,32,NULL,'2024-11-02','N',NULL,'N',NULL,'2024-11-02 00:00:02','2024-11-02 00:00:02'),(165,12,2,1,1,1,50,NULL,'2024-11-02','N',NULL,'N',NULL,'2024-11-02 00:00:02','2024-11-02 00:00:02'),(166,14,1,NULL,1,1,32,NULL,'2024-11-02','N',NULL,'N',NULL,'2024-11-02 00:00:02','2024-11-02 00:00:02'),(167,15,3,NULL,1,1,11,'06:00 PM','2024-11-02','N',NULL,'N',NULL,'2024-11-02 00:00:02','2024-11-02 00:00:02'),(168,7,2,1,1,1,3,'09:00 AM','2024-11-03','N',NULL,'N',NULL,'2024-11-03 00:00:02','2024-11-03 00:00:02'),(169,8,2,1,1,1,10,'09:00 AM','2024-11-03','N',NULL,'N',NULL,'2024-11-03 00:00:02','2024-11-03 00:00:02'),(170,9,2,1,1,1,32,NULL,'2024-11-03','N',NULL,'N',NULL,'2024-11-03 00:00:02','2024-11-03 00:00:02'),(171,12,2,1,1,1,50,NULL,'2024-11-03','N',NULL,'N',NULL,'2024-11-03 00:00:02','2024-11-03 00:00:02'),(172,14,1,NULL,1,1,32,NULL,'2024-11-03','N',NULL,'N',NULL,'2024-11-03 00:00:02','2024-11-03 00:00:02'),(173,15,3,NULL,1,1,11,'06:00 PM','2024-11-03','N',NULL,'N',NULL,'2024-11-03 00:00:02','2024-11-03 00:00:02'),(174,7,2,1,1,1,3,'09:00 AM','2024-11-04','N',NULL,'N',NULL,'2024-11-04 00:00:02','2024-11-04 00:00:02'),(175,8,2,1,1,1,10,'09:00 AM','2024-11-04','N',NULL,'N',NULL,'2024-11-04 00:00:02','2024-11-04 00:00:02'),(176,9,2,1,1,1,32,NULL,'2024-11-04','N',NULL,'N',NULL,'2024-11-04 00:00:02','2024-11-04 00:00:02'),(177,12,2,1,1,1,50,NULL,'2024-11-04','N',NULL,'N',NULL,'2024-11-04 00:00:02','2024-11-04 00:00:02'),(178,14,1,NULL,1,1,32,NULL,'2024-11-04','N',NULL,'N',NULL,'2024-11-04 00:00:02','2024-11-04 00:00:02'),(179,15,3,NULL,1,1,11,'06:00 PM','2024-11-04','N',NULL,'N',NULL,'2024-11-04 00:00:02','2024-11-04 00:00:02');

/*Table structure for table `task_management_master` */

DROP TABLE IF EXISTS `task_management_master`;

CREATE TABLE `task_management_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `report_to_id` int(11) DEFAULT NULL,
  `frequency_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `next_schedule_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `report_to_id` (`report_to_id`),
  KEY `task_id` (`task_id`),
  KEY `frequency_id` (`frequency_id`),
  CONSTRAINT `task_management_master_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `human_resource` (`id`),
  CONSTRAINT `task_management_master_ibfk_2` FOREIGN KEY (`report_to_id`) REFERENCES `human_resource` (`id`),
  CONSTRAINT `task_management_master_ibfk_3` FOREIGN KEY (`task_id`) REFERENCES `task_master` (`id`),
  CONSTRAINT `task_management_master_ibfk_4` FOREIGN KEY (`frequency_id`) REFERENCES `frequency` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `task_management_master` */

insert  into `task_management_master`(`id`,`employee_id`,`report_to_id`,`frequency_id`,`location_id`,`task_id`,`next_schedule_date`,`created_at`,`updated_at`) values (7,2,1,1,1,3,'2024-11-05 00:00:00','2024-10-03 07:17:09','2024-11-04 00:00:02'),(8,2,1,1,1,10,'2024-11-05 00:00:00','2024-10-03 07:18:03','2024-11-04 00:00:02'),(9,2,1,1,1,32,'2024-11-05 00:00:00','2024-10-03 07:24:46','2024-11-04 00:00:02'),(10,2,1,5,1,35,'2025-10-03 00:00:00','2024-10-03 07:25:27','2024-10-03 07:25:27'),(11,2,1,2,1,38,'2024-11-07 00:00:00','2024-10-03 07:25:59','2024-10-31 00:00:03'),(12,2,1,1,1,50,'2024-11-05 00:00:00','2024-10-03 07:27:13','2024-11-04 00:00:02'),(13,2,1,2,1,97,'2024-11-07 00:00:00','2024-10-03 07:28:42','2024-10-31 00:00:03'),(14,1,NULL,1,1,32,'2024-11-05 00:00:00','2024-10-21 15:01:54','2024-11-04 00:00:02'),(15,3,NULL,1,1,11,'2024-11-05 00:00:00','2024-10-24 11:58:08','2024-11-04 00:00:02');

/*Table structure for table `task_master` */

DROP TABLE IF EXISTS `task_master`;

CREATE TABLE `task_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(255) DEFAULT NULL,
  `parent_task_id` int(11) DEFAULT NULL,
  `end_task` enum('Y','N') DEFAULT 'N',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_task_id` (`parent_task_id`),
  CONSTRAINT `task_master_ibfk_1` FOREIGN KEY (`parent_task_id`) REFERENCES `task_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `task_master` */

insert  into `task_master`(`id`,`task`,`parent_task_id`,`end_task`,`created_at`,`updated_at`) values (1,'Facility Maintenance',NULL,'N','2024-09-27 17:13:51','2024-09-27 17:13:53'),(2,'Cleanliness of Unit',1,'N','2024-09-27 17:14:12','2024-09-27 17:14:13'),(3,'Lobby Area',2,'Y','2024-09-27 17:14:28','2024-10-01 07:19:54'),(4,'Equip Maintenance',NULL,'N','2024-09-27 17:23:04','2024-09-30 07:29:53'),(5,'Dialysis Machine and Monitors',4,'N','2024-09-27 17:23:18','2024-09-30 06:42:03'),(6,'Dialysis Machine',5,'Y',NULL,'2024-09-27 17:23:39'),(7,'Water Treatment Plant',NULL,'N','2024-09-27 13:52:08','2024-09-27 13:55:11'),(8,'Daily Checking and monitoring',7,'N','2024-09-27 13:53:27','2024-09-27 13:53:58'),(9,'Major filter checking',8,'Y','2024-09-27 13:54:15','2024-09-30 06:42:32'),(10,'Door Mat',2,'Y','2024-10-03 05:45:06','2024-10-03 05:45:06'),(11,'Shoe rack',2,'Y','2024-10-03 05:45:25','2024-10-03 05:45:25'),(12,'Front door handle',2,'Y','2024-10-03 05:45:35','2024-10-03 05:45:35'),(13,'House keeping',1,'N','2024-10-03 05:46:20','2024-10-03 05:46:20'),(14,'Floor Mopping',13,'Y','2024-10-03 05:46:34','2024-10-03 05:46:34'),(15,'Toilet Cleaning',13,'Y','2024-10-03 05:46:49','2024-10-03 06:16:25'),(16,'Biowaste Packing Disposal',13,'Y','2024-10-03 06:17:30','2024-10-03 06:17:30'),(17,'Other Miscellaneous Issues',1,'N','2024-10-03 06:17:51','2024-10-03 06:17:51'),(18,'Sleepers at Dialysis room',17,'Y','2024-10-03 06:18:10','2024-10-03 06:18:10'),(19,'Cellotapes / Micropore in Bed Chairs ETc',17,'Y','2024-10-03 06:18:30','2024-10-03 06:18:30'),(20,'Surface of O2 Cylinder /Carrier',17,'Y','2024-10-03 06:18:46','2024-10-03 06:18:46'),(21,'Curtain and Linen',1,'N','2024-10-03 06:21:26','2024-10-03 06:21:26'),(22,'Curtain Channel Smooth ness',21,'Y','2024-10-03 06:21:40','2024-10-03 06:21:40'),(23,'Curtain Cleanliness',21,'Y','2024-10-03 06:21:51','2024-10-03 06:21:51'),(24,'Any Spare Curtain',21,'Y','2024-10-03 06:22:13','2024-10-03 06:22:13'),(25,'TV content , Music, Leaflet Posters',1,'N','2024-10-03 06:23:23','2024-10-03 06:23:23'),(26,'TV Content to run during dialysis hrs',25,'Y','2024-10-03 06:23:38','2024-10-03 06:23:38'),(27,'Music to be played',25,'Y','2024-10-03 06:23:49','2024-10-03 06:23:49'),(28,'Leaflets',25,'Y','2024-10-03 06:24:00','2024-10-03 06:24:00'),(29,'Art works Plant Asthetics aspects',1,'N','2024-10-03 06:24:23','2024-10-03 06:24:23'),(30,'Art works',29,'Y','2024-10-03 06:24:36','2024-10-03 06:24:36'),(31,'Plants',29,'Y','2024-10-03 06:24:51','2024-10-03 06:24:51'),(32,'Notice board',29,'Y','2024-10-03 06:25:05','2024-10-03 06:25:05'),(33,'WASTE MANAGEMENT',1,'N','2024-10-03 06:25:18','2024-10-03 06:25:18'),(34,'SOP for Biowaste management',33,'Y','2024-10-03 06:25:31','2024-10-03 06:25:31'),(35,'Waste management Agreement',33,'Y','2024-10-03 06:25:45','2024-10-03 06:25:45'),(36,'Waste Packing in each shift',33,'Y','2024-10-03 06:26:04','2024-10-03 06:26:04'),(37,'Food Quality and Hygiene',1,'N','2024-10-03 06:26:19','2024-10-03 06:26:19'),(38,'Checking Food menu in different Shift',37,'Y','2024-10-03 06:26:36','2024-10-03 06:26:36'),(39,'Tasting Prepared food for each shift',37,'Y','2024-10-03 06:26:53','2024-10-03 06:26:53'),(40,'Food preference UNDERSTANDING from pts',37,'Y','2024-10-03 06:27:09','2024-10-03 06:27:09'),(41,'Stationaries and Store',1,'N','2024-10-03 06:28:05','2024-10-03 06:28:05'),(42,'Maiking List of all Stationaries required to run the show, like Pad, Forms,Stamp, Ink Pad, House keeping items etc',41,'Y','2024-10-03 06:28:30','2024-10-03 06:28:30'),(43,'Maiking List of all Consumables like dialyser, Tubings, Heparin etc etc required to run the show',41,'Y','2024-10-03 06:28:56','2024-10-03 06:28:56'),(44,'Checking the stock of  all the stationaries items and maintaing a list',41,'Y','2024-10-03 06:29:07','2024-10-03 06:29:07'),(45,'Patient satisfaction and Happiness',1,'N','2024-10-03 06:29:31','2024-10-03 06:29:31'),(46,'Interacting Humanly with each patient , Greeting with smlle',45,'Y','2024-10-03 06:29:42','2024-10-03 06:29:42'),(47,'Preparing Data for Birthday and anniversary for each existing patient and all new patient',45,'Y','2024-10-03 06:29:56','2024-10-03 06:29:56'),(48,'Preparions of Qustions what telecaller should ask and record daily after dialysis',45,'Y','2024-10-03 06:30:09','2024-10-03 06:30:09'),(49,'Naming and giving Serial no to each machine',5,'Y','2024-10-03 06:31:16','2024-10-03 06:31:16'),(50,'Daily Maintennace  Record book',5,'Y','2024-10-03 06:31:31','2024-10-03 06:31:31'),(51,'Ventilator, BiPAP, Nebuliser, Defib',4,'N','2024-10-03 06:31:55','2024-10-03 06:31:55'),(52,'Ventilator',51,'Y','2024-10-03 06:32:11','2024-10-03 06:32:11'),(53,'To check Airflow callibrator',51,'Y','2024-10-03 06:32:29','2024-10-03 06:32:29'),(54,'Power switch',51,'Y','2024-10-03 06:32:51','2024-10-03 06:32:51'),(55,'Weighing Scale, BP,Stetho',4,'N','2024-10-03 06:33:09','2024-10-03 06:33:09'),(56,'Weighing Scale',55,'Y','2024-10-03 06:33:21','2024-10-03 06:33:21'),(57,'Spare Weighing Scale',55,'Y','2024-10-03 06:33:43','2024-10-03 06:33:43'),(58,'BP Velcrow, Bulb, Cock',55,'Y','2024-10-03 06:33:54','2024-10-03 06:33:54'),(59,'Dialysis Beds and Chairs,Wheel Chair',4,'N','2024-10-03 06:34:07','2024-10-03 06:34:07'),(60,'Dialysis Bed Health check',59,'Y','2024-10-03 06:34:22','2024-10-03 06:34:22'),(61,'Checking the wheels and oiling',59,'Y','2024-10-03 06:34:31','2024-10-03 06:34:31'),(62,'Checking the Railing',59,'Y','2024-10-03 06:34:41','2024-10-03 06:34:41'),(63,'Airconditioning',4,'N','2024-10-03 06:35:03','2024-10-03 06:35:03'),(64,'Checking all the AC',63,'Y','2024-10-03 06:35:11','2024-10-03 06:35:11'),(65,'Drain pipe',63,'Y','2024-10-03 06:35:19','2024-10-03 06:35:19'),(66,'Filter cleaning',63,'Y','2024-10-03 06:35:33','2024-10-03 06:35:33'),(67,'UPS and electrical maintenance, Autoclave',4,'N','2024-10-03 06:35:57','2024-10-03 06:35:57'),(68,'All Power point and plug checking',67,'Y','2024-10-03 06:36:07','2024-10-03 06:36:07'),(69,'All light checking',67,'Y','2024-10-03 06:36:16','2024-10-03 06:36:16'),(70,'UPS Battery checking',67,'Y','2024-10-03 06:36:25','2024-10-03 06:36:25'),(71,'O2 Distribution system',4,'N','2024-10-03 06:36:43','2024-10-03 06:36:43'),(72,'Roof Top Oxygen Plant',71,'Y','2024-10-03 06:36:59','2024-10-03 06:36:59'),(73,'O2 Pressure Valves',71,'Y','2024-10-03 06:37:09','2024-10-03 06:37:09'),(74,'Oxygen Tumblers and flowmeters',71,'Y','2024-10-03 06:37:19','2024-10-03 06:37:19'),(75,'Plumbing and Pump',4,'N','2024-10-03 06:37:46','2024-10-03 06:37:46'),(76,'All Plumbing PipeNetwork of Dialysis',75,'Y','2024-10-03 06:37:58','2024-10-03 06:37:58'),(77,'All Valves and joints',75,'Y','2024-10-03 06:38:10','2024-10-03 06:38:10'),(78,'All Nozzles at Dialysis room',75,'Y','2024-10-03 06:38:19','2024-10-03 06:38:19'),(79,'TV',4,'N','2024-10-03 06:38:43','2024-10-03 06:38:43'),(80,'TV Screen and power system',79,'Y','2024-10-03 06:38:53','2024-10-03 06:38:53'),(81,'Remote and its battery',79,'Y','2024-10-03 06:39:08','2024-10-03 06:39:08'),(82,'Cable connection / Subscription',79,'Y','2024-10-03 06:39:18','2024-10-03 06:39:18'),(83,'Computer and printer',4,'N','2024-10-03 06:39:32','2024-10-03 06:39:32'),(84,'All Computer accessories',83,'Y','2024-10-03 06:39:41','2024-10-03 06:39:41'),(85,'Mouse, Key board',83,'Y','2024-10-03 06:39:53','2024-10-03 06:39:53'),(86,'Virus scan',83,'Y','2024-10-03 06:40:01','2024-10-03 06:40:01'),(87,'Sound System',4,'N','2024-10-03 06:40:17','2024-10-03 06:40:17'),(88,'Speaker check',87,'Y','2024-10-03 06:40:29','2024-10-03 06:40:29'),(89,'Sound player check',87,'Y','2024-10-03 06:40:42','2024-10-03 06:40:42'),(90,'Sound file Archiving',87,'Y','2024-10-03 06:40:57','2024-10-03 06:40:57'),(91,'Leakage monitoring',8,'Y','2024-10-03 06:41:33','2024-10-03 06:41:33'),(92,'RAW water TDS',8,'Y','2024-10-03 06:41:42','2024-10-03 06:41:42'),(93,'RO TREATMENT AND MAINTENANCE',7,'N','2024-10-03 06:42:03','2024-10-03 06:42:03'),(94,'Tank cleaning (ro)',93,'Y','2024-10-03 06:42:11','2024-10-03 06:42:11'),(95,'Loop disinfection',93,'Y','2024-10-03 06:42:19','2024-10-03 06:42:19'),(96,'Endotoxin report',93,'Y','2024-10-03 06:42:27','2024-10-03 06:42:27'),(97,'Syringe Pump',55,'Y','2024-10-03 07:28:20','2024-10-03 07:28:20');

/*Table structure for table `task_time_dtl` */

DROP TABLE IF EXISTS `task_time_dtl`;

CREATE TABLE `task_time_dtl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_management_id` int(11) DEFAULT NULL,
  `time_master_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_management_id` (`task_management_id`),
  KEY `time_master_id` (`time_master_id`),
  CONSTRAINT `task_time_dtl_ibfk_1` FOREIGN KEY (`task_management_id`) REFERENCES `task_management_master` (`id`),
  CONSTRAINT `task_time_dtl_ibfk_2` FOREIGN KEY (`time_master_id`) REFERENCES `time_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `task_time_dtl` */

insert  into `task_time_dtl`(`id`,`task_management_id`,`time_master_id`,`created_at`,`updated_at`) values (10,8,1,'2024-10-03 07:18:03','2024-10-03 07:18:03'),(23,7,1,'2024-10-07 08:09:17','2024-10-07 08:09:17'),(25,15,2,'2024-10-24 11:59:24','2024-10-24 11:59:24');

/*Table structure for table `time_master` */

DROP TABLE IF EXISTS `time_master`;

CREATE TABLE `time_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(255) NOT NULL,
  `precedence` int(11) NOT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `time_master` */

insert  into `time_master`(`id`,`time`,`precedence`,`is_active`,`created_at`,`updated_at`) values (1,'09:00 AM',1,'Y',NULL,NULL),(2,'06:00 PM',5,'Y',NULL,NULL),(3,'02:00 PM',3,'Y',NULL,NULL),(4,'05:00 PM',4,'Y',NULL,NULL),(5,'06:30 PM',6,'Y',NULL,NULL),(6,'10:00 AM',2,'Y',NULL,NULL);

/*Table structure for table `user_account_activitys` */

DROP TABLE IF EXISTS `user_account_activitys`;

CREATE TABLE `user_account_activitys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_browser` varchar(255) NOT NULL,
  `user_platform` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_account_activitys_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_account_activitys` */

insert  into `user_account_activitys`(`id`,`user_id`,`ip_address`,`user_browser`,`user_platform`,`login_time`,`logout_time`,`created_at`,`updated_at`) values (1,3,'127.0.0.1','Firefox','Windows','2024-09-26 09:12:17','2024-09-26 09:14:55',NULL,NULL),(2,3,'127.0.0.1','Firefox','Windows','2024-09-26 09:16:10','2024-09-26 09:24:23',NULL,NULL),(3,3,'127.0.0.1','Firefox','Windows','2024-09-26 09:24:26',NULL,NULL,NULL),(4,3,'127.0.0.1','Firefox','Windows','2024-09-26 13:31:29',NULL,NULL,NULL),(5,3,'127.0.0.1','Firefox','Windows','2024-09-27 05:38:26','2024-09-27 10:59:07',NULL,NULL),(6,3,'127.0.0.1','Firefox','Windows','2024-09-27 10:59:30',NULL,NULL,NULL),(7,3,'127.0.0.1','Firefox','Windows','2024-09-30 06:35:42',NULL,NULL,NULL),(8,3,'127.0.0.1','Firefox','Windows','2024-09-30 10:21:21','2024-09-30 11:01:09',NULL,NULL),(9,4,'127.0.0.1','Firefox','Windows','2024-09-30 11:02:30','2024-09-30 11:08:47',NULL,NULL),(10,3,'127.0.0.1','Firefox','Windows','2024-09-30 11:08:50','2024-09-30 11:08:53',NULL,NULL),(11,4,'127.0.0.1','Firefox','Windows','2024-09-30 11:09:00','2024-09-30 11:09:42',NULL,NULL),(12,3,'127.0.0.1','Firefox','Windows','2024-09-30 11:09:45',NULL,NULL,NULL),(13,3,'127.0.0.1','Firefox','Windows','2024-10-01 06:06:30','2024-10-01 09:18:12',NULL,NULL),(14,4,'127.0.0.1','Firefox','Windows','2024-10-01 09:18:21','2024-10-01 09:29:05',NULL,NULL),(15,3,'127.0.0.1','Firefox','Windows','2024-10-01 09:29:08','2024-10-01 09:29:11',NULL,NULL),(16,4,'127.0.0.1','Firefox','Windows','2024-10-01 09:29:25','2024-10-01 09:31:35',NULL,NULL),(17,3,'127.0.0.1','Firefox','Windows','2024-10-01 09:31:37','2024-10-01 09:43:22',NULL,NULL),(18,4,'127.0.0.1','Firefox','Windows','2024-10-01 09:48:09','2024-10-01 09:55:51',NULL,NULL),(19,4,'127.0.0.1','Firefox','Windows','2024-10-01 09:56:05','2024-10-01 10:14:36',NULL,NULL),(20,3,'127.0.0.1','Firefox','Windows','2024-10-01 09:57:59','2024-10-01 10:10:27',NULL,NULL),(21,3,'127.0.0.1','Firefox','Windows','2024-10-01 10:10:29',NULL,NULL,NULL),(22,4,'127.0.0.1','Firefox','Windows','2024-10-01 10:14:53','2024-10-01 10:34:03',NULL,NULL),(23,4,'127.0.0.1','Firefox','Windows','2024-10-01 10:36:08','2024-10-01 10:39:55',NULL,NULL),(24,5,'127.0.0.1','Firefox','Windows','2024-10-01 10:40:00','2024-10-01 14:06:34',NULL,NULL),(25,4,'127.0.0.1','Firefox','Windows','2024-10-01 14:06:47','2024-10-01 14:13:28',NULL,NULL),(26,5,'127.0.0.1','Firefox','Windows','2024-10-01 14:13:44',NULL,NULL,NULL),(27,3,'223.185.32.115','Firefox','Windows','2024-10-01 14:29:59',NULL,NULL,NULL),(28,1,'110.224.98.24','Firefox','Windows','2024-10-01 17:28:30',NULL,NULL,NULL),(29,5,'110.224.98.24','Firefox','Windows','2024-10-01 17:31:27',NULL,NULL,NULL),(30,5,'110.224.98.24','Chrome','AndroidOS','2024-10-01 18:02:04',NULL,NULL,NULL),(31,1,'110.224.98.24','Chrome','AndroidOS','2024-10-01 18:03:15',NULL,NULL,NULL),(32,4,'110.224.111.75','Chrome','AndroidOS','2024-10-02 04:29:12',NULL,NULL,NULL),(33,4,'110.224.103.192','Firefox','Windows','2024-10-02 08:27:22','2024-10-02 08:34:01',NULL,NULL),(34,1,'110.224.103.192','Firefox','Windows','2024-10-02 08:27:47',NULL,NULL,NULL),(35,5,'110.224.103.192','Firefox','Windows','2024-10-02 08:34:18','2024-10-02 08:38:14',NULL,NULL),(36,4,'110.224.103.192','Firefox','Windows','2024-10-02 08:38:28','2024-10-02 08:38:45',NULL,NULL),(37,5,'110.224.103.192','Firefox','Windows','2024-10-02 08:38:52',NULL,NULL,NULL),(38,4,'110.224.103.192','Chrome','AndroidOS','2024-10-02 09:39:10',NULL,NULL,NULL),(39,4,'110.224.103.192','Chrome','AndroidOS','2024-10-02 09:39:45',NULL,NULL,NULL),(40,3,'110.224.103.192','Chrome','AndroidOS','2024-10-02 09:40:42',NULL,NULL,NULL),(41,5,'115.187.53.73','Chrome','Windows','2024-10-03 05:16:12','2024-10-03 05:16:50',NULL,NULL),(42,1,'115.187.53.73','Chrome','Windows','2024-10-03 05:17:21',NULL,NULL,NULL),(43,3,'223.185.35.199','Firefox','Windows','2024-10-03 05:32:09',NULL,NULL,NULL),(44,5,'223.185.35.199','Firefox','Windows','2024-10-03 05:33:54','2024-10-03 05:56:50',NULL,NULL),(45,4,'223.185.35.199','Firefox','Windows','2024-10-03 05:56:57',NULL,NULL,NULL),(46,3,'223.185.35.199','Firefox','Windows','2024-10-03 07:16:01',NULL,NULL,NULL),(47,3,'223.185.35.199','Firefox','Windows','2024-10-03 07:16:50','2024-10-03 09:10:28',NULL,NULL),(48,5,'223.185.35.199','Firefox','Windows','2024-10-03 07:17:22','2024-10-03 09:07:40',NULL,NULL),(49,5,'115.187.53.73','Chrome','Windows','2024-10-03 08:30:51','2024-10-03 09:09:47',NULL,NULL),(50,1,'115.187.53.73','Chrome','Windows','2024-10-03 13:29:47','2024-10-03 13:31:04',NULL,NULL),(51,3,'223.185.35.199','Firefox','Windows','2024-10-03 14:17:43',NULL,NULL,NULL),(52,4,'223.185.28.37','Firefox','Windows','2024-10-04 06:33:44',NULL,NULL,NULL),(53,3,'223.185.28.37','Firefox','Windows','2024-10-04 06:48:26',NULL,NULL,NULL),(54,4,'223.185.28.37','Firefox','Windows','2024-10-04 09:51:18',NULL,NULL,NULL),(55,1,'59.94.69.219','Chrome','Windows','2024-10-04 10:02:34','2024-10-04 10:11:28',NULL,NULL),(56,5,'59.94.69.219','Chrome','Windows','2024-10-04 10:05:38','2024-10-04 10:09:31',NULL,NULL),(57,4,'59.94.69.219','Chrome','Windows','2024-10-04 10:09:52','2024-10-04 10:10:47',NULL,NULL),(58,1,'103.242.196.107','Chrome','Windows','2024-10-04 12:17:57','2024-10-04 12:22:56',NULL,NULL),(59,3,'223.185.28.37','Firefox','Windows','2024-10-04 12:20:24',NULL,NULL,NULL),(60,1,'103.242.196.107','Chrome','Windows','2024-10-04 12:31:13','2024-10-04 12:32:58',NULL,NULL),(61,1,'103.242.196.107','Chrome','Windows','2024-10-04 12:40:06',NULL,NULL,NULL),(62,5,'103.242.196.107','Chrome','Windows','2024-10-04 12:43:32','2024-10-04 12:44:12',NULL,NULL),(63,4,'103.242.196.107','Chrome','Windows','2024-10-04 12:44:29',NULL,NULL,NULL),(64,3,'223.185.34.114','Firefox','Windows','2024-10-07 05:32:47',NULL,NULL,NULL),(65,4,'223.185.34.114','Firefox','Windows','2024-10-07 05:35:28',NULL,NULL,NULL),(66,3,'223.185.34.114','Firefox','Windows','2024-10-07 07:47:09',NULL,NULL,NULL),(67,1,'117.214.39.119','Chrome','Windows','2024-10-15 07:54:25',NULL,NULL,NULL),(68,1,'117.214.39.119','Chrome','Windows','2024-10-15 11:30:41',NULL,NULL,NULL),(69,3,'223.185.34.89','Firefox','Windows','2024-10-17 06:31:27',NULL,NULL,NULL),(70,1,'117.211.67.134','Chrome','Windows','2024-10-17 07:39:39',NULL,NULL,NULL),(71,3,'223.185.32.64','Firefox','Windows','2024-10-18 07:08:34',NULL,NULL,NULL),(72,4,'223.185.32.64','Firefox','Windows','2024-10-18 08:25:40',NULL,NULL,NULL),(73,3,'223.185.32.64','Firefox','Windows','2024-10-18 08:27:24',NULL,NULL,NULL),(74,3,'223.185.32.64','Edge','Windows','2024-10-18 09:57:26',NULL,NULL,NULL),(75,4,'223.185.32.64','Firefox','Windows','2024-10-18 11:15:59',NULL,NULL,NULL),(76,4,'223.185.32.64','Firefox','Windows','2024-10-18 12:40:34',NULL,NULL,NULL),(77,3,'106.196.2.16','Chrome','Windows','2024-10-19 17:05:19',NULL,NULL,NULL),(78,4,'106.196.2.16','Chrome','Windows','2024-10-19 17:06:11',NULL,NULL,NULL),(79,4,'127.0.0.1','Firefox','Windows','2024-10-21 15:30:45','2024-10-21 15:31:10',NULL,NULL),(80,5,'127.0.0.1','Firefox','Windows','2024-10-21 15:31:18',NULL,NULL,NULL),(81,3,'127.0.0.1','Firefox','Windows','2024-10-22 11:21:04','2024-10-22 12:06:31',NULL,NULL),(82,3,'127.0.0.1','Firefox','Windows','2024-10-22 12:06:39','2024-10-22 12:09:20',NULL,NULL),(83,4,'127.0.0.1','Firefox','Windows','2024-10-22 12:08:05','2024-10-22 17:56:07',NULL,NULL),(84,3,'127.0.0.1','Firefox','Windows','2024-10-22 12:14:47',NULL,NULL,NULL),(85,5,'127.0.0.1','Firefox','Windows','2024-10-22 17:56:25',NULL,NULL,NULL),(86,3,'127.0.0.1','Firefox','Windows','2024-10-23 11:28:54',NULL,NULL,NULL),(87,3,'192.168.1.5','Firefox','Windows','2024-10-23 13:16:19',NULL,NULL,NULL),(88,4,'192.168.1.6','Chrome','AndroidOS','2024-10-23 13:17:01',NULL,NULL,NULL),(89,4,'192.168.1.5','Firefox','Windows','2024-10-23 13:32:49',NULL,NULL,NULL),(90,3,'127.0.0.1','Firefox','Windows','2024-10-23 16:44:30','2024-10-23 16:53:18',NULL,NULL),(91,3,'127.0.0.1','Firefox','Windows','2024-10-23 16:53:23','2024-10-23 16:53:51',NULL,NULL),(92,3,'127.0.0.1','Firefox','Windows','2024-10-23 16:53:54','2024-10-23 16:54:04',NULL,NULL),(93,3,'127.0.0.1','Firefox','Windows','2024-10-23 16:54:06','2024-10-23 19:15:36',NULL,NULL),(94,3,'127.0.0.1','Firefox','Windows','2024-10-23 19:15:40','2024-10-23 19:16:15',NULL,NULL),(95,3,'127.0.0.1','Firefox','Windows','2024-10-23 19:16:18',NULL,NULL,NULL),(96,3,'127.0.0.1','Firefox','Windows','2024-10-24 11:15:11','2024-10-24 11:41:40',NULL,NULL),(97,4,'127.0.0.1','Firefox','Windows','2024-10-24 11:21:10','2024-10-24 11:32:46',NULL,NULL),(98,4,'127.0.0.1','Firefox','Windows','2024-10-24 11:33:00','2024-10-24 11:33:08',NULL,NULL),(99,5,'127.0.0.1','Firefox','Windows','2024-10-24 11:33:14','2024-10-24 11:37:01',NULL,NULL),(100,4,'127.0.0.1','Firefox','Windows','2024-10-24 11:37:11',NULL,NULL,NULL),(101,3,'127.0.0.1','Firefox','Windows','2024-10-24 11:41:43',NULL,NULL,NULL),(102,4,'223.185.31.190','Firefox','Windows','2024-10-24 06:46:06',NULL,NULL,NULL),(103,3,'223.185.31.190','Firefox','Windows','2024-10-24 06:47:31','2024-10-24 07:53:52',NULL,NULL),(104,4,'223.185.31.190','Chrome','AndroidOS','2024-10-24 07:04:25',NULL,NULL,NULL),(105,4,'223.185.31.190','Chrome','AndroidOS','2024-10-24 07:15:54',NULL,NULL,NULL),(106,4,'223.185.31.190','Chrome','AndroidOS','2024-10-24 07:35:23',NULL,NULL,NULL),(107,6,'223.185.31.190','Chrome','Windows','2024-10-24 07:53:04',NULL,NULL,NULL),(108,1,'223.185.31.190','Firefox','Windows','2024-10-24 07:53:58',NULL,NULL,NULL),(109,1,'223.185.31.190','Chrome','Windows','2024-10-24 07:58:33',NULL,NULL,NULL),(110,1,'223.185.31.190','Chrome','Windows','2024-10-24 08:01:42',NULL,NULL,NULL),(111,6,'223.185.31.190','Chrome','Windows','2024-10-24 10:36:28','2024-10-24 12:42:25',NULL,NULL),(112,3,'223.185.31.190','Firefox','Windows','2024-10-24 11:02:40','2024-10-24 11:22:59',NULL,NULL),(113,1,'223.185.31.190','Firefox','Windows','2024-10-24 11:23:04',NULL,NULL,NULL),(114,1,'223.185.35.102','Firefox','Windows','2024-10-25 08:17:54',NULL,NULL,NULL),(115,4,'106.196.15.81','Chrome','AndroidOS','2024-10-25 09:55:55',NULL,NULL,NULL),(116,3,'223.185.35.102','Firefox','Windows','2024-10-25 12:13:22','2024-10-25 12:13:34',NULL,NULL),(117,1,'223.185.35.102','Firefox','Windows','2024-10-25 12:13:40',NULL,NULL,NULL),(118,6,'117.214.34.133','Chrome','Windows','2024-10-25 12:14:07',NULL,NULL,NULL),(119,4,'223.185.35.102','Firefox','Windows','2024-10-25 12:56:25',NULL,NULL,NULL),(120,1,'106.196.9.143','Chrome','Windows','2024-10-27 08:16:47',NULL,NULL,NULL),(121,4,'223.185.31.160','Firefox','Windows','2024-10-28 08:02:55','2024-10-28 08:04:30',NULL,NULL),(122,5,'223.185.31.160','Firefox','Windows','2024-10-28 08:04:40',NULL,NULL,NULL),(123,1,'223.185.31.9','Firefox','Windows','2024-10-29 12:48:52',NULL,NULL,NULL),(124,6,'117.203.217.140','Chrome','Windows','2024-10-29 12:48:59','2024-10-29 13:35:15',NULL,NULL),(125,3,'223.185.31.9','Firefox','Windows','2024-10-29 12:49:53',NULL,NULL,NULL),(126,1,'223.185.31.9','Firefox','Windows','2024-10-29 13:04:50','2024-10-29 13:07:53',NULL,NULL),(127,4,'223.185.31.9','Firefox','Windows','2024-10-29 13:08:04','2024-10-29 13:08:17',NULL,NULL),(128,5,'223.185.31.9','Firefox','Windows','2024-10-29 13:08:38','2024-10-29 13:57:10',NULL,NULL),(129,1,'223.185.31.9','Firefox','Windows','2024-10-29 13:09:02',NULL,NULL,NULL),(130,4,'223.185.31.9','Chrome','Windows','2024-10-29 13:15:05','2024-10-29 13:50:19',NULL,NULL),(131,1,'117.203.217.140','Chrome','Windows','2024-10-29 13:35:30','2024-10-29 13:49:55',NULL,NULL),(132,6,'117.203.217.140','Chrome','Windows','2024-10-29 13:38:08','2024-10-29 13:39:37',NULL,NULL),(133,1,'117.203.217.140','Chrome','Windows','2024-10-29 14:46:10','2024-10-29 14:46:37',NULL,NULL),(134,1,'223.185.31.208','Firefox','Windows','2024-10-30 05:58:04',NULL,NULL,NULL),(135,1,'103.242.196.214','Chrome','OS X','2024-10-30 06:06:06',NULL,NULL,NULL),(136,3,'223.185.31.208','Firefox','Windows','2024-10-30 09:40:53',NULL,NULL,NULL),(137,3,'223.185.34.253','Firefox','Windows','2024-11-01 06:04:47',NULL,NULL,NULL),(138,3,'223.185.34.253','Firefox','Windows','2024-11-01 08:55:08',NULL,NULL,NULL),(139,1,'103.242.196.251','Chrome','iOS','2024-11-02 06:38:07',NULL,NULL,NULL),(140,4,'127.0.0.1','Firefox','Windows','2024-11-04 14:00:29','2024-11-04 14:00:38',NULL,NULL),(141,6,'127.0.0.1','Firefox','Windows','2024-11-04 14:00:51','2024-11-04 14:02:58',NULL,NULL),(142,4,'127.0.0.1','Firefox','Windows','2024-11-04 14:03:05',NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `is_online` enum('1','0') NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`mobile_no`,`email`,`email_verified_at`,`password`,`profile_image`,`address`,`role_id`,`is_active`,`is_online`,`remember_token`,`created_at`,`updated_at`) values (1,'Pritim Sengupta','admin','9830099686','pratim.sengupta@gmail.com','2024-07-12 02:13:00','$2y$10$tm8HGtv25ANHO3OfYhj54uNMbfS3.n1sjQidxrQgoJONxBJ5ER1O2',NULL,NULL,1,'1','1',NULL,'2024-07-12 02:13:11','2024-10-30 11:28:04'),(3,'Developer','dev','8910088950','developer@gmail.com','2024-07-12 02:13:00','$2y$10$W5hmQ3cWloGx0DSlQqOlv.pj1HK9oevwPwLeElLWXzBB7OfNcdZB2',NULL,NULL,1,'1','1',NULL,'2024-07-12 02:13:11','2024-10-29 18:19:53'),(4,'Pallav Das','8944961893','8944961893','pallav@gmail.com',NULL,'$2y$10$bWY.Z4F1SoG4grpqkcOhWec7YW2a/Rjf5U07uckQpIczdZ4nk5aHW',NULL,NULL,2,'1','1',NULL,'2024-09-30 21:58:42','2024-11-04 14:03:05'),(5,'Aratrika Khatun','7458997896','7458997896','aratrika@gmail.com',NULL,'$2y$10$u3Eat1hVwHxqggGbOja9FuVgREiDxh00Vly/l/MeFx7jO11h4BrKG',NULL,NULL,2,'1','0',NULL,'2024-09-30 23:32:20','2024-10-29 19:27:10'),(6,'Suman Mukherjee','9831024741','9831024741','admin@softhought.com',NULL,'$2y$10$74u4Q9TH2mh30MCQktyD6.pd.d8FZmN1t6o5OJPz4Ynqofflm592e',NULL,NULL,2,'1','0',NULL,'2024-10-24 01:08:51','2024-11-04 14:02:58');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
