create table board_etc (
   num int not null auto_increment,
   id char(15) not null,
   name char(10) not null,
   content text not null,  
   destination char(10) not null,
   reservation int not null,
   regist_day char(20) not null,
   time char(20) not null,
    point int,
   primary key(num)
);
