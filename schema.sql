create database todolist;
use todolist;

create table projects (
    id int auto_increment primary key,
    project char(128)
);

create table tasks (
    id int auto_increment primary key,
    create_dttm timestamp(6),
    realized_dttm timestamp(6),
    task char(128),
    filename char(128),
    due_dttm timestamp(6),
    image_url char(128)
);

create table users (
    id int auto_increment primary key,
    register_dttm timestamp(6),
    email char(128),
    name char(128),
    pass_hash char(64),
    phone char(12)
);

create index project_i on projects(project);
create index create_dttm_i on tasks(create_dttm);

create index realized_dttm_i on tasks(realized_dttm);
create index task_i on tasks(task);
create index filename_i on tasks(filename);
create index due_dttm_i on tasks(due_dttm);
create index image_url_i on tasks(image_url);

create index register_dttm_i on users(register_dttm);
create unique index email_i on users(email);
create index name_i on users(name);
create unique index phone_i on users(phone);