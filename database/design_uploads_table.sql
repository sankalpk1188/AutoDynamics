-- Upload Your Design — standalone table (run in phpMyAdmin if migration not used)



CREATE TABLE IF NOT EXISTS `design_uploads` (

  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,

  `name` varchar(255) NOT NULL,

  `email` varchar(255) NOT NULL,

  `company` varchar(255) NOT NULL,

  `looking_for` varchar(255) NOT NULL,

  `preferred_material` varchar(255) DEFAULT NULL,

  `annual_volume` varchar(255) DEFAULT NULL,

  `part_description` text DEFAULT NULL,

  `program_name` varchar(255) DEFAULT NULL,

  `sop_timeline` varchar(255) DEFAULT NULL,

  `files` json DEFAULT NULL,

  `ip_address` varchar(45) DEFAULT NULL,

  `status` varchar(32) NOT NULL DEFAULT 'pending',

  `created_at` timestamp NULL DEFAULT NULL,

  `updated_at` timestamp NULL DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- If table already exists, add new columns:

-- ALTER TABLE `design_uploads`

--   ADD COLUMN `preferred_material` varchar(255) DEFAULT NULL AFTER `looking_for`,

--   ADD COLUMN `annual_volume` varchar(255) DEFAULT NULL AFTER `preferred_material`,

--   ADD COLUMN `part_description` text DEFAULT NULL AFTER `annual_volume`,

--   ADD COLUMN `program_name` varchar(255) DEFAULT NULL AFTER `part_description`,

--   ADD COLUMN `sop_timeline` varchar(255) DEFAULT NULL AFTER `program_name`;

