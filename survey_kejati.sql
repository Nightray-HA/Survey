/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28/06/2021 23:01:43                          */
/*==============================================================*/



/*==============================================================*/
/* Table: DIVISI                                                */
/*==============================================================*/
create table DIVISI
(
   ID_DIVISI            int not null auto_increment comment '',
   NAMA_DIVISI          varchar(255)  comment '',
   primary key (ID_DIVISI)
);

/*==============================================================*/
/* Table: SURVEY                                                */
/*==============================================================*/
create table SURVEY
(
   ID_SURVEY            int not null auto_increment comment '',
   ID_DIVISI            int not null  comment '',
   TANGGAL_SURVEY       date  comment '',
   TANGGAPAN            varchar(11)  comment '',
   primary key (ID_SURVEY)
);

/*==============================================================*/
/* Table: ADMIN                                                */
/*==============================================================*/
create table ADMIN
(
   ID_ADMIN            int not null auto_increment comment '',
   NAMA_ADMIN          varchar(255) not null comment '',
   USERNAME            varchar(16) not null comment '',
   PASSWORD            varchar(16) not null comment '',
   primary key (ID_ADMIN)
);

alter table SURVEY add constraint FK_SURVEY_RELATIONS_DIVISI foreign key (ID_DIVISI)
      references DIVISI (ID_DIVISI) on delete restrict on update restrict;

