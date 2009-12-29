-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. Dezember 2009 um 12:48
-- Server Version: 5.1.37
-- PHP-Version: 5.2.10-2ubuntu6.3

--
-- Sample data for sbmttr
--
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `sbmttr`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artists`
--

CREATE TABLE IF NOT EXISTS `artists` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8_unicode_ci,
  `picture` mediumblob,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recovery_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Used for "forgot password" function',
  `recovery_token_expires` datetime DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'When checked, artist has admin rights!',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `artists`
--

INSERT INTO `artists` (`id`, `name`, `surname`, `email`, `url`, `picture`, `password`, `recovery_token`, `recovery_token_expires`, `is_admin`) VALUES
(1, 'Admin', 'Administrator', 'admin@admin.test', '', NULL, '1e21435baaeb64ce96ac77798ce8749fa0cad5c7', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artists_pieces`
--

CREATE TABLE IF NOT EXISTS `artists_pieces` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `artist_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `piece_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `function` varchar(50) NOT NULL DEFAULT '',
  `is_main_contact` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Marks the main contact for a piece',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Linking artist and their work together. Adding their functio' AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `artists_pieces`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `iso` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `iso3` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=240 ;

--
-- Daten für Tabelle `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `iso3`, `numcode`) VALUES
(1, 'AF', 'Afghanistan', 'AFG', 4),
(2, 'AL', 'Albania', 'ALB', 8),
(3, 'DZ', 'Algeria', 'DZA', 12),
(4, 'AS', 'American Samoa', 'ASM', 16),
(5, 'AD', 'Andorra', 'AND', 20),
(6, 'AO', 'Angola', 'AGO', 24),
(7, 'AI', 'Anguilla', 'AIA', 660),
(8, 'AQ', 'Antarctica', NULL, NULL),
(9, 'AG', 'Antigua and Barbuda', 'ATG', 28),
(10, 'AR', 'Argentina', 'ARG', 32),
(11, 'AM', 'Armenia', 'ARM', 51),
(12, 'AW', 'Aruba', 'ABW', 533),
(13, 'AU', 'Australia', 'AUS', 36),
(14, 'AT', 'Austria', 'AUT', 40),
(15, 'AZ', 'Azerbaijan', 'AZE', 31),
(16, 'BS', 'Bahamas', 'BHS', 44),
(17, 'BH', 'Bahrain', 'BHR', 48),
(18, 'BD', 'Bangladesh', 'BGD', 50),
(19, 'BB', 'Barbados', 'BRB', 52),
(20, 'BY', 'Belarus', 'BLR', 112),
(21, 'BE', 'Belgium', 'BEL', 56),
(22, 'BZ', 'Belize', 'BLZ', 84),
(23, 'BJ', 'Benin', 'BEN', 204),
(24, 'BM', 'Bermuda', 'BMU', 60),
(25, 'BT', 'Bhutan', 'BTN', 64),
(26, 'BO', 'Bolivia', 'BOL', 68),
(27, 'BA', 'Bosnia and Herzegovina', 'BIH', 70),
(28, 'BW', 'Botswana', 'BWA', 72),
(29, 'BV', 'Bouvet Island', NULL, NULL),
(30, 'BR', 'Brazil', 'BRA', 76),
(31, 'IO', 'British Indian Ocean Territory', NULL, NULL),
(32, 'BN', 'Brunei Darussalam', 'BRN', 96),
(33, 'BG', 'Bulgaria', 'BGR', 100),
(34, 'BF', 'Burkina Faso', 'BFA', 854),
(35, 'BI', 'Burundi', 'BDI', 108),
(36, 'KH', 'Cambodia', 'KHM', 116),
(37, 'CM', 'Cameroon', 'CMR', 120),
(38, 'CA', 'Canada', 'CAN', 124),
(39, 'CV', 'Cape Verde', 'CPV', 132),
(40, 'KY', 'Cayman Islands', 'CYM', 136),
(41, 'CF', 'Central African Republic', 'CAF', 140),
(42, 'TD', 'Chad', 'TCD', 148),
(43, 'CL', 'Chile', 'CHL', 152),
(44, 'CN', 'China', 'CHN', 156),
(45, 'CX', 'Christmas Island', NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'CO', 'Colombia', 'COL', 170),
(48, 'KM', 'Comoros', 'COM', 174),
(49, 'CG', 'Congo', 'COG', 178),
(50, 'CD', 'Congo, the Democratic Republic of the', 'COD', 180),
(51, 'CK', 'Cook Islands', 'COK', 184),
(52, 'CR', 'Costa Rica', 'CRI', 188),
(53, 'CI', 'Cote D''Ivoire', 'CIV', 384),
(54, 'HR', 'Croatia', 'HRV', 191),
(55, 'CU', 'Cuba', 'CUB', 192),
(56, 'CY', 'Cyprus', 'CYP', 196),
(57, 'CZ', 'Czech Republic', 'CZE', 203),
(58, 'DK', 'Denmark', 'DNK', 208),
(59, 'DJ', 'Djibouti', 'DJI', 262),
(60, 'DM', 'Dominica', 'DMA', 212),
(61, 'DO', 'Dominican Republic', 'DOM', 214),
(62, 'EC', 'Ecuador', 'ECU', 218),
(63, 'EG', 'Egypt', 'EGY', 818),
(64, 'SV', 'El Salvador', 'SLV', 222),
(65, 'GQ', 'Equatorial Guinea', 'GNQ', 226),
(66, 'ER', 'Eritrea', 'ERI', 232),
(67, 'EE', 'Estonia', 'EST', 233),
(68, 'ET', 'Ethiopia', 'ETH', 231),
(69, 'FK', 'Falkland Islands (Malvinas)', 'FLK', 238),
(70, 'FO', 'Faroe Islands', 'FRO', 234),
(71, 'FJ', 'Fiji', 'FJI', 242),
(72, 'FI', 'Finland', 'FIN', 246),
(73, 'FR', 'France', 'FRA', 250),
(74, 'GF', 'French Guiana', 'GUF', 254),
(75, 'PF', 'French Polynesia', 'PYF', 258),
(76, 'TF', 'French Southern Territories', NULL, NULL),
(77, 'GA', 'Gabon', 'GAB', 266),
(78, 'GM', 'Gambia', 'GMB', 270),
(79, 'GE', 'Georgia', 'GEO', 268),
(80, 'DE', 'Germany', 'DEU', 276),
(81, 'GH', 'Ghana', 'GHA', 288),
(82, 'GI', 'Gibraltar', 'GIB', 292),
(83, 'GR', 'Greece', 'GRC', 300),
(84, 'GL', 'Greenland', 'GRL', 304),
(85, 'GD', 'Grenada', 'GRD', 308),
(86, 'GP', 'Guadeloupe', 'GLP', 312),
(87, 'GU', 'Guam', 'GUM', 316),
(88, 'GT', 'Guatemala', 'GTM', 320),
(89, 'GN', 'Guinea', 'GIN', 324),
(90, 'GW', 'Guinea-Bissau', 'GNB', 624),
(91, 'GY', 'Guyana', 'GUY', 328),
(92, 'HT', 'Haiti', 'HTI', 332),
(93, 'HM', 'Heard Island and Mcdonald Islands', NULL, NULL),
(94, 'VA', 'Holy See (Vatican City State)', 'VAT', 336),
(95, 'HN', 'Honduras', 'HND', 340),
(96, 'HK', 'Hong Kong', 'HKG', 344),
(97, 'HU', 'Hungary', 'HUN', 348),
(98, 'IS', 'Iceland', 'ISL', 352),
(99, 'IN', 'India', 'IND', 356),
(100, 'ID', 'Indonesia', 'IDN', 360),
(101, 'IR', 'Iran, Islamic Republic of', 'IRN', 364),
(102, 'IQ', 'Iraq', 'IRQ', 368),
(103, 'IE', 'Ireland', 'IRL', 372),
(104, 'IL', 'Israel', 'ISR', 376),
(105, 'IT', 'Italy', 'ITA', 380),
(106, 'JM', 'Jamaica', 'JAM', 388),
(107, 'JP', 'Japan', 'JPN', 392),
(108, 'JO', 'Jordan', 'JOR', 400),
(109, 'KZ', 'Kazakhstan', 'KAZ', 398),
(110, 'KE', 'Kenya', 'KEN', 404),
(111, 'KI', 'Kiribati', 'KIR', 296),
(112, 'KP', 'Korea, Democratic People''s Republic of', 'PRK', 408),
(113, 'KR', 'Korea, Republic of', 'KOR', 410),
(114, 'KW', 'Kuwait', 'KWT', 414),
(115, 'KG', 'Kyrgyzstan', 'KGZ', 417),
(116, 'LA', 'Lao People''s Democratic Republic', 'LAO', 418),
(117, 'LV', 'Latvia', 'LVA', 428),
(118, 'LB', 'Lebanon', 'LBN', 422),
(119, 'LS', 'Lesotho', 'LSO', 426),
(120, 'LR', 'Liberia', 'LBR', 430),
(121, 'LY', 'Libyan Arab Jamahiriya', 'LBY', 434),
(122, 'LI', 'Liechtenstein', 'LIE', 438),
(123, 'LT', 'Lithuania', 'LTU', 440),
(124, 'LU', 'Luxembourg', 'LUX', 442),
(125, 'MO', 'Macao', 'MAC', 446),
(126, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
(127, 'MG', 'Madagascar', 'MDG', 450),
(128, 'MW', 'Malawi', 'MWI', 454),
(129, 'MY', 'Malaysia', 'MYS', 458),
(130, 'MV', 'Maldives', 'MDV', 462),
(131, 'ML', 'Mali', 'MLI', 466),
(132, 'MT', 'Malta', 'MLT', 470),
(133, 'MH', 'Marshall Islands', 'MHL', 584),
(134, 'MQ', 'Martinique', 'MTQ', 474),
(135, 'MR', 'Mauritania', 'MRT', 478),
(136, 'MU', 'Mauritius', 'MUS', 480),
(137, 'YT', 'Mayotte', NULL, NULL),
(138, 'MX', 'Mexico', 'MEX', 484),
(139, 'FM', 'Micronesia, Federated States of', 'FSM', 583),
(140, 'MD', 'Moldova, Republic of', 'MDA', 498),
(141, 'MC', 'Monaco', 'MCO', 492),
(142, 'MN', 'Mongolia', 'MNG', 496),
(143, 'MS', 'Montserrat', 'MSR', 500),
(144, 'MA', 'Morocco', 'MAR', 504),
(145, 'MZ', 'Mozambique', 'MOZ', 508),
(146, 'MM', 'Myanmar', 'MMR', 104),
(147, 'NA', 'Namibia', 'NAM', 516),
(148, 'NR', 'Nauru', 'NRU', 520),
(149, 'NP', 'Nepal', 'NPL', 524),
(150, 'NL', 'Netherlands', 'NLD', 528),
(151, 'AN', 'Netherlands Antilles', 'ANT', 530),
(152, 'NC', 'New Caledonia', 'NCL', 540),
(153, 'NZ', 'New Zealand', 'NZL', 554),
(154, 'NI', 'Nicaragua', 'NIC', 558),
(155, 'NE', 'Niger', 'NER', 562),
(156, 'NG', 'Nigeria', 'NGA', 566),
(157, 'NU', 'Niue', 'NIU', 570),
(158, 'NF', 'Norfolk Island', 'NFK', 574),
(159, 'MP', 'Northern Mariana Islands', 'MNP', 580),
(160, 'NO', 'Norway', 'NOR', 578),
(161, 'OM', 'Oman', 'OMN', 512),
(162, 'PK', 'Pakistan', 'PAK', 586),
(163, 'PW', 'Palau', 'PLW', 585),
(164, 'PS', 'Palestinian Territory, Occupied', NULL, NULL),
(165, 'PA', 'Panama', 'PAN', 591),
(166, 'PG', 'Papua New Guinea', 'PNG', 598),
(167, 'PY', 'Paraguay', 'PRY', 600),
(168, 'PE', 'Peru', 'PER', 604),
(169, 'PH', 'Philippines', 'PHL', 608),
(170, 'PN', 'Pitcairn', 'PCN', 612),
(171, 'PL', 'Poland', 'POL', 616),
(172, 'PT', 'Portugal', 'PRT', 620),
(173, 'PR', 'Puerto Rico', 'PRI', 630),
(174, 'QA', 'Qatar', 'QAT', 634),
(175, 'RE', 'Reunion', 'REU', 638),
(176, 'RO', 'Romania', 'ROM', 642),
(177, 'RU', 'Russian Federation', 'RUS', 643),
(178, 'RW', 'Rwanda', 'RWA', 646),
(179, 'SH', 'Saint Helena', 'SHN', 654),
(180, 'KN', 'Saint Kitts and Nevis', 'KNA', 659),
(181, 'LC', 'Saint Lucia', 'LCA', 662),
(182, 'PM', 'Saint Pierre and Miquelon', 'SPM', 666),
(183, 'VC', 'Saint Vincent and the Grenadines', 'VCT', 670),
(184, 'WS', 'Samoa', 'WSM', 882),
(185, 'SM', 'San Marino', 'SMR', 674),
(186, 'ST', 'Sao Tome and Principe', 'STP', 678),
(187, 'SA', 'Saudi Arabia', 'SAU', 682),
(188, 'SN', 'Senegal', 'SEN', 686),
(189, 'CS', 'Serbia and Montenegro', NULL, NULL),
(190, 'SC', 'Seychelles', 'SYC', 690),
(191, 'SL', 'Sierra Leone', 'SLE', 694),
(192, 'SG', 'Singapore', 'SGP', 702),
(193, 'SK', 'Slovakia', 'SVK', 703),
(194, 'SI', 'Slovenia', 'SVN', 705),
(195, 'SB', 'Solomon Islands', 'SLB', 90),
(196, 'SO', 'Somalia', 'SOM', 706),
(197, 'ZA', 'South Africa', 'ZAF', 710),
(198, 'GS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
(199, 'ES', 'Spain', 'ESP', 724),
(200, 'LK', 'Sri Lanka', 'LKA', 144),
(201, 'SD', 'Sudan', 'SDN', 736),
(202, 'SR', 'Suriname', 'SUR', 740),
(203, 'SJ', 'Svalbard and Jan Mayen', 'SJM', 744),
(204, 'SZ', 'Swaziland', 'SWZ', 748),
(205, 'SE', 'Sweden', 'SWE', 752),
(206, 'CH', 'Switzerland', 'CHE', 756),
(207, 'SY', 'Syrian Arab Republic', 'SYR', 760),
(208, 'TW', 'Taiwan, Province of China', 'TWN', 158),
(209, 'TJ', 'Tajikistan', 'TJK', 762),
(210, 'TZ', 'Tanzania, United Republic of', 'TZA', 834),
(211, 'TH', 'Thailand', 'THA', 764),
(212, 'TL', 'Timor-Leste', NULL, NULL),
(213, 'TG', 'Togo', 'TGO', 768),
(214, 'TK', 'Tokelau', 'TKL', 772),
(215, 'TO', 'Tonga', 'TON', 776),
(216, 'TT', 'Trinidad and Tobago', 'TTO', 780),
(217, 'TN', 'Tunisia', 'TUN', 788),
(218, 'TR', 'Turkey', 'TUR', 792),
(219, 'TM', 'Turkmenistan', 'TKM', 795),
(220, 'TC', 'Turks and Caicos Islands', 'TCA', 796),
(221, 'TV', 'Tuvalu', 'TUV', 798),
(222, 'UG', 'Uganda', 'UGA', 800),
(223, 'UA', 'Ukraine', 'UKR', 804),
(224, 'AE', 'United Arab Emirates', 'ARE', 784),
(225, 'GB', 'United Kingdom', 'GBR', 826),
(226, 'US', 'United States', 'USA', 840),
(227, 'UM', 'United States Minor Outlying Islands', NULL, NULL),
(228, 'UY', 'Uruguay', 'URY', 858),
(229, 'UZ', 'Uzbekistan', 'UZB', 860),
(230, 'VU', 'Vanuatu', 'VUT', 548),
(231, 'VE', 'Venezuela', 'VEN', 862),
(232, 'VN', 'Viet Nam', 'VNM', 704),
(233, 'VG', 'Virgin Islands, British', 'VGB', 92),
(234, 'VI', 'Virgin Islands, U.s.', 'VIR', 850),
(235, 'WF', 'Wallis and Futuna', 'WLF', 876),
(236, 'EH', 'Western Sahara', 'ESH', 732),
(237, 'YE', 'Yemen', 'YEM', 887),
(238, 'ZM', 'Zambia', 'ZMB', 894),
(239, 'ZW', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `piece_id` smallint(6) NOT NULL DEFAULT '0',
  `content` mediumblob NOT NULL,
  `name` text NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Images related to a piece.' AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `pictures`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pieces`
