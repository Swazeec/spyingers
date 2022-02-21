CREATE DATABASE IF NOT EXISTS spyingers DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
USE spyingers;
SET default_storage_engine = InnoDB;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(60) NOT NULL,
    password VARCHAR(60) NOT NULL,
    creationDate DATE NOT NULL
) engine = innodb;

CREATE TABLE IF NOT EXISTS countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) engine = innodb;

CREATE TABLE IF NOT EXISTS safehouseTypes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) engine = innodb;


CREATE TABLE IF NOT EXISTS status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) engine = innodb;

CREATE TABLE IF NOT EXISTS missionTypes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) engine = innodb;

CREATE TABLE IF NOT EXISTS specialities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
) engine = innodb;

CREATE TABLE IF NOT EXISTS nationalities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country_id INT UNIQUE,
    FOREIGN KEY (country_id) REFERENCES countries(id)
) engine = innodb;

CREATE TABLE IF NOT EXISTS missions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    codename VARCHAR(50) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    missionType_id INT NOT NULL,
    status_id INT NOT NULL,
    country_id INT NOT NULL,
    speciality_id INT NOT NULL,
    FOREIGN KEY (missionType_id) REFERENCES missionTypes(id),
    FOREIGN KEY (status_id) REFERENCES status(id),
    FOREIGN KEY (country_id) REFERENCES countries(id),
    FOREIGN KEY (speciality_id) REFERENCES specialities(id)
) engine = innoDB;


CREATE TABLE IF NOT EXISTS safehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL,
    address VARCHAR(100) NOT NULL,
    postalCode VARCHAR(10) NOT NULL,
    city VARCHAR(100) NOT NULL,
    SHType_id INT NOT NULL,
    country_id INT NOT NULL,
    mission_id INT,
    FOREIGN KEY (SHType_id) REFERENCES safehouseTypes(id),
    FOREIGN KEY (country_id) REFERENCES countries(id),
    FOREIGN KEY (mission_id) REFERENCES missions(id)
) engine = innodb;

CREATE TABLE IF NOT EXISTS targets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    codename VARCHAR(50) NOT NULL,
    nationality_id INT NOT NULL,
    mission_id INT,
    FOREIGN KEY (nationality_id) REFERENCES nationalities(id),
    FOREIGN KEY (mission_id) REFERENCES missions(id)
) engine = innodb;

CREATE TABLE IF NOT EXISTS agents(
    id INT AUTO_INCREMENT PRIMARY KEY,
    idcode CHAR(36) NOT NULL, -- INSERT INTO agents VALUES (uuid())
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    nationality_id INT NOT NULL,
    FOREIGN KEY (nationality_id) REFERENCES nationalities(id)
) engine = innoDB;

CREATE TABLE IF NOT EXISTS agents_missions(
    agent_id INT NOT NULL,
    mission_id INT NOT NULL,
    PRIMARY KEY (agent_id, mission_id),
    FOREIGN KEY (agent_id) REFERENCES agents(id),
    FOREIGN KEY (mission_id) REFERENCES missions(id)
);

CREATE TABLE IF NOT EXISTS agents_specialities(
    agent_id INT NOT NULL,
    speciality_id INT NOT NULL,
    PRIMARY KEY (agent_id, speciality_id),
    FOREIGN KEY (agent_id) REFERENCES agents(id),
    FOREIGN KEY (speciality_id) REFERENCES specialities(id)
) engine = InnoDB;


CREATE TABLE IF NOT EXISTS contacts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    codename VARCHAR(100) NOT NULL,
    nationality_id INT NOT NULL,
    FOREIGN KEY (nationality_id) REFERENCES nationalities(id)
) engine = innoDB;

CREATE TABLE IF NOT EXISTS contacts_missions(
    contact_id INT NOT NULL,
    mission_id INT NOT NULL,
    PRIMARY KEY (contact_id, mission_id),
    FOREIGN KEY (contact_id) REFERENCES contacts(id),
    FOREIGN KEY (mission_id) REFERENCES missions(id)
);

