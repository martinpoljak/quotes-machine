-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 13, 2006 at 04:27 PM
-- Server version: 5.0.22
-- PHP Version: 5.1.4
-- 
-- Copyright © 2006 Martin Kozák (martinkozak@martinkozak.net)
-- 
-- 
-- Database: `martinkozak_net`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `quotes_machine_authors`
-- 
-- Creation: Oct 13, 2006 at 04:26 PM
-- Last update: Oct 13, 2006 at 04:26 PM
-- Last check: Oct 13, 2006 at 04:26 PM
-- 

CREATE TABLE IF NOT EXISTS `quotes_machine_authors` (
  `id` mediumint(1) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `url` varchar(256) default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
