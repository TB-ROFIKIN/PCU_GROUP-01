create table users (
    id int (11) auto_increment primary key,
    username varchar(50) not null unique,
    email varchar(100) not null unique,
    password varchar(255) not null unique,
    role id int(11),
    created at timestamp default current_timestamp
);