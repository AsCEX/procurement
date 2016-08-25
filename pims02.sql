/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : pims02

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-08-26 07:15:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_access_lists`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_access_lists`;
CREATE TABLE `tbl_access_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_access_lists
-- ----------------------------
INSERT INTO `tbl_access_lists` VALUES ('1', '1', 'procurement_plan', null);
INSERT INTO `tbl_access_lists` VALUES ('2', '1', 'purchased_request', null);
INSERT INTO `tbl_access_lists` VALUES ('3', '1', 'purchased_order', null);
INSERT INTO `tbl_access_lists` VALUES ('4', '1', 'groups', null);
INSERT INTO `tbl_access_lists` VALUES ('5', '1', 'categories', null);
INSERT INTO `tbl_access_lists` VALUES ('6', '1', 'suppliers', null);
INSERT INTO `tbl_access_lists` VALUES ('7', '1', 'offices', null);
INSERT INTO `tbl_access_lists` VALUES ('8', '1', 'units', null);
INSERT INTO `tbl_access_lists` VALUES ('9', '1', 'users', null);
INSERT INTO `tbl_access_lists` VALUES ('10', '1', 'inventory', null);
INSERT INTO `tbl_access_lists` VALUES ('11', '1', 'funds', null);

-- ----------------------------
-- Table structure for `tbl_biddings`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_biddings`;
CREATE TABLE `tbl_biddings` (
  `bids_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bids_pri_id` bigint(20) DEFAULT NULL,
  `bids_supp_id` bigint(20) DEFAULT NULL,
  `bids_remarks` tinyint(1) DEFAULT NULL,
  `bids_completed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`bids_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_biddings
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE `tbl_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_code` varchar(20) DEFAULT NULL,
  `cat_description` text,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `code` (`cat_code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('1', null, 'Agricultural Supplies');
INSERT INTO `tbl_categories` VALUES ('2', null, 'Animal & Zoological Supplies');
INSERT INTO `tbl_categories` VALUES ('3', null, 'Construction Materials');
INSERT INTO `tbl_categories` VALUES ('4', null, 'Drugs & Medicines');
INSERT INTO `tbl_categories` VALUES ('5', null, 'Food & Non-Food Supplies');
INSERT INTO `tbl_categories` VALUES ('6', null, 'Gasoline, Oils & Lubricants');
INSERT INTO `tbl_categories` VALUES ('7', null, 'Livestock');
INSERT INTO `tbl_categories` VALUES ('8', null, 'Medical & Dental');
INSERT INTO `tbl_categories` VALUES ('9', null, 'Military and Police Supplies');
INSERT INTO `tbl_categories` VALUES ('10', null, 'Office Supplies');
INSERT INTO `tbl_categories` VALUES ('11', null, 'Other Supplies');
INSERT INTO `tbl_categories` VALUES ('12', null, 'Spare Parts');
INSERT INTO `tbl_categories` VALUES ('13', null, 'Textbooks and Instructional Materials');

-- ----------------------------
-- Table structure for `tbl_employees`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_employees`;
CREATE TABLE `tbl_employees` (
  `emp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `emp_ui_id` bigint(20) DEFAULT NULL,
  `emp_position_id` bigint(20) DEFAULT NULL,
  `emp_username` varchar(50) DEFAULT NULL,
  `emp_password` varchar(100) DEFAULT NULL,
  `emp_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_employees
-- ----------------------------
INSERT INTO `tbl_employees` VALUES ('1', '1', '1', 'superadmin', 'admin', '1');
INSERT INTO `tbl_employees` VALUES ('2', '2', '1', 'test', 'test', '0');

-- ----------------------------
-- Table structure for `tbl_groups`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_groups`;
CREATE TABLE `tbl_groups` (
  `grp_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `grp_name` varchar(20) NOT NULL,
  `grp_description` varchar(100) NOT NULL,
  PRIMARY KEY (`grp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_groups
-- ----------------------------
INSERT INTO `tbl_groups` VALUES ('1', 'admin', 'Administrator');
INSERT INTO `tbl_groups` VALUES ('2', 'members', 'General User');
INSERT INTO `tbl_groups` VALUES ('3', 'Test', 'teststsets');
INSERT INTO `tbl_groups` VALUES ('4', 'asdfasd', ' fasdf asfa');
INSERT INTO `tbl_groups` VALUES ('5', 'asdfasdf', 'ASSSSSCEXXXXXXXX ');
INSERT INTO `tbl_groups` VALUES ('6', 'rtutiters', 'asdfasd fasdfasdfasd fasda');
INSERT INTO `tbl_groups` VALUES ('7', 'adsfa', 'sdfasdfasdfa');
INSERT INTO `tbl_groups` VALUES ('8', 'asdfasd', 'fasdfasdaf');
INSERT INTO `tbl_groups` VALUES ('9', 'adfas', 'dfasdfa');
INSERT INTO `tbl_groups` VALUES ('10', 'asdfa', 'sdfasdfa');
INSERT INTO `tbl_groups` VALUES ('11', 'asdfa', 'sdfadfasa');
INSERT INTO `tbl_groups` VALUES ('12', 'adsfas', 'fasdf asdfa sdfasa');

-- ----------------------------
-- Table structure for `tbl_inventories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_inventories`;
CREATE TABLE `tbl_inventories` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_qty` decimal(11,2) DEFAULT NULL,
  `inv_unit` int(11) DEFAULT NULL,
  `inv_date_acquired` date DEFAULT NULL,
  `inv_description` text,
  `inv_unit_cost` decimal(11,2) DEFAULT NULL,
  `inv_class_no` varchar(100) DEFAULT NULL,
  `inv_property_no` varchar(100) DEFAULT NULL,
  `inv_remarks` text,
  `inv_received_from` int(11) DEFAULT NULL,
  `inv_received_from_date` date DEFAULT NULL,
  `inv_received_by` int(11) DEFAULT NULL,
  `inv_received_by_date` date DEFAULT NULL,
  PRIMARY KEY (`inv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_inventories
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_items`;
CREATE TABLE `tbl_items` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_stock_id` bigint(20) DEFAULT NULL,
  `item_description` text,
  `item_created_by` bigint(20) DEFAULT NULL,
  `item_created_date` datetime DEFAULT NULL,
  `item_modified_by` bigint(20) DEFAULT NULL,
  `item_modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_items
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_offices`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_offices`;
CREATE TABLE `tbl_offices` (
  `ofc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ofc_initial` varchar(10) DEFAULT NULL,
  `ofc_code` varchar(10) DEFAULT NULL,
  `ofc_name` varchar(100) DEFAULT NULL,
  `ofc_parent_id` int(11) DEFAULT NULL,
  `ofc_created_by` int(11) DEFAULT NULL,
  `ofc_created_date` date DEFAULT NULL,
  `ofc_modified_by` int(11) DEFAULT NULL,
  `ofc_modified_date` date DEFAULT NULL,
  `ofc_deleted_by` int(11) DEFAULT NULL,
  `ofc_deleted_date` date DEFAULT NULL,
  `ofc_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ofc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_offices
-- ----------------------------
INSERT INTO `tbl_offices` VALUES ('1', 'CGSO', '420', 'City General Services Office', null, '1', '2016-08-22', '1', '2016-08-22', null, null, '1');
INSERT INTO `tbl_offices` VALUES ('2', 'SP', '3392', 'Sangguniang Panlungsod Office - Executive Services', null, '1', '2016-08-23', '1', '2016-08-23', null, null, '1');

-- ----------------------------
-- Table structure for `tbl_positions`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_positions`;
CREATE TABLE `tbl_positions` (
  `pos_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_positions
-- ----------------------------
INSERT INTO `tbl_positions` VALUES ('1', 'Super Admin');

-- ----------------------------
-- Table structure for `tbl_procurement_plans`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_procurement_plans`;
CREATE TABLE `tbl_procurement_plans` (
  `ppmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `ppmp_code` int(11) DEFAULT NULL,
  `ppmp_description` text,
  `ppmp_qty` decimal(11,4) DEFAULT NULL,
  `ppmp_unit` int(11) DEFAULT NULL,
  `ppmp_budget` decimal(11,2) DEFAULT NULL,
  `ppmp_category_id` int(11) DEFAULT NULL,
  `ppmp_office_id` int(11) DEFAULT NULL,
  `ppmp_source_fund` int(11) DEFAULT NULL,
  `ppmp_created_date` datetime DEFAULT NULL,
  `ppmp_created_by` int(11) DEFAULT NULL,
  `ppmp_modified_date` datetime DEFAULT NULL,
  `ppmp_modified_by` int(11) DEFAULT NULL,
  `ppmp_deleted_date` date DEFAULT NULL,
  `ppmp_deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`ppmp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_procurement_plans
-- ----------------------------
INSERT INTO `tbl_procurement_plans` VALUES ('1', '420', 'asdfasf', null, '1', '12000.00', '1', '1', '1', '2016-08-07 00:00:00', '1', null, null, null, null);
INSERT INTO `tbl_procurement_plans` VALUES ('2', '421', 'AVE AVE', null, '1', '16000.00', '2', '1', '1', '2016-08-07 00:00:00', '1', null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_procurement_plan_schedules`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_procurement_plan_schedules`;
CREATE TABLE `tbl_procurement_plan_schedules` (
  `pps_id` int(11) NOT NULL AUTO_INCREMENT,
  `pps_ppmp_id` int(11) DEFAULT NULL,
  `pps_month` int(11) DEFAULT NULL,
  `pps_value` double DEFAULT NULL,
  `pps_pri_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_procurement_plan_schedules
-- ----------------------------
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('1', '1', '1', '3', '22');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('2', '1', '2', '0', '22');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('3', '1', '3', '0', '22');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('4', '1', '4', '3', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('5', '1', '5', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('6', '1', '6', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('7', '1', '7', '3', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('8', '1', '8', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('9', '1', '9', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('10', '1', '10', '3', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('11', '1', '11', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('12', '1', '12', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('13', '2', '1', '4', '21');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('14', '2', '2', '0', '21');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('15', '2', '3', '0', '21');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('16', '2', '4', '4', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('17', '2', '5', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('18', '2', '6', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('19', '2', '7', '4', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('20', '2', '8', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('21', '2', '9', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('22', '2', '10', '4', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('23', '2', '11', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('24', '2', '12', '0', null);

-- ----------------------------
-- Table structure for `tbl_purchased_orders`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchased_orders`;
CREATE TABLE `tbl_purchased_orders` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_supplier_id` int(11) DEFAULT NULL,
  `po_department_id` int(11) DEFAULT NULL,
  `po_gentlemen` text,
  `po_mode_of_procurment` int(11) DEFAULT NULL,
  `po_place_of_delivery` text,
  `po_date_of_delivery` text,
  `po_delivery_term` varchar(50) DEFAULT NULL,
  `po_payment_term` varchar(100) DEFAULT NULL,
  `po_created_by` int(11) DEFAULT NULL,
  `po_created_date` date DEFAULT NULL,
  `po_modified_by` int(11) DEFAULT NULL,
  `po_modified_date` datetime DEFAULT NULL,
  `po_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchased_orders
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_purchased_order_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchased_order_items`;
CREATE TABLE `tbl_purchased_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `description` text,
  `unit_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchased_order_items
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_purchase_requests`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_requests`;
CREATE TABLE `tbl_purchase_requests` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_department_id` int(11) DEFAULT NULL,
  `pr_sai_no` varchar(50) DEFAULT NULL,
  `pr_sai_date` date DEFAULT NULL,
  `pr_alobs_no` varchar(50) DEFAULT NULL,
  `pr_alobs_date` date DEFAULT NULL,
  `pr_quarter` int(11) DEFAULT NULL,
  `pr_section` varchar(100) DEFAULT NULL,
  `pr_requested_by` int(11) DEFAULT NULL,
  `pr_cash_availability_by` int(11) DEFAULT NULL,
  `pr_approved_date` date DEFAULT NULL,
  `pr_approved_by` int(11) DEFAULT NULL,
  `pr_purpose` text,
  `pr_created_by` int(11) DEFAULT NULL,
  `pr_created_date` date DEFAULT NULL,
  `pr_modified_by` int(11) DEFAULT NULL,
  `pr_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`pr_id`),
  UNIQUE KEY `pr_id` (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_requests
-- ----------------------------
INSERT INTO `tbl_purchase_requests` VALUES ('1', '1', '', '0000-00-00', '', '0000-00-00', '1', '112saf', '1', null, null, null, 'rtete', null, '2016-08-07', null, '2016-08-07');

-- ----------------------------
-- Table structure for `tbl_purchase_request_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_request_items`;
CREATE TABLE `tbl_purchase_request_items` (
  `pri_id` int(11) NOT NULL AUTO_INCREMENT,
  `pri_pr_id` int(11) DEFAULT NULL,
  `pri_ppmp_id` int(11) DEFAULT NULL,
  `pri_qty` decimal(11,2) DEFAULT NULL,
  `pri_description` text,
  `pri_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`pri_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_request_items
-- ----------------------------
INSERT INTO `tbl_purchase_request_items` VALUES ('21', '1', '2', '3.50', 'AVE AVE', '500.00');
INSERT INTO `tbl_purchase_request_items` VALUES ('22', '1', '1', '5.00', 'asdfasf', '700.00');

-- ----------------------------
-- Table structure for `tbl_purchase_request_item_details`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_request_item_details`;
CREATE TABLE `tbl_purchase_request_item_details` (
  `prid_id` int(11) NOT NULL AUTO_INCREMENT,
  `prid_pri_id` int(11) DEFAULT NULL,
  `prid_title` varchar(50) DEFAULT NULL,
  `prid_description` text,
  `prid_cost` decimal(11,2) DEFAULT NULL,
  `prid_po_description` text,
  `prid_po_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`prid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_request_item_details
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_purchase_request_item_detail_specs`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_request_item_detail_specs`;
CREATE TABLE `tbl_purchase_request_item_detail_specs` (
  `prs_id` int(11) NOT NULL AUTO_INCREMENT,
  `prs_prid_id` int(11) DEFAULT NULL,
  `prs_name` varchar(50) DEFAULT NULL,
  `prs_qty` decimal(11,4) DEFAULT NULL,
  `prs_unit` int(11) DEFAULT NULL,
  `prs_cost` decimal(11,2) DEFAULT NULL,
  `prs_po_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`prs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_request_item_detail_specs
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_source_funds`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_source_funds`;
CREATE TABLE `tbl_source_funds` (
  `fund_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`fund_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_source_funds
-- ----------------------------
INSERT INTO `tbl_source_funds` VALUES ('1', 'General Funds');
INSERT INTO `tbl_source_funds` VALUES ('2', 'Trust Funds');

-- ----------------------------
-- Table structure for `tbl_stocks`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stocks`;
CREATE TABLE `tbl_stocks` (
  `stock_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `stock_cat_id` bigint(11) DEFAULT NULL,
  `stock_description` text,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_stocks
-- ----------------------------
INSERT INTO `tbl_stocks` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for `tbl_units`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_units`;
CREATE TABLE `tbl_units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_units
-- ----------------------------
INSERT INTO `tbl_units` VALUES ('1', 'unit');
INSERT INTO `tbl_units` VALUES ('2', 'lot');
INSERT INTO `tbl_units` VALUES ('3', 'pcs');
INSERT INTO `tbl_units` VALUES ('4', 'sets');

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(100) DEFAULT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  `u_email` varchar(255) DEFAULT NULL,
  `u_firstname` varchar(50) DEFAULT NULL,
  `u_middlename` varchar(50) DEFAULT NULL,
  `u_lastname` varchar(50) DEFAULT NULL,
  `u_extname` varchar(10) DEFAULT NULL,
  `u_department_id` int(11) DEFAULT NULL,
  `u_grp_id` int(11) DEFAULT NULL,
  `u_created_on` datetime DEFAULT NULL,
  `u_created_by` int(11) DEFAULT NULL,
  `u_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'yiu.ascex@gmail.com', 'Allan', 'S', 'Cabusora', null, '1', '1', '2016-06-29 16:21:47', null, '0');

-- ----------------------------
-- Table structure for `tbl_users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users_groups`;
CREATE TABLE `tbl_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`grp_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users_groups
-- ----------------------------
INSERT INTO `tbl_users_groups` VALUES ('5', '1', '1');
INSERT INTO `tbl_users_groups` VALUES ('6', '1', '2');
INSERT INTO `tbl_users_groups` VALUES ('7', '2', '2');

-- ----------------------------
-- Table structure for `tbl_user_informations`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_informations`;
CREATE TABLE `tbl_user_informations` (
  `ui_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ui_firstname` varchar(50) DEFAULT NULL,
  `ui_middlename` varchar(50) DEFAULT NULL,
  `ui_lastname` varchar(50) DEFAULT NULL,
  `ui_extname` varchar(20) DEFAULT NULL,
  `ui_address` varchar(100) DEFAULT NULL,
  `ui_birthdate` date DEFAULT NULL,
  PRIMARY KEY (`ui_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_informations
-- ----------------------------
INSERT INTO `tbl_user_informations` VALUES ('1', 'Desidido', 'Kho', 'Manigbas', null, 'Pogi St.', '1907-01-01');
INSERT INTO `tbl_user_informations` VALUES ('2', 'test', 'test', 'test', 's', 'alksdjflak', '1990-07-10');
