-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2013 at 11:52 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `PHKAPA`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_key` (`foreign_key`),
  KEY `foreign_key_2` (`foreign_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL DEFAULT '0',
  `aco_id` int(10) unsigned NOT NULL DEFAULT '0',
  `_allow` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notifier_id` int(11) NOT NULL,
  `notified_id` int(11) NOT NULL,
  `reference` varchar(500) NOT NULL,
  `notification` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `phkapa_actions`
--

DROP TABLE IF EXISTS `phkapa_actions`;
CREATE TABLE IF NOT EXISTS `phkapa_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL DEFAULT '0',
  `action_type_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `deadline` int(11) NOT NULL DEFAULT '0',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `action_effectiveness_id` int(11) DEFAULT NULL,
  `effectiveness_notes` text,
  `verify_user_id` int(11) DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `close_user_id` int(11) DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ActionTypeId` (`action_type_id`),
  KEY `TicketId` (`ticket_id`),
  KEY `ActionEffectivenessId` (`action_effectiveness_id`),
  KEY `VerifyUserID` (`verify_user_id`),
  KEY `CloseUserID` (`close_user_id`),
  KEY `ModifiedUserID` (`modified_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_actions_revision`
--

DROP TABLE IF EXISTS `phkapa_actions_revision`;
CREATE TABLE IF NOT EXISTS `phkapa_actions_revision` (
  `version_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_description` varchar(250) NOT NULL,
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL DEFAULT '0',
  `action_type_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `deadline` int(11) NOT NULL DEFAULT '0',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `action_effectiveness_id` int(11) DEFAULT NULL,
  `effectiveness_notes` text,
  `verify_user_id` int(11) DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `close_user_id` int(11) DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `version_created` datetime NOT NULL,
  `version_request` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`version_id`),
  KEY `ActionTypeId` (`action_type_id`),
  KEY `TicketId` (`ticket_id`),
  KEY `ActionEffectivenessId` (`action_effectiveness_id`),
  KEY `ActionId` (`id`),
  KEY `VerifyUserID` (`verify_user_id`),
  KEY `CloseUserID` (`close_user_id`),
  KEY `ModifiedUserID` (`modified_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `phkapa_action_effectivenesses`
--

DROP TABLE IF EXISTS `phkapa_action_effectivenesses`;
CREATE TABLE IF NOT EXISTS `phkapa_action_effectivenesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_action_types`
--

DROP TABLE IF EXISTS `phkapa_action_types`;
CREATE TABLE IF NOT EXISTS `phkapa_action_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `verification` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_activities`
--

DROP TABLE IF EXISTS `phkapa_activities`;
CREATE TABLE IF NOT EXISTS `phkapa_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_activities_processes`
--

DROP TABLE IF EXISTS `phkapa_activities_processes`;
CREATE TABLE IF NOT EXISTS `phkapa_activities_processes` (
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `process_id` int(11) NOT NULL DEFAULT '0',
  KEY `activity_id` (`activity_id`),
  KEY `process_id` (`process_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_categories`
--

DROP TABLE IF EXISTS `phkapa_categories`;
CREATE TABLE IF NOT EXISTS `phkapa_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_categories_causes`
--

DROP TABLE IF EXISTS `phkapa_categories_causes`;
CREATE TABLE IF NOT EXISTS `phkapa_categories_causes` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `cause_id` int(11) NOT NULL DEFAULT '0',
  KEY `category_id` (`category_id`),
  KEY `motive_id` (`cause_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_categories_processes`
--

DROP TABLE IF EXISTS `phkapa_categories_processes`;
CREATE TABLE IF NOT EXISTS `phkapa_categories_processes` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `process_id` int(11) NOT NULL DEFAULT '0',
  KEY `process_id` (`process_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_causes`
--

DROP TABLE IF EXISTS `phkapa_causes`;
CREATE TABLE IF NOT EXISTS `phkapa_causes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_origins`
--

DROP TABLE IF EXISTS `phkapa_origins`;
CREATE TABLE IF NOT EXISTS `phkapa_origins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_processes`
--

DROP TABLE IF EXISTS `phkapa_processes`;
CREATE TABLE IF NOT EXISTS `phkapa_processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_processes_users`
--

DROP TABLE IF EXISTS `phkapa_processes_users`;
CREATE TABLE IF NOT EXISTS `phkapa_processes_users` (
  `process_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `process_id` (`process_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_suppliers`
--

DROP TABLE IF EXISTS `phkapa_suppliers`;
CREATE TABLE IF NOT EXISTS `phkapa_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_tickets`
--

-- --------------------------------------------------------

DROP TABLE IF EXISTS `phkapa_tickets`;
CREATE TABLE IF NOT EXISTS `phkapa_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_parent` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `process_id` int(11) NOT NULL DEFAULT '0',
  `priority_id` int(11) NOT NULL DEFAULT '0',
  `safety_id` int(11) NOT NULL DEFAULT '0',
  `registar_id` int(11) NOT NULL DEFAULT '0',
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `origin_id` int(11) NOT NULL DEFAULT '0',
  `origin_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `review_notes` text,
  `workflow_id` int(11) NOT NULL DEFAULT '0',
  `cause_id` int(11) DEFAULT NULL,
  `cause_notes` text,
  `description` text,
  `close_date` date DEFAULT NULL,
  `close_user_id` int(11) DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `TypeIdKey` (`type_id`),
  KEY `ProcessIdKey` (`process_id`),
  KEY `RegistarIdKey` (`registar_id`),
  KEY `ActivityIdKey` (`activity_id`),
  KEY `OriginIdKey` (`origin_id`),
  KEY `WorkflowIdKey` (`workflow_id`),
  KEY `CategoryIdKey` (`category_id`),
  KEY `CauseIdKey` (`cause_id`),
  KEY `TicketParentIdKey` (`ticket_parent`),
  KEY `PriorityIdKey` (`priority_id`),
  KEY `ClosedUserIdKey` (`close_user_id`),
  KEY `ModifiedUserIdKey` (`modified_user_id`),
  KEY `SupplierIdKey` (`supplier_id`),
  KEY `SafetyIdKey` (`safety_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- Table structure for table `phkapa_tickets_revision`
--

DROP TABLE IF EXISTS `phkapa_tickets_revision`;
CREATE TABLE IF NOT EXISTS `phkapa_tickets_revision` (
  `version_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_description` varchar(250) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `ticket_parent` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `process_id` int(11) NOT NULL DEFAULT '0',
  `priority_id` int(11) NOT NULL DEFAULT '0',
  `safety_id` int(11) NOT NULL DEFAULT '0',
  `registar_id` int(11) NOT NULL DEFAULT '0',
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `origin_id` int(11) NOT NULL DEFAULT '0',
  `origin_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `review_notes` text,
  `workflow_id` int(11) NOT NULL DEFAULT '0',
  `cause_id` int(11) DEFAULT NULL,
  `cause_notes` text,
  `description` text,
  `close_date` date DEFAULT NULL,
  `close_user_id` int(11) DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `version_created` datetime NOT NULL,
  `version_request` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`version_id`),
  KEY `TypeIdKey` (`type_id`),
  KEY `ProcessIdKey` (`process_id`),
  KEY `RegistarIdKey` (`registar_id`),
  KEY `ActivityIdKey` (`activity_id`),
  KEY `OriginIdKey` (`origin_id`),
  KEY `WorkflowIdKey` (`workflow_id`),
  KEY `CategoryIdKey` (`category_id`),
  KEY `CauseIdKey` (`cause_id`),
  KEY `TicketParentIdKey` (`ticket_parent`),
  KEY `PriorityIdKey` (`priority_id`),
  KEY `ClosedUserIdKey` (`close_user_id`),
  KEY `ModifiedUserIdKey` (`modified_user_id`),
  KEY `TicketId` (`id`),
  KEY `SupplierIdKey` (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- Table structure for table `phkapa_types`
--

DROP TABLE IF EXISTS `phkapa_types`;
CREATE TABLE IF NOT EXISTS `phkapa_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phkapa_workflows`
--

DROP TABLE IF EXISTS `phkapa_workflows`;
CREATE TABLE IF NOT EXISTS `phkapa_workflows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `phkapa_priorities`
--

DROP TABLE IF EXISTS `phkapa_priorities`;
CREATE TABLE IF NOT EXISTS `phkapa_priorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `OrderUnique` (`order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Table structure for table  `phkapa_safeties`
--

DROP TABLE IF EXISTS `phkapa_safeties`;
CREATE TABLE IF NOT EXISTS `phkapa_safeties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `OrderUnique` (`order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phkapa_actions`
--
ALTER TABLE `phkapa_actions`
  ADD CONSTRAINT `phkapa_actions_ibfk_7` FOREIGN KEY (`modified_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ActionTypeId` FOREIGN KEY (`action_type_id`) REFERENCES `phkapa_action_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_ibfk_3` FOREIGN KEY (`ticket_id`) REFERENCES `phkapa_tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_ibfk_4` FOREIGN KEY (`action_effectiveness_id`) REFERENCES `phkapa_action_effectivenesses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_ibfk_5` FOREIGN KEY (`verify_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_ibfk_6` FOREIGN KEY (`close_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `phkapa_actions_revision`
--
ALTER TABLE `phkapa_actions_revision`
  ADD CONSTRAINT `phkapa_actions_revision_ibfk_1` FOREIGN KEY (`id`) REFERENCES `phkapa_actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_revision_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `phkapa_tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_revision_ibfk_3` FOREIGN KEY (`action_type_id`) REFERENCES `phkapa_action_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_revision_ibfk_4` FOREIGN KEY (`action_effectiveness_id`) REFERENCES `phkapa_action_effectivenesses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_revision_ibfk_5` FOREIGN KEY (`verify_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_revision_ibfk_6` FOREIGN KEY (`close_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_actions_revision_ibfk_7` FOREIGN KEY (`modified_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `phkapa_activities_processes`
--
ALTER TABLE `phkapa_activities_processes`
  ADD CONSTRAINT `phkapa_activities_processes_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `phkapa_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_activities_processes_ibfk_2` FOREIGN KEY (`process_id`) REFERENCES `phkapa_processes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phkapa_categories_causes`
--
ALTER TABLE `phkapa_categories_causes`
  ADD CONSTRAINT `phkapa_categories_causes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `phkapa_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_categories_causes_ibfk_2` FOREIGN KEY (`cause_id`) REFERENCES `phkapa_causes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phkapa_categories_processes`
--
ALTER TABLE `phkapa_categories_processes`
  ADD CONSTRAINT `phkapa_categories_processes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `phkapa_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_categories_processes_ibfk_2` FOREIGN KEY (`process_id`) REFERENCES `phkapa_processes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phkapa_processes_users`
--
ALTER TABLE `phkapa_processes_users`
  ADD CONSTRAINT `phkapa_processes_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_processes_users_ibfk_3` FOREIGN KEY (`process_id`) REFERENCES `phkapa_processes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phkapa_tickets`
--
ALTER TABLE `phkapa_tickets`
  ADD CONSTRAINT `phkapa_tickets_ibfk_11` FOREIGN KEY (`cause_id`) REFERENCES `phkapa_causes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_12` FOREIGN KEY (`ticket_parent`) REFERENCES `phkapa_tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_13` FOREIGN KEY (`priority_id`) REFERENCES `phkapa_priorities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_14` FOREIGN KEY (`close_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_15` FOREIGN KEY (`modified_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_16` FOREIGN KEY (`supplier_id`) REFERENCES `phkapa_suppliers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_17` FOREIGN KEY (`safety_id`) REFERENCES `phkapa_safeties` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `phkapa_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_3` FOREIGN KEY (`process_id`) REFERENCES `phkapa_processes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_4` FOREIGN KEY (`registar_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_5` FOREIGN KEY (`activity_id`) REFERENCES `phkapa_activities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_6` FOREIGN KEY (`category_id`) REFERENCES `phkapa_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_7` FOREIGN KEY (`origin_id`) REFERENCES `phkapa_origins` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_ibfk_8` FOREIGN KEY (`workflow_id`) REFERENCES `phkapa_workflows` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `phkapa_tickets_revision`
--
ALTER TABLE `phkapa_tickets_revision`
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_1` FOREIGN KEY (`id`) REFERENCES `phkapa_tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_10` FOREIGN KEY (`workflow_id`) REFERENCES `phkapa_workflows` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_11` FOREIGN KEY (`cause_id`) REFERENCES `phkapa_causes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_12` FOREIGN KEY (`close_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_13` FOREIGN KEY (`modified_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_14` FOREIGN KEY (`type_id`) REFERENCES `phkapa_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_15` FOREIGN KEY (`supplier_id`) REFERENCES `phkapa_suppliers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_2` FOREIGN KEY (`ticket_parent`) REFERENCES `phkapa_tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_4` FOREIGN KEY (`process_id`) REFERENCES `phkapa_processes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_5` FOREIGN KEY (`priority_id`) REFERENCES `phkapa_priorities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_6` FOREIGN KEY (`registar_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_7` FOREIGN KEY (`activity_id`) REFERENCES `phkapa_activities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_8` FOREIGN KEY (`category_id`) REFERENCES `phkapa_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phkapa_tickets_revision_ibfk_9` FOREIGN KEY (`origin_id`) REFERENCES `phkapa_origins` (`id`) ON UPDATE CASCADE;


SET FOREIGN_KEY_CHECKS=1;


SET FOREIGN_KEY_CHECKS=0;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, '', NULL, 'Total', 1, 16),
(2, 1, '', NULL, 'Phkapa', 2, 15),
(6, 2, '', NULL, 'Administration', 3, 4),
(7, 2, '', NULL, 'Register', 7, 8),
(8, 2, '', NULL, 'Plan', 11, 12),
(9, 2, '', NULL, 'Verify', 13, 14),
(22, 2, '', NULL, 'Query', 5, 6),
(23, 2, '', NULL, 'Review', 9, 10);

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, '', NULL, 'Administrator', 1, 4),
(3, 1, 'User', 1, 'Admin', 2, 3),
(2, NULL, '', NULL, 'User', 5, 24);


--
-- Dumping data for table `aros_acos`
--
INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_allow`) VALUES
(1, 1, 1, '1'),
(2, 2, 2, '1');

--
-- Dumping data for table `phkapa_action_effectivenesses`
--

INSERT INTO `phkapa_action_effectivenesses` (`id`, `name`, `active`, `created`, `modified`) VALUES
(1, 'Aguarda Verificação', 1, '2012-08-21 08:09:34', '2012-08-21 08:09:34'),
(2, 'Eficaz', 1, '2012-08-21 08:09:34', '2012-08-21 08:09:34'),
(3, 'Não eficaz', 1, '2012-08-21 08:09:34', '2012-08-21 08:09:34');

--
-- Dumping data for table `phkapa_action_types`
--

INSERT INTO `phkapa_action_types` (`id`, `name`, `verification`, `active`, `created`, `modified`) VALUES
(1, 'Adaptiva', 1, 1, '2012-08-21 08:10:24', '2012-08-21 08:10:24'),
(2, 'Correctiva', 1, 1, '2012-08-21 08:10:24', '2012-08-21 08:10:24'),
(3, 'Preventiva', 0, 1, '2012-08-21 08:10:24', '2012-08-21 08:10:24'),
(4, 'Intermédia', 0, 1, '2013-02-20 23:13:35', '2013-02-20 23:13:35');


--
-- Dumping data for table `phkapa_workflows`
--

INSERT INTO `phkapa_workflows` (`id`, `name`, `active`, `order`, `created`, `modified`) VALUES
(1, 'Registo', 1, 1, '2012-08-21 08:12:37', '2012-08-21 08:12:37'),
(2, 'Revisão', 1, 2, '2012-08-21 08:12:37', '2012-08-21 08:12:37'),
(3, 'Plano/Implementar', 1, 3, '2012-08-21 08:12:37', '2012-08-21 08:12:37'),
(4, 'Verificação', 1, 4, '2012-08-21 08:12:37', '2012-08-21 08:12:37'),
(5, 'Fechado', 1, 5, '2012-08-21 08:12:37', '2012-08-21 08:12:37');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `active`, `modified`, `created`) VALUES
(1, 'Admin', 'admin', '8b404da7bfc9a93aec1a46653d347e5edf2ca683', 1, '2013-01-01 00:00:00', '2013-01-01 00:00:00');
SET FOREIGN_KEY_CHECKS=1;

--
-- Dumping data for table `phkapa_priorities`
--

INSERT INTO `phkapa_priorities` (`id`, `name`, `active`, `order`, `created`, `modified`) VALUES
(1, 'Alta', 1, 1, '2013-02-20 20:59:27', '2013-02-20 23:40:24'),
(2, 'Media', 1, 2, '2013-02-20 21:00:13', '2013-02-22 23:22:59'),
(3, 'Baixa', 1, 3, '2013-02-20 21:00:36', '2013-02-22 23:22:32');


--
-- Dumping data for table `phkapa_safeties`
--

INSERT INTO `phkapa_safeties` (`id`, `name`, `active`, `order`, `created`, `modified`) VALUES
(1, 'Alto', 1, 1, '2013-02-20 20:59:27', '2013-02-20 23:40:24'),
(2, 'Medio', 1, 2, '2013-02-20 21:00:13', '2013-02-22 23:22:59'),
(3, 'Baixo', 1, 3, '2013-02-20 21:00:36', '2013-02-22 23:22:32');

--
-- Dumping data for table `phkapa_types`
--
INSERT INTO `phkapa_types` (`id`, `name`, `active`, `created`, `modified`) VALUES
(1, 'Não Conformidade', 1, '2012-08-21 08:12:26', '2013-01-17 13:25:40'),
(2, 'Observação', 1, '2012-08-21 08:12:26', '2012-08-21 08:12:26'),
(3, 'PNC / PB', 0, '2012-08-21 08:12:26', '2012-08-21 08:12:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


