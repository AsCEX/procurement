/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : pims02

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-03-12 13:49:40
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_biddings
-- ----------------------------
INSERT INTO `tbl_biddings` VALUES ('1', '1', '1', null, null);
INSERT INTO `tbl_biddings` VALUES ('2', '1', '2', null, null);
INSERT INTO `tbl_biddings` VALUES ('3', '1', '3', null, null);
INSERT INTO `tbl_biddings` VALUES ('4', '2', '1', null, null);
INSERT INTO `tbl_biddings` VALUES ('5', '2', '2', null, null);
INSERT INTO `tbl_biddings` VALUES ('6', '2', '3', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('1', '1', 'Office Supplies');
INSERT INTO `tbl_categories` VALUES ('3', '3', 'Animal & Zoological Supplies');
INSERT INTO `tbl_categories` VALUES ('4', '4', 'Food & Non-Food Supplies');
INSERT INTO `tbl_categories` VALUES ('5', '5', 'Drugs & Medicines');
INSERT INTO `tbl_categories` VALUES ('6', '6', 'Medical & Dental');
INSERT INTO `tbl_categories` VALUES ('7', '7', 'Gasoline, Oils & Lubricants');
INSERT INTO `tbl_categories` VALUES ('8', '8', 'Agricultural Supplies');
INSERT INTO `tbl_categories` VALUES ('9', '9', 'Textbooks and Instructional Materials');
INSERT INTO `tbl_categories` VALUES ('10', '10', 'Military and Police Supplies');
INSERT INTO `tbl_categories` VALUES ('11', '11', 'Other Supplies');
INSERT INTO `tbl_categories` VALUES ('12', '12', 'Spare Parts');
INSERT INTO `tbl_categories` VALUES ('13', '13', 'Construction Materials');
INSERT INTO `tbl_categories` VALUES ('14', '14', 'Livestock');

-- ----------------------------
-- Table structure for `tbl_employees`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_employees`;
CREATE TABLE `tbl_employees` (
  `emp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `emp_ui_id` bigint(20) DEFAULT NULL,
  `emp_department_id` bigint(20) DEFAULT NULL,
  `emp_position_id` bigint(20) DEFAULT NULL,
  `emp_username` varchar(50) DEFAULT NULL,
  `emp_password` varchar(100) DEFAULT NULL,
  `emp_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_employees
-- ----------------------------
INSERT INTO `tbl_employees` VALUES ('1', '1', null, '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');
INSERT INTO `tbl_employees` VALUES ('5', '5', '1', '3', 'acabusora', '25d55ad283aa400af464c76d713c07ad', '1');

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
-- Table structure for `tbl_inventories2`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_inventories2`;
CREATE TABLE `tbl_inventories2` (
  `i_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `i_office_id` bigint(20) DEFAULT NULL,
  `i_remarks` text,
  `i_received_from` bigint(20) DEFAULT NULL,
  `i_received_from_date` date DEFAULT NULL,
  `i_received_by` bigint(20) DEFAULT NULL,
  `i_received_by_date` date DEFAULT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_inventories2
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_inventory_details`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_inventory_details`;
CREATE TABLE `tbl_inventory_details` (
  `id_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_inv_id` bigint(20) DEFAULT NULL,
  `id_unit` bigint(20) DEFAULT NULL,
  `id_date_acquired` date DEFAULT NULL,
  `id_description` text,
  `id_unit_cost` decimal(11,2) DEFAULT NULL,
  `id_category` bigint(20) DEFAULT NULL,
  `id_account_classification_no` varchar(100) DEFAULT NULL,
  `id_property_no` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_inventory_details
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_items
-- ----------------------------
INSERT INTO `tbl_items` VALUES ('1', '1', 'sdfasdfa', null, null, null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_positions
-- ----------------------------
INSERT INTO `tbl_positions` VALUES ('1', 'Super Admin');
INSERT INTO `tbl_positions` VALUES ('2', 'Employee');
INSERT INTO `tbl_positions` VALUES ('3', 'Department Head');

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
INSERT INTO `tbl_procurement_plans` VALUES ('1', '761', 'Diesel', null, '5', '280000.00', '6', '1', '1', '2017-01-04 00:00:00', '1', null, null, null, null);
INSERT INTO `tbl_procurement_plans` VALUES ('2', '123', 'sdfs', null, '1', '5263231.00', '1', '1', '1', '2017-01-17 00:00:00', '1', null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_procurement_plan_schedules`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_procurement_plan_schedules`;
CREATE TABLE `tbl_procurement_plan_schedules` (
  `pps_id` int(11) NOT NULL AUTO_INCREMENT,
  `pps_ppmp_id` int(11) DEFAULT NULL,
  `pps_quarter` int(11) DEFAULT NULL,
  `pps_value` double DEFAULT NULL,
  `pps_pri_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_procurement_plan_schedules
-- ----------------------------
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('1', '1', '1', '2000', '2');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('4', '1', '2', '2000', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('7', '1', '3', '2000', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('10', '1', '4', '1000', '4');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('13', '2', '1', '10', '1');
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('16', '2', '2', '30', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('19', '2', '3', '20', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('22', '2', '4', '50', '3');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_requests
-- ----------------------------
INSERT INTO `tbl_purchase_requests` VALUES ('1', '1', '', '0000-00-00', '', '0000-00-00', '1', '', '0', null, null, null, 'asdfasfa', null, '2017-01-17', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('2', '1', '', '0000-00-00', '', '0000-00-00', '2', 'sds', '1', null, null, null, 'dg', null, '2017-01-19', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_request_items
-- ----------------------------
INSERT INTO `tbl_purchase_request_items` VALUES ('1', '1', '2', '60.00', 'sdfsasdfaslkj', '40847.55');
INSERT INTO `tbl_purchase_request_items` VALUES ('2', '1', '1', '6000.00', 'Diesel', '40.00');
INSERT INTO `tbl_purchase_request_items` VALUES ('3', '2', '2', '30.00', 'sdfs', '155.55');
INSERT INTO `tbl_purchase_request_items` VALUES ('4', '2', '1', '200.00', 'Diesel', '40.00');

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
INSERT INTO `tbl_stocks` VALUES ('1', '1', '1qwe');

-- ----------------------------
-- Table structure for `tbl_suppliers`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_suppliers`;
CREATE TABLE `tbl_suppliers` (
  `supp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `supp_ui_id` bigint(20) NOT NULL,
  `supp_business_name` varchar(50) NOT NULL,
  `supp_address` varchar(50) NOT NULL,
  `supp_tin` varchar(50) NOT NULL,
  `supp_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supp_id`),
  KEY `FK_supp_ui_id` (`supp_ui_id`),
  CONSTRAINT `tbl_suppliers_ibfk_1` FOREIGN KEY (`supp_ui_id`) REFERENCES `tbl_user_informations` (`ui_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_suppliers
-- ----------------------------
INSERT INTO `tbl_suppliers` VALUES ('1', '1', 'Company 3', 'Pogi', '1234567', '1');
INSERT INTO `tbl_suppliers` VALUES ('2', '2', 'Company 4', 'test2 biz add', 'test2 biz tin', '1');
INSERT INTO `tbl_suppliers` VALUES ('3', '4', 'Company 2', 'test3', 'test3', '1');
INSERT INTO `tbl_suppliers` VALUES ('4', '5', 'Company 1', 'test4', 'test4', '1');

-- ----------------------------
-- Table structure for `tbl_units`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_units`;
CREATE TABLE `tbl_units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_units
-- ----------------------------
INSERT INTO `tbl_units` VALUES ('1', 'unit');
INSERT INTO `tbl_units` VALUES ('2', 'lot');
INSERT INTO `tbl_units` VALUES ('3', 'pcs');
INSERT INTO `tbl_units` VALUES ('4', 'sets');
INSERT INTO `tbl_units` VALUES ('5', 'liter');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_informations
-- ----------------------------
INSERT INTO `tbl_user_informations` VALUES ('1', 'Desidido', 'Kho', 'Manigbas', ' ', 'Pogi St.', '1907-01-01');
INSERT INTO `tbl_user_informations` VALUES ('2', 'test', 'test', 'test', 's', 'alksdjflak', '1990-07-10');
INSERT INTO `tbl_user_informations` VALUES ('3', 'allan', 'salangron', 'cabusora', '2', 'test', '1990-07-10');
INSERT INTO `tbl_user_informations` VALUES ('4', 'allan', 'test', 'cabusora', 'r', 'asdfa', '1990-07-10');
INSERT INTO `tbl_user_informations` VALUES ('5', 'Allan', 'S', 'Cabusora', ' ', 'Sandawa', '1990-07-10');
