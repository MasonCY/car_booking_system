CREATE TABLE IF NOT EXISTS CLIENT
(
    ID integer not null primary key autoincrement,
    name VARCHAR(30) not null,  
    age integer not null, 
    licenseNumber VARCHAR(18) not null unique,
    licenceType VARCHAR(3) not null,
    email VARCHAR(50) not null 

);
CREATE TABLE IF NOT EXISTS CAR
(
    ID integer not null primary key autoincrement,
    rego char(6) not null unique,
    make varchar(20) not null,
    model varchar(10) not null,
    year char(4) not null,
    odometer integer not null,
    color varchar(10) not null 
);
CREATE TABLE IF NOT EXISTS BOOKING
(
    carID integer not null,
    clientID integer not null,
    startDate varchar(15),
    startTime varchar(15),
    returnDate varchar(15),
    returnTime varchar(15),
    PRIMARY KEY(carID, clientID),
    FOREIGN KEY(carID) REFERENCES CAR(ID),
    FOREIGN KEY(clientID) REFERENCES CLIENT(ID)
);
insert into client values(null,'Rick Novak', 25, '23324321','C','Rick_Novak@gmail.com');
insert into client values(null,'Susan Connor', 28, '23324322','B','Susan_Connor@gmail.com');
insert into client values(null,'Margaret Adelman', 19, '23324323','C','Margaret_Adelman@gmail.com');
insert into client values(null,'Rnald Barr', 35, '23324324','A','Rnald_Barr@gmail.com');
insert into client values(null,'Marie Broadbet', 46, '23324325','A','Marie_Broadbet@gmail.com');
insert into client values(null,'Roger Lum', 27, '23324326','A','Roger_Lum@gmail.com');
insert into client values(null,'Jeff Johnson', 23, '23324327','C','Jeff_Johnson@gmail.com');
insert into client values(null,'Melvin Forbis', 25, '23324328','C','Melvin_Forbis@gmail.com');
insert into car values(null,'003AAA','Ford','Cobra','2019','20000','Blue');
insert into car values(null,'004AAB','Ford','Bronco','2020','10000','White');
insert into car values(null,'005AAC','Ford','Capri','2018','30000','Red');
insert into car values(null,'006AAD','Audi','A3','2015','50000','Black');
insert into car values(null,'007AAE','Audi','A4','2016','40000','Silver');
insert into car values(null,'008AAF','Audi','A5','2017','30000','Black');
insert into car values(null,'009AAG','Audi','A6','2018','20000','White');
insert into car values(null,'010AAH','Audi','A7','2019','10000','Blue');
insert into car values(null,'011AAI','Audi','A8','2020','5000','Black');
insert into booking values(1,1,'2021-10-09','17:00','2021-10-11','16:00');
insert into booking values(1,2,'2021-10-13','13:00','2021-10-16','16:00');
insert into booking values(1,3,'2021-10-17','12:00','2021-10-19','15:00');
insert into booking values(2,4,'2021-10-20','15:00','2021-10-21','16:00');
insert into booking values(2,5,'2021-10-22','09:00','2021-10-24','16:00');
insert into booking values(2,6,'2021-10-25','08:00','2021-10-27','13:00');
insert into booking values(3,2,'2021-10-29','14:00','2021-11-01','16:00');
insert into booking values(3,4,'2021-11-02','13:00','2021-11-04','11:00');
insert into booking values(3,5,'2021-11-05','11:00','2021-11-07','16:00');
insert into booking values(4,6,'2021-11-09','12:00','2021-11-11','16:00');
