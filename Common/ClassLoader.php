<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',
        'InvalidPartidoPoliticoIdException' => 'Domain/Exceptions/InvalidPartidoPoliticoIdException.php',
        'InvalidPartidoPoliticoNombreException' => 'Domain/Exceptions/InvalidPartidoPoliticoNombreException.php',
        'InvalidPartidoPoliticoEsloganException' => 'Domain/Exceptions/InvalidPartidoPoliticoEsloganException.php',
        'InvalidPartidoPoliticoDirigenteException' => 'Domain/Exceptions/InvalidPartidoPoliticoDirigenteException.php',
        'InvalidPartidoPoliticoPaisException' => 'Domain/Exceptions/InvalidPartidoPoliticoPaisException.php',
        'InvalidPartidoPoliticoCifraException' => 'Domain/Exceptions/InvalidPartidoPoliticoCifraException.php',
        'PartidoPoliticoAlreadyExistsException' => 'Domain/Exceptions/PartidoPoliticoAlreadyExistsException.php',
        'PartidoPoliticoNotFoundException' => 'Domain/Exceptions/PartidoPoliticoNotFoundException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',
        'PartidoPoliticoId' => 'Domain/ValueObjects/PartidoPoliticoId.php',
        'PartidoPoliticoNombre' => 'Domain/ValueObjects/PartidoPoliticoNombre.php',
        'PartidoPoliticoEslogan' => 'Domain/ValueObjects/PartidoPoliticoEslogan.php',
        'PartidoPoliticoDirigente' => 'Domain/ValueObjects/PartidoPoliticoDirigente.php',
        'PartidoPoliticoPais' => 'Domain/ValueObjects/PartidoPoliticoPais.php',
        'PartidoPoliticoCifra' => 'Domain/ValueObjects/PartidoPoliticoCifra.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'PartidoPoliticoModel' => 'Domain/Models/PartidoPoliticoModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',
        'CreatePartidoPoliticoUseCase' => 'Application/Ports/In/CreatePartidoPoliticoUseCase.php',
        'UpdatePartidoPoliticoUseCase' => 'Application/Ports/In/UpdatePartidoPoliticoUseCase.php',
        'GetPartidoPoliticoByIdUseCase' => 'Application/Ports/In/GetPartidoPoliticoByIdUseCase.php',
        'GetAllPartidosPoliticosUseCase' => 'Application/Ports/In/GetAllPartidosPoliticosUseCase.php',
        'DeletePartidoPoliticoUseCase' => 'Application/Ports/In/DeletePartidoPoliticoUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',
        'SavePartidoPoliticoPort' => 'Application/Ports/Out/SavePartidoPoliticoPort.php',
        'UpdatePartidoPoliticoPort' => 'Application/Ports/Out/UpdatePartidoPoliticoPort.php',
        'GetPartidoPoliticoByIdPort' => 'Application/Ports/Out/GetPartidoPoliticoByIdPort.php',
        'GetPartidoPoliticoByNombrePort' => 'Application/Ports/Out/GetPartidoPoliticoByNombrePort.php',
        'GetAllPartidosPoliticosPort' => 'Application/Ports/Out/GetAllPartidosPoliticosPort.php',
        'CountPartidosPoliticosPort' => 'Application/Ports/Out/CountPartidosPoliticosPort.php',
        'DeletePartidoPoliticoPort' => 'Application/Ports/Out/DeletePartidoPoliticoPort.php',

        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',
        'CreatePartidoPoliticoCommand' => 'Application/Services/Dto/Commands/CreatePartidoPoliticoCommand.php',
        'UpdatePartidoPoliticoCommand' => 'Application/Services/Dto/Commands/UpdatePartidoPoliticoCommand.php',
        'DeletePartidoPoliticoCommand' => 'Application/Services/Dto/Commands/DeletePartidoPoliticoCommand.php',
        'GetPartidoPoliticoByIdQuery' => 'Application/Services/Dto/Queries/GetPartidoPoliticoByIdQuery.php',
        'GetAllPartidosPoliticosQuery' => 'Application/Services/Dto/Queries/GetAllPartidosPoliticosQuery.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',
        'CreatePartidoPoliticoService' => 'Application/Services/CreatePartidoPoliticoService.php',
        'UpdatePartidoPoliticoService' => 'Application/Services/UpdatePartidoPoliticoService.php',
        'GetPartidoPoliticoByIdService' => 'Application/Services/GetPartidoPoliticoByIdService.php',
        'GetAllPartidosPoliticosService' => 'Application/Services/GetAllPartidosPoliticosService.php',
        'DeletePartidoPoliticoService' => 'Application/Services/DeletePartidoPoliticoService.php',
        'PartidoPoliticoApplicationMapper' => 'Application/Services/Mappers/PartidoPoliticoApplicationMapper.php',
        'PartidoPoliticoPage' => 'Application/Services/Responses/PartidoPoliticoPage.php',

        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',
        'PartidoPoliticoPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/PartidoPoliticoPersistenceDto.php',
        'PartidoPoliticoEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/PartidoPoliticoEntity.php',
        'PartidoPoliticoPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/PartidoPoliticoPersistenceMapper.php',
        'PartidoPoliticoRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/PartidoPoliticoRepositoryMySQL.php',

        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

        'DependencyInjection' => 'Common/DependencyInjection.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}