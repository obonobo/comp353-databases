-- ******* CREATE TABLE STATEMENTS *******
CREATE TABLE Region (
   rID INTEGER AUTO_INCREMENT PRIMARY KEY,
   rName VARCHAR(255)
);

CREATE TABLE Country (
    cID INTEGER AUTO_INCREMENT PRIMARY KEY,
    cName VARCHAR(255),
    rID INTEGER NOT NULL,
    FOREIGN KEY (rID) REFERENCES Region(rID)
);

CREATE TABLE Organization (
    oID INTEGER AUTO_INCREMENT PRIMARY KEY,
    orgName VARCHAR(255),
    orgType VARCHAR(255),
    cID INTEGER NOT NULL,
    FOREIGN KEY (cID) REFERENCES Country(cID)
);

CREATE TABLE proStaTer(
    pstID INTEGER AUTO_INCREMENT PRIMARY KEY,
    cID INTEGER,
    pstName VARCHAR(255),
    FOREIGN KEY (cID) REFERENCES Country(cID)
);

CREATE TABLE proStaTerRecords (
    pstID INTEGER,
    totPopulation     INTEGER,
    totDeaths         INTEGER,
    infectedNoVaccine INTEGER,
    timestamp DATETIME,

    PRIMARY KEY (pstID,timestamp),
    FOREIGN KEY (pstID) REFERENCES proStaTer(pstID)
);

CREATE TABLE Users (
    uID INTEGER AUTO_INCREMENT PRIMARY KEY,
    fName VARCHAR(255),
    lName VARCHAR(255),
    dateOfBirth DATE,
    phoneNum VARCHAR(255),
    email VARCHAR(255),
    uType VARCHAR(255),
    pstID INTEGER NOT NULL,
    FOREIGN KEY (pstID) REFERENCES proStaTer(pstID)
);

CREATE TABLE specialUser(
  uID INTEGER,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(50),
  FOREIGN KEY (uID) REFERENCES Users(uID)
);

CREATE TABLE Article (
    aID INTEGER AUTO_INCREMENT PRIMARY KEY,
    authName VARCHAR(255),
    majTopic VARCHAR(255),
    minTopic VARCHAR(255),
    pubDate DATE,
    artTitle VARCHAR(255),
    summary VARCHAR(100),
    uID INTEGER,
    FOREIGN KEY (uID) REFERENCES Users(uID),
    FOREIGN KEY (authName) REFERENCES specialUser(username)
);

CREATE TABLE Researcher (
    researcherID INTEGER AUTO_INCREMENT PRIMARY KEY,
    uID INTEGER NOT NULL,
    FOREIGN KEY (uID) REFERENCES Users(uID)
);

CREATE TABLE Admin (
    adminID INTEGER AUTO_INCREMENT PRIMARY KEY,
    uID INTEGER NOT NULL,
    FOREIGN KEY (uID) REFERENCES Users(uID)
);

CREATE TABLE orgDelagate (
    delagateID INTEGER AUTO_INCREMENT PRIMARY KEY,
    uID INTEGER NOT NULL,
    oID INTEGER NOT NULL,
    FOREIGN KEY (uID) REFERENCES Users(uID),
    FOREIGN KEY (oID) REFERENCES Organization(oID)
);

CREATE TABLE VaccineCompany (
    compID INTEGER AUTO_INCREMENT PRIMARY KEY,
    vaccine VARCHAR(255),
    pstID INTEGER,
    FOREIGN KEY (pstID) REFERENCES proStaTer(pstID)
);

CREATE TABLE VaccineCompany (
    compID INTEGER AUTO_INCREMENT PRIMARY KEY,
    vaccine VARCHAR(255),
    pstID INTEGER,
    FOREIGN KEY (pstID) REFERENCES proStaTer(pstID)
);

CREATE TABLE VaccineRecords(

    compID INTEGER,
    vacButInfected INTEGER,
    vacButDied INTEGER,
    vacTotal INTEGER,
    timestamp DATETIME,

    PRIMARY KEY (compID,timestamp),
    FOREIGN KEY (compID) REFERENCES VaccineCompany(compID)
);

CREATE TABLE Suspension (
    uID INTEGER NOT NULL,
    suspendDate DATE,
    FOREIGN KEY (uID) REFERENCES Users(uID)
);

