/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.4.4-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: kairos_stats
-- ------------------------------------------------------
-- Server version	11.4.4-MariaDB-3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `activites`
--

DROP TABLE IF EXISTS `activites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_objectif` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `activites_intitule_unique` (`intitule`),
  KEY `activites_id_objectif_foreign` (`id_objectif`),
  KEY `activites_id_index` (`id`),
  CONSTRAINT `activites_id_objectif_foreign` FOREIGN KEY (`id_objectif`) REFERENCES `objectifs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activites`
--

LOCK TABLES `activites` WRITE;
/*!40000 ALTER TABLE `activites` DISABLE KEYS */;
/*!40000 ALTER TABLE `activites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaine_intervenants`
--

DROP TABLE IF EXISTS `domaine_intervenants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domaine_intervenants` (
  `domaine_valeur_element_id` bigint(20) unsigned NOT NULL,
  `intervenant_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`domaine_valeur_element_id`,`intervenant_id`),
  KEY `domaine_intervenants_intervenant_id_foreign` (`intervenant_id`),
  CONSTRAINT `domaine_intervenants_domaine_valeur_element_id_foreign` FOREIGN KEY (`domaine_valeur_element_id`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domaine_intervenants_intervenant_id_foreign` FOREIGN KEY (`intervenant_id`) REFERENCES `intervenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaine_intervenants`
--

LOCK TABLES `domaine_intervenants` WRITE;
/*!40000 ALTER TABLE `domaine_intervenants` DISABLE KEYS */;
INSERT INTO `domaine_intervenants` VALUES
(3,2),
(4,2);
/*!40000 ALTER TABLE `domaine_intervenants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaine_valeur_elements`
--

DROP TABLE IF EXISTS `domaine_valeur_elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domaine_valeur_elements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libele` varchar(255) NOT NULL,
  `type` enum('0','1') NOT NULL DEFAULT '0',
  `id_domaine` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domaine_valeur_elements_id_domaine_foreign` (`id_domaine`),
  KEY `domaine_valeur_elements_id_index` (`id`),
  CONSTRAINT `domaine_valeur_elements_id_domaine_foreign` FOREIGN KEY (`id_domaine`) REFERENCES `domaine_valeurs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaine_valeur_elements`
--

LOCK TABLES `domaine_valeur_elements` WRITE;
/*!40000 ALTER TABLE `domaine_valeur_elements` DISABLE KEYS */;
INSERT INTO `domaine_valeur_elements` VALUES
(1,'Developpeur','0',1,'2025-03-01 00:28:57','2025-03-01 00:28:57'),
(2,'Archiviste','0',1,'2025-03-01 00:29:06','2025-03-01 00:29:06'),
(3,'Faire les taches','0',2,'2025-03-01 02:01:24','2025-03-01 02:01:24'),
(4,'Faire les recettes','0',2,'2025-03-01 02:02:09','2025-03-01 02:02:09');
/*!40000 ALTER TABLE `domaine_valeur_elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaine_valeurs`
--

DROP TABLE IF EXISTS `domaine_valeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domaine_valeurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libele` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domaine_valeurs_libele_unique` (`libele`),
  KEY `domaine_valeurs_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaine_valeurs`
--

LOCK TABLES `domaine_valeurs` WRITE;
/*!40000 ALTER TABLE `domaine_valeurs` DISABLE KEYS */;
INSERT INTO `domaine_valeurs` VALUES
(1,'Fonction des intervenants','Liste des fonctions associées aux intervenants.','1','2025-02-28 09:30:53','2025-02-28 09:30:53'),
(2,'Activites','Liste des activites associées aux intervenants.','1','2025-02-28 09:30:53','2025-02-28 09:30:53'),
(3,'Typologie documentaire','Liste des typologies documentaires associées aux intervenants.','1','2025-02-28 09:30:53','2025-02-28 09:30:53'),
(4,'Periodicite','Liste des periodicites.','1','2025-02-28 09:30:53','2025-02-28 09:30:53'),
(5,'unites','Liste des unites.','1','2025-02-28 09:30:53','2025-02-28 09:30:53');
/*!40000 ALTER TABLE `domaine_valeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entite_organisations`
--

DROP TABLE IF EXISTS `entite_organisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entite_organisations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `libele` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `fonction` enum('1','2','3','4') DEFAULT NULL,
  `type_entity_id` bigint(20) unsigned DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entite_organisations_code_unique` (`code`),
  KEY `entite_organisations_type_entity_id_foreign` (`type_entity_id`),
  CONSTRAINT `entite_organisations_type_entity_id_foreign` FOREIGN KEY (`type_entity_id`) REFERENCES `type_entites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entite_organisations`
--

LOCK TABLES `entite_organisations` WRITE;
/*!40000 ALTER TABLE `entite_organisations` DISABLE KEYS */;
INSERT INTO `entite_organisations` VALUES
(13,'d','d','d','2',15,0,'2025-03-01 11:30:11','2025-03-01 11:30:11');
/*!40000 ALTER TABLE `entite_organisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervenants`
--

DROP TABLE IF EXISTS `intervenants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intervenants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `fonction` bigint(20) unsigned NOT NULL,
  `date_integration` varchar(255) DEFAULT NULL,
  `info_connexes` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT NULL,
  `sex` enum('1','2') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `intervenants_matricule_unique` (`matricule`),
  KEY `intervenants_fonction_foreign` (`fonction`),
  KEY `intervenants_id_index` (`id`),
  CONSTRAINT `intervenants_fonction_foreign` FOREIGN KEY (`fonction`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervenants`
--

LOCK TABLES `intervenants` WRITE;
/*!40000 ALTER TABLE `intervenants` DISABLE KEYS */;
INSERT INTO `intervenants` VALUES
(1,'20v2436','Sylvain','Pro',NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,'1','2025-03-01 00:29:23','2025-03-01 00:29:23'),
(2,'Gallagher','Gallagher','Gallagher',NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,'1','2025-03-01 00:29:52','2025-03-01 00:29:52');
/*!40000 ALTER TABLE `intervenants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jour_feriers`
--

DROP TABLE IF EXISTS `jour_feriers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jour_feriers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `recurrent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jour_feriers_date_unique` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jour_feriers`
--

LOCK TABLES `jour_feriers` WRITE;
/*!40000 ALTER TABLE `jour_feriers` DISABLE KEYS */;
/*!40000 ALTER TABLE `jour_feriers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_02_03_122657_create_domaine_valeurs_table',1),
(5,'2025_02_03_122704_create_domaine_valeur_elements_table',1),
(6,'2025_02_03_134515_create_intervenants_table',1),
(7,'2025_02_04_092523_create_objects_table',1),
(8,'2025_02_04_105436_create_objectifs_table',1),
(9,'2025_02_04_105506_create_activites_table',1),
(10,'2025_02_04_133744_create_performances_table',1),
(11,'2025_02_07_221456_create_jour_feriers_table',1),
(12,'2025_02_12_153729_create_password_defaults_table',1),
(13,'2025_02_28_223211_create_type_entites_table',2),
(14,'2025_02_28_223218_create_entite_organisations_table',2),
(16,'2025_03_01_013316_create_presences_table',3),
(17,'2025_03_01_163856_create_post_travails_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objectifs`
--

DROP TABLE IF EXISTS `objectifs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objectifs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `activite` bigint(20) unsigned NOT NULL,
  `typologie` bigint(20) unsigned NOT NULL,
  `valeur_cible` varchar(255) DEFAULT NULL,
  `unites` bigint(20) unsigned NOT NULL,
  `periodicite` bigint(20) unsigned NOT NULL,
  `commentaires` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `objectifs_code_unique` (`code`),
  KEY `objectifs_activite_foreign` (`activite`),
  KEY `objectifs_typologie_foreign` (`typologie`),
  KEY `objectifs_unites_foreign` (`unites`),
  KEY `objectifs_periodicite_foreign` (`periodicite`),
  KEY `objectifs_id_index` (`id`),
  CONSTRAINT `objectifs_activite_foreign` FOREIGN KEY (`activite`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `objectifs_periodicite_foreign` FOREIGN KEY (`periodicite`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `objectifs_typologie_foreign` FOREIGN KEY (`typologie`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `objectifs_unites_foreign` FOREIGN KEY (`unites`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objectifs`
--

LOCK TABLES `objectifs` WRITE;
/*!40000 ALTER TABLE `objectifs` DISABLE KEYS */;
/*!40000 ALTER TABLE `objectifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objects`
--

DROP TABLE IF EXISTS `objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libele` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `objects_libele_unique` (`libele`),
  KEY `objects_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects`
--

LOCK TABLES `objects` WRITE;
/*!40000 ALTER TABLE `objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_defaults`
--

DROP TABLE IF EXISTS `password_defaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_defaults` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libele` varchar(255) NOT NULL,
  `valeur` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_defaults`
--

LOCK TABLES `password_defaults` WRITE;
/*!40000 ALTER TABLE `password_defaults` DISABLE KEYS */;
INSERT INTO `password_defaults` VALUES
(1,'mot_de_passe_par_defaut','password','Mot de passe par défaut pour les nouveaux utilisateurs.','0','2025-02-28 09:30:53','2025-02-28 09:30:53');
/*!40000 ALTER TABLE `password_defaults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performances`
--

DROP TABLE IF EXISTS `performances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `performances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intervenant` bigint(20) unsigned NOT NULL,
  `objects` bigint(20) unsigned NOT NULL,
  `activites` bigint(20) unsigned NOT NULL,
  `date_performance` date NOT NULL,
  `performance_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `performances_intervenant_foreign` (`intervenant`),
  KEY `performances_objects_foreign` (`objects`),
  KEY `performances_activites_foreign` (`activites`),
  CONSTRAINT `performances_activites_foreign` FOREIGN KEY (`activites`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `performances_intervenant_foreign` FOREIGN KEY (`intervenant`) REFERENCES `intervenants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `performances_objects_foreign` FOREIGN KEY (`objects`) REFERENCES `domaine_valeur_elements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performances`
--

LOCK TABLES `performances` WRITE;
/*!40000 ALTER TABLE `performances` DISABLE KEYS */;
/*!40000 ALTER TABLE `performances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_travails`
--

DROP TABLE IF EXISTS `post_travails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_travails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `entite_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_travails_code_unique` (`code`),
  KEY `post_travails_entite_id_foreign` (`entite_id`),
  CONSTRAINT `post_travails_entite_id_foreign` FOREIGN KEY (`entite_id`) REFERENCES `entite_organisations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_travails`
--

LOCK TABLES `post_travails` WRITE;
/*!40000 ALTER TABLE `post_travails` DISABLE KEYS */;
INSERT INTO `post_travails` VALUES
(7,'gggg','ggg','yy',13,'2025-03-01 16:28:02','2025-03-01 16:28:02');
/*!40000 ALTER TABLE `post_travails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presences`
--

DROP TABLE IF EXISTS `presences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `intervenant_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `heure_arrivee` time DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `justification` enum('0','1') NOT NULL DEFAULT '0',
  `presentOrAbsent` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `presences_intervenant_id_foreign` (`intervenant_id`),
  CONSTRAINT `presences_intervenant_id_foreign` FOREIGN KEY (`intervenant_id`) REFERENCES `intervenants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presences`
--

LOCK TABLES `presences` WRITE;
/*!40000 ALTER TABLE `presences` DISABLE KEYS */;
INSERT INTO `presences` VALUES
(3,2,'2025-03-01',NULL,NULL,'0','1','2025-03-01 11:45:33','2025-03-01 11:45:33');
/*!40000 ALTER TABLE `presences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('ovgQqf0wkN2w1MzLyYbXt0PhoaH4Doymkpe894hG',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTXJYUDlkVTNzak04aG4yYk5TSHYwN2REZ3g4RUVjU0lSSW5UWVV4eiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1740914269);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_entites`
--

DROP TABLE IF EXISTS `type_entites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_entites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libele` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_entites`
--

LOCK TABLES `type_entites` WRITE;
/*!40000 ALTER TABLE `type_entites` DISABLE KEYS */;
INSERT INTO `type_entites` VALUES
(15,'Document personnel','qqqqqqqqqqqqqqqq','2025-03-01 11:27:27','2025-03-01 11:27:27'),
(17,'s','s','2025-03-01 16:20:26','2025-03-01 16:20:26');
/*!40000 ALTER TABLE `type_entites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user','super') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `profile_image` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `type_utilisateur` enum('0','1') NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL DEFAULT 'Definir qui vous etes ici ! :)',
  `theme_preference` varchar(255) DEFAULT 'iconcolor gradient font-opensans',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Admin','User','admin@example.com','super','active',NULL,'01-01-1900','23700000007',NULL,'0','$2y$12$sjILNR/7/4YTxAewgGB6Iu.tdCO6VItwEcuQDqguvcRkjdyXq1IhK','I am the administrator.','font-opensans iconcolor sidebar_dark','9Fg6nY7s3KgjRloKBr2LkDVNf0lfliWZcbqXrPhVMfm1zZvZCAMgoSlOoZkC','2025-02-28 09:30:53','2025-03-01 13:29:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-03-02 12:29:07
