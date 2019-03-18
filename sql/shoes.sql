create table shoes (
   num int not null auto_increment,
   sh_name char(60) not null,
   sh_color  char(15) not null,
   sh_type char(13) not null,
   sh_lev int not null,
   sh_money int not null,
   content text not null,
   regist_day char(20),
   size230 int,
   size240 int,
   size250 int,
   size260 int,
   size270 int,
   size280 int,
   size290 int,
   file_name_0 char(40),
   file_name_1 char(40),
   file_name_2 char(40),
   file_name_3 char(40),
   file_name_4 char(40),
   file_copied_0 char(30),
   file_copied_1 char(30),
   file_copied_2 char(30),
   file_copied_3 char(30),
   file_copied_4 char(30), 
   primary key(num)
);