CREATE TABLE Emails(
    emailID INTEGER AUTO_INCREMENT PRIMARY KEY,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    username VARCHAR(50) NOT NULL,
    subject VARCHAR(8000) NOT NULL DEFAULT '',
    body LONGTEXT NOT NULL DEFAULT (''),
    FOREIGN KEY (username) REFERENCES specialUser(username)
);

CREATE TABLE EmailRegistration(
    username VARCHAR(50),
    author VARCHAR(50),
    PRIMARY KEY (username, author),
    FOREIGN KEY (username) REFERENCES specialUser(username),
    FOREIGN KEY (author) REFERENCES specialUser(username)
);

-- Below may be required for trigger creating permissions in MySQL. Run as admin.
SET GLOBAL log_bin_trust_function_creators=1;

CREATE TRIGGER InsertArticleSendEmailToSubcribers
AFTER INSERT ON Article FOR EACH ROW
INSERT INTO Emails(username, subject, body)
SELECT
    Subscribers.username,
    CONCAT(
        NEW.authName,
        ' has published a new article called "',
        NEW.artTitle,
        '"'
    ) AS subject,
    NEW.summary AS body
FROM (
    SELECT username
    FROM EmailRegistration
    WHERE author = NEW.authName
) AS Subscribers;


-- ******* INSERT STATEMENTS *******
INSERT INTO Region (rName) VALUES
('Africa'),
('Americas'),
('Eastern Mediterranean'),
('Europe'),
('South-East Asia'),
('Western Pacific');

INSERT INTO Country (cName, rID) VALUES
('Israel', 3),
('Egypt', 3),
('Italy', 4),
('Congo', 1),
('Ghana', 1),
('China', 6),
('Thailand', 5),
('Laos', 5),
('USA', 2),
('Canada', 2);

INSERT INTO proStaTer (cID, pstName) VALUES
(10, 'Quebec'),
(10, 'British-Columbia'),
(9, 'Alabama'),
(9, 'California'),
(8, 'Savannakhet'),
(8, 'Vientiane'),
(7, 'Bangkok'),
(7, 'Chiang'),
(6, 'Taiwan'),
(6, 'Beijing'),
(5, 'Accra'),
(5, 'Ashanti'),
(4, 'Kinshasa'),
(4, 'Kwilu'),
(3, 'Lazio'),
(3, 'Sicily'),
(2, 'Cairo'),
(2, 'Giza'),
(1, 'Jerusalem'),
(1, 'Haifa');

INSERT INTO VaccineCompany (vaccine,pstID) VALUES
  ('Pfizer',1),
  ('Moderna',1),
  ('Johnson & Johnson',1),
  ('AstraZeneca',1),
  ('Pfizer',2),
  ('Moderna',2),
  ('Johnson & Johnson',2),
  ('AstraZeneca',2),
  ('Pfizer',3),
  ('Moderna,',3),
  ('Johnson & Johnson',3),
  ('AstraZeneca',3),
  ('Pfizer',4),
  ('Moderna',4),
  ('Johnson & Johnson',4),
  ('AstraZeneca',4),
  ('Pfizer',5),
  ('Moderna',5),
  ('Johnson & Johnson',5),
  ('AstraZeneca',5),
  ('Pfizer',6),
  ('Moderna.',6),
  ('Johnson & Johnson',6),
  ('AstraZeneca',6),
  ('Pfizer',7),
  ('Moderna.',7),
  ('Johnson & Johnson',7),
  ('AstraZeneca',7),
  ('Pfizer',8),
  ('Moderna',8),
  ('Johnson & Johnson',8),
  ('AstraZeneca',8),
  ('Pfizer',9),
  ('Moderna',9),
  ('Johnson & Johnson',9),
  ('AstraZeneca',9),
  ('Pfizer',10),
  ('Moderna',10),
  ('Johnson & Johnson.',10),
  ('AstraZeneca',10),
  ('Pfizer',11),
  ('Moderna,',11),
  ('Johnson & Johnson.',11),
  ('AstraZeneca',11),
  ('Pfizer',12),
  ('Moderna.',12),
  ('Johnson & Johnson',12),
  ('AstraZeneca',12),
  ('Pfizer.',13),
  ('Moderna,',13),
  ('Johnson & Johnson',13),
  ('AstraZeneca',13),
  ('Pfizer',14),
  ('Moderna.',14),
  ('Johnson & Johnson',14),
  ('AstraZeneca',14),
  ('Pfizer',15),
  ('Moderna,',15),
  ('Johnson & Johnson',15),
  ('AstraZeneca',15),
  ('Pfizer',16),
  ('Moderna',16),
  ('Johnson & Johnson',16),
  ('AstraZeneca',16),
  ('Pfizer',17),
  ('Moderna',17),
  ('Johnson & Johnson',17),
  ('AstraZeneca',17),
  ('Pfizer',18),
  ('Moderna',18),
  ('Johnson & Johnson',18),
  ('AstraZeneca',18),
  ('Pfizer',19),
  ('Moderna,',19),
  ('Johnson & Johnson',19),
  ('AstraZeneca.',19),
  ('Pfizer',20),
  ('Moderna',20),
  ('Johnson & Johnson',20),
  ('AstraZeneca',20);

