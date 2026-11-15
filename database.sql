-- ================================================================
-- Script de base de datos para PostgreSQL
-- Base de datos: partido_politico_db
-- Ejecutar en pgAdmin 4 (Query Tool) conectado a esa base de datos
-- ================================================================

-- ----------------------------------------------------------------
-- Tabla de usuarios (CRUD de usuarios, capa base del proyecto)
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'MEMBER',
    status VARCHAR(20) NOT NULL DEFAULT 'ACTIVE',
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW()
);

-- Usuario administrador de prueba (correo: admin@crud.com / clave: admin123)
INSERT INTO users (id, name, email, password, role, status)
VALUES (
    'a1b2c3d4-e5f6-4a7b-8c9d-0e1f2a3b4c5d',
    'Administrador',
    'admin@crud.com',
    '$2y$10$CbpscSgoctPKj7U670KUduYEZ8WSliekXE.bPFb5F578nhpX6UDmO',
    'ADMIN',
    'ACTIVE'
)
ON CONFLICT (email) DO NOTHING;

-- ----------------------------------------------------------------
-- Tabla de partidos politicos (Ejercicio #24)
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS partidos_politicos (
    id VARCHAR(36) PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    eslogan VARCHAR(180) NOT NULL,
    presidente VARCHAR(100) NOT NULL,
    secretario VARCHAR(100) NOT NULL,
    tesorero VARCHAR(100) NOT NULL,
    pais VARCHAR(80) NOT NULL,
    num_presidentes INTEGER NOT NULL DEFAULT 0,
    num_gobernadores INTEGER NOT NULL DEFAULT 0,
    num_alcaldes INTEGER NOT NULL DEFAULT 0,
    num_concejales INTEGER NOT NULL DEFAULT 0,
    num_congresistas INTEGER NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_partidos_politicos_nombre ON partidos_politicos (nombre);
CREATE INDEX IF NOT EXISTS idx_partidos_politicos_pais ON partidos_politicos (pais);

-- ----------------------------------------------------------------
-- Datos de ejemplo para el listado (opcional)
-- ----------------------------------------------------------------
INSERT INTO partidos_politicos (
    id, nombre, eslogan, presidente, secretario, tesorero, pais,
    num_presidentes, num_gobernadores, num_alcaldes, num_concejales, num_congresistas
)
VALUES
    (
        'b2c3d4e5-f6a7-4b8c-9d0e-1f2a3b4c5d6e',
        'Partido Liberal',
        'Por la libertad y el progreso',
        'Carlos Restrepo',
        'Ana Gomez',
        'Jorge Morales',
        'Colombia',
        3, 8, 45, 120, 78
    ),
    (
        'c3d4e5f6-a7b8-4c9d-0e1f-2a3b4c5d6e7f',
        'Partido Conservador',
        'Tradicion, familia y orden',
        'Marta Valdez',
        'Luis Cardenas',
        'Sofia Restrepo',
        'Colombia',
        2, 6, 38, 110, 65
    ),
    (
        'd4e5f6a7-b8c9-4d0e-1f2a-3b4c5d6e7f8a',
        'Movimiento Verde',
        'Un pais sustentable es posible',
        'Diego Torres',
        'Elena Ruiz',
        'Pablo Sanchez',
        'Colombia',
        1, 2, 12, 35, 18
    )
ON CONFLICT (id) DO NOTHING;