--

CREATE TABLE IF NOT EXISTS `pieces` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `original_title` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `english_title` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Key for the work typ, e.g. film, lecture, installation',
  `synopsis` text CHARACTER SET latin1 NOT NULL,
  `section_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Key for which festival section the work was submitted',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the work was selected to be shown',
  `notes_team` text CHARACTER SET latin1 COMMENT 'Notes by the festival team',
  `notes_artist` text CHARACTER SET latin1 COMMENT 'Notes by the artist',
  `production_year` year(4) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `shooting_format_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Key to the format a film was shot in',
  `country_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `genre` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `shown_before` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `preview_how` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `preview_url` text CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `pieces`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pieces_screening_formats`
--

CREATE TABLE IF NOT EXISTS `pieces_screening_formats` (
  `piece_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `screening_format_id` smallint(5) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Keys to link available screening formats to a film';

--
-- Daten für Tabelle `pieces_screening_formats`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pieces_tags`
--

CREATE TABLE IF NOT EXISTS `pieces_tags` (
  `piece_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag_id` smallint(5) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Key for linking tags to pieces';

--
-- Daten für Tabelle `pieces_tags`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `requirements`
--

CREATE TABLE IF NOT EXISTS `requirements` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` smallint(6) NOT NULL DEFAULT '0',
  `info_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `kind` int(11) NOT NULL DEFAULT '0',
  `detailed_description` text COLLATE utf8_unicode_ci COMMENT 'Help text for this field for this type',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Which piece info is required for the different types' AUTO_INCREMENT=32 ;

--
-- Daten für Tabelle `requirements`
--

INSERT INTO `requirements` (`id`, `type_id`, `info_title`, `kind`, `detailed_description`) VALUES
(1, 1, 'original_title', 1, 'The title of your film in the language is was originally published in'),
(2, 1, 'english_title', 2, 'An english translation of the film title'),
(3, 1, 'production_year', 2, 'The year the film was finished'),
(4, 1, 'synopsis', 2, 'Please briefly outline the content of your film.'),
(5, 1, 'genre', 2, 'Please enter a genre you think your film belongs to. Examples: Coming of age, Thriller, Kindergarten-Drama'),
(6, 1, 'shown_before', 1, 'Please make a list of public screenings of your film that have taken place so far. Don''t worry, we don''t care if it has been submitted to 100 other festivals, too.'),
(7, 1, 'duration', 2, 'The running length of your film, including credits.'),
(8, 1, 'notes_artist', 1, 'Is there anything special we should know?'),
(9, 1, 'shooting_format_id', 2, NULL),
(29, 1, 'ScreeningFormat', 1, 'Please tick all screening formats that you could provide for cinema screening. At least one format is required.'),
(11, 1, 'country_id', 2, 'Please select the country where the film was produced. If this does not apply, enter the country where the director lives and/or studies'),
(12, 1, 'preview_how', 2, NULL),
(13, 1, 'preview_url', 1, NULL),
(14, 2, 'original_title', 2, 'Please enter the title of your lecture'),
(15, 2, 'duration', 0, NULL),
(16, 2, 'production_year', 0, NULL),
(17, 2, 'synopsis', 2, 'Please give us a short abstract of your lecture'),
(18, 2, 'genre', 0, NULL),
(19, 2, 'shown_before', 0, NULL),
(20, 2, 'english_title', 0, NULL),
(21, 2, 'notes_artist', 1, 'Is there anything else we need to know?'),
(22, 2, 'ScreeningFormat', 0, ''),
(23, 2, 'shooting_format_id', 0, NULL),
(24, 2, 'preview_how', 0, NULL),
(25, 2, 'preview_url', 0, NULL),
(26, 2, 'country_id', 2, 'Please select the country where you are currently doing your research'),
(27, 1, 'section_id', 2, 'Into which festival section do you want to submit your film?'),
(28, 2, 'section_id', 2, 'Please select the Festival section you want to submit your work to.'),
(30, 1, 'Pictures', 1, 'You can upload one or more still images from your film (one at a time).'),
(31, 2, 'Pictures', 0, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `screening_formats`
--

CREATE TABLE IF NOT EXISTS `screening_formats` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Selection of screening formats for a film' AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `screening_formats`
--

INSERT INTO `screening_formats` (`id`, `name`) VALUES
(1, 'HD File'),
(2, 'DVD'),
(3, '35mm'),
(4, '16mm');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `searches`
--

CREATE TABLE IF NOT EXISTS `searches` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This table allows the user to save search queries for later ' AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `searches`
--

INSERT INTO `searches` (`id`, `title`, `params`) VALUES
(1, 'All Lectures', 'type_id:2'),
(4, 'All pieces with test title', 'any_title:test'),
(5, 'All works with "what" in the title', 'any_title:what'),
(6, 'Films with "and" in the title', 'type_id:1/any_title:and');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `opening_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `closing_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type_id` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Reference to the media type that is allowed in this section',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Listing of the different sections of a festival, including d' AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `sections`
--

INSERT INTO `sections` (`id`, `title`, `opening_date`, `closing_date`, `description`, `type_id`) VALUES
(1, 'Short Films 2010', '2009-05-13 21:23:00', '2009-08-13 21:23:00', 'Short Film Competition', 1),
(2, 'Conference 2030', '2009-08-13 21:23:00', '2009-11-13 21:23:00', 'A meeting on future things.', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shooting_formats`
--

CREATE TABLE IF NOT EXISTS `shooting_formats` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Selection of film formats' AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `shooting_formats`
--

INSERT INTO `shooting_formats` (`id`, `name`) VALUES
(1, '16mm'),
(4, '35mm'),
(5, 'HD Video'),
(6, 'SD Video');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `tags`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `terms` text COLLATE utf8_unicode_ci COMMENT 'Terms and conditions to submit work of this kind',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Listing of available work types, e.g. film, lecture, install' AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `types`
--

INSERT INTO `types` (`id`, `title`, `terms`) VALUES
(1, 'Film', 'These are the english conditions for a film. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi consectetur ante elementum purus vehicula eget ullamcorper nibh fermentum. In dolor nisl, interdum id laoreet ac, pulvinar sit amet est. Fusce scelerisque hendrerit placerat. Ut sem nisl, rhoncus ornare commodo sed, ornare nec ante. Pellentesque gravida, velit eget pulvinar aliquet, metus mi sodales mi, in pulvinar urna dui eget nunc. Morbi ullamcorper augue in lorem tristique malesuada. Nulla fringilla porta imperdiet. Duis viverra risus sed lorem placerat iaculis. Sed accumsan neque sit amet lorem dictum porttitor. Aliquam et est non libero tristique sollicitudin. Etiam fermentum lectus vitae est ultrices vel accumsan nibh fermentum. Phasellus a sapien purus, quis molestie felis. Vivamus ornare vulputate justo iaculis vestibulum. Curabitur nec lorem ut dolor pretium placerat. Donec id pretium metus. Fusce euismod ornare neque vel adipiscing. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel dolor sit amet ipsum viverra lacinia. Phasellus enim velit, pretium non lacinia id, mattis suscipit sem. Maecenas ac mauris eu arcu ullamcorper venenatis. '),
(2, 'Lecture', 'Terms for submitting a lecture. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi consectetur ante elementum purus vehicula eget ullamcorper nibh fermentum. In dolor nisl, interdum id laoreet ac, pulvinar sit amet est. Fusce scelerisque hendrerit placerat. Ut sem nisl, rhoncus ornare commodo sed, ornare nec ante. Pellentesque gravida, velit eget pulvinar aliquet, metus mi sodales mi, in pulvinar urna dui eget nunc. Morbi ullamcorper augue in lorem tristique malesuada. Nulla fringilla porta imperdiet. Duis viverra risus sed lorem placerat iaculis. Sed accumsan neque sit amet lorem dictum porttitor. Aliquam et est non libero tristique sollicitudin. Etiam fermentum lectus vitae est ultrices vel accumsan nibh fermentum. Phasellus a sapien purus, quis molestie felis. Vivamus ornare vulputate justo iaculis vestibulum. Curabitur nec lorem ut dolor pretium placerat. Donec id pretium metus. Fusce euismod ornare neque vel adipiscing. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel dolor sit amet ipsum viverra lacinia. Phasellus enim velit, pretium non lacinia id, mattis suscipit sem. Maecenas ac mauris eu arcu ullamcorper venenatis. ');
