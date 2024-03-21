create table files
(
    id          bigint unsigned auto_increment,
    name        varchar(100) not null,
    size        double       null,
    path        varchar(255) null,
    created_at  timestamp    null,
    modified_at timestamp    null,
    constraint files_pk
        primary key (id)
);

alter table notifications
    add user_notificator_id int null after user_id;
