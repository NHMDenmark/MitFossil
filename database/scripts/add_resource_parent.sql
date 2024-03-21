alter table resources
    add resource_id bigint unsigned null after id;

alter table resources
    add constraint resources_parent_fk
        foreign key (resource_id) references resources (id);

