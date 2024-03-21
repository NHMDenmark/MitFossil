alter table fossil_identifies
    add vote_curator_date timestamp null;

alter table fossils
    add vote_scientific_id bigint unsigned null;

alter table fossils
    add vote_scientific_date timestamp null;

alter table fossils
    add constraint fossils_user_scientific_fk
        foreign key (vote_scientific_id) references users (id);
