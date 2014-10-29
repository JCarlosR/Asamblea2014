DROP DATABASE if exists asamblea2014;

CREATE DATABASE asamblea2014;
USE asamblea2014;

-- Creando tabla asambleista
CREATE TABLE asambleista(
	asamUsername varchar(20) PRIMARY KEY,
	asamNombre varchar(50),
	asamPassword varchar(30)
);

-- Creando tabla modificacion
CREATE TABLE modificacion(
	ID_Modificacion int AUTO_INCREMENT PRIMARY KEY,
	fecha datetime NOT NULL,
	asamUsername varchar(20) NOT NULL,
	FOREIGN KEY (asamUsername) REFERENCES asambleista(asamUsername)
);

-- Creando tabla titulo
CREATE TABLE titulo(
	ID_Titulo int AUTO_INCREMENT PRIMARY KEY,
	descripcionTit varchar (99) NOT NULL,
	numeroTit int NOT NULL,
	ID_Modificacion int NOT NULL,
	FOREIGN KEY (ID_Modificacion) REFERENCES modificacion(ID_Modificacion)
);

-- Creando tabla capitulo
CREATE TABLE capitulo(
	ID_Capitulo int AUTO_INCREMENT PRIMARY KEY,
	descripcionCap varchar(255),
	numeroCap int NOT NULL,
	ID_Modificacion int,
	ID_Titulo int,
	FOREIGN KEY (ID_Modificacion) REFERENCES modificacion(ID_Modificacion),
	FOREIGN KEY (ID_Titulo) REFERENCES Titulo(ID_Titulo)
);

-- Creando tabla articulo
CREATE TABLE articulo(
	ID_Articulo int AUTO_INCREMENT PRIMARY KEY,
	contenidoArt text NOT NULL,
	numeroArt int NOT NULL,
	ID_Modificacion int,
	ID_Capitulo int,
	FOREIGN KEY (ID_Modificacion) REFERENCES modificacion(ID_Modificacion),
	FOREIGN KEY (ID_Capitulo) REFERENCES capitulo(ID_Capitulo)
);

INSERT asambleista VALUES
('asambleista1', 'Juarez Guzman', '123456'),
('asambleista2', 'Remso Guevara', '654321'),
('asambleista3', 'Arcadio Gonzales', '115599'),
('asambleista4', 'Ramos Suyon', '666');

INSERT modificacion VALUES
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista2'),
(NULL, '2014-09-15 22:00:00', 'asambleista3'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista2'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista2'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista2'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista4'),
(NULL, '2014-09-15 22:00:00', 'asambleista1'),
(NULL, '2014-09-15 22:00:00', 'asambleista4');

INSERT titulo VALUES
(NULL, 'DISPOSICIONES GENERALES, PRINCIPIOS, FINES Y AUTONOMIA', 1, 1),
(NULL, 'ORGANIZACION ACADEMICA', 2, 2),
(NULL, 'FUNCIONES DE LA UNIVERSIDAD', 3, 3),
(NULL, 'ORGANIZACION ADMINISTRATIVA', 4, 4);

INSERT capitulo VALUES
-- Capítulos del Título 1
(NULL, 'DISPOSICIONES GENERALES', 1, 5, 1),
(NULL, 'DE LOS PRINCIPIOS', 2, 6, 1),
(NULL, 'DE LOS FINES', 3, 7, 1),
(NULL, 'DE LA AUTONOMIA', 4, 8, 1),
-- Capítulos del Título 2
(NULL, 'DE LOS ÓRGANOS DE EJECUCIÓN DEL SISTEMA ACADÉMICO', 1, 17, 2),
(NULL, 'DE LA DIRECCIÓN Y CONTROL DEL SISTEMA ACADÉMICO', 2, 18, 2),
(NULL, 'DE LA ESTRUCTURA ACADÉMICA', 3, 19, 2);

INSERT articulo VALUES
(NULL, 'La UNT es persona jurídica de derecho público interno.', 1, 9, 1),
(NULL, 'La UNT está integrada por profesiores, estudiantes y graduados.', 2, 10, 1),
(NULL, 'La UNT tiene autonomía académica, normativa, administrativa y económica, dentro de la Ley. Se rige por su propio Estatuto y demás normas reglamentarias, en el marco de la Constitución y las leyes.', 3, 11, 1),
(NULL, 'LA UNT imparte educación superior gratuita', 4, 12, 1),