# INSERTION DE DONNEES :

## ajout des admins
INSERT INTO admins (firstname, lastname, email, password, creationDate) VALUES ('Sile', 'Altham', 'saltham0@cloudflare.com', '$2y$10$7q0J0LbnKWu6IkgDqfX3QOCh2gLaM0tjFYaTD/TFBCdsNDqYUgDE2', '2021-04-24');
INSERT INTO admins (firstname, lastname, email, password, creationDate) VALUES ('Christye', 'Paschke', 'cpaschke1@theglobeandmail.com', '$2y$10$UMBXxDdjAP4mvQTxnR4q1urwEu4vVJrQ4KBQ370Q8gWl2zv8X.qki', '2021-05-11');
INSERT INTO admins (firstname, lastname, email, password, creationDate) VALUES ('Sollie', 'Hallstone', 'shallstone2@simplemachines.org', '$2y$10$Yv/5cw0OiaVFFtDrDqpEJOpboxG5WgxgOReMTJs.ULI2r7S9TCg8e', '2021-09-14');
INSERT INTO admins (firstname, lastname, email, password, creationDate) VALUES ('Barnard', 'Spellard', 'bspellard3@fastcompany.com', '$2y$10$32/BsAOXsJS9ctIU1ONhvO3oorPCss0Si5MrRZcTtDrK5ThnEEr8.', '2021-07-31');
INSERT INTO admins (firstname, lastname, email, password, creationDate) VALUES ('Vitoria', 'Abramovitch', 'vabramovitch4@psu.edu', '$2y$10$W1wtFnpzW9yIPGKNiZX9dekKxM6S29MVy1SjzEem4UtPzBQVQfdDq', '2021-07-11');

## ajout des pays
INSERT INTO countries (name) VALUES ('France');
INSERT INTO countries (name) VALUES ('Allemagne');
INSERT INTO countries (name) VALUES ('Italie');
INSERT INTO countries (name) VALUES ('Russie');
INSERT INTO countries (name) VALUES ('Chine');
INSERT INTO countries (name) VALUES ('USA');
INSERT INTO countries (name) VALUES ('Canada');
INSERT INTO countries (name) VALUES ('Espagne');
INSERT INTO countries (name) VALUES ('Angleterre');

## ajout des types de planques
INSERT INTO safehouseTypes (name) VALUES ('maison');
INSERT INTO safehouseTypes (name) VALUES ('appartement');
INSERT INTO safehouseTypes (name) VALUES ('abri atomique');
INSERT INTO safehouseTypes (name) VALUES ('chalet');

## ajout des status
INSERT INTO status (name) VALUES ('En préparation');
INSERT INTO status (name) VALUES ('En cours');
INSERT INTO status (name) VALUES ('Terminé');
INSERT INTO status (name) VALUES ('Échec');

## ajout des spécialités
INSERT INTO specialities (name) VALUES ('Infiltration');
INSERT INTO specialities (name) VALUES ('Cyber-renseignement');
INSERT INTO specialities (name) VALUES ('Décryptage et analyse de données');
INSERT INTO specialities (name) VALUES ('Traduction');
INSERT INTO specialities (name) VALUES ('Interrogatoire');
INSERT INTO specialities (name) VALUES ('Piratage');


## ajout des types de mission
INSERT INTO missionTypes (name) VALUES ('Surveillance');
INSERT INTO missionTypes (name) VALUES ('Écoute');
INSERT INTO missionTypes (name) VALUES ('Filature');
INSERT INTO missionTypes (name) VALUES ('Assassinat');
INSERT INTO missionTypes (name) VALUES ('Sabotage');
INSERT INTO missionTypes (name) VALUES ('Exfiltration');
INSERT INTO missionTypes (name) VALUES ('Manipulation');
INSERT INTO missionTypes (name) VALUES ('Vol');

