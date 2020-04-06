CREATE TABLE Repair_Centre
(
    Location integer,
    Name varchar(20),
    PostalCode varchar(20),
    PRIMARY KEY (Location , Name)
);

CREATE TABLE EmployEmployeeOne
(
    SIN integer Primary Key,
    ID integer,
    Email char(25),
    CenterLocation integer,
    CenterName char(20),

    FOREIGN KEY (CenterLocation, CenterName) REFERENCES Repair_Centre(Location, Name)
);

CREATE TABLE EmployEmployeeTwo
(
    Email char(25) Primary Key REFERENCES EmployEmployeeOne(Email),
    Name char(20) UNIQUE 

);

CREATE TABLE TechnicianOne
(
    SIN integer,
    Type char(20),
    Name char(20),
    ID char(20),
    FOREIGN KEY (SIN) REFERENCES EmployEmployeeOne(SIN),
    FOREIGN KEY (Name) REFERENCES EmployEmployeeTwo (Name)
);

CREATE TABLE TechnicianTwo
(
    SIN integer,
    Email char(25),
    FOREIGN KEY (SIN) REFERENCES EmployEmployeeOne(SIN),
    FOREIGN KEY (Email) REFERENCES EmployEmployeeTwo(Email)
);

CREATE TABLE Delivery_Person_One
(
    SIN integer,
    Email char(25),
    FOREIGN KEY (SIN) REFERENCES EmployEmployeeOne(SIN),
    FOREIGN KEY (Email) REFERENCES EmployEmployeeTwo(Email)
);

CREATE TABLE Delivery_Person_Two
(
    SIN integer,
    Trolley_ID integer,
    Name char(20),
    ID char(20),
    FOREIGN KEY(SIN) REFERENCES EmployEmployeeOne(SIN),
    FOREIGN KEY (Name) REFERENCES EmployEmployeeTwo (Name)
);

CREATE TABLE TrolleyTwo
(
    SIN integer,
    ID integer,
    LastMaintained Date,  
    FOREIGN KEY (SIN) REFERENCES EmployEmployeeOne(SIN)
);

CREATE TABLE TrolleyOne
(
    LastMaintained Date Primary Key REFERENCES TrolleyTwo(LastMaintained),
    NextMaintenance Date
);

CREATE TABLE HubOne
(
    ID integer REFERENCES HubThree(ID),
    Location char(20)
);

CREATE TABLE HubTwo
(
    Address char(20) REFERENCES HubThree(Address),
    Location char(20)
);

CREATE TABLE HubThree
(
    ID integer,
    Address char(20),
    Employee_ID integer REFERENCES EmployEmployeeOne(ID)

);

CREATE TABLE Belong
(
    HID integer REFERENCES HubThree(ID),
    BID integer REFERENCES BikeTwo(ID)
);

CREATE TABLE BikeOne
(
    ID integer REFERENCES BikeTwo(ID),
    Age integer
);

CREATE TABLE BikeTwo
(
    ID integer,
    Electric boolean,
    LastMaintained Date
);

CREATE TABLE UserOne
(
    ID integer Primary Key AUTO_INCREMENT,
    Email char(20) UNIQUE
);

