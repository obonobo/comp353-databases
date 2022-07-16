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


-- q8

-- Get a list of all the users in the system. Details include privilege name,
-- user's first name, last name, email address, phone number, date of birth, and
-- citizenship. Results should be displayed in ascending order by privilege
-- name, then by citizenship, then by date of birth. Privilege name could be
-- either administrator, researcher, or organization delegate. In case of
-- organization delegate, you need to provide the organization's name as well
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
