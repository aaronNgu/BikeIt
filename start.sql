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