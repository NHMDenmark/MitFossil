alter table fossils
    add send_delete boolean default false not null after need_identify;
