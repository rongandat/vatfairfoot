<?php

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."news` (
  `id_news` int(10) NOT NULL AUTO_INCREMENT,
  `active` tinyint(4) NOT NULL,
  `position` int(10) NOT NULL,
  `youtube_id` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."news_lang` (
  `id_news` int(10) NOT NULL,
  `id_lang` int(10) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `link_rewrite` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_news`,`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");