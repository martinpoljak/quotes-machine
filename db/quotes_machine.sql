-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 13, 2006 at 04:33 PM
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
-- Table structure for table `quotes_machine`
-- 
-- Creation: Sep 20, 2006 at 09:06 PM
-- Last update: Oct 12, 2006 at 09:47 PM
-- 

CREATE TABLE IF NOT EXISTS `quotes_machine` (
  `id` mediumint(1) unsigned NOT NULL auto_increment,
  `author` varchar(200) default NULL,
  `body` varchar(2500) NOT NULL,
  `url` varchar(5096) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=197 ;
