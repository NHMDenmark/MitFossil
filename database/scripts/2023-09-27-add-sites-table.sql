create table pages
(
    id         bigint unsigned auto_increment,
    title      varchar(100) null,
    text       text         null,
    created_at timestamp    null,
    updated_at timestamp    null,
    constraint pages_pk
        primary key (id)
);

insert into mitfossil.pages (title, text, created_at, updated_at)
values ('Text 1', 'Text 2', now(), now());

alter table fossils
    modify length varchar(50) null;

alter table fossils
    modify width varchar(50) null;

alter table fossils
    modify height varchar(50) null;

alter table users
    modify email varchar(255) null;

alter table users
    modify username varchar(32) null;

alter table users
    modify password varchar(255) null;
