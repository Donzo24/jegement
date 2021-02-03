-- phpMyAdmin SQL Dump
-- version 4.9.7deb1bionic1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 03 fév. 2021 à 14:34
-- Version du serveur :  5.7.32-0ubuntu0.18.04.1
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `casier`
--

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id_document`, `nom`, `template`, `slug`, `variables`, `datas`) VALUES
(1, 'Jugement supletif', 'public/templates/jugement-supletif-template.bin', 'jugement-supletif', 'date_jour:Date du jour\r\netat_civil:Etat civil\r\ndate_requete: Date de requete\r\nsexe_requerant:Civilite du requerant\r\nrequerant:Prenom et Nom/Profession/Adresse\r\nsexe: Civilite (Mr/Mme)\r\nnom:Nom\r\nprenom:Prenom\r\ndate_naissance:Date de naissance\r\nlieu_naissance:Lieu de naissance\r\npere:Prenon du pere\r\nmere:Prenom et nom de la mere\r\ntemoin_1: Temoin 1 Mr/MMe Nom, Prenom, Profession, Adresse\r\ntemoin_2: Temoin 2 Mr/Mme Nom, Prenom, Profession, Adresse', 'etat_civil:Matam-Conakry\r\ntribunal:CONAKRY III- MAFANCO\r\npremier_signataire:Youssouf\r\nsecond_secondaire:Donzo\r\nparticipant_1:Madame  Lamarana DIALLO\r\nparticipant_2:Madame  Josephine  Loly TINKIANO\r\nparticipant_3:Monsieur  Lonceny  KANDE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
