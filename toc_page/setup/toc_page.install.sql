-- Table of Contents Page plugin - installation SQL
-- Creates tables for storing TOC trees and items
-- plugins/toc_page/setup/toc_page.install.sql

CREATE TABLE IF NOT EXISTS `cot_toc_page_trees` (
  `tree_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tree_title` VARCHAR(255) NOT NULL DEFAULT '',
  `tree_description` TEXT DEFAULT NULL,
  `tree_created` INT UNSIGNED NOT NULL DEFAULT 0,
  `tree_updated` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`tree_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cot_toc_page_items` (
  `item_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tree_id` INT UNSIGNED NOT NULL DEFAULT 0,
  `parent_id` INT UNSIGNED NOT NULL DEFAULT 0,
  `item_type` ENUM('category','page','custom') NOT NULL DEFAULT 'category',
  `item_ref` VARCHAR(255) NOT NULL DEFAULT '',
  `item_title` VARCHAR(255) NOT NULL DEFAULT '',
  `item_url` VARCHAR(255) NOT NULL DEFAULT '',
  `item_sort` INT UNSIGNED NOT NULL DEFAULT 0,
  `item_enabled` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`item_id`),
  KEY `idx_tree_id` (`tree_id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_item_sort` (`item_sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;