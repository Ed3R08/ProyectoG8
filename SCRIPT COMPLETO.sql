--------------------------------------------------------
-- Archivo creado  - jueves-noviembre-27-2025   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Sequence SEQ_CARRITO
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_CARRITO"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 21 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_CATEGORIA
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_CATEGORIA"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 21 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_DETALLE
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_DETALLE"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 21 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_DIRECCION
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_DIRECCION"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_ERROR
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_ERROR"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_FAVORITOS
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_FAVORITOS"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 21 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_HISTORIAL
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_HISTORIAL"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 21 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_INFORME
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_INFORME"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_PRODUCTO
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_PRODUCTO"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 41 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_ROL
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_ROL"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_TIPO_SERVICIO
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_TIPO_SERVICIO"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_USUARIOS
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_USUARIOS"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 6 NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_VISITA
--------------------------------------------------------

   CREATE SEQUENCE  "OCTAVIUS"."SEQ_VISITA"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Table CARRITO
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."CARRITO" 
   (	"ID_CARRITO" NUMBER(11,0), 
	"ID_USUARIO" NUMBER(11,0), 
	"ID_PRODUCTO" NUMBER(12,0), 
	"CANTIDAD" NUMBER(11,0), 
	"FECHA_AGREGADO" DATE DEFAULT SYSDATE
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table CATEGORIA
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."CATEGORIA" 
   (	"ID_CATEGORIA" NUMBER(10,0), 
	"DESCRIPCION" VARCHAR2(255 BYTE), 
	"ACTIVO" NUMBER(1,0), 
	"RUTA_IMAGEN" VARCHAR2(255 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table DETALLE_COMPRA
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."DETALLE_COMPRA" 
   (	"ID_DETALLE" NUMBER(12,0), 
	"ID_COMPRA" NUMBER(12,0), 
	"ID_PRODUCTO" NUMBER(12,0), 
	"CANTIDAD" NUMBER(11,0), 
	"PRECIO_UNITARIO" NUMBER(12,2)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table DIRECCION
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."DIRECCION" 
   (	"ID_USUARIO" NUMBER(11,0), 
	"ID_DIRECCION" NUMBER(11,0), 
	"PROVINCIA" VARCHAR2(20 BYTE), 
	"CANTON" VARCHAR2(20 BYTE), 
	"DISTRITO" VARCHAR2(20 BYTE), 
	"DIRECCION_DETALLADA" VARCHAR2(100 BYTE), 
	"CODIGO_POSTAL" NUMBER(10,0)
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table ERROR
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."ERROR" 
   (	"ID_ERROR" NUMBER(11,0), 
	"DESCRIPCION" VARCHAR2(255 BYTE), 
	"FECHA_HORA" TIMESTAMP (6) DEFAULT CURRENT_TIMESTAMP
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table FAVORITOS
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."FAVORITOS" 
   (	"ID_FAVORITO" NUMBER(11,0), 
	"ID_PRODUCTO" NUMBER(12,0), 
	"ID_USUARIO" NUMBER(11,0)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table HISTORIAL_COMPRA
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."HISTORIAL_COMPRA" 
   (	"ID_COMPRA" NUMBER(12,0), 
	"ID_USUARIO" NUMBER(11,0), 
	"TOTAL" NUMBER(12,2), 
	"FECHA" DATE DEFAULT SYSDATE
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table INFORME_VISITA_TECNICA
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."INFORME_VISITA_TECNICA" 
   (	"ID_INFORME" NUMBER(12,0), 
	"ID_VISITA" NUMBER(20,0), 
	"DESCRIPCION" VARCHAR2(255 BYTE)
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table PRODUCTO
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."PRODUCTO" 
   (	"ID_PRODUCTO" NUMBER(12,0), 
	"ID_CATEGORIA" NUMBER(10,0), 
	"NOMBRE" VARCHAR2(100 BYTE), 
	"DETALLE" VARCHAR2(500 BYTE), 
	"PRECIO" NUMBER(12,2), 
	"CANTIDAD" NUMBER(11,0), 
	"ESTADO" NUMBER(1,0), 
	"RUTA_IMAGEN" VARCHAR2(255 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table ROL
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."ROL" 
   (	"ID_ROL" NUMBER(11,0), 
	"NOMBRE_ROL" VARCHAR2(50 BYTE), 
	"DESCRIPCION_ROL" VARCHAR2(50 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table TIPO_SERVICIO
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."TIPO_SERVICIO" 
   (	"ID_TIPO" NUMBER(11,0), 
	"DESCRIPCION" VARCHAR2(100 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table USUARIOS
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."USUARIOS" 
   (	"ID_USUARIO" NUMBER(11,0), 
	"NOMBRE" VARCHAR2(100 BYTE), 
	"APELLIDO1" VARCHAR2(100 BYTE), 
	"APELLIDO2" VARCHAR2(100 BYTE), 
	"CORREO" VARCHAR2(255 BYTE), 
	"IDENTIFICACION" VARCHAR2(20 BYTE), 
	"CONTRASENA" VARCHAR2(50 BYTE), 
	"ID_ROL" NUMBER(11,0)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Table VISITA_TECNICA
--------------------------------------------------------

  CREATE TABLE "OCTAVIUS"."VISITA_TECNICA" 
   (	"ID_VISITA" NUMBER(20,0), 
	"ID_USUARIO" NUMBER(11,0), 
	"ID_TIPO" NUMBER(11,0), 
	"FECHA_HORA" DATE, 
	"DIRECCION" VARCHAR2(255 BYTE), 
	"MOTIVO" VARCHAR2(100 BYTE)
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" ;
REM INSERTING into OCTAVIUS.CARRITO
SET DEFINE OFF;
REM INSERTING into OCTAVIUS.CATEGORIA
SET DEFINE OFF;
Insert into OCTAVIUS.CATEGORIA (ID_CATEGORIA,DESCRIPCION,ACTIVO,RUTA_IMAGEN) values ('5','Quimicos','1','/ProyectoG8/Uploads/categorias/cat_69212c90be816.jpg');
Insert into OCTAVIUS.CATEGORIA (ID_CATEGORIA,DESCRIPCION,ACTIVO,RUTA_IMAGEN) values ('6','Accesorios 1','1','/ProyectoG8/Uploads/categorias/cat_69212c9da2ede.jpeg');
Insert into OCTAVIUS.CATEGORIA (ID_CATEGORIA,DESCRIPCION,ACTIVO,RUTA_IMAGEN) values ('7','Equipos','1','/ProyectoG8/Uploads/categorias/cat_69212caa66a7b.jpeg');
Insert into OCTAVIUS.CATEGORIA (ID_CATEGORIA,DESCRIPCION,ACTIVO,RUTA_IMAGEN) values ('8','Servicios Varios2','1','/ProyectoG8/Uploads/categorias/cat_692134a938553.jpeg');
REM INSERTING into OCTAVIUS.DETALLE_COMPRA
SET DEFINE OFF;
Insert into OCTAVIUS.DETALLE_COMPRA (ID_DETALLE,ID_COMPRA,ID_PRODUCTO,CANTIDAD,PRECIO_UNITARIO) values ('1','1','21','3','30');
REM INSERTING into OCTAVIUS.DIRECCION
SET DEFINE OFF;
REM INSERTING into OCTAVIUS.ERROR
SET DEFINE OFF;
REM INSERTING into OCTAVIUS.FAVORITOS
SET DEFINE OFF;
REM INSERTING into OCTAVIUS.HISTORIAL_COMPRA
SET DEFINE OFF;
Insert into OCTAVIUS.HISTORIAL_COMPRA (ID_COMPRA,ID_USUARIO,TOTAL,FECHA) values ('1','3','90',to_date('27/11/25','DD/MM/RR'));
REM INSERTING into OCTAVIUS.INFORME_VISITA_TECNICA
SET DEFINE OFF;
REM INSERTING into OCTAVIUS.PRODUCTO
SET DEFINE OFF;
Insert into OCTAVIUS.PRODUCTO (ID_PRODUCTO,ID_CATEGORIA,NOMBRE,DETALLE,PRECIO,CANTIDAD,ESTADO,RUTA_IMAGEN) values ('21','6','Boquilla de retorno','134546','30','100','1','/ProyectoG8/Uploads/productos/prod_6928b0a7c5eda.jpeg');
REM INSERTING into OCTAVIUS.ROL
SET DEFINE OFF;
Insert into OCTAVIUS.ROL (ID_ROL,NOMBRE_ROL,DESCRIPCION_ROL) values ('1','Usuario Regular','Cliente con permisos básicos');
Insert into OCTAVIUS.ROL (ID_ROL,NOMBRE_ROL,DESCRIPCION_ROL) values ('2','Usuario Administrador','Administrador del sistema');
Insert into OCTAVIUS.ROL (ID_ROL,NOMBRE_ROL,DESCRIPCION_ROL) values ('3','Usuario Tecnico','Técnico que brinda servicios');
REM INSERTING into OCTAVIUS.TIPO_SERVICIO
SET DEFINE OFF;
Insert into OCTAVIUS.TIPO_SERVICIO (ID_TIPO,DESCRIPCION) values ('1','Mantenimiento general');
Insert into OCTAVIUS.TIPO_SERVICIO (ID_TIPO,DESCRIPCION) values ('2','Visita técnica');
Insert into OCTAVIUS.TIPO_SERVICIO (ID_TIPO,DESCRIPCION) values ('3','Limpieza profunda');
REM INSERTING into OCTAVIUS.USUARIOS
SET DEFINE OFF;
Insert into OCTAVIUS.USUARIOS (ID_USUARIO,NOMBRE,APELLIDO1,APELLIDO2,CORREO,IDENTIFICACION,CONTRASENA,ID_ROL) values ('4','prueba2','ape1','ape2','prueba2@correo.com','987654321','789','1');
Insert into OCTAVIUS.USUARIOS (ID_USUARIO,NOMBRE,APELLIDO1,APELLIDO2,CORREO,IDENTIFICACION,CONTRASENA,ID_ROL) values ('1','Eder','Serrano','Valerio','eserrano00695@ufide.ac.cr','114300695','12345','2');
Insert into OCTAVIUS.USUARIOS (ID_USUARIO,NOMBRE,APELLIDO1,APELLIDO2,CORREO,IDENTIFICACION,CONTRASENA,ID_ROL) values ('3','prueba','apellido1','apellido2','prueba@correo.com','123456789','12345','1');
Insert into OCTAVIUS.USUARIOS (ID_USUARIO,NOMBRE,APELLIDO1,APELLIDO2,CORREO,IDENTIFICACION,CONTRASENA,ID_ROL) values ('5','Eder1','Serrano1','Valerio1','ederseva@gmail.com','114300198','12345','1');
REM INSERTING into OCTAVIUS.VISITA_TECNICA
SET DEFINE OFF;
--------------------------------------------------------
--  DDL for Index UQ_FAVORITOS
--------------------------------------------------------

  CREATE UNIQUE INDEX "OCTAVIUS"."UQ_FAVORITOS" ON "OCTAVIUS"."FAVORITOS" ("ID_USUARIO", "ID_PRODUCTO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Trigger TRG_CARRITO
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_CARRITO" 
BEFORE INSERT ON carrito
FOR EACH ROW
BEGIN
  IF :NEW.id_carrito IS NULL THEN
    :NEW.id_carrito := seq_carrito.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_CARRITO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_CATEGORIA
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_CATEGORIA" 
BEFORE INSERT ON categoria
FOR EACH ROW
BEGIN
  IF :NEW.id_categoria IS NULL THEN
    :NEW.id_categoria := seq_categoria.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_CATEGORIA" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_DETALLE
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_DETALLE" 
BEFORE INSERT ON detalle_compra
FOR EACH ROW
BEGIN
  IF :NEW.id_detalle IS NULL THEN
    :NEW.id_detalle := seq_detalle.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_DETALLE" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_DIRECCION
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_DIRECCION" 
BEFORE INSERT ON direccion
FOR EACH ROW
BEGIN
  IF :NEW.id_direccion IS NULL THEN
    :NEW.id_direccion := seq_direccion.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_DIRECCION" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_ERROR
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_ERROR" 
BEFORE INSERT ON error
FOR EACH ROW
BEGIN
  IF :NEW.id_error IS NULL THEN
    :NEW.id_error := seq_error.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_ERROR" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_FAVORITOS
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_FAVORITOS" 
BEFORE INSERT ON favoritos
FOR EACH ROW
BEGIN
  IF :NEW.id_favorito IS NULL THEN
    :NEW.id_favorito := seq_favoritos.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_FAVORITOS" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_HISTORIAL
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_HISTORIAL" 
BEFORE INSERT ON historial_compra
FOR EACH ROW
BEGIN
  IF :NEW.id_compra IS NULL THEN
    :NEW.id_compra := seq_historial.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_HISTORIAL" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_INFORME
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_INFORME" 
BEFORE INSERT ON informe_visita_tecnica
FOR EACH ROW
BEGIN
  IF :NEW.id_informe IS NULL THEN
    :NEW.id_informe := seq_informe.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_INFORME" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_PRODUCTO
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_PRODUCTO" 
BEFORE INSERT ON producto
FOR EACH ROW
BEGIN
  IF :NEW.id_producto IS NULL THEN
    :NEW.id_producto := seq_producto.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_PRODUCTO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_ROL
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_ROL" 
BEFORE INSERT ON rol
FOR EACH ROW
BEGIN
  IF :NEW.id_rol IS NULL THEN
    :NEW.id_rol := seq_rol.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_ROL" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_TIPO_SERVICIO
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_TIPO_SERVICIO" 
BEFORE INSERT ON tipo_servicio
FOR EACH ROW
BEGIN
  IF :NEW.id_tipo IS NULL THEN
    :NEW.id_tipo := seq_tipo_servicio.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_TIPO_SERVICIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_USUARIOS
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_USUARIOS" 
BEFORE INSERT ON usuarios
FOR EACH ROW
BEGIN
  IF :NEW.id_usuario IS NULL THEN
    :NEW.id_usuario := seq_usuarios.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_USUARIOS" ENABLE;
--------------------------------------------------------
--  DDL for Trigger TRG_VISITA
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "OCTAVIUS"."TRG_VISITA" 
BEFORE INSERT ON visita_tecnica
FOR EACH ROW
BEGIN
  IF :NEW.id_visita IS NULL THEN
    :NEW.id_visita := seq_visita.NEXTVAL;
  END IF;
END;

/
ALTER TRIGGER "OCTAVIUS"."TRG_VISITA" ENABLE;
--------------------------------------------------------
--  DDL for Procedure ACTIVARCATEGORIA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."ACTIVARCATEGORIA" (
    pId IN NUMBER
)
AS
BEGIN
    UPDATE categoria
       SET activo = 1
     WHERE id_categoria = pId;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure ACTIVARPRODUCTO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."ACTIVARPRODUCTO" (
    pId IN NUMBER
)
AS
BEGIN
    UPDATE producto
       SET estado = 1
     WHERE id_producto = pId;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure ACTUALIZARCONTRASENNA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."ACTUALIZARCONTRASENNA" (
    pIdUsuario   IN NUMBER,
    pContrasenna IN VARCHAR2
)
AS
BEGIN
    UPDATE usuarios
       SET contrasena = pContrasenna
     WHERE id_usuario = pIdUsuario;
END;

/
--------------------------------------------------------
--  DDL for Procedure ACTUALIZARPERFILUSUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."ACTUALIZARPERFILUSUARIO" (
    pIdUsuario      IN NUMBER,
    pNombre         IN VARCHAR2,
    pCorreo         IN VARCHAR2,
    pIdentificacion IN VARCHAR2
)
AS
BEGIN
    UPDATE usuarios
       SET nombre        = pNombre,
           correo        = pCorreo,
           identificacion = pIdentificacion
     WHERE id_usuario = pIdUsuario;
END;

/
--------------------------------------------------------
--  DDL for Procedure CONSULTARINFOUSUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."CONSULTARINFOUSUARIO" (
    pIdUsuario IN NUMBER,
    pCursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN pCursor FOR
        SELECT id_usuario,
               nombre,
               correo,
               identificacion,
               contrasena
        FROM usuarios
        WHERE id_usuario = pIdUsuario;
END;

/
--------------------------------------------------------
--  DDL for Procedure EDITARCATEGORIA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."EDITARCATEGORIA" (
    pId        IN NUMBER,
    pDesc      IN VARCHAR2,
    pImagen    IN VARCHAR2,
    pActivo    IN NUMBER
)
AS
BEGIN
    UPDATE categoria
       SET descripcion = pDesc,
           ruta_imagen = pImagen,
           activo      = pActivo
     WHERE id_categoria = pId;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure EDITARPRODUCTO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."EDITARPRODUCTO" (
    pId_producto   IN NUMBER,
    pIdCategoria   IN NUMBER,
    pNombre        IN VARCHAR2,
    pDetalle       IN VARCHAR2,
    pPrecio        IN NUMBER,
    pExistencias   IN NUMBER,
    pImagen        IN VARCHAR2
)
AS
BEGIN
    UPDATE producto
       SET id_categoria = pIdCategoria,
           nombre       = pNombre,
           detalle      = pDetalle,
           precio       = pPrecio,
           cantidad     = pExistencias,
           ruta_imagen  = pImagen
     WHERE id_producto = pId_producto;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure ELIMINARCATEGORIA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."ELIMINARCATEGORIA" (
    pId IN NUMBER
)
AS
BEGIN
    UPDATE categoria
       SET activo = 0
     WHERE id_categoria = pId;

    UPDATE producto
       SET estado = 0
     WHERE id_categoria = pId;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure ELIMINARPRODUCTO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."ELIMINARPRODUCTO" (
    pId_producto IN NUMBER
)
AS
BEGIN
    UPDATE producto
       SET estado = 0
     WHERE id_producto = pId_producto;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure REGISTRARERROR
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."REGISTRARERROR" (
    pDescripcion IN VARCHAR2
)
AS
BEGIN
    INSERT INTO error(descripcion, fecha_hora)
    VALUES(pDescripcion, CURRENT_TIMESTAMP);

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure REGISTRARUSUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."REGISTRARUSUARIO" (
    pNombre          IN VARCHAR2,
    pApellido1       IN VARCHAR2,
    pApellido2       IN VARCHAR2,
    pCorreo          IN VARCHAR2,
    pIdentificacion  IN VARCHAR2,
    pContrasenna     IN VARCHAR2
)
AS
BEGIN
    INSERT INTO Usuarios (
        Id_Usuario,
        Nombre,
        Apellido1,
        Apellido2,
        Correo,
        Identificacion,
        Contrasena,
        Id_Rol
    )
    VALUES (
        seq_usuarios.NEXTVAL,
        pNombre,
        pApellido1,
        pApellido2,
        pCorreo,
        pIdentificacion,
        pContrasenna,   -- ✔ nombre correcto
        1
    );

END;

/
--------------------------------------------------------
--  DDL for Procedure SP_ACTUALIZAR_CARRITO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_ACTUALIZAR_CARRITO" (
  p_carrito_id     IN NUMBER,
  p_nueva_cantidad IN NUMBER
)
AS
BEGIN
  UPDATE carrito
     SET cantidad = p_nueva_cantidad
   WHERE id_carrito = p_carrito_id;

  COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_AGREGAR_CARRITO1
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_AGREGAR_CARRITO1" (
  p_usuario_id  IN NUMBER,
  p_producto_id IN NUMBER,
  p_cantidad    IN NUMBER
)
AS
  v_existe NUMBER := 0;
BEGIN
  SELECT COUNT(*)
    INTO v_existe
    FROM carrito
   WHERE id_usuario  = p_usuario_id
     AND id_producto = p_producto_id;

  IF v_existe = 0 THEN
    INSERT INTO carrito(id_usuario, id_producto, cantidad)
    VALUES(p_usuario_id, p_producto_id, p_cantidad);
  ELSE
    UPDATE carrito
       SET cantidad = cantidad + p_cantidad
     WHERE id_usuario  = p_usuario_id
       AND id_producto = p_producto_id;
  END IF;

  COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_AGREGAR_FAVORITO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_AGREGAR_FAVORITO" (
    pIdUsuario  IN NUMBER,
    pIdProducto IN NUMBER
) AS
BEGIN
    INSERT INTO FAVORITOS (ID_FAVORITO, ID_USUARIO, ID_PRODUCTO)
    VALUES (SEQ_FAVORITOS.NEXTVAL, pIdUsuario, pIdProducto);

    COMMIT;
EXCEPTION
    WHEN DUP_VAL_ON_INDEX THEN
        -- Ya existe ese favorito para ese usuario, lo ignoramos
        NULL;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_CONSULTA_CATEGORIAS
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_CONSULTA_CATEGORIAS" (
    p_cursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT 
            id_categoria,
            descripcion,
            ruta_imagen
        FROM categoria
        WHERE activo = 1
        ORDER BY descripcion;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_CONSULTA_CATEGORIAS_ADMIN
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_CONSULTA_CATEGORIAS_ADMIN" (
    p_cursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT 
            id_categoria,
            descripcion,
            ruta_imagen,
            activo
        FROM categoria
        ORDER BY descripcion;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_CONSULTA_PRODUCTOS
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_CONSULTA_PRODUCTOS" (
    pCat     IN NUMBER,
    p_cursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT 
            id_producto      AS id_producto,
            id_categoria     AS id_categoria,
            nombre           AS nombre,
            detalle          AS detalle,
            precio           AS precio,
            cantidad         AS existencias,
            ruta_imagen      AS ruta_imagen
        FROM producto
        WHERE id_categoria = pCat
          AND estado = 1
        ORDER BY nombre;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_CONSULTA_PRODUCTOS_ALL
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_CONSULTA_PRODUCTOS_ALL" (
    p_cursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT 
            id_producto      AS id_producto,
            id_categoria     AS id_categoria,
            nombre           AS nombre,
            detalle          AS detalle,
            precio           AS precio,
            cantidad         AS existencias,
            ruta_imagen      AS ruta_imagen,
            estado           AS estado   -- ✅ AÑADIDO
        FROM producto
        ORDER BY nombre;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_CONSULTA_VISITAS
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_CONSULTA_VISITAS" (
    p_user   IN  NUMBER,
    p_cursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT
            v.id_visita,
            v.fecha_hora,
            ts.descripcion AS tipo_servicio,
            v.direccion,
            v.motivo
        FROM visita_tecnica v
        JOIN tipo_servicio ts ON v.id_tipo = ts.id_tipo
        WHERE v.id_usuario = p_user
        ORDER BY v.fecha_hora DESC;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_DETALLE_COMPRA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_DETALLE_COMPRA" (
    p_id_compra IN NUMBER,
    p_cursor    OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT 
            d.cantidad,
            d.precio_unitario AS precio,
            p.nombre AS producto,
            (d.cantidad * d.precio_unitario) AS subtotal
        FROM detalle_compra d
        JOIN producto p ON p.id_producto = d.id_producto
        WHERE d.id_compra = p_id_compra;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_ELIMINAR_CARRITO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_ELIMINAR_CARRITO" (
    p_carrito_id IN NUMBER
)
AS
BEGIN
    DELETE FROM carrito
    WHERE id_carrito = p_carrito_id;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_ELIMINAR_FAVORITO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_ELIMINAR_FAVORITO" (
    pIdUsuario  IN NUMBER,
    pIdProducto IN NUMBER
) AS
BEGIN
    DELETE FROM FAVORITOS
    WHERE ID_USUARIO  = pIdUsuario
      AND ID_PRODUCTO = pIdProducto;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_FINALIZAR_COMPRA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_FINALIZAR_COMPRA" (
    p_usuario_id IN NUMBER
)
AS
    v_total NUMBER(12,2);
    v_id_compra NUMBER;
BEGIN
    -------------------------------------------------------------------
    -- 1. Calcular total del carrito
    -------------------------------------------------------------------
    SELECT SUM(p.precio * c.cantidad)
    INTO v_total
    FROM carrito c
    JOIN producto p ON p.id_producto = c.id_producto
    WHERE c.id_usuario = p_usuario_id;

    IF v_total IS NULL THEN
        v_total := 0;
    END IF;

    -------------------------------------------------------------------
    -- 2. Insertar registro en historial_compra
    -------------------------------------------------------------------
    INSERT INTO historial_compra (
        id_usuario, total
    )
    VALUES (
        p_usuario_id, v_total
    )
    RETURNING id_compra INTO v_id_compra;

    -------------------------------------------------------------------
    -- 3. Insertar detalle (cada producto del carrito)
    -------------------------------------------------------------------
    INSERT INTO detalle_compra (
        id_detalle,
        id_compra,
        id_producto,
        cantidad,
        precio_unitario
    )
    SELECT
        seq_detalle.NEXTVAL,
        v_id_compra,
        c.id_producto,
        c.cantidad,
        p.precio
    FROM carrito c
    JOIN producto p ON p.id_producto = c.id_producto
    WHERE c.id_usuario = p_usuario_id;

    -------------------------------------------------------------------
    -- 4. Vaciar carrito
    -------------------------------------------------------------------
    DELETE FROM carrito
    WHERE id_usuario = p_usuario_id;

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_HISTORIAL_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_HISTORIAL_USUARIO" (
    p_usuario_id IN NUMBER,
    pCursor      OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN pCursor FOR
        SELECT 
            hc.id_compra,
            hc.fecha,
            hc.total,
            dc.id_producto,
            p.nombre AS producto,
            dc.cantidad,
            dc.precio_unitario AS precio
        FROM historial_compra hc
        JOIN detalle_compra dc 
            ON hc.id_compra = dc.id_compra
        JOIN producto p 
            ON p.id_producto = dc.id_producto
        WHERE hc.id_usuario = p_usuario_id
        ORDER BY hc.fecha DESC, hc.id_compra DESC;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_INSERT_CATEGORIA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_INSERT_CATEGORIA" (
    pDesc   IN VARCHAR2,
    pImagen IN VARCHAR2
)
AS
BEGIN
    INSERT INTO categoria (
        descripcion,
        activo,
        ruta_imagen
    )
    VALUES (
        pDesc,
        1,
        pImagen
    );

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_INSERT_PRODUCTO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_INSERT_PRODUCTO" (
    pCat       IN NUMBER,
    pNombre    IN VARCHAR2,
    pDetalle   IN VARCHAR2,
    pPrecio    IN NUMBER,
    pCantidad  IN NUMBER,
    pImagen    IN VARCHAR2
)
AS
BEGIN
    INSERT INTO producto (
        id_producto,
        id_categoria,
        nombre,
        detalle,
        precio,
        cantidad,
        estado,
        ruta_imagen
    )
    VALUES (
        seq_producto.NEXTVAL,
        pCat,
        pNombre,
        pDetalle,
        pPrecio,
        pCantidad,
        1,          -- activo por defecto
        pImagen
    );

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_INSERT_VISITA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_INSERT_VISITA" (
    pUser        IN NUMBER,
    pTipo        IN NUMBER,
    pFechaHora   IN DATE,
    pDireccion   IN VARCHAR2,
    pMotivo      IN VARCHAR2
)
AS
BEGIN
    INSERT INTO visita_tecnica (
        id_usuario,
        id_tipo,
        fecha_hora,
        direccion,
        motivo
    ) VALUES (
        pUser,
        pTipo,
        pFechaHora,
        pDireccion,
        pMotivo
    );

    COMMIT;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_LISTAR_FAVORITOS_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_LISTAR_FAVORITOS_USUARIO" (
    pIdUsuario IN NUMBER,
    p_cursor   OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN p_cursor FOR
        SELECT 
            p.ID_PRODUCTO,
            p.NOMBRE,
            p.DETALLE,
            p.PRECIO,
            p.CANTIDAD,
            p.RUTA_IMAGEN   -- ✅ corregido
        FROM PRODUCTO p
        JOIN FAVORITOS f
          ON f.ID_PRODUCTO = p.ID_PRODUCTO
       WHERE f.ID_USUARIO = pIdUsuario
         AND p.ESTADO = 1
       ORDER BY p.NOMBRE;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_LISTAR_USUARIOS
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_LISTAR_USUARIOS" (
    pCursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN pCursor FOR
        SELECT 
            id_usuario,
            nombre
        FROM usuarios
        ORDER BY nombre;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_ULTIMA_COMPRA_POR_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_ULTIMA_COMPRA_POR_USUARIO" (
    p_usuario_id IN NUMBER,
    pCursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN pCursor FOR
        SELECT 
            h.id_compra,
            h.fecha,
            u.nombre AS cliente
        FROM historial_compra h
        JOIN usuarios u ON u.id_usuario = h.id_usuario
        WHERE h.id_usuario = p_usuario_id
        ORDER BY h.id_compra DESC
        FETCH FIRST 1 ROWS ONLY;
END;

/
--------------------------------------------------------
--  DDL for Procedure SP_VER_CARRITO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."SP_VER_CARRITO" (
    p_usuario_id IN NUMBER,
    pCursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN pCursor FOR
        SELECT
            c.id_carrito,
            p.nombre,
            p.precio,
            c.cantidad,
            (p.precio * c.cantidad) AS subtotal,
            c.fecha_agregado
        FROM carrito c
        JOIN producto p ON p.id_producto = c.id_producto
        WHERE c.id_usuario = p_usuario_id
        ORDER BY c.fecha_agregado DESC;
END;

/
--------------------------------------------------------
--  DDL for Procedure VALIDARCORREO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."VALIDARCORREO" (
    pCorreo IN VARCHAR2,
    pCursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN pCursor FOR
        SELECT 
            id_usuario,
            nombre,
            correo,
            identificacion,
            contrasena
        FROM usuarios
        WHERE UPPER(correo) = UPPER(pCorreo);
END;

/
--------------------------------------------------------
--  DDL for Procedure VALIDARINICIOSESION
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "OCTAVIUS"."VALIDARINICIOSESION" (
    pCorreo        IN  VARCHAR2,
    pContrasenna   IN  VARCHAR2,
    pCursor        OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN pCursor FOR
        SELECT 
            u.id_usuario,
            u.nombre,
            u.correo,
            u.identificacion,
            u.contrasena,
            r.id_rol,
            r.nombre_rol
        FROM usuarios u
        INNER JOIN rol r ON u.id_rol = r.id_rol
        WHERE UPPER(u.correo) = UPPER(pCorreo)
          AND u.contrasena = pContrasenna;
END;

/
--------------------------------------------------------
--  Constraints for Table VISITA_TECNICA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."VISITA_TECNICA" ADD PRIMARY KEY ("ID_VISITA")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table CARRITO
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."CARRITO" ADD PRIMARY KEY ("ID_CARRITO")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table DETALLE_COMPRA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."DETALLE_COMPRA" ADD PRIMARY KEY ("ID_DETALLE")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table ERROR
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."ERROR" ADD PRIMARY KEY ("ID_ERROR")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table ROL
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."ROL" ADD PRIMARY KEY ("ID_ROL")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table FAVORITOS
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."FAVORITOS" ADD PRIMARY KEY ("ID_FAVORITO")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table HISTORIAL_COMPRA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."HISTORIAL_COMPRA" ADD PRIMARY KEY ("ID_COMPRA")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table USUARIOS
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."USUARIOS" ADD PRIMARY KEY ("ID_USUARIO")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table CATEGORIA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."CATEGORIA" ADD PRIMARY KEY ("ID_CATEGORIA")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table TIPO_SERVICIO
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."TIPO_SERVICIO" ADD PRIMARY KEY ("ID_TIPO")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table DIRECCION
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."DIRECCION" ADD PRIMARY KEY ("ID_USUARIO", "ID_DIRECCION")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table PRODUCTO
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."PRODUCTO" ADD PRIMARY KEY ("ID_PRODUCTO")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Constraints for Table INFORME_VISITA_TECNICA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."INFORME_VISITA_TECNICA" ADD PRIMARY KEY ("ID_INFORME")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table CARRITO
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."CARRITO" ADD CONSTRAINT "FK_CARRITO_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "OCTAVIUS"."USUARIOS" ("ID_USUARIO") ENABLE;
  ALTER TABLE "OCTAVIUS"."CARRITO" ADD CONSTRAINT "FK_CARRITO_PRODUCTO" FOREIGN KEY ("ID_PRODUCTO")
	  REFERENCES "OCTAVIUS"."PRODUCTO" ("ID_PRODUCTO") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table DETALLE_COMPRA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."DETALLE_COMPRA" ADD CONSTRAINT "FK_DETALLE_COMPRA" FOREIGN KEY ("ID_COMPRA")
	  REFERENCES "OCTAVIUS"."HISTORIAL_COMPRA" ("ID_COMPRA") ENABLE;
  ALTER TABLE "OCTAVIUS"."DETALLE_COMPRA" ADD CONSTRAINT "FK_DETALLE_PRODUCTO" FOREIGN KEY ("ID_PRODUCTO")
	  REFERENCES "OCTAVIUS"."PRODUCTO" ("ID_PRODUCTO") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table DIRECCION
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."DIRECCION" ADD CONSTRAINT "FK_DIRECCION_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "OCTAVIUS"."USUARIOS" ("ID_USUARIO") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table FAVORITOS
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."FAVORITOS" ADD CONSTRAINT "FK_FAVORITO_PRODUCTO" FOREIGN KEY ("ID_PRODUCTO")
	  REFERENCES "OCTAVIUS"."PRODUCTO" ("ID_PRODUCTO") ENABLE;
  ALTER TABLE "OCTAVIUS"."FAVORITOS" ADD CONSTRAINT "FK_FAVORITO_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "OCTAVIUS"."USUARIOS" ("ID_USUARIO") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table HISTORIAL_COMPRA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."HISTORIAL_COMPRA" ADD CONSTRAINT "FK_HISTORIAL_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "OCTAVIUS"."USUARIOS" ("ID_USUARIO") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table PRODUCTO
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."PRODUCTO" ADD CONSTRAINT "FK_PRODUCTO_CATEGORIA" FOREIGN KEY ("ID_CATEGORIA")
	  REFERENCES "OCTAVIUS"."CATEGORIA" ("ID_CATEGORIA") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table USUARIOS
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."USUARIOS" ADD CONSTRAINT "FK_USUARIO_ROL" FOREIGN KEY ("ID_ROL")
	  REFERENCES "OCTAVIUS"."ROL" ("ID_ROL") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table VISITA_TECNICA
--------------------------------------------------------

  ALTER TABLE "OCTAVIUS"."VISITA_TECNICA" ADD CONSTRAINT "FK_VISITA_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "OCTAVIUS"."USUARIOS" ("ID_USUARIO") ENABLE;
  ALTER TABLE "OCTAVIUS"."VISITA_TECNICA" ADD CONSTRAINT "FK_VISITA_TIPO" FOREIGN KEY ("ID_TIPO")
	  REFERENCES "OCTAVIUS"."TIPO_SERVICIO" ("ID_TIPO") ENABLE;