CREATE TABLE UserTwo
(
    Email char(20) REFERENCES UserOne(Email) ON DELETE CASCADE,
    Name char(20),
    CONSTRAINT Email_fk FOREIGN KEY (Email) REFERENCES UserOne(Email) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE AccountOne
(
    AccountNumber integer,
    CreditCardNumber integer,
    UID integer REFERENCES UserOne(ID)
);

CREATE TABLE AccountTwo
(
    AccountNumber integer REFERENCES AccountOne(AccountNumber),
    Tier char(20)
);

-- TODO: need to add in instances for each of the table

INSERT INTO Repair_Centre VALUES(1, "ubc", "V6T1Z1");
INSERT INTO Repair_Centre VALUES(2, "west van", "V7P3GA");
INSERT INTO Repair_Centre VALUES(3, "van", "V5H3Z7");
INSERT INTO Repair_Centre VALUES(4, "burnaby", "V3H1G7");
INSERT INTO Repair_Centre VALUES(5, "richmond", "V3M0A6");

INSERT INTO EmployEmployeeOne VALUES(101,1,"joeD@gmail.com",1,"ubc");
INSERT INTO EmployEmployeeOne VALUES(202,2,"janeD@gmail.com",2,"west van");
INSERT INTO EmployEmployeeOne VALUES(303,3,"johnR@hotmail.com",3,"van");
INSERT INTO EmployEmployeeOne VALUES(404,4,"jennyR@hotmail.com",4,"burnaby");
INSERT INTO EmployEmployeeOne VALUES(505,5,"jackH@yahoo.com",5,"richmond");

INSERT INTO EmployEmployeeTwo VALUES("joeD@gmail.com","Joe D");
INSERT INTO EmployEmployeeTwo VALUES("janeD@gmail.com","Jane D");
INSERT INTO EmployEmployeeTwo VALUES("johnR@hotmail.com","John R");
INSERT INTO EmployEmployeeTwo VALUES("jennyR@hotmail.com","Jenny R");
INSERT INTO EmployEmployeeTwo VALUES("jackH@yahoo.com","Jack H");

INSERT INTO TechnicianOne VALUES(101,"bike repair","Joe D",1);
INSERT INTO TechnicianOne VALUES(202,"tire repair","Jane D",2);

INSERT INTO TechnicianTwo VALUES(101,"joeD@gmail.com");
INSERT INTO TechnicianTwo VALUES(202,"janeD@gmail.com");

INSERT INTO Delivery_Person_One VALUES(303,"johnR@hotmail.com");
INSERT INTO Delivery_Person_One VALUES(404,"jennyR@hotmail.com");

INSERT INTO Delivery_Person_Two VALUES(303,11,"John R",3);
INSERT INTO Delivery_Person_Two VALUES(404,22,"Jenny R",4);

INSERT INTO TrolleyTwo VALUES(303,11,"2020-01-01");
INSERT INTO TrolleyTwo VALUES(404,22,"2020-02-02");

INSERT INTO TrolleyOne VALUES("2020-01-01","2020-01-31");
INSERT INTO TrolleyOne VALUES("2020-02-02","2020-02-29");

INSERT INTO HubThree VALUES(1111,"1111 Test Rd",1);
INSERT INTO HubThree VALUES(1111,"1111 Test Rd",3);
INSERT INTO HubThree VALUES(2222,"2222 Test Ave",2);
INSERT INTO HubThree VALUES(2222,"2222 Test Rd",4);

INSERT INTO HubTwo VALUES("1111 Test Rd","ubc");
INSERT INTO HubTwo VALUES("2222 Test Rd","van");

INSERT INTO HubOne VALUES(1111,"ubc");
INSERT INTO HubOne VALUES(2222,"van");

INSERT INTO BikeTwo VALUES(121,true,"2019-12-31");
INSERT INTO BikeTwo VALUES(122,true,"2019-08-31");
INSERT INTO BikeTwo VALUES(123,false,"2020-01-31");
INSERT INTO BikeTwo VALUES(124,false,"2020-03-31");

INSERT INTO BikeOne VALUES(121,1);
INSERT INTO BikeOne VALUES(122,0);
INSERT INTO BikeOne VALUES(123,2);
INSERT INTO BikeOne VALUES(124,2);

INSERT INTO Belong VALUES(1111,121);
INSERT INTO Belong VALUES(1111,122);
INSERT INTO Belong VALUES(2222,123);
INSERT INTO Belong VALUES(2222,124);

INSERT INTO UserOne VALUES(1211,"user1@gmail.com");
INSERT INTO UserOne VALUES(1212,"user2@gmail.com");
INSERT INTO UserOne VALUES(1213,"user3@gmail.com");
INSERT INTO UserOne VALUES(1214,"user4@gmail.com");

INSERT INTO UserTwo VALUES("user1@gmail.com","Anna S");
INSERT INTO UserTwo VALUES("user2@gmail.com","Bob S");
INSERT INTO UserTwo VALUES("user3@gmail.com","Caesar S");
INSERT INTO UserTwo VALUES("user4@gmail.com","Denny S");

INSERT INTO AccountOne VALUES(1201, 12345678, 1211);
INSERT INTO AccountOne VALUES(1202, 23456789, 1212);
INSERT INTO AccountOne VALUES(1203, 34567890, 1213);
INSERT INTO AccountOne VALUES(1204, 45678901, 1214);

INSERT INTO AccountTwo VALUES(1201, "trial");
INSERT INTO AccountTwo VALUES(1202, "trial");
INSERT INTO AccountTwo VALUES(1203, "premium");
INSERT INTO AccountTwo VALUES(1204, "premium");