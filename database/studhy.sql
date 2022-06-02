CREATE DATABASE studhy;

USE studhy;

-- TABLA DEPARTAMENTOS
CREATE TABLE departamentos(
  id_departamento int(11) auto_increment PRIMARY KEY,
  nombre varchar(50) not null
) ENGINE = InnoDb;

-- TABLA FACULTADES
CREATE TABLE facultades(
  id_facultad int(11) auto_increment PRIMARY KEY,
  nombre varchar(50) not null,
  descripcion varchar(255) not null
) ENGINE = InnoDb;

-- TABLA CARRERAS
CREATE TABLE carreras(
  id_carrera int(11) auto_increment PRIMARY KEY,
  nombre varchar(50) not null,
  descripcion varchar(255) not null
) ENGINE = InnoDb;

-- TABLA CURSOS
CREATE TABLE cursos(
  id_curso int(11) auto_increment PRIMARY KEY,
  nombre varchar(50) not null
) ENGINE = InnoDb;

-- TABLA TEMAS
CREATE TABLE temas(
  id_tema int(11) auto_increment PRIMARY KEY,
  nombre varchar(50) not null
) ENGINE = InnoDb;

-- TABLA PROSPECTO
CREATE TABLE prospectos(
  id_prospecto int(11) auto_increment PRIMARY KEY,
  nombre varchar(255) not null
) ENGINE = InnoDb;

-- TABLA PREGUNTAS
CREATE TABLE preguntas(
  id_pregunta int(11) auto_increment PRIMARY KEY,
  descripcion varchar(255) not null
) ENGINE = InnoDb;

-- TABLA RESPUESTAS
CREATE TABLE respuestas(
  id_respuesta int(11) auto_increment PRIMARY KEY,
  respuesta varchar(255) not null
) ENGINE = InnoDb;

-- TABLA PROVINCIAS
CREATE TABLE provincias(
  id_provincia int(11) auto_increment PRIMARY KEY,
  id_departamento int(11) not null,
  nombre varchar(50) not null,
  FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento)
) ENGINE = InnoDb;

-- TABLA DISTRITOS
CREATE TABLE distritos(
  id_distrito int(11) auto_increment PRIMARY KEY,
  id_provincia int(11) not null,
  id_departamento int(11) not null,
  FOREIGN KEY (id_provincia) REFERENCES provincias(id_provincia),
  FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento),
  nombre varchar(50) not null
) ENGINE = InnoDb;

-- TABLA UNIVERSIDADES
CREATE TABLE universidades(
  id_universidad int(11) auto_increment PRIMARY KEY,
  id_departamento int(11) not null,
  id_provincia int(11) not null,
  id_distrito int(11) not null,
  id_prospecto int(11) not null,
  nombre varchar(50) not null,
  descripcion varchar(255) not null,
  imagen_url varchar(50) not null,
  FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento),
  FOREIGN KEY (id_provincia) REFERENCES provincias(id_provincia),
  FOREIGN KEY (id_distrito) REFERENCES distritos(id_distrito),
  FOREIGN KEY (id_prospecto) REFERENCES prospectos(id_prospecto)
) ENGINE = InnoDb;

-- TABLA UNIVERSIDAD-FACULTAD-CARRERA
CREATE TABLE univ_fac_carr(
  id_univ_fac_carr int(11) not null PRIMARY KEY,
  id_universidad int(11) not null,
  id_facultad int(11) not null,
  id_carrera int(11) not null,
  FOREIGN KEY (id_facultad) REFERENCES facultades(id_facultad),
  FOREIGN KEY (id_carrera) REFERENCES carreras(id_carrera)
) ENGINE = InnoDb;

-- TABLA DE USUARIOS
CREATE TABLE usuarios(
  id_usuario int(11) auto_increment PRIMARY KEY,
  nombres varchar(50) not null,
  apellidos varchar(50) not null,
  edad int(11) not null,
  celular varchar(13) not null,
  telefono varchar(13),
  email varchar(70) not null UNIQUE,
  contrasena varchar(255) not null,
  año_egreso DATE,
  año_cursa varchar(30),
  colegio varchar(50) not null,
  f_registro DATETIME not null,
  id_univ_fac_carr int(11) not null,
  id_departamento int(11) not null,
  id_provincia int(11) not null,
  id_distrito int(11) not null,
  extranjero varchar(50),
  pais varchar(50) not null,
  rol varchar(50) not null,
  FOREIGN KEY (id_univ_fac_carr) REFERENCES univ_fac_carr(id_univ_fac_carr),
  FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento),
  FOREIGN KEY (id_provincia) REFERENCES provincias(id_provincia),
  FOREIGN KEY (id_distrito) REFERENCES distritos(id_distrito)
) ENGINE = InnoDb;

-- TABLA RECORD DE USUARIO
CREATE TABLE records(
  id_record int(11) auto_increment PRIMARY KEY,
  id_usuario int(11) not null,
  f_realiza_examen DATE not null,
  h_realiza_examen TIME not null,
  h_termina_examen TIME not null,
  cant_preg_correctas int(11) not null,
  cant_preg_incorretas int(11) not null,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
) ENGINE = InnoDb;

-- TABLA CURSOS-TEMAS
CREATE TABLE curso_tema(
  id_curso_tema int(11) auto_increment PRIMARY KEY,
  id_curso int(11) not null,
  id_tema int(11) not null,
  FOREIGN KEY (id_curso) REFERENCES cursos(id_curso),
  FOREIGN KEY (id_tema) REFERENCES temas(id_tema)
) ENGINE = InnoDb;

-- TABLA PROSPECTO - CURSO_TEMA
CREATE TABLE prospecto_cursoTema(
  id_pros_curTema int(11) auto_increment PRIMARY KEY,
  id_prospecto int(11) not null,
  id_curso_tema int(11) not null,
  FOREIGN KEY (id_prospecto) REFERENCES prospectos(id_prospecto),
  FOREIGN KEY (id_curso_tema) REFERENCES curso_tema(id_curso_tema)
) ENGINE = InnoDb;

-- TABLA PREGUNTA-RESPUESTA
CREATE TABLE pregunta_respuesta(
  id_preg_resp int(11) auto_increment PRIMARY KEY,
  id_curso_tema int(11) not null,
  id_pregunta int(11) not null,
  id_respuesta int(11) not null,
  estado varchar(50) not null,
  FOREIGN KEY (id_curso_tema) REFERENCES curso_tema(id_curso_tema),
  FOREIGN KEY (id_pregunta) REFERENCES preguntas(id_pregunta),
  FOREIGN KEY (id_respuesta) REFERENCES respuestas(id_respuesta)
) ENGINE = InnoDb;