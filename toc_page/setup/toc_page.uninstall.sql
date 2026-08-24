-- Table of Contents Page plugin - uninstallation SQL
-- Removes plugin tables
-- plugins/toc_page/setup/toc_page.uninstall.sql

-- version 1.1.4
-- Date Aug 24, 2026

DROP TABLE IF EXISTS `cot_toc_page_i18n`;
DROP TABLE IF EXISTS `cot_toc_page_items`;
DROP TABLE IF EXISTS `cot_toc_page_trees`;
