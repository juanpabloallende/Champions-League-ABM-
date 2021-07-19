DROP DATABASE IF EXISTS UEFACL;
CREATE DATABASE IF NOT EXISTS UEFACL;
USE UEFACL;

/*
			Tabla posiciones
*/

CREATE TABLE IF NOT EXISTS posiciones (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
posicion VARCHAR(45),
PRIMARY KEY (id)
)ENGINE= InnoDB;

/*
			Tabla Equipos
*/

CREATE TABLE IF NOT EXISTS equipos(
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
equipo VARCHAR(45),
PRIMARY KEY (id)
)ENGINE=InnoDB;

/*
			Tabla Nacionalidades
*/

CREATE TABLE IF NOT EXISTS nacionalidades (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
nacionalidad VARCHAR(45),
PRIMARY KEY (id)
)ENGINE=InnoDB;
 
 /*
			Tabla Campeones
*/

CREATE TABLE IF NOT EXISTS campeones (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
anio YEAR(4) UNIQUE NOT NULL,
equipos_id_campeon INT UNSIGNED NOT NULL,
equipos_id_finalista INT UNSIGNED NOT NULL,
resultado VARCHAR(20) NOT NULL,
sede VARCHAR(45),
PRIMARY KEY (id),
FOREIGN KEY (equipos_id_campeon)
REFERENCES equipos (id)
ON DELETE NO ACTION
ON UPDATE CASCADE,
FOREIGN KEY (equipos_id_finalista)
REFERENCES equipos (id)
ON DELETE NO ACTION
ON UPDATE CASCADE
)ENGINE = InnoDB;
/*
			Tabla Goleadores
*/
CREATE TABLE IF NOT EXISTS goleadores (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
nombre VARCHAR(45) NOT NULL,
partidos TINYINT(3) UNSIGNED NOT NULL,
goles TINYINT(3) UNSIGNED NOT NULL,
posiciones_id INT UNSIGNED NOT NULL,
nacionalidades_id INT UNSIGNED NOT NULL,
debut YEAR(4) NOT NULL,
retiro YEAR(4) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (posiciones_id) 
REFERENCES posiciones (id)
ON DELETE NO ACTION
ON UPDATE CASCADE,
FOREIGN KEY (nacionalidades_id) 
REFERENCES nacionalidades (id)
ON DELETE NO ACTION
ON UPDATE CASCADE
)ENGINE=InnoDB;

/*
			Tabla Roles
*/ 

CREATE TABLE IF NOT EXISTS roles (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
rol VARCHAR(45),
PRIMARY KEY (id)
)ENGINE=InnoDB;

/*
			Tabla Usuarios
*/

CREATE TABLE IF NOT EXISTS usuarios (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
nombre VARCHAR(45),
apellido VARCHAR(45),
email VARCHAR(45),
usuario VARCHAR(45),
direccion VARCHAR (60),
codigo_postal VARCHAR(45),
telefono VARCHAR(45),
password VARCHAR(60),
roles_id INT UNSIGNED NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (roles_id)
REFERENCES roles (id)
ON DELETE NO ACTION
ON UPDATE CASCADE
)ENGINE=InnoDB;

 /*
			Tabla goleadores_equipos
 */
 
