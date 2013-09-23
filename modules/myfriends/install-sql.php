<?php

if (!defined('_MYSQL_ENGINE_')) {
    define(_MYSQL_ENGINE_, 'MyISAM');
}

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "friend` (
                            `id_friend` int(10) NOT NULL AUTO_INCREMENT,
                            `active` tinyint(1) NOT NULL,
                            `date_add` datetime NOT NULL,
                            `date_upd` datetime NOT NULL,
                            `position` int(11) NOT NULL,
                            `name` varchar(128) NOT NULL,
                            `website` text NULL,
                            `facebook` text NULL,
                            PRIMARY KEY (`id_friend`)
                          ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;");

Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "friend_data` (
                            `id_friend_data` int(10) NOT NULL AUTO_INCREMENT,
                            `id_friend` int(10) NOT NULL,
                            `active` tinyint(1) NOT NULL,
                            `youtube_id` text NOT NULL,                            
                            `date_add` datetime NOT NULL,
                            `date_upd` datetime NOT NULL,
                            `position` int(10) NOT NULL,
                            PRIMARY KEY (`id_friend_data`)
                          ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;");
Db::getInstance()->Execute("CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "friend_data_lang` (
                            `id_friend_data_lang` int(10) NOT NULL AUTO_INCREMENT,
                            `id_friend_data` int(10) NOT NULL,
                            `id_lang` int(11) NOT NULL,
                            `title` varchar(255) NOT NULL,                                                     
                            PRIMARY KEY (`id_friend_data_lang`)
                          ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;");

?>