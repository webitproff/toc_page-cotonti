-- Table of Contents Page plugin - installation SQL
-- plugins/toc_page/setup/toc_page.install.sql
-- Creates tables for storing TOC trees, items, and translations

-- version 1.1.4
-- Date Aug 24, 2026

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

-- Таблица переводов для элементов дерева
CREATE TABLE IF NOT EXISTS `cot_toc_page_i18n` (
  `item_id` INT UNSIGNED NOT NULL,
  `field_name` VARCHAR(255) NOT NULL,
  `lang` CHAR(2) NOT NULL DEFAULT 'en',
  `value` TEXT,
  PRIMARY KEY (`item_id`, `field_name`, `lang`),
  CONSTRAINT `fk_toc_page_i18n_item` FOREIGN KEY (`item_id`) REFERENCES `cot_toc_page_items` (`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