INSERT INTO Organization (orgName, orgType, cID) VALUES
('At Institute', 'ResearchCenter', 1),
('Urna PC', 'GovernmentAgency', 2),
('Nulla Incorporated', 'Company', 6),
('Non Consulting', 'ResearchCenter', 4),
('Diam Lorem LLP', 'Company', 5),
('Semper Consulting', 'ResearchCenter', 6),
('Nulla Foundation', 'ResearchCenter', 2),
('Dictum Associates', 'GovernmentAgency', 4),
('Ultricies Institute', 'GovernmentAgency', 8),
('Proin LLC', 'Company', 10),
('ProCabs', 'GovernmentAgency', 3),
('Sectum SMP', 'ResearchCenter', 9),
('Doremi Incorporated', 'Company', 7);

INSERT INTO Users (fName, lName, dateOfBirth, phoneNum, email, uType, pstID) VALUES
('Freddie', 'Gibbs', '1964-02-24', '8054561431', 'cras@google.edu', 'orgDelegate', 1),
('Zeph', 'Hammond', '1974-01-21', '033576118', 'ipsum@google.net', 'researcher', 2),
('Kyle', 'Reeves', '1984-03-14', '3406971755', 'primis@google.edu', 'administrator', 8),
('Savannah', 'Warner', '1994-04-12', '2525418619', 'risus@yahoo.edu', 'researcher', 3),
('Tasha', 'Peck', '1999-12-02', '4462466157', 'ridiculus@aol.com', 'regular', 7),
('Yuli', 'Michael', '1989-11-29', '4595237640', 'rhoncus@icloud.uk', 'researcher', 6),
('Thaddeus', 'Potter', '1979-10-12', '6372864424', 'dolor@yahoo.com', 'orgDelegate', 5),
('Joe', 'Smith', '1969-09-11', '5643563254', 'natoque@google.net', 'researcher', 1),
('Curran', 'Morse', '1970-05-21', '8033743757', 'consectetuer@aol.io', 'administrator', 10),
('Riley', 'Mcdowell', '1980-06-01', '2544085654', 'metus@icloud.com', 'orgDelegate', 5),
('Thaddeus', 'Harrison', '1990-01-24', '4595237640', 'rhonid@icloud.couk', 'researcher', 2),
('Thaddeus', 'Potter', '1990-07-21', '6372864424', 'dolorio@yahoo.com', 'regular', 7),
('Quentin', 'Clark', '1988-02-04', '5643563254', 'cum.toque@google.net', 'researcher', 3),
('Curran', 'Morse', '1978-08-10', '80937436557', 'conseursus@aol.net', 'administrator', 10),
('Kathleen', 'Lawson', '1999-01-01', '2544085654', 'metusa@icloud.com', 'researcher', 4),
('Natalie', 'Gilmore', '1981-11-17', '5235544064', 'enim@hotmail.net', 'orgDelegate', 6),
('Norman', 'Tran', '1977-04-14', '5086210206', 'phasellue@yahoo.couk', 'researcher', 4),
('Gay', 'Bond', '1996-11-09', '4037399735', 'liberon@outlook.com', 'researcher', 5),
('Phoebe', 'Russell', '1987-05-28', '4455838614', 'ornaitre@google.net', 'orgDelegate', 2),
('Christopher', 'Britt', '1990-08-01', '2338892845', 'primitois@protonmail.couk', 'researcher', 5),
('Breanna','Wise','2022-03-06','(766) 214-8715','colis.in@aol.com', 'researcher', 17),
('Tanner','Martin','2023-03-02','(365) 396-6683','ut.m@hotmail.ca', 'researcher', 16),
('Mira','Hawkins','2021-09-04','(253) 534-9492','sodales@outlook.edu', 'orgDelegate', 19),
('Bo','Cash','2023-03-07','(913) 265-9914','inonec@icloud.org', 'regular',17),
('Zachery','Saunders','2023-01-25','(746) 159-5316','aliquaulla@aol.ca','administrator', 16),
('Kirby','Chase','2021-08-21','(730) 736-2743','vel.cons@hotmail.net', 'regular', 17),
('Preston','Torres','2022-04-20','(682) 575-7220','ligulaqua@outlook.org', 'administrator', 13),
('Zeus','Hendrix','2023-06-29','(719) 857-1378','pedelosa@outlook.edu', 'researcher', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Joelle','Davidson','2023-04-25','(694) 126-1646','telldisse@protonmail.com', 'researcher', 20),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12),
('Amena','Nash','2023-01-18','(687) 164-0971','orciini@outlook.couk', 'orgDelegate', 12);

INSERT INTO specialUser (uID, username, password) VALUES
(1, 'freddster', 'ksjdfh234'),
(2, 'zeddphyrus', '12893add'),
(3, 'killarvs', 'kjdfh_28'),
(4, 'savy892', 'loapa_193ka'),
(6, 'yuyu1990', 'amnsm1_12'),
(7, 'wizard', 'hogwarts3892'),
(8, 'joeblo', 'averagejoes134'),
(9, 'curan', 'yurr9283'),
(10, 'rileyyo', 'Yoyo_11'),
(11, 'thaddawg', 'Blueblue990'),
(13, 'theQman', 'ilovefball13'),
(14, 'currymo', 'cm9822'),
(15, 'katielaww', 'lawgrad2k22'),
(16, 'natgilly', 'manutd123'),
(17, 'norm', 'antran77'),
(18, 'Gay123', 'bond007'),
(19, 'feebz', 'russ_1987'),
(20, 'christhebritt', 'gunners_23'),
(21, 'brebre', 'wisest_1999'),
(22, 'thetanman', 'tm_1993'),
(23, 'mirame', 'thehawk_111'),
(25, 'zachmac', 'saundz_999'),
(27, 'elpres', 'torres_87'),
(28, 'almightyzeus', 'hendrix_64'),
(29, 'amenita', 'nashynash1000'),
(30, 'jojo111', 'jld1995'),
(31, 'Joe Smith', 'password123'),
(32, 'AT Institute', 'password123'),
(33, 'Urna PC', 'password123'),
(34, 'Savannah Warner', 'password123'),
(35, 'Gay Bond', 'password123'),
(36, 'Yuli Michael', 'password123'),
(37, 'Quentin Clark', 'password123'),
(38, 'Semper Consulting', 'password123'),
(39, 'Nulla Foundation', 'password123'),
(40, 'Norman Tran', 'password123');

INSERT INTO Admin (uID) VALUES
(3),
(9),
(14),
(25),
(27);

INSERT INTO Researcher (uID) VALUES
(2),
(4),
(6),
(8),
(11),
(13),
(15),
(17),
(18),
(20),
(21),
(22),
(28),
(30);

INSERT INTO orgDelagate (uID, oID) VALUES
(1, 1),
(7, 4),
(10, 5),
(16, 3),
(19, 2),
(23, 1),
(29, 6);

INSERT INTO Suspension VALUES
(14,'2020-08-10'),
(24,'2020-10-12'),
(2,'2021-04-6');

INSERT INTO EmailRegistration VALUES
('freddster', 'freddster'),
('zeddphyrus', 'freddster'),
('theQman', 'freddster'),
('norm', 'wizard');

INSERT INTO Article (authName, majTopic, minTopic, pubDate, artTitle, summary, uID) VALUES
('Joe Smith', 'Nullam ut', 'varius orci,', '2021-08-27', 'Clear And Unbiased Facts About COVID-19', 'ut nisi a odio semper cursus.', 8),
('AT Institute', 'vestibulum massa', 'augue eu', '2020-10-03', 'Top 10 Tips To Grow Your COVID-19', 'aliquet molestie tellus. Aenean egestas.', 1),
('Urna PC', 'velit. Cras', 'pede et', '2021-07-09', 'COVID-19 Made Simple', 'vehicula risus. Nulla eget metus',19),
('Savannah Warner', 'non enim', 'Ut tincidunt', '2021-04-21', 'How To Use COVID-19 To Desire', 'luctus lobortis. Class aptent taciti sociosqu ad.', 4),
('Gay Bond', 'non arcu.', 'sit amet', '2019-12-09', '22 Tips To Start Building A COVID-19', 'diam lorem, auctor quis, tristique', 18),
('Yuli Michael', 'pretium neque.', 'Suspendisse tristique', '2021-04-21', 'How To Win Buyers And Influence Sales with COVID-19', 'Suspendisse sagittis. Nullam vitae diam.', 6),
('Quentin Clark', 'luctus et', 'Donec est', '2020-11-30', 'Want To Step Up Your COVID-19? You Need To Read This', 'libero lacus, varius', 13),
('Semper Consulting', 'mauris ut', 'penatibus et', '2020-06-29', 'Take 10 Minutes to Get Started With COVID-19', 'Aliquam ultrices iaculis odio. Nam', 29),
('Nulla Foundation', 'vitae odio', 'tincidunt, nunc', '2019-11-20', '7 Rules About COVID-19 Meant To Be Broken', 'eu metus. In lorem. Donec elementum, lorem ut aliquam.', 16),
('Norman Tran', 'Fusce dolor', 'Cras eu', '2020-03-20', 'The Death Of COVID-19 And How To Avoid It', 'Sed nec', 17),
('Joe Smith', 'ligula. Donec', 'magna tellus', '2021-12-03', 'Your Key To Success: COVID-19', 'convallis est, vitae.', 8),
('Joe Smith', 'defef', 'carta nf', '2021-12-12', 'Your COVID-19', 'convolu', 8),
('Quentin Clark', 'wer', 'estes', '2020-11-17', 'You Need To Read This', 'libero lacus, varius',13),
('freddster', 'Nullam ut', 'varius orci,', '2021-08-27', 'Clear And Unbiased Facts About COVID-19', 'ut nisi a odio semper cursus.', 8),
('freddster', 'vestibulum massa', 'augue eu', '2020-10-03', 'Top 10 Tips To Grow Your COVID-19', 'aliquet molestie tellus. Aenean egestas.', 1),
('freddster', 'velit. Cras', 'pede et', '2021-07-09', 'COVID-19 Made Simple', 'vehicula risus. Nulla eget metus',19),
('freddster', 'non enim', 'Ut tincidunt', '2021-04-21', 'How To Use COVID-19 To Desire', 'luctus lobortis. Class aptent taciti sociosqu ad.', 4),
('freddster', 'non arcu.', 'sit amet', '2019-12-09', '22 Tips To Start Building A COVID-19', 'diam lorem, auctor quis, tristique', 18),
('freddster', 'pretium neque.', 'Suspendisse tristique', '2021-04-21', 'How To Win Buyers And Influence Sales with COVID-19', 'Suspendisse sagittis. Nullam vitae diam.', 6),
('freddster', 'luctus et', 'Donec est', '2020-11-30', 'Want To Step Up Your COVID-19? You Need To Read This', 'libero lacus, varius', 13),
('freddster', 'mauris ut', 'penatibus et', '2020-06-29', 'Take 10 Minutes to Get Started With COVID-19', 'Aliquam ultrices iaculis odio. Nam', 29),
('freddster', 'vitae odio', 'tincidunt, nunc', '2019-11-20', '7 Rules About COVID-19 Meant To Be Broken', 'eu metus. In lorem. Donec elementum, lorem ut aliquam.', 16),
('freddster', 'Fusce dolor', 'Cras eu', '2020-03-20', 'The Death Of COVID-19 And How To Avoid It', 'Sed nec', 17),
('freddster', 'ligula. Donec', 'magna tellus', '2021-12-03', 'Your Key To Success: COVID-19', 'convallis est, vitae.', 8),
('freddster', 'defef', 'carta nf', '2021-12-12', 'Your COVID-19', 'convolu', 8),
('wizard', 'wer', 'estes', '2020-11-17', 'You Need To Read This', 'libero lacus, varius',13);

INSERT INTO proStaTerRecords (pstID, totPopulation, totDeaths, infectedNoVaccine,timestamp) VALUES
(1, 9928163, 746923, 6993463,'2022-07-20 08:52:27'),
(1, 9928163, 746923, 6993463, '2022-01-11 08:52:27'),
(2, 6681963, 546421, 4393421,'2022-01-30 21:33:17'),
(3, 5024279, 245987, 3194782,'2022-07-19 19:55:27'),
(4,  39538223, 2228471, 19319392,'2022-06-06 16:28:24'),
(5,  969697, 198283, 402890,'2022-05-06 02:33:09'),
(6,  820940, 168482, 392089,'2022-04-06 13:12:30'),
(7,  5666264, 969185, 2289161,'2022-01-08 00:04:31'),
(8,  1779254, 168482, 392089,'2022-02-08 18:22:58'),
(9,  23162123, 2177265, 10392746,'2022-04-07 21:56:33'),
(10,  21893095, 2028996, 9323060,'2022-02-26 15:35:09'),
(11,  5455692, 617765, 1939244,'2022-04-08 11:34:52'),
(12,  5440463, 415899, 1790242,'2022-04-05 19:27:13'),
(13,  11575000, 241777, 3936976,'2022-01-01 08:13:53'),
(14,  5174718, 125198, 3790288,'2022-03-17 10:27:37'),
(15,  5715190, 541247, 1945722,'2022-07-20 13:40:18'),
(16,  4801468, 185273, 279181,'2022-07-10 07:58:59'),
(17,  9788739, 949165, 6992872,'2022-04-04 13:42:21'),
(18,  8915164, 8188764, 5991771,'2022-06-20 22:21:04'),
(19,  1133700, 91288, 694572,'2022-06-09 21:44:48'),
(20,  1032800, 85271, 679111,'2022-02-23 15:20:13');

INSERT INTO VaccineRecords (compID,vacButInfected,vacButDied,vacTotal,timestamp) VALUES
  (1,522994,1429739,348743,'2022-01-13 21:54:27'),
  (2,1620040,1078552,993868,'2022-01-13 21:54:27'),
  (3,1567742,459720,242528,'2022-01-13 21:54:27'),
  (4,1009160,1622276,1295398,'2022-01-13 21:54:27'),
  (5,640631,726867,433468,'2022-01-30 21:33:17'),
  (6,249661,1630160,661427,'2022-01-30 21:33:17'),
  (7,1035382,879563,1227011,'2022-01-30 21:33:17'),
  (8,585267,1866934,1621834,'2022-01-30 21:33:17'),
  (9,897037,1849240,766891,'2022-07-19 19:55:27'),
  (10,579130,1792051,984679,'2022-07-19 19:55:27'),
  (11,384069,1044384,1550032,'2022-07-19 19:55:27'),
  (12,1909337,1169881,215257,'2022-07-19 19:55:27'),
  (13,633901,262048,809423,'2022-06-06 16:28:24'),
  (14,481325,1894940,296600,'2022-06-06 16:28:24'),
  (15,997572,1230250,1148905,'2022-06-06 16:28:24'),
  (16,547307,699185,626700,'2022-06-06 16:28:24'),
  (17,540014,236905,542187,'2022-05-06 02:33:09'),
  (18,709580,1293306,753599,'2022-05-06 02:33:09'),
  (19,687391,296505,209229,'2022-05-06 02:33:09'),
  (20,1855054,831250,430262,'2022-05-06 02:33:09'),
  (21,431538,1189629,224066,'2022-04-06 13:12:30'),
  (22,1023754,612867,512636,'2022-04-06 13:12:30'),
  (23,1842005,1216407,842949,'2022-04-06 13:12:30'),
  (24,1573215,1036517,1838283,'2022-04-06 13:12:30'),
  (25,1160465,1789125,546933,'2022-01-08 00:04:31'),
  (26,1897194,542240,1600158,'2022-01-08 00:04:31'),
  (27,1325145,1754016,519040,'2022-01-08 00:04:31'),
  (28,1095319,309104,254387,'2022-01-08 00:04:31'),
  (29,1022378,927619,870982,'2022-02-08 18:22:58'),
  (30,1433970,818535,1750973,'2022-02-08 18:22:58'),
  (31,1967362,1903656,1626347,'2022-02-08 18:22:58'),
  (32,1581830,1455110,915999,'2022-02-08 18:22:58'),
  (33,1444195,675418,1866468,'2022-04-07 21:56:33'),
  (34,1726475,1861643,553328,'2022-04-07 21:56:33'),
  (35,1028476,1811436,356848,'2022-04-07 21:56:33'),
  (36,378382,1389130,1294324,'2022-04-07 21:56:33'),
  (37,714977,1515112,694610,'2022-02-26 15:35:09'),
  (38,307167,1194066,357878,'2022-02-26 15:35:09'),
  (39,1267328,368596,213240,'2022-04-08 11:34:52'),
  (40,500839,1473635,1264030,'2022-04-08 11:34:52'),
  (41,1054987,1184689,1200467,'2022-04-05 19:27:13'),
  (42,392070,1186012,854503,'2022-04-05 19:27:13'),
  (43,1781490,1535208,1994431,'2022-01-01 08:13:53'),
  (44,519036,1134001,1340917,'2022-01-01 08:13:53'),
  (45,994424,583520,708162,'2022-03-17 10:27:37'),
  (46,398328,611237,1994077,'2022-03-17 10:27:37'),
  (47,1492780,1264526,1129131,'2022-07-20 13:40:18'),
  (48,1050751,949919,1327494,'2022-07-20 13:40:18'),
  (49,1876635,418128,1484099,'2022-07-10 07:58:59'),
  (50,282751,632241,1627519,'2022-07-10 07:58:59'),
  (51,975826,1237363,1629740,'2022-07-10 07:58:59'),
  (52,514149,1534074,393315,'2022-04-04 13:42:21'),
  (53,1492953,340937,1381065,'2022-04-04 13:42:21'),
  (54,1023625,1940326,1815832,'2022-06-20 22:21:04'),
  (55,972596,1378973,896145,'2022-06-20 22:21:04'),
  (56,391247,780338,415834,'2022-06-20 22:21:04'),
  (57,810242,1389822,885228,'2022-06-09 21:44:48'),
  (58,1123145,992845,493652,'2022-06-09 21:44:48'),
  (59,1919721,1416932,936995,'2022-02-23 15:20:13'),
  (60,1486060,1356916,1259874,'2022-02-23 15:20:13'),
  (61,756324,566345,744889,'2022-02-23 15:20:13'),
  (62,1928391,1630791,710535,'2022-02-23 15:20:13');

-- ******* QUERIES *******

/*
 * QUERY 10
 *
 **/
SELECT uType AS role,
    IFNULL(username, 'NONE'),
    fName AS firstName,
    lName AS lastName,
    cName AS citizenship,
    email,
    phoneNum
FROM Users u,
    (
        SELECT u.uID, username
        FROM Users u
        LEFT JOIN specialUser su ON u.uID = su.uID
    ) AS allUsers,
    proStaTer pst,
    Country c
WHERE u.uID = allUsers.uID
    AND u.pstID = pst.pstID
    AND pst.cID = c .cID
ORDER BY role, citizenship ASC;

/*
 * QUERY 13
 *
 **/
WITH
    cte1 AS (
        SELECT specialUser.username,
            Suspension.uID,
            suspendDate
        FROM Suspension
            LEFT JOIN specialUser ON Suspension.uID = specialUser.uID
    )
SELECT cte1.username,
    fName,
    lName,
    cName,
    email,
    phoneNum,
    cte1.suspendDate
FROM cte1,
    Users,
    proStaTer,
    Country
WHERE Users.uID IN (
        SELECT uID
        FROM Suspension
    )
    AND Users.pstID = proStaTer.pstID
    AND proStaTer.cID = Country.cID
    AND cte1.uID = Users.uID
ORDER BY suspendDate;

/*
 * QUERY 14
 *
 **/
SELECT pubDate, majTopic, minTopic, summary, artTitle
FROM Article
WHERE Article.authName = '' #some input
ORDER BY pubDate;

/*
 * QUERY 15
 *
 **/
SELECT authName,
    cName,
    COUNT(artTitle) AS numOfPublications
FROM Article,
    Users,
    proStaTer,
    Country
WHERE Article.uID = Users.uID
    AND Users.pstID = proStaTer.pstID
    AND proStaTer.cID = Country.cID
GROUP BY Article.uID
ORDER BY numOfPublications DESC;

/*
 * QUERY 16
 *
 **/
SELECT rName,
    cName,
    COUNT(authName) AS totAuthors,
    COUNT(artTitle) AS numOfPublications
FROM Region,
    Country,
    Article,
    Users,
    proStaTer
WHERE Country.rID = Region.rID
    AND Article.uID = Users.uID
    AND Users.pstID = proStaTer.pstID
    and proStaTer.cID = Country.cID
GROUP BY cName, rName
ORDER BY rName ASC, numOfPublications DESC;

/*
 * QUERY 17
 *
 **/
WITH
    cte1 AS (
        SELECT pstName,
            proStaTer.pstID,
            SUM(vacTotal) AS totalVaccinated,
            SUM(vacButDied) AS totalVaccinatedbutDied
        FROM VaccineCompany, proStaTer
        WHERE proStaTer.pstID = VaccineCompany.pstID
        GROUP BY proStaTer.pstName
    ),
    cte2 AS (
        SELECT cName,
            SUM(totPopulation) AS popSum,
            SUM(totDeaths) AS deathSum
        FROM proStaTer, Country
        WHERE Country.cID = proStaTer.cID
        GROUP BY proStaTer.cID
    )
SELECT rName,
    Country.cName,
    cte2.popSum,
    cte2.deathSum,
    SUM(cte1.totalVaccinated) AS totalVaccinatedCountry,
    SUM(cte1.totalVaccinatedbutDied) AS totalVaccinatedbutDiedCountry
FROM Region
    JOIN Country
    JOIN proStaTer
    JOIN cte1
    JOIN cte2
WHERE Region.rID = Country.rID
    AND Country.cName = cte2.cName
    AND proStaTer.pstID = cte1.pstID
    AND proStaTer.cID = Country.cID
GROUP BY Country.cID
ORDER BY cte2.deathSum ASC;

/*
 * QUERY 18
 *
 **/
SELECT Emails.timestamp, Users.email, Emails.subject
FROM Emails
    JOIN specialUser ON Emails.username = specialUser.username
    JOIN Users ON Users.uID = specialUser.uID
WHERE EXTRACT(YEAR FROM Emails.timestamp) = 2022
ORDER BY Emails.timestamp ASC;

/*
 * QUERY 19
 *
 **/
SELECT
    DATE(VaccineRecords.timestamp) AS date,
    proStaTerRecords.totPopulation AS population,
    VaccineCompany.vaccine AS vaccine,
    SUM(VaccineRecords.vacTotal) AS totalVaccinated,
    SUM(VaccineRecords.vacButInfected) + SUM(proStaTerRecords.infectedNoVaccine) AS totalInfected
FROM VaccineRecords
    JOIN VaccineCompany ON VaccineCompany.compID = VaccineRecords.compID
    JOIN proStaTer ON proStaTer.pstID = VaccineCompany.pstID
    JOIN Country ON proStaTer.cID = Country.cID
    LEFT JOIN proStaTerRecords ON (proStaTerRecords.pstID, proStaTerRecords.timestamp) = (
            -- This subquery retrieves the proStaTerRecord whose date is closest
            -- to our VaccineRecord.
            SELECT proStaTerRecords.pstID, proStaTerRecords.timestamp
            FROM proStaTerRecords
                JOIN proStaTer ON proStaTer.pstID = proStaTerRecords.pstID
                JOIN Country AS InnerCountry ON proStaTer.cID = Country.cID
            WHERE DATE(timestamp) <= DATE(VaccineRecords.timestamp)
            AND InnerCountry.cID = Country.cID
            ORDER BY timestamp DESC
            LIMIT 1
        )
WHERE LOWER(Country.cName) = 'canada'
GROUP BY date, population, vaccine
ORDER BY date DESC;

/*
 * QUERY 20
 *
 **/
