-- Table creation
CREATE TABLE Region (
    rID INTEGER AUTO_INCREMENT PRIMARY KEY,
    rName VARCHAR(255)
);

CREATE TABLE Country (
    cID INTEGER AUTO_INCREMENT PRIMARY KEY,
    cName VARCHAR(255),
    totPopulation INTEGER,
    totDeaths INTEGER,
    infectedNoVaccine INTEGER,
    rID INTEGER,
    FOREIGN KEY (rID) REFERENCES Region(rID)
);

CREATE TABLE Article (
    aID INTEGER AUTO_INCREMENT PRIMARY KEY,
    authName VARCHAR(255),
    majTopic VARCHAR(255),
    minTopic VARCHAR(255),
    pubDate DATE,
    artTitle VARCHAR(255),
    summary VARCHAR(255),
    oID INTEGER,
    researcherID INTEGER
);

CREATE TABLE Organization (
    oID INTEGER AUTO_INCREMENT PRIMARY KEY,
    orgName VARCHAR(255),
    orgType VARCHAR(255),
    cID INTEGER NOT NULL
);

CREATE TABLE Researcher (
    researcherID INTEGER AUTO_INCREMENT PRIMARY KEY,
    fName VARCHAR(255),
    lName VARCHAR(255),
    cID INTEGER NOT NULL
);

CREATE TABLE Users (
    uID INTEGER AUTO_INCREMENT PRIMARY KEY,
    fName VARCHAR(255),
    lName VARCHAR(255),
    dateOfBirth DATE,
    phoneNum VARCHAR(255),
    email VARCHAR(255),
    uType VARCHAR(255),
    uPrivileges VARCHAR(255),
    cID INTEGER NOT NULL,
    oID INTEGER,
    researcherID INTEGER
);

CREATE TABLE VaccineCompany (
    compID INTEGER AUTO_INCREMENT PRIMARY KEY,
    compName VARCHAR(255),
    vacButInfected INTEGER,
    vacButDied INTEGER,
    cID INTEGER NOT NULL,
    vacTotal INTEGER
);


-- Clear database
DROP TABLE Region;
DROP TABLE Country;
DROP TABLE Article;
DROP TABLE Organization;
DROP TABLE Researcher;
DROP TABLE Users;
DROP TABLE VaccineCompany;


-- Insert statements
INSERT INTO `Article` VALUES
(
    1,
    'Joe Smith',
    'Nullam ut',
    'varius orci,',
    '2021-08-27',
    'Clear And Unbiased Facts About COVID-19',
    'ut nisi a odio semper cursus.',
    7,
    1
),
(
    2,
    'AT Institute',
    'vestibulum massa',
    'augue eu',
    '2020-10-03',
    'Top 10 Tips To Grow Your COVID-19',
    'aliquet molestie tellus. Aenean egestas.',
    1,
    NULL
),
(
    3,
    'Urna PC',
    'velit. Cras',
    'pede et',
    '2021-07-09',
    'COVID-19 Made Simple',
    'vehicula risus. Nulla eget metus',
    2,
    NULL
),
(
    4,
    'Proin LLC',
    'non enim',
    'Ut tincidunt',
    '2021-04-21',
    'How To Use COVID-19 To Desire',
    'luctus lobortis. Class aptent taciti sociosqu ad.',
    10,
    NULL
),
(
    5,
    'Gay Bond',
    'non arcu.',
    'sit amet',
    '2019-12-09',
    '22 Tips To Start Building A COVID-19',
    'diam lorem, auctor quis, tristique',
    6,
    5
),
(
    6,
    'Yuli Michael',
    'pretium neque.',
    'Suspendisse tristique',
    '2021-04-21',
    'How To Win Buyers And Influence Sales with COVID-19',
    'Suspendisse sagittis. Nullam vitae diam.',
    6,
    6
),
(
    7,
    'Quentin Clark',
    'luctus et',
    'Donec est',
    '2020-11-30',
    'Want To Step Up Your COVID-19? You Need To Read This',
    'libero lacus, varius',
    6,
    7
),
(
    8,
    'Dictum Associates',
    'mauris ut',
    'penatibus et',
    '2020-06-29',
    'Take 10 Minutes to Get Started With COVID-19',
    'Aliquam ultrices iaculis odio. Nam',
    8,
    NULL
),
(
    9,
    'Nulla Foundation',
    'vitae odio',
    'tincidunt, nunc',
    '2019-11-20',
    '7 Rules About COVID-19 Meant To Be Broken',
    'eu metus. In lorem. Donec elementum, lorem ut aliquam.',
    7,
    NULL
),
(
    10,
    'Norman Tran',
    'Fusce dolor',
    'Cras eu',
    '2020-03-20',
    'The Death Of COVID-19 And How To Avoid It',
    'Sed nec',
    4,
    4
),
(
    11,
    'Joe Smith',
    'ligula. Donec',
    'magna tellus',
    '2021-12-03',
    'Your Key To Success: COVID-19',
    'convallis est, vitae.',
    7,
    1
);

