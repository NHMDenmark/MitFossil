alter table fossils
    drop column need_identify;

alter table fossils
    add send_report int null after send_delete;
