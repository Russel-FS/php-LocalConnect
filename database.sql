DROP DATABASE IF EXISTS localconnect;

CREATE DATABASE IF NOT EXISTS localconnect;

USE localconnect;
-- Tabla de ubicaciones
CREATE TABLE ubicaciones (
    id_ubicacion BIGINT AUTO_INCREMENT PRIMARY KEY,
    direccion VARCHAR(255) NOT NULL,
    distrito VARCHAR(100) NOT NULL,
    ciudad VARCHAR(100) NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    departamento VARCHAR(100),
    pais VARCHAR(100) NOT NULL DEFAULT 'Perú',
    latitud DECIMAL(10, 8),
    longitud DECIMAL(11, 8),
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Usuarios (residentes, negocios y administradores)
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    email_verified_at DATETIME NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    telefono VARCHAR(20),
    tipo ENUM(
        'residente',
        'negocio',
        'admin'
    ) NOT NULL,
    estado ENUM(
        'activo',
        'suspendido',
        'eliminado'
    ) DEFAULT 'activo',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Negocios, referenciando a usuarios y a ubicaciones
CREATE TABLE negocios (
    id_negocio INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_ubicacion BIGINT,
    nombre_negocio VARCHAR(100) NOT NULL,
    descripcion TEXT,
    horario_atencion VARCHAR(100),
    verificado BOOLEAN DEFAULT FALSE,
    imagen_portada VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (id_ubicacion) REFERENCES ubicaciones (id_ubicacion)
);

-- Categorías y su relación N:M con negocios
CREATE TABLE categorias (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(100) NOT NULL
);

CREATE TABLE negocio_categoria (
    id_negocio INT,
    id_categoria INT,
    PRIMARY KEY (id_negocio, id_categoria),
    FOREIGN KEY (id_negocio) REFERENCES negocios (id_negocio),
    FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria)
);

-- Servicios ofrecidos por cada negocio
CREATE TABLE servicios_personalizados (
    id_servicio INT PRIMARY KEY AUTO_INCREMENT,
    id_negocio INT NOT NULL,
    nombre_servicio VARCHAR(100),
    descripcion TEXT,
    precio DECIMAL(10, 2),
    disponible BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_negocio) REFERENCES negocios (id_negocio)
);

CREATE TABLE categorias_servicio (
    id_categoria_servicio INT PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria_servicio VARCHAR(100) NOT NULL,
    descripcion TEXT,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE servicios_predefinidos (
    id_servicio_predefinido INT PRIMARY KEY AUTO_INCREMENT,
    id_categoria_servicio INT NOT NULL,
    nombre_servicio VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),
    FOREIGN KEY (id_categoria_servicio) REFERENCES categorias_servicio (id_categoria_servicio)
);

CREATE TABLE negocio_servicio_prefenidos (
    id_negocio INT,
    id_servicio_predefinido INT,
    PRIMARY KEY (
        id_negocio,
        id_servicio_predefinido
    ),
    FOREIGN KEY (id_negocio) REFERENCES negocios (id_negocio),
    FOREIGN KEY (id_servicio_predefinido) REFERENCES servicios_predefinidos (id_servicio_predefinido)
);

CREATE TABLE caracteristicas (
    id_caracteristica INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    constraint unique_nombre UNIQUE (nombre),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE negocio_caracteristica (
    id_negocio INT,
    id_caracteristica INT,
    PRIMARY KEY (id_negocio, id_caracteristica),
    FOREIGN KEY (id_negocio) REFERENCES negocios (id_negocio),
    FOREIGN KEY (id_caracteristica) REFERENCES caracteristicas (id_caracteristica),
    UNIQUE (id_negocio, id_caracteristica)
);

-- Promociones de negocios
CREATE TABLE promociones (
    id_promocion INT PRIMARY KEY AUTO_INCREMENT,
    id_negocio INT NOT NULL,
    titulo VARCHAR(100),
    descripcion TEXT,
    fecha_inicio DATE,
    fecha_fin DATE,
    activa BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_negocio) REFERENCES negocios (id_negocio)
);

-- Valoraciones y comentarios de usuarios
CREATE TABLE valoraciones (
    id_valoracion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_negocio INT NOT NULL,
    calificacion INT CHECK (calificacion BETWEEN 1 AND 5),
    comentario TEXT,
    fecha_valoracion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (id_negocio) REFERENCES negocios (id_negocio)
);

-- Contactos del negocio (teléfono, WhatsApp, RRSS, sitio web)
CREATE TABLE contactos (
    id_contacto INT PRIMARY KEY AUTO_INCREMENT,
    id_negocio INT NOT NULL,
    tipo ENUM(
        'telefono',
        'whatsapp',
        'facebook',
        'instagram',
        'web'
    ),
    valor_contacto VARCHAR(150),
    FOREIGN KEY (id_negocio) REFERENCES negocios (id_negocio)
);

-- Registros de acciones administrativas
CREATE TABLE logs_admin (
    id_log INT PRIMARY KEY AUTO_INCREMENT,
    id_admin INT NOT NULL,
    accion VARCHAR(255),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_admin) REFERENCES usuarios (id_usuario)
);