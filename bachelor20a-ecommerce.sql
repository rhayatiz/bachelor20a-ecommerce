-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 mai 2021 à 11:29
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bachelor20a-ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `libelle` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `libelle`) VALUES
(1, 'Tshirt'),
(5, 'Casquettes'),
(8, 'Libelletes');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `number` int(50) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `card` varchar(128) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `number`, `prenom`, `nom`, `adresse`, `mail`, `card`, `total`) VALUES
(12, 1615137583, 'rhayati', 'zakaria', 'adresse', 'rhayatiz@mail', '1231 2312 3212 1233', 203.96),
(13, 1615140186, 'zakaria', 'rhayati', '123', 'a@c', '1231 3212 3311 3212', 50.99),
(14, 1615141078, 'a', 'aa', 'a', 'a', '9999 9999 9999 9999', 254.95),
(15, 1615141394, 'a', 'a', 'a', 'a', '1231 2312 3123 1221', 50.99),
(16, 1615141693, 'a', 'a', 'aa', 'a', '1222 2222 2222 2222', 203.96),
(17, 1615143310, 'za', 'za', 'za', 'za', '1231 2312 3131 2333', 305.94),
(18, 1615143389, 'a', 'a', 'a', 'a', '2222 2222 2222 2222', 509.9),
(19, 1615143450, 'a', 'a', 'a', 'a', '2222 2222 2222 2222', 0),
(20, 1615143474, 'a', 'a', 'a', 'a', '2333 3232 3223 2323', 356.93),
(21, 1615144346, 'a', 'a', 'a', 'a', '3333 3333 3333 3333', 1274.75),
(22, 1617980431, 'zaki', 'miyazaki', 'nullepar', 'zakimayki@yopmail.com', '1230 9231 9899 3828', 1000410);

-- --------------------------------------------------------

--
-- Structure de la table `orders_produits`
--

CREATE TABLE `orders_produits` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders_produits`
--

INSERT INTO `orders_produits` (`id`, `order_id`, `produit_id`, `quantite`) VALUES
(1, 12, 11, 4),
(2, 13, 11, 1),
(3, 14, 6, 5),
(4, 15, 6, 1),
(5, 16, 6, 4),
(6, 17, 11, 6),
(7, 18, 6, 10),
(8, 20, 6, 7),
(9, 21, 11, 25),
(10, 22, 13, 1),
(11, 22, 6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `libelle` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `libelle`, `description`, `stock`, `img`, `prix`, `categorie_id`) VALUES
(6, 'Casquette polo noir', 'Casquette type bob polo noir', 5, '1615076981polohat.png', 50.99, 1),
(11, 'TSHIRT Lacoste ROUGE', 'Tshirt rouge 100% cotton', 23, '1615122090lacoste_rouge.png', 50.99, 1),
(13, 'Doge T-shirt', 'Wow  so rare', 2, '1615074033doge_shirt.png', 199.99, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `email` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `login`, `password`, `isAdmin`, `email`) VALUES
(1, 'Maynard Keynes', 'John', 'admin', '4297f44b13955235245b2497399d7a93', 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders_produits`
--
ALTER TABLE `orders_produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produit_id` (`produit_id`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produits_categorie_id` (`categorie_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `orders_produits`
--
ALTER TABLE `orders_produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders_produits`
--
ALTER TABLE `orders_produits`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_produit_id` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_produits_categorie_id` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
