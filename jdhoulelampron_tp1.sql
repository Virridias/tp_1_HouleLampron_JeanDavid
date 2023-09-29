SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de données : `jdhoulelampron_tp1`


-- Structure de la table `film`

create table `film` (
    `id` int(11) not null primary key auto_increment,
    `titre` varchar(255) default null,
    `annee_difusion` int(11) default null,
    `genre` varchar(50) default null,
    `directeur` varchar(50) default null
)