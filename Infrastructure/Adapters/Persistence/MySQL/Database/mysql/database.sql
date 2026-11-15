-- ================================================================
-- Script de Base de Datos para CRUDL con Arquitectura Hexagonal
-- Entidades: Usuario y Partido Político (Ejercicio Asignado #24)
-- ================================================================

-- 1. CREAR USUARIO DE BASE DE DATOS (Segun Guía)
CREATE USER IF NOT EXISTS 'Estudiante'@'%' IDENTIFIED BY 'Developer';

-- 2. CREAR BASE DE DATOS
DROP DATABASE IF EXISTS crud_usuarios;
CREATE DATABASE crud_usuarios
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 3. OTORGAR PERMISOS AL USUARIO
GRANT ALL PRIVILEGES ON crud_usuarios.* TO 'Estudiante'@'%';
FLUSH PRIVILEGES;

-- 4. USAR BASE DE DATOS
USE crud_usuarios;

-- 5. TABLA DE ROLES
CREATE TABLE IF NOT EXISTS roles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- 6. TABLA DE USUARIOS
CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'MEMBER',
    status VARCHAR(20) DEFAULT 'ACTIVE',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 7. INSERTAR ROLES
INSERT INTO roles (name) VALUES ('Admin'), ('User'), ('Estudiante')
ON DUPLICATE KEY UPDATE name=name;

-- 8. INSERTAR USUARIO ADMINISTRADOR
-- Contraseña bcrypt para 'admin123'
INSERT INTO users (id, name, email, password, role, status)
VALUES (
    '1',
    'Administrador',
    'admin@crud.com',
    '$2y$10$XUqnhSHZ9V.qWabpvDo5oOeQQoWBW3qJS7JZoqQxtbtFRlOqhn9fi',
    'ADMIN',
    'ACTIVE'
)
ON DUPLICATE KEY UPDATE name=name;

-- 9. TABLA DE PARTIDOS POLITICOS (Ejercicio 24)
-- Atributos requeridos: nombre, eslogan, presidente, secretario, tesorero, pais,
-- numPresidentes, numGobernadores, numAlcaldes, numConcejales, numCongresistas
CREATE TABLE IF NOT EXISTS partidos_politicos (
    id VARCHAR(36) PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE,
    eslogan VARCHAR(255) NOT NULL,
    presidente VARCHAR(150) NOT NULL,
    secretario VARCHAR(150) NOT NULL,
    tesorero VARCHAR(150) NOT NULL,
    pais VARCHAR(100) NOT NULL,
    num_presidentes INT NOT NULL DEFAULT 0,
    num_gobernadores INT NOT NULL DEFAULT 0,
    num_alcaldes INT NOT NULL DEFAULT 0,
    num_concejales INT NOT NULL DEFAULT 0,
    num_congresistas INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 10. DATOS DE EJEMPLO PARA PARTIDOS POLITICOS
INSERT INTO partidos_politicos (
    id, nombre, eslogan, presidente, secretario, tesorero, pais,
    num_presidentes, num_gobernadores, num_alcaldes, num_concejales, num_congresistas
) VALUES (
    'b7d512a8-a530-4cf8-8774-7cecb001f301',
    'Partido Esperanza y Progreso',
    'Por un futuro digno y transparente',
    'Carlos Alberto Mendoza',
    'Mariana Gómez Silva',
    'Rodrigo Restrepo',
    'Colombia',
    2, 4, 18, 95, 12
) ON DUPLICATE KEY UPDATE nombre=nombre;