## ajout des nationalités
INSERT INTO nationalities (name, country_id) VALUES ('Française', 1);
INSERT INTO nationalities (name, country_id) VALUES ('Allemande', 2);
INSERT INTO nationalities (name, country_id) VALUES ('Italienne', 3);
INSERT INTO nationalities (name, country_id) VALUES ('Russe', 4);
INSERT INTO nationalities (name, country_id) VALUES ('Chinoise', 5);
INSERT INTO nationalities (name, country_id) VALUES ('Américaine', 6);
INSERT INTO nationalities (name, country_id) VALUES ('Canadienne', 7);
INSERT INTO nationalities (name, country_id) VALUES ('Espagnole', 8);
INSERT INTO nationalities (name, country_id) VALUES ('Anglaise', 9);


## ajout des missions
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Recruter un indic', 'pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit', 'Ours polaire', '2022-02-15', '2022-02-20', 7, 3, 5, 5);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Sauver la cible', 'leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices', 'Renard des neiges', '2021-07-30', '2022-12-21', 6, 2, 1, 3);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Voler les bijoux de la Castafiore', 'penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis', 'Marmotte', '2021-07-27', '2021-10-18', 8, 4, 1, 2);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Saboter les plans', 'interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et', 'Loupiot', '2021-04-03', '2022-12-01', 5, 2, 1, 4);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Sauver la loutre', 'vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean', 'Papillon caniche', '2021-02-24', '2022-12-14', 6, 2, 6, 6);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Filer le mouton', 'elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus', 'Ornithorynque', '2022-04-03', '2022-12-27', 3, 1, 1, 1);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Convaincre la mule', 'neque libero convallis eget eleifend luctus ultricies eu nibh quisque id', 'Fourmi panda', '2021-05-17', '2021-10-26', 7, 3, 4, 6);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Surveiller le caméléon', 'sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum', 'Okapi', '2021-07-09', '2021-12-17', 1, 4, 7, 3);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Suivre le lémurien', 'posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec', 'Tatou', '2021-08-09', '2022-01-01', 3, 3, 8, 4);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Exfiltrer l''éléphant discrètement', 'accumsan felis ut at dolor quis odio consequat varius integer', 'Rat-taupe nu', '2021-02-19', '2022-02-02', 6, 4, 4, 1);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Assassiner le hibou grand Duc', 'habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat', 'Blobfish', '2022-11-30', '2023-01-24', 4, 1, 2, 4);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Mettre sur écoute le loup', 'nec nisi volutpat eleifend donec ut dolor morbi vel lectus', 'Tortue', '2022-11-29', '2023-03-05', 2, 1, 5, 5);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Mettre sur écoute le renard', 'in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit', 'Poisson chauve-souris', '2022-09-11', '2022-11-17', 2, 1, 8, 6);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Saboter les nains saboteurs', 'mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis', 'Requin-lutin', '2021-07-28', '2022-07-08', 5, 2, 2, 1);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Ocean''s eleven', 'ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices', 'Morosphinx', '2021-07-10', '2022-02-16', 8, 4, 2, 4);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Par pitié, sabotez Jul', 'ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi', 'Pacu', '2022-12-09', '2023-05-04', 5, 1, 3, 5);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Mettre sur écoute la belette', 'ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis', 'Saïga', '2021-07-03', '2021-08-25', 2, 4, 3, 6);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Suivre discrètement la puce', 'ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec', 'Atheris', '2021-09-23', '2021-12-08', 3, 4, 1, 4);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Voler le vautour', 'pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc', 'Moloch hérissé', '2021-02-15', '2021-06-20', 8, 3, 4, 1);
INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) VALUES ('Exfiltrer un anaconda', 'risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh', 'Scotoplane', '2021-07-05', '2021-12-12', 6, 3, 2, 5);

