-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : lun. 04 nov. 2024 à 16:48
-- Version du serveur : 5.7.44
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  `song_number` int(11) NOT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`id`, `titre`, `auteur`, `disponible`, `song_number`, `editor`) VALUES
(25, 'Thriller', 'Michael Jackson', 1, 9, 'Pop'),
(26, 'Back in Black', 'AC/DC', 1, 10, 'Rock'),
(27, 'The Dark Side of the Moon', 'Pink Floyd', 1, 10, 'Rock'),
(28, 'The Wall', 'Pink Floyd', 0, 26, 'Rock'),
(29, 'Abbey Road', 'The Beatles', 1, 17, 'Rock'),
(30, 'Hotel California', 'Eagles', 1, 9, 'Rock'),
(31, '1989', 'Taylor Swift', 0, 13, 'Pop'),
(32, 'Rumours', 'Fleetwood Mac', 1, 11, 'Rock'),
(33, 'Led Zeppelin IV', 'Led Zeppelin', 1, 8, 'Rock'),
(34, 'Purple Rain', 'Prince', 1, 9, 'Pop'),
(35, 'Born to Die', 'Lana Del Rey', 1, 12, 'Indie Pop'),
(36, 'Nevermind', 'Nirvana', 0, 12, 'Grunge'),
(37, 'Hounds of Love', 'Kate Bush', 1, 12, 'Alternative'),
(38, 'Random Access Memories', 'Daft Punk', 1, 13, 'Electronic'),
(39, '25', 'Adele', 1, 11, 'Pop'),
(40, 'OK Computer', 'Radiohead', 1, 12, 'Alternative'),
(41, 'In the Aeroplane Over the Sea', 'Neutral Milk Hotel', 0, 11, 'Indie'),
(42, 'American Idiot', 'Green Day', 1, 13, 'Punk Rock'),
(43, 'Born This Way', 'Lady Gaga', 1, 14, 'Pop'),
(44, 'Songs in the Key of Life', 'Stevie Wonder', 1, 21, 'Soul');

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `disponible` tinyint(1) DEFAULT '1',
  `page_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `titre`, `auteur`, `disponible`, `page_number`) VALUES
(34, 'To Kill a Mockingbird test', 'Harper Lee', 1, 300),
(35, '1984', 'George Orwell', 1, 328),
(36, 'Pride and Prejudice', 'Jane Austen', 1, 279),
(37, 'The Great Gatsby', 'F. Scott Fitzgerald', 1, 180),
(38, 'Moby-Dick', 'Herman Melville', 0, 635),
(39, 'War and Peace', 'Leo Tolstoy', 1, 1225),
(40, 'Crime and Punishment', 'Fyodor Dostoevsky', 0, 671),
(41, 'The Catcher in the Rye', 'J.D. Salinger', 1, 214),
(42, 'The Odyssey', 'Homer', 1, 541),
(43, 'Brave New World', 'Aldous Huxley', 1, 288),
(44, 'The Lord of the Rings', 'J.R.R. Tolkien', 0, 1178),
(45, 'Jane Eyre', 'Charlotte Brontë', 1, 500),
(46, 'Animal Farm', 'George Orwell', 1, 112),
(47, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 1, 796),
(48, 'Wuthering Heights', 'Emily Brontë', 0, 416),
(49, 'The Hobbit', 'J.R.R. Tolkien', 1, 310),
(50, 'Fahrenheit 451', 'Ray Bradbury', 1, 194),
(51, 'Les Misérables', 'Victor Hugo', 1, 1232),
(52, 'The Divine Comedy', 'Dante Alighieri', 0, 798),
(53, 'Dracula', 'Bram Stoker', 1, 418);

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  `duration` float NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `titre`, `auteur`, `disponible`, `duration`, `genre`) VALUES
(33, 'The Shawshank Redemption', 'Frank Darabont', 1, 2.2, 'Drama'),
(34, 'The Godfather', 'Francis Ford Coppola', 1, 2.9, 'Crime'),
(35, 'The Dark Knight', 'Christopher Nolan', 1, 2.3, 'Action'),
(36, 'Pulp Fiction', 'Quentin Tarantino', 0, 2.5, 'Crime'),
(37, 'Forrest Gump', 'Robert Zemeckis', 1, 2.2, 'Drama'),
(38, 'Inception', 'Christopher Nolan', 1, 2.5, 'Science Fiction'),
(39, 'Fight Club', 'David Fincher', 0, 2.3, 'Drama'),
(40, 'The Matrix', 'The Wachowskis', 1, 2.2, 'Science Fiction'),
(41, 'Goodfellas', 'Martin Scorsese', 1, 2.5, 'Crime'),
(42, 'The Silence of the Lambs', 'Jonathan Demme', 1, 2, 'Crime'),
(43, 'Schindler\'s List', 'Steven Spielberg', 1, 3.2, 'Drama'),
(44, 'The Green Mile', 'Frank Darabont', 1, 3, 'Drama'),
(45, 'Interstellar', 'Christopher Nolan', 1, 2.9, 'Science Fiction'),
(46, 'Se7en', 'David Fincher', 0, 2.1, 'Crime'),
(47, 'Gladiator', 'Ridley Scott', 1, 2.5, 'Action'),
(48, 'Jurassic Park', 'Steven Spielberg', 1, 2.1, 'Aventure'),
(49, 'The Lord of the Rings: The Fellowship of the Ring', 'Peter Jackson', 0, 2.9, 'Aventure'),
(50, 'The Lion King', 'Roger Allers', 1, 1.8, 'Aventure'),
(51, 'Titanic', 'James Cameron', 0, 3.2, 'Romance'),
(52, 'Saving Private Ryan', 'Steven Spielberg', 1, 2.9, 'Action');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
