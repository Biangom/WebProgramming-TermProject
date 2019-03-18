create table view_ripple (
    num int not null auto_increment,
    parent int not null,
    id char(15) not null,
    name char(10) not null,
    content text not null,
    regist_day char(20),
    primary key(num)
);