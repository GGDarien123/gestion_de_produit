CREATE DATABASE gestion_produits;
USE gestion_produits;
CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,                 
    prix DECIMAL(10, 2) NOT NULL,
    quantite INT DEFAULT 0         
);
