/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `ages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `epoch_id` bigint unsigned DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ages_epoch_id_foreign` (`epoch_id`),
  CONSTRAINT `ages_epoch_id_foreign` FOREIGN KEY (`epoch_id`) REFERENCES `epoches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `copyright_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `copyright_rules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `counties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `counties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `eons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `epoches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `epoches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `period_id` bigint unsigned DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `epoches_period_id_foreign` (`period_id`),
  CONSTRAINT `epoches_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `eras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `eon_id` bigint unsigned DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eras_eon_id_foreign` (`eon_id`),
  CONSTRAINT `eras_eon_id_foreign` FOREIGN KEY (`eon_id`) REFERENCES `eons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `size` double DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fossil_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fossil_comments_fossil_id_foreign` (`fossil_id`),
  KEY `fossil_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `fossil_comments_fossil_id_foreign` FOREIGN KEY (`fossil_id`) REFERENCES `fossils` (`id`),
  CONSTRAINT `fossil_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_commons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_commons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_families`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_families` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_genres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_identifies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_identifies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fossil_id` bigint unsigned NOT NULL,
  `fossil_taxonomy_id` bigint unsigned DEFAULT NULL,
  `fossil_kingdom` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_common` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_phylum` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_class` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_order` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_family` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_genre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_subgenre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `specific_epithet` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_subspecies` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_suggest_id` bigint unsigned DEFAULT NULL,
  `user_curator_id` bigint unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `vote_curator` tinyint(1) NOT NULL DEFAULT '0',
  `vote_expert` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vote_user` int DEFAULT (0),
  `vote_users_json` json DEFAULT NULL,
  `vote_curator_id` bigint unsigned DEFAULT NULL,
  `vote_curator_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fossil_identifies_fossil_class_id_foreign` (`fossil_class`),
  KEY `fossil_identifies_fossil_common_id_foreign` (`fossil_common`),
  KEY `fossil_identifies_fossil_family_id_foreign` (`fossil_family`),
  KEY `fossil_identifies_fossil_genre_id_foreign` (`fossil_genre`),
  KEY `fossil_identifies_fossil_id_foreign` (`fossil_id`),
  KEY `fossil_identifies_fossil_kingdom_id_foreign` (`fossil_kingdom`),
  KEY `fossil_identifies_fossil_order_id_foreign` (`fossil_order`),
  KEY `fossil_identifies_fossil_phylum_id_foreign` (`fossil_phylum`),
  KEY `fossil_identifies_fossil_subgenre_id_foreign` (`fossil_subgenre`),
  KEY `fossil_identifies_fossil_subspecies_id_foreign` (`fossil_subspecies`),
  KEY `fossil_identifies_fossil_taxonomy_id_foreign` (`fossil_taxonomy_id`),
  KEY `fossil_identifies_specific_epithet_id_foreign` (`specific_epithet`),
  KEY `fossil_identifies_user_curator_id_foreign` (`user_curator_id`),
  KEY `fossil_identifies_user_id_foreign` (`user_id`),
  KEY `fossil_identifies_user_suggest_id_foreign` (`user_suggest_id`),
  CONSTRAINT `fossil_identifies_fossil_id_foreign` FOREIGN KEY (`fossil_id`) REFERENCES `fossils` (`id`),
  CONSTRAINT `fossil_identifies_fossil_taxonomy_id_foreign` FOREIGN KEY (`fossil_taxonomy_id`) REFERENCES `fossil_taxonomies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_identifies_user_curator_id_foreign` FOREIGN KEY (`user_curator_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fossil_identifies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fossil_identifies_user_suggest_id_foreign` FOREIGN KEY (`user_suggest_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_kingdoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_kingdoms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_phylums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_phylums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_regions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_specialities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_subgenres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_subgenres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_subspecies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_subspecies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossil_taxonomies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossil_taxonomies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fossil_kingdom_id` bigint unsigned DEFAULT NULL,
  `fossil_common_id` bigint unsigned DEFAULT NULL,
  `fossil_phylum_id` bigint unsigned DEFAULT NULL,
  `fossil_class_id` bigint unsigned DEFAULT NULL,
  `fossil_order_id` bigint unsigned DEFAULT NULL,
  `fossil_family_id` bigint unsigned DEFAULT NULL,
  `fossil_genre_id` bigint unsigned DEFAULT NULL,
  `fossil_subgenre_id` bigint unsigned DEFAULT NULL,
  `specific_epithet_id` bigint unsigned DEFAULT NULL,
  `fossil_subspecies_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fossil_taxonomies_fossil_class_id_foreign` (`fossil_class_id`),
  KEY `fossil_taxonomies_fossil_common_id_foreign` (`fossil_common_id`),
  KEY `fossil_taxonomies_fossil_family_id_foreign` (`fossil_family_id`),
  KEY `fossil_taxonomies_fossil_genre_id_foreign` (`fossil_genre_id`),
  KEY `fossil_taxonomies_fossil_kingdom_id_foreign` (`fossil_kingdom_id`),
  KEY `fossil_taxonomies_fossil_order_id_foreign` (`fossil_order_id`),
  KEY `fossil_taxonomies_fossil_phylum_id_foreign` (`fossil_phylum_id`),
  KEY `fossil_taxonomies_fossil_subgenre_id_foreign` (`fossil_subgenre_id`),
  KEY `fossil_taxonomies_fossil_subspecies_id_foreign` (`fossil_subspecies_id`),
  KEY `fossil_taxonomies_specific_epithet_id_foreign` (`specific_epithet_id`),
  CONSTRAINT `fossil_taxonomies_fossil_class_id_foreign` FOREIGN KEY (`fossil_class_id`) REFERENCES `fossil_classes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_common_id_foreign` FOREIGN KEY (`fossil_common_id`) REFERENCES `fossil_commons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_family_id_foreign` FOREIGN KEY (`fossil_family_id`) REFERENCES `fossil_families` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_genre_id_foreign` FOREIGN KEY (`fossil_genre_id`) REFERENCES `fossil_genres` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_kingdom_id_foreign` FOREIGN KEY (`fossil_kingdom_id`) REFERENCES `fossil_kingdoms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_order_id_foreign` FOREIGN KEY (`fossil_order_id`) REFERENCES `fossil_orders` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_phylum_id_foreign` FOREIGN KEY (`fossil_phylum_id`) REFERENCES `fossil_phylums` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_subgenre_id_foreign` FOREIGN KEY (`fossil_subgenre_id`) REFERENCES `fossil_subgenres` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_fossil_subspecies_id_foreign` FOREIGN KEY (`fossil_subspecies_id`) REFERENCES `fossil_subspecies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossil_taxonomies_specific_epithet_id_foreign` FOREIGN KEY (`specific_epithet_id`) REFERENCES `specific_epithets` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fossils`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fossils` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_taxonomy_id` bigint unsigned DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `county_id` bigint unsigned DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `municipality` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `locality_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `hide_location` tinyint(1) NOT NULL,
  `eon_id` bigint unsigned DEFAULT NULL,
  `era_id` bigint unsigned DEFAULT NULL,
  `period_id` bigint unsigned DEFAULT NULL,
  `epoch_id` bigint unsigned DEFAULT NULL,
  `age_id` bigint unsigned DEFAULT NULL,
  `group` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `formation` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `member` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `geochronology_id` bigint unsigned DEFAULT NULL,
  `length` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `width` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `height` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `identifier` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `collector` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_find` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `personal_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `send_delete` tinyint(1) NOT NULL DEFAULT '0',
  `send_report` int DEFAULT NULL,
  `vote_scientific` tinyint(1) NOT NULL DEFAULT '0',
  `vote_danekrae` tinyint(1) NOT NULL DEFAULT '0',
  `validated_fossil` tinyint(1) DEFAULT '0',
  `vote_curator` tinyint(1) DEFAULT '0',
  `fossil_identify_id` bigint unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `vote_scientific_id` bigint unsigned DEFAULT NULL,
  `vote_scientific_date` timestamp NULL DEFAULT NULL,
  `copyright_rule_id` bigint unsigned DEFAULT NULL,
  `need_identify` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fossils_fossil_taxonomy_id_foreign` (`fossil_taxonomy_id`),
  KEY `fossils_country_id_foreign` (`country_id`),
  KEY `fossils_county_id_foreign` (`county_id`),
  KEY `fossils_eon_id_foreign` (`eon_id`),
  KEY `fossils_era_id_foreign` (`era_id`),
  KEY `fossils_period_id_foreign` (`period_id`),
  KEY `fossils_epoch_id_foreign` (`epoch_id`),
  KEY `fossils_age_id_foreign` (`age_id`),
  KEY `fossils_geochronology_id_foreign` (`geochronology_id`),
  KEY `fossils_user_id_foreign` (`user_id`),
  KEY `fossils_identify_id_foreign` (`fossil_identify_id`),
  KEY `fossils_user_scientific_fk` (`vote_scientific_id`),
  KEY `fossils_copyright_rules_id_fk` (`copyright_rule_id`),
  CONSTRAINT `fossils_age_id_foreign` FOREIGN KEY (`age_id`) REFERENCES `ages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossils_copyright_rules_id_fk` FOREIGN KEY (`copyright_rule_id`) REFERENCES `copyright_rules` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossils_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  CONSTRAINT `fossils_county_id_foreign` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`),
  CONSTRAINT `fossils_eon_id_foreign` FOREIGN KEY (`eon_id`) REFERENCES `eons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossils_epoch_id_foreign` FOREIGN KEY (`epoch_id`) REFERENCES `epoches` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossils_era_id_foreign` FOREIGN KEY (`era_id`) REFERENCES `eras` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossils_fossil_taxonomy_id_foreign` FOREIGN KEY (`fossil_taxonomy_id`) REFERENCES `fossil_taxonomies` (`id`),
  CONSTRAINT `fossils_geochronology_id_foreign` FOREIGN KEY (`geochronology_id`) REFERENCES `geochronologies` (`id`),
  CONSTRAINT `fossils_identify_id_foreign` FOREIGN KEY (`fossil_identify_id`) REFERENCES `fossil_identifies` (`id`),
  CONSTRAINT `fossils_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fossils_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fossils_user_scientific_fk` FOREIGN KEY (`vote_scientific_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `geochronologies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `geochronologies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fossil_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `principal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `licences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `licences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `map_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `map_resources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `message_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_attachments_message_id_foreign` (`message_id`),
  CONSTRAINT `message_attachments_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `body` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `thread_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_thread_id_foreign` (`thread_id`),
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `endpoint` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `new_order` int NOT NULL,
  `active` tinyint(1) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `user_notificator_id` int DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `fossil_id` bigint unsigned DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_user_fk` (`user_id`),
  CONSTRAINT `notification_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `text` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `periods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `era_id` bigint unsigned DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periods_era_id_foreign` (`era_id`),
  CONSTRAINT `periods_era_id_foreign` FOREIGN KEY (`era_id`) REFERENCES `eras` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` bigint unsigned DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `endpoint` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `resource_order` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resources_parent_fk` (`resource_id`),
  CONSTRAINT `resources_parent_fk` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `specific_epithets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specific_epithets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `threads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `threads_sender_id_foreign` (`sender_id`),
  KEY `threads_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `threads_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `threads_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_security_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_security_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `question_number` int NOT NULL,
  `answer` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_security_questions_user_id_foreign` (`user_id`),
  CONSTRAINT `user_security_questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'customer',
  `licence_id` int DEFAULT NULL,
  `username` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `copyright_rule_id` int DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `fossil_speciality` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_region` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `send_delete` tinyint(1) NOT NULL DEFAULT '0',
  `answered_questions` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2023_04_14_035221_add_role_to_users_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2023_04_20_234132_add_picture_licence_id_to_users',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2023_04_20_234557_add_table_licences',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2023_04_23_205313_add_table_fossil',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2023_04_24_181517_create_table_images',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2023_04_24_190520_create_table_geochronologies',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2023_04_24_200602_add_state_to_fossils',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2023_04_25_235126_add_table_copyright_rules',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2023_04_26_000008_add_copyright_rule_id_to_users',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2023_05_04_184642_add_table_fossil_classes',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2023_05_04_184715_add_table_fossil_orders',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2023_05_04_184752_add_table_fossil_families',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2023_05_04_184812_add_table_fossil_genus',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2023_05_04_185130_add_table_fossil_subgenres',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2023_05_04_185239_add_table_specific_epithets',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2023_05_04_185400_add_table_fossil_subpecies',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2023_05_04_185534_add_table_fossil_taxonomies',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2023_05_04_185605_add_table_countries',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2023_05_04_185636_add_table_counties',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2023_05_04_183950_add_table_common',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2023_05_04_184356_add_table_kingdoms',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2023_05_04_184434_add_table_phylums',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2023_05_04_190037_add_table_eons',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41,'2023_05_04_190100_add_table_eras',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42,'2023_05_04_190138_add_table_periods',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43,'2023_05_04_190211_add_table_epoches',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44,'2023_05_04_191149_add_table_ages',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45,'2023_05_04_191412_add_table_fossils',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (46,'2023_05_20_120001_add_need_identify_to_fossil',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (47,'2024_03_24_141051_remove_excess_data_from_users',12);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (48,'2024_03_24_170755_user_security_questions_table',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (50,'2024_03_24_171354_user_has_questions',14);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (51,'2024_03_30_154927_update_password_reset_token',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (52,'2024_03_30_164054_create_threads_table',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (55,'2024_03_30_164135_create_messages_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (56,'2024_03_30_165400_create_message_attachments_table',18);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (57,'2024_05_09_173226_add_soft_delete_to_users_table',19);
