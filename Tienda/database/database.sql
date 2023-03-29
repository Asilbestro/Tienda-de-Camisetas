CREATE DATABASE tienda_master;
use tienda_master;

CREATE TABLE usuarios (
id int(255) auto_increment not null,
nombre varchar(100) not null,
apellido varchar(255) ,
email varchar(255) not null,
pass varchar(255) not null,
rol varchar(20),
imagen varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY (id),
CONSTRAINT uq_email UNIQUE (email)
)ENGINE=InnoDB;

INSERT INTO usuarios VALUES (NULL, 'Admin', 'Admin', 'admin@admin.com', 'constraseña', 'admin',null);

CREATE TABLE categoria(
    id int(255) auto_increment not null,
    nombre varchar(100) not null,
    CONSTRAINT pk_categoria PRIMARY KEY (id)
)ENGINE=InnoDB;

INSERT INTO categoria VALUES(NULL,'Manga corta');
INSERT INTO categoria VALUES(NULL,'Polera');
INSERT INTO categoria VALUES(NULL,'Manga larga');
INSERT INTO categoria VALUES(NULL,'Camisa');

CREATE TABLE productos (
id int(255) auto_increment not null,
categoria_id int(255) not null,
nombre varchar(100) not null,
descripcion text ,
precio float(100,2) not null,
stock int(255) not null,
oferta varchar(2),
fecha date not null ,
imagen varchar(255) ,
CONSTRAINT pk_productos PRIMARY KEY (id),
CONSTRAINT fk_productos_categoria FOREIGN KEY (categoria_id) REFERENCES categoria(id)
)ENGINE=InnoDB;

CREATE TABLE pedidos (
id int(255) auto_increment not null,
usuario_id int(255) not null,
provincia varchar(100) not null,
localidad varchar(100) not null,
direccion varchar(255) not null,
coste float(100,2) not null,
estado varchar(20) not null,
fecha date ,
hora time,
CONSTRAINT pk_pedidos PRIMARY KEY (id),
CONSTRAINT fk_pedidos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDB;


CREATE TABLE lineas_pedido(
    id int(255) auto_increment not null,
    pedido_id int (255) not null,
    producto_id int (255) not null,
    unidades int(255) not null,
    CONSTRAINT pk_lineas_pedido PRIMARY KEY (id),
    CONSTRAINT fk_linea_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_linea_producto FOREIGN KEY (producto_id) REFERENCES productos(id)
)ENGINE=InnoDB;