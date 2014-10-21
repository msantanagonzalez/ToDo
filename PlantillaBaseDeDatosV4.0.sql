/* ***********************  */
/* Base de datos: `ToDo_DB` */
/* Usuario: Admin_ToDo       */
/* Pass: Pass_ToDo       */
/* ***********************  */

/* ********************************************** */
/* 1.- Sentencias de borrado de todas las tablas  */
/* ********************************************** */

DROP TABLE IF EXISTS `Tarea`;
DROP TABLE IF EXISTS `Proyecto`;
DROP TABLE IF EXISTS `Usuario`;

/* ********************************************** */
/* 2.- Creacion de tablas                         */
/* ********************************************** */

/* 2.1- Tabla Usuario   */
CREATE TABLE `Usuario` (
  `ID_Usuario` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `Email_Usuario` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Apellido1_Usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Apellido2_Usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Password_Usuario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Calle_Usuario` varchar(35) COLLATE latin1_spanish_ci DEFAULT NULL,
  `N_Portal_Usuario` varchar(5) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Provincia_Usuario` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `CP_Usuario` int(5) DEFAULT NULL,
  `Tipo_Usuario` int(2) NOT NULL,
/* Creacion de restricciones  */
  CONSTRAINT Pk_Usario PRIMARY KEY (`ID_Usuario`),
  CONSTRAINT Uc_Email_Usuario UNIQUE (`Email_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/* 2.2- Tabla Proyecto  */
CREATE TABLE `Proyecto` (
  `Nombre_Proyecto` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `ID_Usuario` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `Prioridad_Proyecto` int(11) DEFAULT NULL,
  /* Creacion de restricciones  */
  CONSTRAINT Pk_Proyecto PRIMARY KEY (`Nombre_Proyecto`,`ID_Usuario`),
  CONSTRAINT Fk_Proyecto FOREIGN KEY (`ID_Usuario`) REFERENCES Usuario(`ID_Usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/* 2.3- Tabla Tarea     */
CREATE TABLE `Tarea` (
  `Nombre_Tarea` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `ID_Usuario` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Proyecto` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Descripcion_Tarea` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Etiqueta_Tarea` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Estado_Tarea` enum('Creada','En Curso','Finalizada') COLLATE latin1_spanish_ci NOT NULL,
  `Prioridad_Tarea` int(11) DEFAULT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin_Estimada` date NOT NULL,
  `Fecha_Inicio_Real` date DEFAULT NULL,
  `Fecha_Fin_Real` date DEFAULT NULL,
  
  /* Creacion de restricciones  */
  CONSTRAINT Pk_Tarea PRIMARY KEY (`Nombre_Tarea`,`ID_Usuario`),
  CONSTRAINT Fk_Tarea_Usuario FOREIGN KEY (`ID_Usuario`) REFERENCES Usuario(`ID_Usuario`) ON DELETE CASCADE,
  CONSTRAINT Fk_Tarea_Proyecto FOREIGN KEY (`Nombre_Proyecto`) REFERENCES Proyecto(`Nombre_Proyecto`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/* ********************************************** */
/* 3.- Introducir datos ejemplo                   */
/* ********************************************** */

/* 3.1- Tabla usuario     */
INSERT INTO Usuario (ID_Usuario,Email_Usuario,Nombre_Usuario,Apellido1_Usuario,Apellido2_Usuario,Password_Usuario,Fecha_Nacimiento,Calle_Usuario,N_Portal_Usuario,Provincia_Usuario,CP_Usuario,Tipo_Usuario) 
VALUES ("MS01","example@server.com","Marco","Santana","Gonzalez",123456,1991-15-04,"Calle1","p1","Ourense",32005,0),
('admin', 'admin@example.com', 'admin', 'adminapel', 'adminapel2', 'admin', '0000-00-00', 'NULL', 'NULL', 'NULL', 0, 0),
('MG01', 'ejemplo@server.com', 'Maria', 'Apel1', 'Apel2', '123456', '0000-00-00', 'Calle1', 'p1', 'Ourense', 32005, 1),
('Tatiux', 'tatiux.santana@gmail.com', 'Marco', 'Santana', 'Gonzalez', '12345', '0000-00-00', '', '', '', 0, 1);



/* 3.1- Tabla proyecto     */
INSERT INTO Proyecto (Nombre_Proyecto,ID_Usuario,Prioridad_Proyecto)
VALUES ("P1","MS01",1);
INSERT INTO Proyecto (Nombre_Proyecto,ID_Usuario,Prioridad_Proyecto)
VALUES ("P2","MS01",2);
INSERT INTO Proyecto (Nombre_Proyecto,ID_Usuario,Prioridad_Proyecto)
VALUES ("P3","MS01",3);

INSERT INTO Proyecto (Nombre_Proyecto,ID_Usuario,Prioridad_Proyecto)
VALUES ("P1","MG01",1);
INSERT INTO Proyecto (Nombre_Proyecto,ID_Usuario,Prioridad_Proyecto)
VALUES ("P2","MG01",1);

/* 3.1- Tabla tareas     */

INSERT INTO Tarea (Nombre_Tarea,ID_Usuario,Nombre_Proyecto,Descripcion_Tarea,Etiqueta_Tarea,Estado_Tarea,Prioridad_Tarea,Fecha_Inicio,Fecha_Fin_Estimada,Fecha_Inicio_Real,Fecha_Fin_Real)
VALUES ('Tarea1', 'MS01', NULL, 'TareaNoAsociadaAProyecto', 'Prueba', 'Creada', 1, '0000-00-00', '0000-00-00', NULL, NULL),
('Tarea10', 'MS01', NULL, 'TareaNoAsociadaAProyecto', 'Prueba', 'Finalizada', 4, '0000-00-00', '0000-00-00', NULL, NULL),
('Tarea1DelProyecto1', 'MS01', 'P1', 'TareaAsociadaAProyecto1', 'Prueba', 'Creada', 1, '0000-00-00', '0000-00-00', NULL, NULL),
('Tarea2', 'MS01', 'P2', 'TareaAsociadaAProyecto2', 'Prueba', 'En Curso', 2, '0000-00-00', '0000-00-00', NULL, NULL),
('Tarea3', 'MS01', 'P2', 'TareaAsociadaAProyecto2', 'Prueba', 'En Curso', 2, '0000-00-00', '0000-00-00', NULL, NULL),
('Tarea4', 'MS01', 'P2', 'blablabla', 'Prueba', 'En Curso', 1, '0000-00-00', '0000-00-00', NULL, NULL),
('Tarea5', 'MS01', NULL, 'TareaNoAsociadaAProyecto', 'Prueba', 'Finalizada', 1, '0000-00-00', '0000-00-00', NULL, NULL);





