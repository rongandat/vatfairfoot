<?php

if(!defined('_MYSQL_ENGINE_')){
	define(_MYSQL_ENGINE_,'MyISAM');
}

/*
$latest_exists = Db::getInstance()->Execute("DESCRIBE `"._DB_PREFIX_."blog_post_shop`");

if(!$latest_exists){
	//check update from old version
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_categories`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_category`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_category_lang`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_comment`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_image`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_products`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_publication`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_publication_lang`");
	Db::getInstance()->Execute("DROP TABLE `"._DB_PREFIX_."blog_related`");
}
*/

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_categories` (
                            `id_blog_post` int(10) unsigned NOT NULL,
                            `id_blog_category` int(10) unsigned NOT NULL,
                            PRIMARY KEY (`id_blog_post`,`id_blog_category`),
                            KEY `id_psblog` (`id_blog_post`)
                          ) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8;");
			
Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_category` (
                            `id_blog_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
                            `id_lang` int(10) unsigned NOT NULL DEFAULT '0',
                            `active` tinyint(1) unsigned DEFAULT '1',
                            `position` int(10) unsigned DEFAULT NULL,
                            `name` varchar(255) NOT NULL,
                            `description` text,
                            `link_rewrite` varchar(128) DEFAULT NULL,
                            `meta_keywords` varchar(255) DEFAULT NULL,
                            `meta_description` text,
                            PRIMARY KEY (`id_blog_category`)
                          ) ENGINE="._MYSQL_ENGINE_."  DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_category_shop` (
                            `id_blog_category` int(10) unsigned NOT NULL,
                            `id_shop` int(10) unsigned NOT NULL,
                            PRIMARY KEY (`id_blog_category`,`id_shop`)
                          ) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_comment` (
                            `id_blog_comment` int(10) unsigned NOT NULL AUTO_INCREMENT,
                            `id_blog_post` int(10) unsigned NOT NULL,
                            `id_customer` int(10) unsigned DEFAULT NULL,
                            `id_guest` int(10) unsigned DEFAULT NULL,
                            `id_lang` int(10) unsigned NOT NULL,
                            `id_shop` int(10) unsigned NOT NULL,
                            `customer_name` varchar(128) CHARACTER SET utf8 NOT NULL,
                            `content` text CHARACTER SET utf8 NOT NULL,
                            `date_add` datetime NOT NULL,
                            `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
                            PRIMARY KEY (`id_blog_comment`),
                            KEY `id_blog_post` (`id_blog_post`),
                            KEY `id_customer` (`id_customer`)
                          ) ENGINE="._MYSQL_ENGINE_."  DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_image` (
                            `id_blog_image` int(10) NOT NULL AUTO_INCREMENT,
                            `id_blog_post` int(10) NOT NULL,
                            `img_name` varchar(255) NOT NULL,
                            `default` tinyint(1) NOT NULL DEFAULT '0',
                            `position` int(10) unsigned NOT NULL DEFAULT '0',
                            PRIMARY KEY (`id_blog_image`)
                          ) ENGINE="._MYSQL_ENGINE_."  DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_products` (
                            `id_blog_post` int(10) unsigned NOT NULL,
                            `id_product` int(10) unsigned NOT NULL,
                            `position` tinyint(4) NOT NULL DEFAULT '1',
                            PRIMARY KEY (`id_blog_post`,`id_product`)
                          ) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_post` (
                            `id_blog_post` int(10) unsigned NOT NULL AUTO_INCREMENT,
                            `id_lang` int(10) unsigned NOT NULL DEFAULT '0',
                            `date_on` date DEFAULT NULL,
                            `status` enum('published','drafted','suspended') DEFAULT NULL,
                            `allow_comments` tinyint(1) DEFAULT '0',
                            `title` varchar(255) NOT NULL,
                            `content` text,
                            `excerpt` text,
                            `link_rewrite` varchar(128) DEFAULT NULL,
                            `meta_keywords` varchar(255) DEFAULT NULL,
                            `meta_description` text,
                            PRIMARY KEY (`id_blog_post`)
                          ) ENGINE="._MYSQL_ENGINE_."  DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_post_shop` (
                            `id_blog_post` int(10) unsigned NOT NULL,
                            `id_shop` int(10) unsigned NOT NULL,
                            PRIMARY KEY (`id_blog_post`,`id_shop`)
                          ) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."blog_related` (
                            `id_blog_post` int(10) unsigned NOT NULL,
                            `id_related_blog_post` int(10) unsigned NOT NULL
                          ) ENGINE="._MYSQL_ENGINE_." DEFAULT CHARSET=utf8;");

?>