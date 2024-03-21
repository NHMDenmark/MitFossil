alter table users
    drop foreign key users_fossil_region_id_foreign;

alter table users
    drop foreign key users_fossil_speciality_id_foreign;

drop index users_fossil_region_id_foreign on users;

drop index users_fossil_speciality_id_foreign on users;

alter table users
    change fossil_speciality_id fossil_speciality varchar(50) null;

alter table users
    change fossil_region_id fossil_region varchar(50) null;