## ajout des planques
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Pastèque', '1 rue de la République', '75004', 'Paris', 3, 1, 3);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Mandarine', 'Rathausstrasse 15', '10178', 'Berlin', 4, 2, 15);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Kaki', 'Spiridon-Louis-Ring 21', '80809', 'Munich', 1, 2, 20);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Orange', 'Theater square, 1', '125009', 'Moscou', 3, 4, 7);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Clémentine', '5 Place du corbeau', '56300', 'Pontivy', 2, 1, 4);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Litchi', 'Piazza Nazarion Sauro; 25/r', '50124', 'Florence', 4, 3, 16);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Pomme', '45 Rockfellere Plaza, New York', '10111', 'New York', 1, 6, 5);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Poire', 'C. San Jorge, 12', '50001', 'Saragosse', 1, 8, 9);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Citron', '177 Robson St', 'BC V6B 2A8', 'Vancouver', 2, 7, 8);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Kiwi', '2 avenue Saint Laurent', '44000', 'Nantes', 1, 1, 4);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Banane', '6216 Archer Ave', 'IL 60638', 'Chicago', 2, 6, 5);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Fraise', 'Via della Chiera', '00193', 'Rome', 3, 3, 17);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Framboise', '123 Queen Street', 'ON M5H 2M9', 'Toronto', 2, 7, 8);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Pêche', 'Heumarkt 20', '50667', 'Cologne', 2, 2, 15);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Abricot', '1006 Spring St', 'WA 98104', 'Seattle', 1, 6, 5);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Cerise', 'Piazza della Stazione, 2', '56125', 'Pise', 1, 3, 17);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Prune', '60, Tianze Lu Chaoyang District', '100600', 'Pékin', 1, 5, 1);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Myrtille', '15 quai de la Moïka', '191186', 'Saint Pétersbourg', 1, 4, 10);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Cassis', '20 impasse de la motte', '35000', 'Rennes', 2, 1, 18);
INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) VALUES ('Mangue', 'Piazza Navona, 12', '80100', 'Naples', 3, 3, 16);

## ajout des cibles
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Chen', 'Lin', '1950-01-1', 'Mercure', 5, 1);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('François', 'Dupont', '1981-12-28', 'Vénus', 1, 2);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Jeanne', 'Ancel', '1970-06-28', 'Terre', 1, 3);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Alphonse', 'Marchand', '1996-07-02', 'Mars', 1, 4);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Richard', 'McGee', '1970-05-06', 'Jupiter', 6, 5);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Eli', 'Curley', '1969-01-14', 'Saturne', 6, 5);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Julien', 'Gaumont', '1981-12-28', 'Uranus', 1, 6);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Jaromir', 'Stepanovich', '1956-08-28', 'Neptune', 4, 7);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Aiden', 'Boyd', '1972-05-05', 'Pluton', 7, 8);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Domingo', 'Muniz', '1990-10-28', 'Amateru', 8, 9);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Igor', 'Yurigovich', '1950-10-18', 'Halla', 4, 10);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Karl', 'Herr', '1996-10-03', 'Quichotte', 2, 11);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Xia', 'Long', '1997-11-15', 'Dulcinée', 5, 12);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Bruno', 'Agramonte', '1990-05-10', 'Rossinante', 8, 13);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Maria', 'Waldstein', '1969-01-14', 'Sancho', 2, 14);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Timon', 'Körver', '1970-05-06', 'Taphao Thong', 2, 15);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Vito', 'Luchini', '1987-03-04', 'Janssen', 3, 16);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Anna', 'Lo Nigro', '1992-09-05', 'Galilée', 3, 17);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Françoise', 'Couturier', '1999-02-28', 'Brahe', 1, 18);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Nikitin', 'Igorevich', '2002-08-28', 'Harriot', 4, 19);
INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES ('Mathias', 'Flügel', '1996-10-06', 'Lipperhey', 2, 20);

