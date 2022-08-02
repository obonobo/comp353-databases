# Functional Dependencies

User(uID, fName, lName, uType, phoneNum, email, pstID)
FD = { uID -> fName lName uType phoneNum email pstID }

SpecialUser(uID, username, password)
FD = { uID -> username password }

Admin(adminID, uID)
FD = { adminID -> uID }

Researcher(researcherID, uID)
FD = { researcherID -> uID }

OrgDelegates(delegateID, uID, oID)
FD = { delegateID -> uID oID }

VaccineRecords(compID, timestamp, vacButDied, vacButInfected, vacTotal)
FD = { timestamp compID -> vacButDied vacButInfected vacTotal }

VaccineCompany(compID, pstID, vaccine)
FD = { compID -> vaccine pstID }

ProStatTer(pstID, cID, proStaTerName)
FD = { pstID -> cID proStaTerName }

ProStatTerRecords(pstID, timestamp, totPopulation, totDeaths, infectedNoVaccine)
FD = { pstID timestamp -> totPopulation totDeaths infectedNoVaccine }

EmailRecords(recordID, username, timestamp, subject, body)
FD = { recordID -> username timestamp subject body }

Country(cID, rID, cName)
FD = { cID -> rID cName }

Region(rID, rName)
FD = { rID -> rName }

Organization(oID, cID, orgType, orgName)
FD = { oID -> cID orgType orgName }

Article(aID, artTitle, uID, authName, summary, minTopic, pubDate, majTopic)
FD = { aID -> artTitle uID authName summary minTopic pubDate majTopic }
