<?php

if (!defined('_MYSQL_ENGINE_')) {
    define(_MYSQL_ENGINE_, 'MyISAM');
}

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "video_cat` (
                            `id_video_cat` int(10) NOT NULL AUTO_INCREMENT,
                            `active` tinyint(1) NOT NULL,
                            `date_add` datetime NOT NULL,
                            `date_upd` datetime NOT NULL,
                            `position` int(11) NOT NULL,
                            PRIMARY KEY (`id_video_cat`)
                          ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "video_cat_lang` (
                            `id_video_cat_lang` int(11) NOT NULL AUTO_INCREMENT,
                            `id_video_cat` int(11) NOT NULL,
                            `id_lang` int(11) NOT NULL,
                            `name` varchar(128) NOT NULL,
                            `description` text NOT NULL,
                            PRIMARY KEY (`id_video_cat_lang`)
                          ) ENGINE=" . _MYSQL_ENGINE_ . "  DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "video` (
                            `id_video` int(10) NOT NULL AUTO_INCREMENT,
                            `id_video_cat` int(10) NOT NULL,
                            `active` tinyint(1) NOT NULL,
                            `youtube_id` text NOT NULL,                            
                            `date_add` datetime NOT NULL,
                            `date_upd` datetime NOT NULL,
                            `position` int(10) NOT NULL,
                            PRIMARY KEY (`id_video`)
                          ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "video_lang` (
                            `id_video_lang` int(11) NOT NULL AUTO_INCREMENT,
                            `id_video` int(11) NOT NULL,
                            `id_lang` int(11) NOT NULL,
                            `title` varchar(255) NOT NULL,
                            `description` text NOT NULL,
                            PRIMARY KEY (`id_video_lang`)
                          ) ENGINE=" . _MYSQL_ENGINE_ . "  DEFAULT CHARSET=utf8;");
?>