CREATE TABLE IF NOT EXISTS goleadores_equipos (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
goleadores_id INT UNSIGNED NOT NULL,
equipos_id INT UNSIGNED NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (goleadores_id)
REFERENCES goleadores (id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (equipos_id)
REFERENCES equipos (id)
ON DELETE CASCADE
ON UPDATE CASCADE
)ENGINE = InnoDB;

/*
			Tabla imagenes
*/

CREATE TABLE IF NOT EXISTS imagenes (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
ruta VARCHAR(200),
PRIMARY KEY (id)
)ENGINE = InnoDB;

/*
			Tabla productos
*/

CREATE TABLE IF NOT EXISTS productos (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
nombre VARCHAR(100) NOT NULL,
descripcion TEXT,
precio FLOAT(7,2) UNSIGNED NOT NULL,
fecha_alta DATETIME NOT NULL,
estado TINYINT(1) UNSIGNED DEFAULT 0,
imagenes_id INT UNSIGNED NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (imagenes_id)
REFERENCES imagenes (id)
ON DELETE CASCADE
ON UPDATE CASCADE 
)ENGINE = InnoDB;

/*
			Tabla compras
*/

CREATE TABLE IF NOT EXISTS compras (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
fecha DATETIME NOT NULL,
estado TINYINT(1) UNSIGNED NOT NULL,
usuarios_id INT(9) UNSIGNED NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (usuarios_id)
REFERENCES usuarios (id)
ON DELETE NO ACTION
ON UPDATE CASCADE
)ENGINE = InnoDB;

/*
			Tabla compras_productos
*/

CREATE TABLE IF NOT EXISTS compras_productos (
id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
compras_id INT UNSIGNED NOT NULL,
productos_id INT UNSIGNED NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (compras_id)
REFERENCES compras (id)
ON DELETE NO ACTION
ON UPDATE CASCADE,
FOREIGN KEY (productos_id)
REFERENCES productos (id)
ON DELETE NO ACTION
ON UPDATE CASCADE 
)ENGINE = InnoDB;

-- INSERTS

/*
	Posiciones
*/    
INSERT INTO posiciones 
SET id = 1, posicion = "Arquero";

INSERT INTO posiciones 
SET id = 2, posicion = "Defensor central";

INSERT INTO posiciones 
SET id = 3, posicion = "Lateral izquierdo";

INSERT INTO posiciones 
SET id = 4, posicion = "Lateral derecho";

INSERT INTO posiciones 
SET id = 5, posicion = "Volante central";

INSERT INTO posiciones 
SET id = 6, posicion = "Líbero";

INSERT INTO posiciones 
SET id = 7, posicion = "Volante izquierdo";

INSERT INTO posiciones 
SET id = 8, posicion = "Volante derecho";

INSERT INTO posiciones 
SET id = 9, posicion = "Centrodelantero";

INSERT INTO posiciones
SET id = 10, posicion = "Mediapunta";

INSERT INTO posiciones 
SET id = 11, posicion = "Segunda punta";

INSERT INTO posiciones 
SET id = 12, posicion = "Extremo izquierdo";

INSERT INTO posiciones 
SET id = 13, posicion = "Extremo derecho";
		
 /*
	Equipos
 */

INSERT INTO equipos
SET id  = 1, equipo = "Ajax"; 

INSERT INTO equipos
SET id  = 2, equipo = "Arsenal"; 

INSERT INTO equipos
SET id  = 3, equipo = "Atlético de Madrid"; 

INSERT INTO equipos
SET id  = 4, equipo = "Barcelona";

INSERT INTO equipos
SET id  = 5, equipo = "Bayern Munich";  

INSERT INTO equipos
SET id  = 6, equipo = "Benfica";

INSERT INTO equipos
SET id  = 7, equipo = "Borussia Dortmund";

INSERT INTO equipos
SET id  = 8, equipo = "Chelsea";

INSERT INTO equipos
SET id  = 9, equipo = "Dynamo Kiev";

INSERT INTO equipos
SET id  = 10, equipo = "Inter";

INSERT INTO equipos
SET id  = 11, equipo = "Juventus";

INSERT INTO equipos
SET id  = 12, equipo = "Liverpool";

INSERT INTO equipos
SET id  = 13, equipo = "Manchester United";

INSERT INTO equipos
SET id  = 14, equipo = "Milan";

INSERT INTO equipos
SET id  = 15, equipo = "AS Monaco";

INSERT INTO equipos
SET id  = 16, equipo = "Olympique de Lyon";

INSERT INTO equipos
SET id  = 17, equipo = "Olympique de Marseille";

INSERT INTO equipos
SET id  = 18, equipo = "PSG";

INSERT INTO equipos
SET id = 19, equipo = "PSV";

INSERT INTO equipos
SET id  = 20, equipo = "Real Madrid";

INSERT INTO equipos
SET id  = 21, equipo = "Schalke 04";

INSERT INTO equipos
SET id  = 22, equipo = "Tottenham Hotspur";

/*
	Nacionalidades
*/   

INSERT INTO nacionalidades (id, nacionalidad)
VALUES (1, "Alemania"), (2, "Argentina"), (3, "Brasil"), (4, "Camerún"), (5, "Costa de Marfil"), (6, "España"), 
(7, "Francia"), (8, "Hungría"), (9, "Inglaterra"), (10, "Italia"), (11, "Países Bajos"), 
(12, "Polonia"), (13, "Portugal"), (14, "Suecia"), (15, "Ucrania"), (16, "Uruguay");

/*
	Campeones
*/

INSERT INTO campeones (id, anio, equipos_id_campeon, equipos_id_finalista, resultado, sede)
VALUES (1, 2019, 12, 22, "2-0", "Wanda Metropolitano"),
(2, 2018, 20, 12, "3-1", "Olímpico de Kiev"),
(3, 2017, 20, 11, "4-1", "Millennium Stadium"),
(4, 2016, 20, 3, "1-1(p)", "Guiseppe Meazza"),
(5, 2015, 4, 11, "3-1", "Olímpico de Berlín"),
(6, 2014, 20, 3, "4-1", "Estadio Da Luz"),
(7, 2013, 5, 7, "2-1", "Wembley"),
(8, 2012, 8, 5, "1-1(p)", "Allianz Arena"),
(9, 2011, 4, 13, "3-1", "Wembley"),
(10, 2010, 10, 5, "2-0", "Santiago Bernabéu");

/*
	Goleadores
*/

INSERT INTO goleadores (id, nombre, partidos, goles, nacionalidades_id, posiciones_id, debut, retiro)
VALUES (1, "Cristiano Ronaldo", 169, 128, 13, 12, 2003, 2020),   
(2, "Lionel Messi", 141, 114, 2, 10, 2004, 2020),   
(3, "Raúl", 142, 71, 6, 9, 1995, 2011),
(4, "Robert Lewandowski", 86, 64, 12, 9, 2011, 2020),
(5, "Karim Benzema", 119, 64, 7, 9, 2006, 2020),
(6, "Ruud Van Nistelrooy", 73, 56, 11, 9, 1998, 2009),
(7, "Thierry Henry", 112, 50, 7, 9, 1997, 2012),
(8, "Alfredo Di Stéfano", 58, 49, 2, 11, 1955, 1964),
(9, "Andriy Shevchenko", 100, 48, 15, 9, 1994, 2012),
(10, "Zlatan Ibrahimovic", 120, 48, 14, 9, 2001, 2017);      

/*
	Goleadores_equipos
*/

INSERT INTO goleadores_equipos (id, goleadores_id, equipos_id) 
VALUES (1, 1, 13),
(2, 1, 20),
(3, 1, 11),
(4, 2, 4),
(5, 3, 20),
(6, 3, 21),
(7, 4, 7),
(8, 4, 5),
(9, 5, 16),
(10, 5, 20),
(11, 6, 19),
(12, 6, 13),
(13, 6, 20),
(14, 7, 15),
(15, 7, 2),
(16, 7, 4),
(17, 8, 19),
(18, 9, 9),
(19, 9, 14),
(20, 9, 8),
(21, 10, 10),
(22, 10, 4),
(23, 10, 14),
(24, 10, 18);

/*
	Roles
*/

INSERT INTO roles SET id = 1, rol = "admin";
INSERT INTO roles SET id = 2, rol = "visitante";

/*
	Imágenes
*/

INSERT INTO imagenes (id, ruta)
VALUES (1, "img/remera.png"),    
(2, "img/pelota.png"),    
(3, "img/gorra.png"),    
(4, "img/buzo.png"); 
   
/*
	Productos
*/

INSERT INTO productos (id, nombre, descripcion, fecha_alta, estado, precio, imagenes_id)
VALUES (1, "Remera Champions League", "Remera gris con el logo de la UEFA Champions League", "2020-07-06", 1, "2499", 1),
(2, "Pelota Final 2020", "Pelota oficial de la final de la UEFA Champions League", "2020-05-14", 1, "1799", 2),
(3, "Gorra negra", "Gorra de color negro con el logo oficial de la competición", "2020-06-29", 1, "1299", 3),
(4, "Buzo azul", "Buzo con el logo de la UEFA Champions League estampado", "2020-07-01", 1, "3999",  4);	

INSERT INTO `usuarios`(`id`, `nombre`, `apellido`, `email`, `usuario`, `password`, `roles_id`) VALUES (1, 'Juan Pablo', 'Allende', 'juan.allende@davinci.edu.ar', 'juan', '7dfcf70805b9107717e415c7a969a3e5', 1);
INSERT INTO `usuarios`(`id`, `nombre`, `apellido`, `email`, `usuario`, `password`, `roles_id`) VALUES (2, 'nombre', 'apellido', 'juan.pablo.allende@hotmail.com', 'ju', '$2y$10$oV4QcCY5OcrgtuQdSLbdsOk2h/Yi7z763sMAMtK2BCWUbvzcupAna', 1);