alter table resources
    add image varchar(255) null after resource_order;

alter table map_resources
    drop column title;

alter table map_resources
    drop column description;