## ajout des agents
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Louise', 'Attaque', '1998-06-01', 1);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Til', 'Lindermann', '1999-01-12', 2);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Tino', 'Roussi', '1950-08-12', 3);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Edouard', 'Khil', '1934-09-04', 4);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Xu', 'Yi', '1980-02-12', 5);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Dave', 'Grohl', '1969-05-05', 6);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Ska', 'P', '1978-04-10', 8);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Frank', 'Turner', '1981-07-19', 9);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Monsieur', 'Roux', '1988-11-12', 1);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Paul', 'Landers', '1978-05-22', 2);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Paolo', 'Conte', '1937-01-06', 3);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Devin', 'Townsend', '1977-04-12', 7);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Ben', 'Lloyd', '1981-10-12', 9);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Jon', 'Snodgrass', '1972-07-16', 6);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Tarrant', 'Anderson', '1980-08-02', 9);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Gaëtan', 'Roussel', '1972-05-19', 1);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Zhao', 'Jing', '2000-05-12', 5);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Oscar', 'Cea', '1995-01-25', 8);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Robin', 'Feix', '1975-11-20', 1);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Matt', 'Smith', '1982-10-28', 9);
INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), 'Barbara', 'Gourde', '1991-09-28', 1);

## assignation des agents à des missions
INSERT INTO agents_missions (agent_id, mission_id) VALUES (1, 1);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (2, 2);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (3, 3);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (4, 4);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (5, 5);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (6, 6);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (7, 7);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (8, 8);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (9, 9);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (10,10);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (11,11);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (12,12);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (13,13);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (14,14);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (15,15);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (16,16);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (17,17);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (18,18);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (19,19);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (20,20);
INSERT INTO agents_missions (agent_id, mission_id) VALUES (21, 1);

## ajout des spécialités des agents
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (1, 5);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (2, 3);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (3, 2);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (4, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (5, 6);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (6, 1);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (7, 6);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (8, 3);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (9, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (10, 1);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (11, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (12, 5);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (13, 6);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (14, 1);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (15, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (16, 5);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (17, 6);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (18, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (19, 1);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (20, 5);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (21, 2);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (1, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (2, 6);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (3, 6);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (12, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (10, 4);
INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (20, 4);

## ajout des contacts
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Liza', 'Emery', 'Agate', 5);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Bobby', 'Paulin', 'Amazonite', 1);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Rina', 'Sidney', 'Ambre', 1);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Davidde', 'Rishworth', 'Rubis', 1);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Ester', 'Bridge', 'Émeraude', 6);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Aidan', 'Shrimpling', 'Saphir', 1);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Loise', 'De Lorenzo', 'Diament', 4);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Germain', 'Oakenfull', 'Jade', 7);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Kaine', 'Kleinsmuntz', 'Lapis-Lazuli', 8);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Carolyne', 'Belasco', 'Obsidienne', 4);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Olivia', 'Elderton', 'Onyx', 2);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Maegan', 'Dabbs', 'Opale', 5);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Tybi', 'Hall', 'Pierre de Lune', 8);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Lexine', 'McSkeagan', 'Quartz rose', 2);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Dell', 'Shirrell', 'Zircon', 2);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Alfy', 'Wehden', 'Serpentine', 3);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Kienan', 'Allwood', 'Pyrite', 3);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Deny', 'Dagger', 'Oeil de Tigre', 1);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Noland', 'Buxsy', 'Jaspe rouge', 4);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Claudell', 'Vaggs', 'Iris', 2);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Eliot', 'Guion', 'Grenat', 5);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Roze', 'Braisby', 'Cristal', 1);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Jedd', 'Brisbane', 'Azurite', 7);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Vikki', 'Kalinsky', 'Malachite', 2);
INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES ('Berny', 'Cecere', 'Améthyste', 1);

## assignation des contacts à des missions
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (1, 1);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (2, 2);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (3, 3);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (4, 4);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (5, 5);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (6, 6);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (7, 7);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (8, 8);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (9, 9);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (10,10);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (11,11);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (12,12);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (13,13);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (14,14);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (15,15);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (16,16);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (17,17);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (18,18);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (19,19);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (20,20);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (21,1);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (22,3);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (23,8);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (24,11);
INSERT INTO contacts_missions (contact_id, mission_id) VALUES (25,3);