INSERT INTO `Country` VALUES
(1, 'Israel', 408988758, 8518, 6962, 3),
(2, 'Egypt', 98372709, 65854, 1639, 3),
(3, 'Italy', 12599693, 7193, 495, 4),
(4, 'Congo', 74645262, 25040, 5151, 1),
(5, 'Ghana', 90551327, 6953, 4118, 1),
(6, 'China', 24545889, 36030, 3685, 6),
(7, 'Thailand', 20848257, 11362, 3032, 5),
(8, 'Laos', 6725079, 45630, 9664, 5),
(9, 'USA', 40967535, 78168, 1016, 2),
(10, 'Canada', 23191458, 16418, 9133, 2);

INSERT INTO `Organization` VALUES
(1, 'At Institute', 'ResearchCenter', 1),
(2, 'Urna PC', 'GovernmentAgency', 2),
(3, 'Nulla Incorporated', 'Company', 6),
(4, 'Non Consulting', 'ResearchCenter', 4),
(5, 'Diam Lorem LLP', 'Company', 5),
(6, 'Semper Consulting', 'ResearchCenter', 6),
(7, 'Nulla Foundation', 'ResearchCenter', 2),
(8, 'Dictum Associates', 'GovernmentAgency', 4),
(9, 'Ultricies Institute', 'GovernmentAgency', 3),
(10, 'Proin LLC', 'Company', 1);

INSERT INTO `Region` VALUES
(1, 'Africa'),
(2, 'Americas'),
(3, 'Eastern Mediterranean'),
(4, 'Europe'),
(5, 'South-East Asia'),
(6, 'Western Pacific');

INSERT INTO `Researcher` VALUES
(1, 'Joe', 'Smith', 1),
(2, 'Zeph', 'Hammond', 2),
(3, 'Savannah', 'Warner', 3),
(4, 'Norman', 'Tran', 4),
(5, 'Gay', 'Bond', 5),
(6, 'Yuli', 'Michael', 6),
(7, 'Quentin', 'Clark', 7),
(8, 'Thaddeus', 'Harrison', 10),
(9, 'Kathleen', 'Lawson', 8),
(10, 'Christopher', 'Britt', 9);

INSERT INTO `Users` VALUES
(
    1,
    'Freddie',
    'Gibbs',
    '8054561431',
    'cras@google.edu',
    'orgDelegate',
    'orgArticles',
    1,
    10,
    NULL
),
(
    2,
    'Zeph',
    'Hammond',
    '033576118',
    'ipsum@google.net',
    'researcher',
    'publicArticles',
    2,
    4,
    2
),
(
    3,
    'Kyle',
    'Reeves',
    '3406971755',
    'primis@google.edu',
    'administrator',
    'usersAndAccts',
    8,
    NULL,
    NULL
),
(
    4,
    'Savannah',
    'Warner',
    '2525418619',
    'risus@yahoo.edu',
    'researcher',
    'publicArticles',
    3,
    1,
    3
),
(
    5,
    'Tasha',
    'Peck',
    '4462466157',
    'ridiculus@aol.com',
    'regular',
    'read',
    7,
    NULL,
    NULL
),
(
    6,
    'Yuli',
    'Michael',
    '4595237640',
    'rhoncus@icloud.uk',
    'researcher',
    'publicArticles',
    6,
    6,
    6
),
(
    7,
    'Thaddeus',
    'Potter',
    '6372864424',
    'dolor@yahoo.com',
    'orgDelegate',
    'orgArticles',
    5,
    5,
    NULL
),
(
    8,
    'Joe',
    'Smith',
    '5643563254',
    'natoque@google.net',
    'researcher',
    'publicArticles',
    1,
    7,
    1
),
(
    9,
    'Curran',
    'Morse',
    '8033743757',
    'consectetuer@aol.io',
    'administrator',
    'usersAndAccts',
    10,
    NULL,
    NULL
),
(
    10,
    'Riley',
    'Mcdowell',
    '2544085654',
    'metus@icloud.com',
    'orgDelegate',
    'orgArticles',
    5,
    5,
    NULL
),
(
    11,
    'Thaddeus',
    'Harrison',
    '4595237640',
    'rhonid@icloud.couk',
    'researcher',
    'publicArticles',
    2,
    1,
    8
),
(
    12,
    'Thaddeus',
    'Potter',
    '6372864424',
    'dolorio@yahoo.com',
    'regular',
    'read',
    7,
    NULL,
    NULL
),
(
    13,
    'Quentin',
    'Clark',
    '5643563254',
    'cum.toque@google.net',
    'researcher',
    'publicArticles',
    3,
    6,
    7
),
(
    14,
    'Curran',
    'Morse',
    '8033743757',
    'conseursus@aol.net',
    'administrator',
    'usersAndAccts',
    10,
    NULL,
    NULL
),
(
    15,
    'Kathleen',
    'Lawson',
    '2544085654',
    'metusa@icloud.com',
    'researcher',
    'publicArticles',
    4,
    7,
    9
),
(
    16,
    'Natalie',
    'Gilmore',
    '5445544064',
    'enim@hotmail.net',
    'orgDelegate',
    'orgArticles',
    6,
    3,
    NULL
),
(
    17,
    'Norman',
    'Tran',
    '5086297206',
    'phasellue@yahoo.couk',
    'researcher',
    'publicArticles',
    4,
    4,
    4
),
(
    18,
    'Gay',
    'Bond',
    '4177399735',
    'liberon@outlook.com',
    'researcher',
    'publicArticles',
    5,
    6,
    5
),
(
    19,
    'Phoebe',
    'Russell',
    '4455758614',
    'ornare@google.net',
    'orgDelegate',
    'orgArticles',
    2,
    2,
    NULL
),
(
    20,
    'Christopher',
    'Britt',
    '2338828845',
    'primis@protonmail.couk',
    'researcher',
    'publicArticles',
    5,
    1,
    10
);

