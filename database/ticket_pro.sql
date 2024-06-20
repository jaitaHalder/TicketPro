-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2024 at 06:03 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codecanyon_eticket_simple`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md. Chanchal Biswas', 'mchanchalbd@gmail.com', '2023-12-21 20:23:46', '$2y$12$JlpBYinabro8Z.4CuyBUAOcCwq6IgUohFvqUBD8SCpGPSPOnX5p.e', NULL, '2023-12-21 20:23:46', '2024-06-15 18:41:31'),
(2, 'Md. Chanchal Biswas', 'facebook@gmail.com', '2023-12-21 20:23:46', '$2y$12$JlpBYinabro8Z.4CuyBUAOcCwq6IgUohFvqUBD8SCpGPSPOnX5p.e', NULL, '2023-12-21 20:23:46', '2024-06-15 18:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` bigint UNSIGNED NOT NULL,
  `bus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_name`, `model`, `capacity`, `detail`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Green Line Deluxe', 'DLX-2000', 36, '-AC\r\n-WiFi', 1, '2023-12-21 20:55:00', '2024-06-05 20:29:30'),
(2, 'Green Line Express', 'GLX-1000', 52, NULL, 1, '2023-12-21 20:55:45', '2023-12-22 22:49:22'),
(6, 'Hanif Express', 'X453N', 55, 'AC', 1, '2024-06-05 19:30:33', '2024-06-05 19:30:33'),
(7, 'Eagle', 'EG-102X', 52, 'Non-AC', 1, '2024-06-05 20:26:53', '2024-06-05 20:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `bus_stops`
--

CREATE TABLE `bus_stops` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_stops`
--

INSERT INTO `bus_stops` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', '2024-06-05 01:29:40', '2024-06-05 01:29:40'),
(2, 'Khulna', '2024-06-05 01:29:46', '2024-06-05 01:29:46'),
(3, 'Barishal', '2024-06-05 01:29:51', '2024-06-05 01:29:51'),
(4, 'Chattogram', '2024-06-05 01:29:55', '2024-06-05 01:29:55'),
(5, 'Gopalganj', '2024-06-05 02:03:47', '2024-06-05 02:03:47'),
(6, 'Mollahat', '2024-06-05 02:03:50', '2024-06-05 02:03:50'),
(7, 'Bhanga', '2024-06-05 02:04:02', '2024-06-05 02:04:02'),
(8, 'Saidabad', '2024-06-05 20:30:53', '2024-06-05 20:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_forms`
--

INSERT INTO `contact_forms` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Md. Chanchal Biswas', 'admin@gmail.com', 'About JobPulse Website Development', 'aa', '2024-06-15 17:45:01', '2024-06-15 17:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_22_072810_create_buses_table', 1),
(6, '2023_12_22_072932_create_routes_table', 1),
(7, '2023_12_22_073209_create_trips_table', 1),
(8, '2023_12_22_204320_create_bus_stops_table', 1),
(9, '2023_12_22_204326_create_sub_routes_table', 1),
(10, '2023_12_23_123353_create_tickets_table', 1),
(11, '2024_06_09_093039_create_ticket_seats_table', 1),
(12, '2024_06_13_142628_create_payments_table', 1),
(13, '2024_06_15_133515_create_admins_table', 1),
(14, '2024_06_15_211715_create_settings_table', 2),
(15, '2024_06_15_232113_create_contact_forms_table', 3),
(16, '2024_06_16_000347_add_column_to_tickets_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BDT',
  `paid_at` timestamp NULL DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Pending','Completed','Failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `ticket_id`, `payment_method`, `amount`, `currency`, `paid_at`, `transaction_id`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(4, 4, 'Cash', 176.00, 'BDT', '2024-06-15 19:37:56', NULL, NULL, 'Pending', '2024-06-15 19:37:56', '2024-06-15 19:37:56'),
(6, 6, 'bKash', 92.00, 'BDT', '2024-06-19 17:55:46', '6748474733345', NULL, 'Completed', '2024-06-19 17:55:46', '2024-06-19 17:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` decimal(8,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `distance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Khulna-Dhaka', 397.60, 1, '2023-12-21 21:38:12', '2024-06-05 00:27:46'),
(5, 'Dhaka-Kolkata', 1465.10, 1, '2023-12-22 09:02:42', '2024-06-05 00:27:57'),
(6, 'Khulna-Jashore', 60.00, 1, '2023-12-23 01:18:56', '2024-06-05 00:28:05'),
(7, 'Khulna-Cox\'s Bazaar', 562.00, 1, '2023-12-24 20:54:51', '2024-06-05 00:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_name`, `value`, `created_at`, `updated_at`) VALUES
('CONTACT_ADDRESS', '123 Main Street, Anytown, USA 12345', NULL, '2024-06-15 17:08:58'),
('CONTACT_EMAIL', 'mchanchalbd@gmail.com<br>bchanchalbd@gmail.com', NULL, '2024-06-15 17:08:58'),
('CONTACT_GOOGLE_MAP', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3009.6538911779026!2d-73.77196452392414!3d41.03282751791296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c294364ee03c35%3A0x3db557fc1364d63c!2s123%20Main%20St%2C%20White%20Plains%2C%20NY%2010601%2C%20USA!5e0!3m2!1sen!2sbd!4v1718469299083!5m2!1sen!2sbd\" width=\"800\" height=\"600\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, '2024-06-15 17:08:58'),
('CONTACT_PHONE', '01707093920<br>01912275418', NULL, '2024-06-15 17:08:58'),
('PRIVACY_POLICY', '<p><strong>Purpose and scope</strong><br>&zwj;</p>\r\n<p>International Social Service Australia ABN 12 004 508 641 (collectively &ldquo;ISS Australia&rdquo;, &ldquo;us&rdquo;, &ldquo;we&rdquo; and &ldquo;our&rdquo;) &nbsp;is committed to respecting the privacy of your personal information. We recognise that all personal information managed and used in its business activities should be handled and protected with the utmost care.</p>\r\n<p>&zwj;<br>This policy describes how we will manage &nbsp;personal information and fulfil its obligations under the Privacy Act 1988 (Cth) (the Act) and other relevant Australian laws and regulations regarding the handing of personal information.<br>&ldquo;Personal information&rdquo; means information which identifies you as an individual or from which your identity can be reasonably ascertained.</p>\r\n<p>&zwj;<br>This policy details the personal information collected by us, including why the organisation holds personal information, how it is protected, and the choices individuals can make about their personal information.</p>\r\n<p>&zwj;<br><strong>Collection &nbsp;<br></strong>&zwj;</p>\r\n<p>ISS Australia will only collect information that is necessary for our performance and primary function. Wherever possible, we will collect personal information from the person themselves.</p>\r\n<p><br>If collecting personal information about a client from a third party, we will advise the client whom the information concerns, from whom their personal information has been collected.</p>\r\n<p>&zwj;<br>Where ISS Australia receives unsolicited information, we will determine whether the personal information could have been collected it in the usual way, and then if it could have, it will be treated normally. If it could not have been treated in the usual way, it will be destroyed, and the person whose personal information has been destroyed will be notified about the receipt and destruction of their personal information.</p>\r\n<p>&zwj;<br>The kinds of personal information that we collect and hold about you may include:</p>\r\n<p>&zwj;</p>\r\n<ul role=\"list\">\r\n<li>name</li>\r\n<li>date of birth&nbsp;</li>\r\n<li>gender&nbsp;</li>\r\n<li>address (work, home or delivery)</li>\r\n<li>telephone numbers (work, home or mobile)</li>\r\n<li>email address</li>\r\n<li>memberships&nbsp;</li>\r\n<li>departments&nbsp;</li>\r\n<li>titles&nbsp;</li>\r\n<li>financial information&nbsp;</li>\r\n<li>usage information&nbsp;&nbsp;</li>\r\n<li>profile data (passwords, purchases or order, preferences, feedback)</li>\r\n</ul>\r\n<p>&zwj;</p>\r\n<p>In certain circumstances we may collect sensitive information such as health information. We will only collect this information if provided voluntarily, with consent or as otherwise authorised by law.</p>\r\n<p>&zwj;<br>ISS Australia collects personal information about individuals such as clients, supporters, volunteers, contractors, job applicants and persons sought by family members requesting our tracing services.</p>\r\n<p>&zwj;<br><em>Offline</em></p>\r\n<p><em>&zwj;</em><br>We collect personal information over the phone or via email (or other means) when you access or make contact with our services.</p>\r\n<p>&zwj;<br><em>Online</em></p>\r\n<p><em>&zwj;</em><br>If you visit www.iss.org.au (our &ldquo;Website&rdquo;) to read, browse or download information, our system may record information such as the date and time of your visit to the Website, the pages accessed and any information downloaded. This information is used for statistical, reporting and website administration and maintenance purposes only.</p>\r\n<p>&zwj;<br>Like many websites, our Website may use &ldquo;cookies&rdquo; from time to time. Cookies are small text files that we transfer to your computer&rsquo;s hard drive through your web browser to enable our systems to recognise your browser. Cookies may also be used to record non-personal information such as the date, time or duration of your visit, or the pages accessed, for website administration, statistical and maintenance purposes. Any such, information will be aggregated and not linked to particular individuals. The default settings of browsers like Internet Explorer always allow cookies, but users can easily erase cookies from their hard-drive, block all cookies, or receive a warning before a cookie is stored. Please note that some parts of the Website may not function fully for users who disallow cookies.</p>\r\n<p>&zwj;<br>While we take great care to protect your personal information on our Website, unfortunately no data transmission over the Internet can be guaranteed to be 100% secure. Accordingly, we cannot ensure or warrant the security of any information you send to us or receive from us online. This is particularly true for information you send to us via email. We have no way of protecting that information until it reaches us. Once we receive your transmission, we make our best effort to ensure its security in our possession.</p>\r\n<p>&zwj;<br>The Website may contains links to other sites. We are not responsible for the privacy practices or policies of those sites.</p>\r\n<p>&zwj;<br><strong>Anonymity &nbsp;</strong></p>\r\n<p>&zwj;<br>ISS Australia will where permissible, allow people from whom the personal information is being collected to not identify themselves or use a pseudonym unless it is impracticable to deal with them on this basis. Provision of personal information is voluntary although we may not be able to properly provide some services to clients without some of their personal information (or we may not be able to provide those services at all). &nbsp;</p>\r\n<p>&zwj;<br><strong>Use</strong></p>\r\n<p>&zwj;<br>We may collect, use and disclose personal information for purposes including: &nbsp;</p>\r\n<p>&zwj;</p>\r\n<ul role=\"list\">\r\n<li>to provide services to clients and prospective clients</li>\r\n<li>assessing the services required and whether we can provide those services and deliver those services assessing any application made to become an employee volunteer or contractor &nbsp;</li>\r\n<li>for supporters (including members, donors, sponsors and referring agencies) to process and record donations, provide receipts and &ndash; subject to legal requirements and any requests you make to opt out &ndash; to contact you about ISS Australia, our activities and to provide our newsletters, reports, invitations and membership renewal requests</li>\r\n<li>compliance with legal requirements (for example, child protection laws) &nbsp;</li>\r\n<li>for direct marketing, where that person would reasonably expect it to be used for this purpose, and ISS Australia has provided an opt out and the opt out has not been taken up</li>\r\n<li>in order to prevent serious, foreseeable and imminent harm to you or another identifiable person or property.</li>\r\n</ul>\r\n<p><br>For other purposes, ISS Australia will only use or disclose the personal information when consent has been obtained from the affected person.</p>\r\n<p>&zwj;<br>Many of our tasks are performed with the assistance of our contractors, partner agencies and associated ISS offices overseas, and we may share personal information with them with consent and within the law. &nbsp;</p>\r\n<p>&zwj;<br><strong>Disclosure</strong></p>\r\n<p>&zwj;<br>ISS Australia provides international family tracing-related services including searching and reunion. Personal information about a person requesting tracing is only provided to the person being traced (or vice versa) with consent or where required by law. When a client requests ISS Australia to undertake an overseas background check, we will only disclose their personal information to the relevant authorities overseas with their consent or where required by law.</p>\r\n<p>&zwj;<br>These countries will have laws relating to the protection use and disclosure of personal information that are different from those that apply in Australia. You may not be entitled to similar protections of your personal information under the laws of those countries.</p>\r\n<p>&zwj;<br>We may sometimes be required to share personal information with government agencies where appropriate in relation to funding arrangements or where relevant to services we are providing (for example, to provide more effective services relating to child welfare, adult welfare, child abduction or family mediation). &nbsp;</p>\r\n<p>&zwj;<br><strong>Security</strong></p>\r\n<p>&zwj;<br>Irrespective of whether personal information is stored electronically or in hard copy form, we take reasonable steps to protect the personal information we hold from misuse and loss and from unauthorised access, modification or disclosure.<br>ISS Australia will implement and maintain steps to ensure that personal information is protected from misuse and loss, unauthorized access, interference, unauthorized modification or disclosure.</p>\r\n<p>&zwj;<br>ISS Australia will destroy personal information once it is not required to be kept for the purpose for which it was collected or it is not required to be kept by law, including from decommissioned laptops and mobile phones. &nbsp;</p>\r\n<p>&zwj;<br>No communication via the internet or web or mobile device is 100% secure.</p>\r\n<p>&zwj;<br>We cannot and do not take any responsibility for maintaining the security of your personal information on any other Website or app linked with our Website or app. If you have any query or inquiry regarding the handling of personal information, make direct access to each relevant Website.</p>\r\n<p>&zwj;<br><strong>Access and Correction &nbsp;</strong></p>\r\n<p>&zwj;<br>ISS Australia will ensure individuals have a right to seek access to information held about them and to correct it if it is inaccurate, incomplete, misleading or not up to date.</p>\r\n<p>&zwj;<br>Upon request, and within the parameters of the privacy principles and legislation, we will provide all individuals access to personal information. There may &nbsp;be cases where we are unable to provide the information you request, such as where it is a threat to life or health or it is authorized by law to refuse, or where it would interfere with the privacy of others or result in a breach of another person\'s confidentiality, such as our client&rsquo;s confidentiality.</p>\r\n<p>&zwj;<br>If a person is able to establish that the personal information is not accurate, then ISS Australia must take steps to correct it. In certain cases, we may charge you an administration fee for providing you with access to the information you have asked for, but we will inform you of this before proceeding. You will not be charged for making a request.</p>\r\n<p>&zwj;<br>ISS Australia will take reasonable steps to ensure the information ISS Australia collects is accurate, complete, up to date, and relevant to the functions we perform.</p>\r\n<p>&zwj;<br>You may contact us to update or correct your personal information (see contact details below). Please include your name, address and/or email address when you contact us. You will not be charged for a correction request.</p>\r\n<p>&zwj;<br><strong>&zwj;Enquiries and complaints</strong></p>\r\n<p>&zwj;<br>ISS Australia is committed to working with individuals to obtain a fair resolution of any privacy concerns. If you are concerned about the way in which we are managing your personal information and think we may have breached the APPs, or any other relevant obligation, please contact us using the contact details set out below.</p>\r\n<p>&zwj;<br>ISS Australia will deal with the matter within a reasonable time, and will keep you informed of the progress of our investigation. If we have not responded to you within a reasonable time or if you feel that your complaint has not been resolved satisfactorily, you can contact us to discuss your concerns.</p>\r\n<p>&zwj;<br>You are also entitled to make a complaint to the Office of the Australian Information Commissioner (<strong>OAIC</strong>). You can obtain further general information about your privacy rights and privacy law from the OAIC by:</p>\r\n<p>&zwj;</p>\r\n<ul role=\"list\">\r\n<li>calling their Privacy Hotline on 1300 363 992</li>\r\n<li>visiting their web site at&nbsp;<a href=\"http://www.oaic.gov.au/\">http://www.oaic.gov.au</a></li>\r\n<li>writing to:&nbsp;</li>\r\n</ul>\r\n<p>The Australian Information Commissioner&nbsp;</p>\r\n<p>GPO Box 5218&nbsp;</p>\r\n<p>Sydney NSW 1042</p>\r\n<p><br><strong>Policy review statement</strong></p>\r\n<p>&zwj;<br>ISS Australia will regularly review and update all rules and procedures regarding the handling of personal information, including this policy.</p>\r\n<p>&zwj;<br>Our policy may be updated following changes to legislation or to our policy scope and purpose. If we make changes we will publish an updated statement on our app, website and social media channels. You can acquire a copy of our privacy policy at any time by visiting our website or using the contact details below.</p>\r\n<p>&zwj;<br><strong>Contact details</strong></p>\r\n<p>&zwj;<br>For any inquiries about our handling of personal information, contact:</p>\r\n<p>&zwj;<br>International Social Service Australia ABN 12 004 508 641</p>\r\n<p>&zwj;<br>Address:</p>\r\n<p>&zwj;<br>Level 30, Collins Place</p>\r\n<p>35 Collins St</p>\r\n<p>Melbourne</p>\r\n<p>VIC 3000</p>\r\n<p>Australia</p>\r\n<p>&zwj;</p>\r\n<p>Ph: 1300 357 843</p>\r\n<p>&zwj;<br>Email:&nbsp;<a href=\"mailto:iss@iss.org.au\">iss@iss.org.au</a> Last updated: 22 July 2021</p>', NULL, '2024-06-15 17:08:58'),
('SETTING_ABOUT_US', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', NULL, '2024-06-15 17:08:58'),
('SETTING_SITE_DESCRIPTION', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', NULL, '2024-06-15 17:08:58'),
('SETTING_SITE_FAVICON', 'favicon.png', NULL, '2024-06-15 15:49:20'),
('SETTING_SITE_LOGO', 'logo.png', NULL, '2024-06-15 16:11:40'),
('SETTING_SITE_TITLE', 'Welcome to Bus Ticket', NULL, '2024-06-15 17:08:58'),
('SETTING_SOCIAL_FACEBOOK', '#', NULL, '2024-06-15 17:08:58'),
('SETTING_SOCIAL_INSTAGRAM', '#', NULL, '2024-06-15 17:08:58'),
('SETTING_SOCIAL_LINKEDIN', '#', NULL, '2024-06-15 17:08:58'),
('SETTING_SOCIAL_TWITTER', '#', NULL, '2024-06-15 17:08:58'),
('SETTING_SOCIAL_YOUTUBE', '#', NULL, '2024-06-15 17:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `sub_routes`
--

CREATE TABLE `sub_routes` (
  `id` bigint UNSIGNED NOT NULL,
  `trip_id` bigint UNSIGNED NOT NULL,
  `origin` bigint UNSIGNED NOT NULL COMMENT 'bus_stop_id',
  `destination` bigint UNSIGNED NOT NULL COMMENT 'bus_stop_id',
  `distance` decimal(8,2) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_routes`
--

INSERT INTO `sub_routes` (`id`, `trip_id`, `origin`, `destination`, `distance`, `departure_time`, `arrival_time`, `price`) VALUES
(1, 4, 2, 1, 300.00, '20:00:00', '12:00:00', 500.00),
(2, 4, 2, 6, 33.00, '20:28:00', '20:27:00', 45.00),
(4, 4, 2, 5, 44.00, NULL, NULL, 55.00),
(5, 4, 6, 1, 55.00, NULL, NULL, 44.00),
(6, 4, 6, 5, 33.00, NULL, NULL, 55.00),
(7, 4, 5, 1, 44.00, NULL, NULL, 33.00),
(8, 5, 2, 1, 200.00, '16:32:00', '18:32:00', 1200.00),
(9, 6, 2, 1, 44.00, '14:29:00', '17:27:00', 44.00),
(10, 4, 2, 8, 22.00, '14:32:00', '16:31:00', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `trip_id` bigint UNSIGNED NOT NULL,
  `sub_route_id` bigint UNSIGNED DEFAULT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat_number` int NOT NULL,
  `booking_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `trip_id`, `sub_route_id`, `ticket_number`, `seat_number`, `booking_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 2, 6, 9, '', 0, '2024-06-16', '2024-06-15 19:37:56', '2024-06-15 19:37:56', NULL),
(6, 2, 4, 1, '', 0, '2024-06-21', '2024-06-19 17:55:46', '2024-06-19 17:55:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_seats`
--

CREATE TABLE `ticket_seats` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `seat_number` smallint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_seats`
--

INSERT INTO `ticket_seats` (`id`, `ticket_id`, `seat_number`, `created_at`, `updated_at`) VALUES
(8, 4, 1, '2024-06-15 19:37:56', '2024-06-15 19:37:56'),
(9, 4, 2, '2024-06-15 19:37:56', '2024-06-15 19:37:56'),
(10, 4, 3, '2024-06-15 19:37:56', '2024-06-15 19:37:56'),
(11, 4, 4, '2024-06-15 19:37:56', '2024-06-15 19:37:56'),
(14, 6, 3, '2024-06-19 17:55:46', '2024-06-19 17:55:46'),
(15, 6, 4, '2024-06-19 17:55:46', '2024-06-19 17:55:46'),
(16, 6, 7, '2024-06-19 17:55:46', '2024-06-19 17:55:46'),
(17, 6, 8, '2024-06-19 17:55:46', '2024-06-19 17:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint UNSIGNED NOT NULL,
  `bus_id` bigint UNSIGNED NOT NULL,
  `route_id` bigint UNSIGNED NOT NULL,
  `days` set('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `bus_id`, `route_id`, `days`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', 1, '2024-06-05 02:24:28', '2024-06-10 20:45:35'),
(5, 6, 1, 'Friday', 1, '2024-06-05 19:31:29', '2024-06-05 19:31:29'),
(6, 7, 1, 'Sunday,Friday', 1, '2024-06-05 20:27:39', '2024-06-05 20:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Md. Chanchal Biswas', 'mchanchalbd@gmail.com', '2024-06-15 19:37:34', '$2y$12$dIDYOCl68XaGDpQDUmJMyu4edmu1nC7CeZ1O4JVVNYisjYLWEG46O', NULL, '2024-06-15 19:36:59', '2024-06-15 19:37:34'),
(3, 'Jaita', 'cncl.developer@gmail.com', '2024-06-19 18:15:17', '$2y$12$NEZRKCt1hTj9pLP/zQ1R1uWuuCdEES8WsSBv74UKKApaaBowUwHku', NULL, '2024-06-19 18:11:19', '2024-06-19 18:15:17'),
(4, 'Jaita Halder', 'jaitahalder71@gmail.com', NULL, '$2y$12$aj02.EQLcRYnwE2FRYshte7FGN.G5lgQWFER/ZdkVlR01psJ7X1Tq', 'nXHyd8EXjhVQgGqNqTI2UpoUfq0wYBx47PteBujjVXKXSfUhlxte4d3nFIAw', '2024-06-19 18:17:23', '2024-06-19 18:17:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_stops`
--
ALTER TABLE `bus_stops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_name`);

--
-- Indexes for table `sub_routes`
--
ALTER TABLE `sub_routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_routes_trip_id_foreign` (`trip_id`),
  ADD KEY `sub_routes_origin_foreign` (`origin`),
  ADD KEY `sub_routes_destination_foreign` (`destination`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_trip_id_foreign` (`trip_id`),
  ADD KEY `tickets_sub_route_id_foreign` (`sub_route_id`),
  ADD KEY `tickets_ticket_number_index` (`ticket_number`);

--
-- Indexes for table `ticket_seats`
--
ALTER TABLE `ticket_seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_seats_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trips_bus_id_foreign` (`bus_id`),
  ADD KEY `trips_route_id_foreign` (`route_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bus_stops`
--
ALTER TABLE `bus_stops`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_routes`
--
ALTER TABLE `sub_routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_seats`
--
ALTER TABLE `ticket_seats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_routes`
--
ALTER TABLE `sub_routes`
  ADD CONSTRAINT `sub_routes_destination_foreign` FOREIGN KEY (`destination`) REFERENCES `bus_stops` (`id`),
  ADD CONSTRAINT `sub_routes_origin_foreign` FOREIGN KEY (`origin`) REFERENCES `bus_stops` (`id`),
  ADD CONSTRAINT `sub_routes_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_sub_route_id_foreign` FOREIGN KEY (`sub_route_id`) REFERENCES `sub_routes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ticket_seats`
--
ALTER TABLE `ticket_seats`
  ADD CONSTRAINT `ticket_seats_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
