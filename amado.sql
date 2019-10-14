-- auto-generated definition
create table "order"
(
    id_order   serial      not null
        constraint order_pk
            primary key,
    first_name varchar(50) not null,
    last_name  varchar(50),
    email      varchar(80) not null,
    tel        varchar(20),
    address    text,
    zip_code   varchar(20),
    phone      varchar(20),
    comment    text,
    created    timestamp,
    modified   timestamp,
    deleted    timestamp
);

alter table "order"
    owner to homestead;

-- auto-generated definition
create table order_product
(
    id_order_product serial  not null
        constraint order_product_pk
            primary key,
    id_order         integer not null,
    id_product       integer not null,
    qty              integer not null,
    created          timestamp,
    modified         timestamp,
    deleted          timestamp
);

alter table order_product
    owner to homestead;

-- auto-generated definition
create table products
(
    id_product serial      not null
        constraint products_pk
            primary key,
    name       varchar(50) not null,
    stock      integer     not null,
    price      integer     not null,
    show       boolean default true,
    created    timestamp,
    modified   timestamp,
    deleted    timestamp
);

alter table products
    owner to homestead;

-- auto-generated definition
create table users
(
    id_user   serial      not null
        constraint user_pk
            primary key,
    user_name varchar(50) not null
        constraint users_user_name_key
            unique,
    pass_word text,
    enable    boolean default true,
    created   timestamp,
    modified  timestamp,
    deleted   timestamp
);

alter table users
    owner to homestead;

