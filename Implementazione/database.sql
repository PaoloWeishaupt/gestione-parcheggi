create database gestione_parcheggi;

use gestione_parcheggi;

create table parametri(
    id int primary key,
    n_posteggi int,
    costo int,
    data_aggiornamento datetime
);

create table ruolo(
    nome varchar(50) primary key,
);

create table utente(
    id int primary key,
    ruolo varchar(50),
    nome varchar(50) not null,
    cognome varchar(50)not null,
    mail varchar(50) not null,
    via varchar(50),
    cap int(4),
    citta varchar(50),
    tel int(10) not null,
    data_r datetime,
    attivo boolean,
    password varchar(255),
    foreign key(ruolo) references ruolo(nome)
);

create table posteggio(
    id int primary key,
    disponibilita varchar(50),
    data_disp datetime,
    n_targa varchar(8),
    id_utente int,
    foreign key(id_utente) references utente(id)
);

create table prenotazione(
    id int primary key,
    richiamo boolean,
    data_prenotazione datetime,
    id_utente int,
    id_posteggio int,
    id_parametri int,
    foreign key(id_utente) references utente(id),
    foreign key(id_posteggio) references posteggio(id),
    foreign key(id_parametri) references parametri(id),
);