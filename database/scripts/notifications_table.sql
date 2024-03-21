create table notifications
(
    id         bigint unsigned,
    user_id    bigint unsigned       not null,
    type       varchar(20)           not null,
    title      varchar(50)           not null,
    text       text                  not null,
    viewed     boolean default false not null,
    created_at timestamp             null,
    updated_at timestamp             null,
    constraint notifications_pk
        primary key (id),
    constraint notification_user_fk
        foreign key (user_id) references users(id)
);

alter table notifications
    modify id bigint unsigned auto_increment;

alter table notifications
    add fossil_id bigint unsigned not null after type;

alter table notifications
    modify fossil_id bigint unsigned null;
