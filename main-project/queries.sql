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
totPopulation INTEGER,
totDeaths INTEGER,
infectedNoVaccine INTEGER,
FOREIGN KEY (cID) REFERENCES Country(cID)
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

CREATE TABLE Article (
    aID INTEGER AUTO_INCREMENT PRIMARY KEY,
    authName VARCHAR(255),
    majTopic VARCHAR(255),
    minTopic VARCHAR(255),
    pubDate DATE,
    artTitle VARCHAR(255),
    summary VARCHAR(100),
    uID INTEGER,
    FOREIGN KEY (uID) REFERENCES Users(uID)
);

CREATE TABLE specialUser(
  uID INTEGER,
  username VARCHAR(50),
  password VARCHAR(50),
  FOREIGN KEY (uID) REFERENCES Users(uID)
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
    vacButInfected INTEGER,
    vacButDied INTEGER,
    vacTotal INTEGER,
    pstID INTEGER,
    FOREIGN KEY (pstID) REFERENCES proStaTer(pstID)
);

CREATE TABLE Suspension (
    uID INTEGER NOT NULL,
    suspendDate DATE,
    FOREIGN KEY (uID) REFERENCES Users(uID)
);



# query 13
WITH
cte1 AS
    (SELECT specialUser.username,Suspension.uID,suspendDate FROM Suspension LEFT JOIN specialUser ON Suspension.uID = specialUser.uID)

SELECT cte1.username,fName,lName,cName,email,phoneNum,cte1.suspendDate FROM cte1,Users,proStaTer,Country
WHERE Users.uID IN (SELECT uID FROM Suspension) AND Users.pstID = proStaTer.pstID AND proStaTer.cID = Country.cID AND cte1.uID = Users.uID
ORDER BY suspendDate;

# Query 14
SELECT pubDate,majTopic,minTopic,summary,artTitle FROM Article
WHERE Article.authName = '' #some input
ORDER BY pubDate;

# Query 15
SELECT authName,cName,COUNT(artTitle) AS numOfPublications FROM Article,Users,proStaTer, Country
WHERE Article.uID = Users.uID AND Users.pstID = proStaTer.pstID AND proStaTer.cID = Country.cID
GROUP BY Article.uID
ORDER BY numOfPublications DESC;

# Query 16
SELECT rName,cName,COUNT(authName) AS totAuthors,COUNT(artTitle) AS numOfPublications FROM Region,Country,Article, Users, proStaTer
WHERE Country.rID = Region.rID AND Article.uID = Users.uID AND Users.pstID = proStaTer.pstID and proStaTer.cID = Country.cID
GROUP BY cName,rName
ORDER BY rName ASC, numOfPublications DESC;

# Query 17
WITH
    cte1 AS (SELECT pstName,proStaTer.pstID,SUM(vacTotal) AS totalVaccinated,SUM(vacButDied) AS totalVaccinatedbutDied FROM VaccineCompany,proStaTer
             WHERE proStaTer.pstID = VaccineCompany.pstID
             GROUP BY proStaTer.pstName),
    cte2 AS (SELECT cName,SUM(totPopulation) AS popSum,SUM(totDeaths) AS deathSum FROM proStaTer,Country
             WHERE Country.cID = proStaTer.cID
             GROUP BY proStaTer.cID)

SELECT rName, Country.cName,cte2.popSum,cte2.deathSum,SUM(cte1.totalVaccinated) AS totalVaccinatedCountry,SUM(cte1.totalVaccinatedbutDied) AS totalVaccinatedbutDiedCountry FROM Region JOIN Country JOIN proStaTer JOIN cte1 JOIN cte2
WHERE Region.rID = Country.rID AND Country.cName = cte2.cName AND proStaTer.pstID = cte1.pstID AND proStaTer.cID = Country.cID
GROUP BY Country.cID
ORDER BY cte2.deathSum ASC;