(NULL, 'LA UNT cumple sus funciones dentro del marco de ...', 26, 13, 6),

(NULL, 'Son fines de la UNT ...', 27, 14, 6),

(NULL, 'La autonomía universitaria es la garantía ...', 28, 15, 7),
(NULL, 'LA UNT imparte educación superior gratuita', 29, 16, 7),

(NULL, 'La UNT organiza su sitema académico dentro del modelo de integración Facultad-Departamento Académico', 5, 20, 1),
(NULL, 'La Estructura Académica se sustenta en la Facultad, como unidad académica, y en el Departamento Académico, como unidad operacional. Junto a estas unidades pueden operar otras...', 6, 21, 1),
(NULL, 'Son funciones del Sistema Académico:
a.impulsar el desarrollo de la investigacion cientifica, tecnologica, humanistica y artistica segun las necesidades de desarrollo de la region y el pais....', 7, 22, 2),

(NULL, 'La organización, dirección y control del sistema académico de la universidad esta a cargo del vicerrectorado academico y para el mejor cumplimiento de sus funciones se ejecuta através de la oficina de Evaluacion, Oficina de Intercambio Academico,Oficina de Registro Técnico, Oficina de...', 17, 23, 6),
(NULL, 'El órgano basico de asesoria del vicerrectorado académico en materia curricular es el comité central del currículo y esta conformado por los presidentes de los comités del currículo de las facultades de la escuela de postgrado y, ademas por dos estudiantes miembros del consejo univesitario.', 18, 24, 6),
(NULL, 'Son organos de apoto del reguimen academico que dependen del vicerrectorado academico:
a. Oficina de Evaluación
b. Oficina de Interambio Académico
c. Oficina de Registro Técnico
d. Oficina de Admisión
e. Oficina de Bibliotecas', 19, 25, 6),

(NULL, 'Las Facultades son unidades fundamentales de formación profesional, investigacion cientifica y la proteccion socual y extension universitaria, integradas por profesores, estudiantes y graduados.', 28, 26, 7),
(NULL, 'En cada Facultad se estudian uyna o mas carreras, segun la finidad de uss contenidos y objetivos. Las Facultades coordinan y consolidan actividades de formacion profesional, invetigacion cientyifica y la proyeccion socual y extension universitaria, ...', 29, 27, 7),
(NULL, 'La creacion de una Facultada de la UNT requiere:
a. Que su organizacion garantice la formacion profesional, investigacion cientifica y la proteccion social y extension universitaria relacionandas entre si en sus objetivos.', 30, 28, 7),

(NULL, 'Son fines de la UNT...', 8, 29, 3),
(NULL, 'La autonomia universitaria es la garantia juridica que..', 9, 30, 4),
(NULL, 'La violacion de la autonomia de la universidad ...', 10, 31 , 4),
(NULL, 'La UNT, en ejercicio de su autonomia...', 11, 32, 4),
(NULL, 'El campus universitario de la UNT es inviolable...', 12, 33, 4),

(NULL, 'La UNT organiza su sitema academico dentro..', 13, 34 , 5),
(NULL, 'La estructura academica se sustenta en la Facultad..', 14, 35 , 5),
(NULL, 'Son funciones del Sistema academico', 15, 36 , 5),
(NULL, 'El desarrollo del sistema academico de la UNT ...', 16, 37, 5),

(NULL, 'La oficina de evaluacion es el organo a traves ..', 20, 38 , 6),
(NULL, 'La oficina de intercambio academico es el organo a traves del cual...', 21,39 , 6),
(NULL, 'A la oficina de Registro tecnico le compete administrar el proceso..', 22,40 , 6),
(NULL, 'A la oficina de admision le compete organizar, planificar...', 23, 41 , 6),
(NULL, 'La oficina de bibliotecas tiene como organo de coordinacion...', 24, 42 , 6),
(NULL, 'Los organos de apoyo del regimen academico de la universidad..', 25, 43 , 6);

