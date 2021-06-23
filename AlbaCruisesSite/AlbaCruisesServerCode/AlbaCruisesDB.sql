CREATE TABLE Account
(
    accountNo INT(4) PRIMARY KEY AUTO_INCREMENT,
    name char(100) NOT NULL,
    emailAddress varchar(100) NOT NULL,
    password varchar(255) NOT NULL,
    address varchar(100) NOT NULL,
    postCode varchar(8) NOT NULL,
    phoneNo varchar(30) NOT NULL,
    isAdmin boolean,
    UNIQUE (emailAddress)
);

CREATE TABLE Route
(
    routeNo int(2) PRIMARY KEY AUTO_INCREMENT,
    route char(30) NOT NULL,
    fares dec(5,2) NOT NULL
);

CREATE TABLE Journey
(
    journeyNo int(4) PRIMARY KEY AUTO_INCREMENT,
    routeNo int(3) NOT NULL,
    sailingDate date NOT NULL,
    departTime time(0) NOT NULL,
    timeAshore time(0) NOT NULL,
    RT int(3) NOT NULL,
    disSpotTaken boolean NOT NULL,
    FOREIGN KEY (routeNo) REFERENCES Route(routeNo)
);

CREATE TABLE Booking
(
    bookingNo int(3) AUTO_INCREMENT,
    accountNo int(3) NOT NULL,
    journeyNo int(4) NOT NULL,
    authorisedBy char(30),
    ticketQuantity int(2),
    totalFare dec(5,2),
    disabledSeating boolean NOT NULL,
    PRIMARY KEY(bookingNo, accountNo),
    FOREIGN KEY (journeyNo) REFERENCES Journey(journeyNo)
);

INSERT INTO `Route` (`routeNo`,`route`,`fares`) VALUES (NULL,"Eigg to Arann","15.50");
INSERT INTO `Route` (`routeNo`,`route`,`fares`) VALUES (NULL,"Eigg to Muck","10.50");
INSERT INTO `Route` (`routeNo`,`route`,`fares`) VALUES (NULL,"Arann to Muck","12.40");

INSERT INTO `Journey` (`journeyNo`,`routeNo`,`sailingDate`,`departTime`,`timeAshore`,`RT`,`disSpotTaken`) VALUES (NULL,"3","2019-12-24","12:50:00","00:50:00","50","FALSE");

