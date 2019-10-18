create database gestione_parcheggi;

use gestione_parcheggi;

create table parametri(
    id int auto_increment primary key,
    n_posteggi int,
    costo int,
    data_aggiornamento datetime
);

create table ruolo(
    nome varchar(50) primary key
);

create table posteggio(
    id int auto_increment primary key,
    disponibilita varchar(50),
    data_disp datetime,
    n_targa varchar(9)
);

create table utente(
    id int auto_increment primary key,
    ruolo varchar(50),
    nome varchar(50) not null,
    cognome varchar(50)not null,
    mail varchar(50) unique not null,
    via varchar(50),
    cap int(4),
    citta varchar(50),
    tel varchar(10) not null,
    data_r datetime,
    attivo boolean,
    password varchar(255),
    id_posteggio int,
    foreign key(ruolo) references ruolo(nome),
    foreign key(id_posteggio) references posteggio(id)
);

create table prenotazione(
    id int auto_increment primary key,
    richiamo boolean,
    data_prenotazione datetime,
    id_utente int,
    id_posteggio int,
    id_parametri int,
    foreign key(id_utente) references utente(id),
    foreign key(id_posteggio) references posteggio(id),
    foreign key(id_parametri) references parametri(id)
);

insert into parametri (id, n_posteggi, costo, data_aggiornamento) values (null, 100, 10, current_timestamp);

insert into ruolo (nome) values ('admin');
insert into ruolo (nome) values ('user');

insert into posteggio (id, disponibilita, data_disp, n_targa) values (null, null, null, null);
insert into posteggio (id, disponibilita, data_disp, n_targa) values (null, null, null, null);
insert into posteggio (id, disponibilita, data_disp, n_targa) values (null, null, null, null);

insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Stacie', 'Torns', 'storns0@cdbaby.com', 'Duke', '3762', 'Cadagmayan Norte', '8741546381', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Silvia', 'Gilyatt', 'sgilyatt1@vinaora.com', 'Granby', '984', 'Tuguanpu', '1726605297', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Thia', 'McCarroll', 'tmccarroll2@java.com', 'Ilene', '3099', 'Suhe', '7107971333', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Jorey', 'Feldbrin', 'jfeldbrin3@sun.com', 'Londonderry', '9277', 'Taiobeiras', '5407606865', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Randie', 'Beachem', 'rbeachem4@github.com', 'Monument', '26', 'Kotlyarevskaya', '1849521629', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Stillmann', 'Wrighton', 'swrighton5@vinaora.com', 'Transport', '1', 'Arroyo Seco', '3415995882', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Lauretta', 'Wilcot', 'lwilcot6@vistaprint.com', 'Pleasure', '7220', 'Caminaca', '7817719852', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Neille', 'Maddocks', 'nmaddocks7@theguardian.com', 'Schlimgen', '9', 'Langjun', '6197480687', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Wallis', 'Castell', 'wcastell8@ed.gov', 'Anniversary', '2', 'Tianjin', '7072962625', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', null);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'user', 'Paul', 'Vereker', 'pvereker9@zimbio.com', 'Manufacturers', '4833', 'Karakol', '1926067930', current_timestamp, false, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 1);
insert into utente (id, ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio) values (null, 'admin', 'Paolo', 'Weishaupt', 'paolo.weishaupt@gmail.com', 'Via ai Saleggi 36', '6600', 'Locarno', '1926067930', current_timestamp, true, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 2);