INSERT INTO `VaccineCompany` VALUES
(1, 'Pfizer', 82372, 9331, 1, 100000),
(2, 'Pfizer', 962595, 8018, 2, 970000),
(3, 'AstraZeneca', 840383, 6973, 3, 850000),
(4, 'Pfizer', 491488, 1508, 4, 500000),
(5, 'Pfizer', 826570, 3564, 5, 836570),
(6, 'Johnson & Johnson', 333034, 5979, 6, 336034),
(7, 'Moderna', 10040, 4994, 7, 14040),
(8, 'Moderna', 262508, 356, 8, 282508),
(9, 'Pfizer', 780420, 8130, 9, 790420),
(10, 'Johnson & Johnson', 271650, 7283, 10, 284650),
(11, 'AstraZeneca', 82372, 9331, 2, 82572),
(12, 'AstraZeneca', 962595, 8018, 4, 965595),
(13, 'Moderna', 840383, 6973, 6, 846383),
(14, 'Johnson & Johnson', 491488, 1508, 5, 500000),
(15, 'Moderna', 82372, 9331, 1, 83372),
(16, 'Moderna', 962595, 8018, 2, 982595),
(17, 'Moderna', 840383, 6973, 3, 850383),
(18, 'Johnson & Johnson', 491488, 1508, 4, 50000),
(19, 'Pfizer', 826570, 3564, 6, 828570),
(20, 'AstraZeneca', 333034, 5979, 6, 334059),
(21, 'Pfizer', 10040, 4994, 7, 11040),
(22, 'Johnson & Johnson', 262508, 356, 8, 312508),
(23, 'Moderna', 780420, 8130, 9, 900420),
(24, 'Pfizer', 271650, 7283, 10, 289650),
(25, 'Johnson & Johnson', 82372, 9331, 2, 85372),
(26, 'Moderna', 962595, 8018, 4, 982595),
(27, 'AstraZeneca', 840383, 6973, 5, 845383),
(28, 'Moderna', 491488, 1508, 5, 498488),
(29, 'AstraZeneca', 82372, 9331, 1, 85372),
(30, 'Johnson & Johnson', 491488, 1508, 1, 50000),
(31, 'Johnson & Johnson', 491488, 1508, 3, 500000),
(32, 'Pfizer', 826570, 3564, 3, 828570);

-- q8
SELECT uPrivileges,
    fName,
    lName,
    email,
    phoneNum,
    dateOfBirth,
    Country.cName AS citizenship,
    Organization.orgName AS organization
FROM Users
    JOIN Country ON Users.cID = Country.cID
    JOIN Organization ON Organization.oID = Users.oID
ORDER BY uPrivileges,
    citizenship,
    dateOfBirth;

-- q9
SELECT fName,
    lName,
    email,
    phoneNum,
    dateOfBirth,
    Country.cName AS citizenship,
    COUNT(aID) AS articlesPosted
FROM Users
    JOIN County ON Users.cID = Country.cID
    JOIN Researcher ON Users.researcherID = Researcher.researcherID
    JOIN Article ON Users.researcherID = Article.researcherID
GROUP BY fName,
    lName,
    email,
    phoneNum,
    dateOfBirth,
    citizenship
ORDER BY articlesPosted DESC;

-- q10
SELECT fName,
    lName,
    email,
    phoneNum,
    dateOfBirth,
    Country.cName AS citizenship,
    COUNT(aID) AS articlesPosted
FROM Users
    JOIN County ON Users.cID = Country.cID
    JOIN Researcher ON Users.researcherID = Researcher.researcherID
WHERE Users.researcherID NOT IN (SELECT researcherID FROM Article);
