-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: project
-- ------------------------------------------------------
-- Server version	8.0.37



CREATE TABLE `topics` (
  `SNO` int NOT NULL,
  `TOPIC` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SNO`)
) ;

INSERT INTO `topics` VALUES (1,'STPI'),(2,'ESC'),(3,'NASSCOM'),(4,'Meity Startup Hub'),(5,'NeGD'),(6,'Tamil Nadu Governance agency'),(7,'IIIt Hyderabad');

