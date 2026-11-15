<?php

declare(strict_types=1);

require_once __DIR__ . '/ClassLoader.php';
require_once __DIR__ . '/EnvLoader.php';

final class DependencyInjection
{
    public static function boot(): void
    {
        EnvLoader::load(dirname(__DIR__) . '/.env');
        ClassLoader::register();
    }

    public static function getConnection(): Connection
    {
        ClassLoader::loadClass('Connection');

        return new Connection(
            host: EnvLoader::get('DB_HOST', '127.0.0.1'),
            port: EnvLoader::getInt('DB_PORT', 3306),
            database: EnvLoader::get('DB_DATABASE', 'crud_usuarios'),
            username: EnvLoader::get('DB_USERNAME', 'root'),
            password: EnvLoader::get('DB_PASSWORD', ''),
            charset: EnvLoader::get('DB_CHARSET', 'utf8mb4')
        );
    }

    public static function getPdo(): PDO
    {
        return self::getConnection()->createPdo();
    }

    public static function getUserPersistenceMapper(): UserPersistenceMapper
    {
        ClassLoader::loadClass('UserPersistenceMapper');

        return new UserPersistenceMapper();
    }

    public static function getUserRepository(): UserRepositoryMySQL
    {
        ClassLoader::loadClass('UserRepositoryMySQL');

        return new UserRepositoryMySQL(
            self::getPdo(),
            self::getUserPersistenceMapper()
        );
    }

    public static function getEmailSenderService(): EmailSenderService
    {
        ClassLoader::loadClass('EmailSenderService');

        return new EmailSenderService(
            host: EnvLoader::get('SMTP_HOST', 'smtp.gmail.com'),
            username: EnvLoader::get('SMTP_USERNAME', ''),
            password: EnvLoader::get('SMTP_PASSWORD', ''),
            fromAddress: EnvLoader::get('SMTP_FROM_ADDRESS', ''),
            fromName: EnvLoader::get('SMTP_FROM_NAME', 'CRUD Usuarios'),
            encryption: EnvLoader::get('SMTP_ENCRYPTION', 'tls'),
            port: EnvLoader::getInt('SMTP_PORT', 587)
        );
    }

    public static function getEmailNotificationService(): EmailNotificationService
    {
        ClassLoader::loadClass('EmailNotificationService');

        return new EmailNotificationService(
            self::getEmailSenderService()
        );
    }

    public static function getCreateUserUseCase(): CreateUserUseCase
    {
        ClassLoader::loadClass('CreateUserService');
        $repository = self::getUserRepository();

        return new CreateUserService(
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getUpdateUserUseCase(): UpdateUserUseCase
    {
        ClassLoader::loadClass('UpdateUserService');
        $repository = self::getUserRepository();

        return new UpdateUserService(
            $repository,
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getGetUserByIdUseCase(): GetUserByIdUseCase
    {
        ClassLoader::loadClass('GetUserByIdService');

        return new GetUserByIdService(
            self::getUserRepository()
        );
    }

    public static function getGetAllUsersUseCase(): GetAllUsersUseCase
    {
        ClassLoader::loadClass('GetAllUsersService');

        return new GetAllUsersService(
            self::getUserRepository()
        );
    }

    public static function getDeleteUserUseCase(): DeleteUserUseCase
    {
        ClassLoader::loadClass('DeleteUserService');
        $repository = self::getUserRepository();

        return new DeleteUserService(
            $repository,
            $repository
        );
    }

    public static function getUserWebMapper(): UserWebMapper
    {
        ClassLoader::loadClass('UserWebMapper');

        return new UserWebMapper();
    }

    public static function getUserController(): UserController
    {
        ClassLoader::loadClass('UserController');

        return new UserController(
            self::getCreateUserUseCase(),
            self::getUpdateUserUseCase(),
            self::getGetUserByIdUseCase(),
            self::getGetAllUsersUseCase(),
            self::getDeleteUserUseCase(),
            self::getUserWebMapper()
        );
    }

    public static function getLoginUseCase(): LoginUseCase
    {
        ClassLoader::loadClass('LoginService');

        return new LoginService(
            self::getUserRepository()
        );
    }

    public static function getPartidoPoliticoPersistenceMapper(): PartidoPoliticoPersistenceMapper
    {
        ClassLoader::loadClass('PartidoPoliticoPersistenceMapper');

        return new PartidoPoliticoPersistenceMapper();
    }

    public static function getPartidoPoliticoRepository(): PartidoPoliticoRepositoryMySQL
    {
        ClassLoader::loadClass('PartidoPoliticoRepositoryMySQL');

        return new PartidoPoliticoRepositoryMySQL(
            self::getPdo(),
            self::getPartidoPoliticoPersistenceMapper()
        );
    }

    public static function getCreatePartidoPoliticoUseCase(): CreatePartidoPoliticoUseCase
    {
        ClassLoader::loadClass('CreatePartidoPoliticoService');
        $repository = self::getPartidoPoliticoRepository();

        return new CreatePartidoPoliticoService(
            $repository,
            $repository
        );
    }

    public static function getUpdatePartidoPoliticoUseCase(): UpdatePartidoPoliticoUseCase
    {
        ClassLoader::loadClass('UpdatePartidoPoliticoService');
        $repository = self::getPartidoPoliticoRepository();

        return new UpdatePartidoPoliticoService(
            $repository,
            $repository,
            $repository
        );
    }

    public static function getGetPartidoPoliticoByIdUseCase(): GetPartidoPoliticoByIdUseCase
    {
        ClassLoader::loadClass('GetPartidoPoliticoByIdService');

        return new GetPartidoPoliticoByIdService(
            self::getPartidoPoliticoRepository()
        );
    }

    public static function getGetAllPartidosPoliticosUseCase(): GetAllPartidosPoliticosUseCase
    {
        ClassLoader::loadClass('GetAllPartidosPoliticosService');
        $repository = self::getPartidoPoliticoRepository();

        return new GetAllPartidosPoliticosService(
            $repository,
            $repository
        );
    }

    public static function getDeletePartidoPoliticoUseCase(): DeletePartidoPoliticoUseCase
    {
        ClassLoader::loadClass('DeletePartidoPoliticoService');
        $repository = self::getPartidoPoliticoRepository();

        return new DeletePartidoPoliticoService(
            $repository,
            $repository
        );
    }

    public static function getPartidoPoliticoWebMapper(): PartidoPoliticoWebMapper
    {
        ClassLoader::loadClass('PartidoPoliticoWebMapper');

        return new PartidoPoliticoWebMapper();
    }

    public static function getPartidoPoliticoController(): PartidoPoliticoController
    {
        ClassLoader::loadClass('PartidoPoliticoController');

        return new PartidoPoliticoController(
            self::getCreatePartidoPoliticoUseCase(),
            self::getUpdatePartidoPoliticoUseCase(),
            self::getGetPartidoPoliticoByIdUseCase(),
            self::getGetAllPartidosPoliticosUseCase(),
            self::getDeletePartidoPoliticoUseCase(),
            self::getPartidoPoliticoWebMapper()
        );
    }
}