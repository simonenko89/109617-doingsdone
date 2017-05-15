create database todolist;
use todolist;

create table projects (
    id int auto_increment primary key,
    name varchar(255) not null
);

create table users (
    id int auto_increment primary key,
    registered_dt timestamp default now(),
    email varchar(255) not null,
    name varchar(255) not null,
    pass_hash varchar(255) not null,
    phone varchar(255) null
);

create table tasks (
    id int auto_increment primary key,
    project_id int null,
    user_id int not null,
    FOREIGN KEY (project_id) REFERENCES projects (id) on delete cascade,
    FOREIGN KEY (user_id) REFERENCES users (id) on delete cascade,
    created_dt timestamp default now(),
    realized_dt timestamp null,
    name varchar(255) not null,
    filename varchar(255) null,
    due_dt timestamp null,
    image_url varchar(255) null
);

create index project_id_i on tasks(project_id);
create index user_id_i on tasks(user_id);
create unique index email_i on users(email);