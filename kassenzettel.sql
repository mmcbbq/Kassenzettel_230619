drop database if exists kassenzettel;
create database Kassenzettel;
use Kassenzettel;


CREATE TABLE kassenzettel (
    id int PRIMARY KEY auto_increment,
    datum datetime
);

CREATE TABLE artikel(
    id int PRIMARY KEY auto_increment,
    name varchar(255),
    preis double,
    mwstsatz int
);

CREATE TABLE Kassen_Artikel(
    id int PRIMARY KEY auto_increment,
    anzahl int,
    kassenzettel_id int,
    artikel_id int,
    FOREIGN KEY (kassenzettel_id) REFERENCES kassenzettel(id) on DELETE CASCADE ,
    FOREIGN KEY (artikel_id) REFERENCES artikel(id) on DELETE CASCADE

);


SELECT anzahl , a.name, a.preis,a.mwstsatz, (anzahl * a.preis) as Geas
FROM kassen_artikel
join artikel a on a.id = artikel_id
where kassenzettel_id = 5;


