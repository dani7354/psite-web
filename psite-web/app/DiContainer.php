<?php
    namespace App;

    use DI\ContainerBuilder;
    use DI\Container;
    use DI;

    use App\Shared\DatabaseInfo;

    use App\Service\Interface\PageServiceInterface;
    use App\Service\Interface\MessageServiceInterface;
    use App\Service\Interface\CsrfTokenServiceInterface;
    use App\Service\Interface\ProjectServiceInterface;
    use App\Service\Interface\UrlServiceInterface;
    use App\Service\Interface\CaptchaServiceInterface;
    use App\Service\CaptchaService;
    use App\Service\ProjectService;
    use App\Service\UrlService;
    use App\Service\MessageService;
    use App\Service\PageService;
    use App\Service\CsrfTokenService;

    use App\Repository\Interface\MessageRepositoryInterface;
    use App\Repository\Interface\ProjectRepositoryInterface;
    use App\Repository\Interface\DatabaseConnectorInterface;
    use App\Repository\MessageRepository;
    use App\Repository\ProjectRepository;
    use App\Repository\MySqlPdoConnector;

    class DiContainer
    {
        private static $container;

        public static function get(string $class_name) : mixed
        {
            if (self::$container === null) {
                self::$container = self::create_container();
            }

            return self::$container->get($class_name);
        }

        private static function create_container() : Container
        {
            $container_builder = new ContainerBuilder();
            $container_builder->addDefinitions(self::get_config());
            return $container_builder->build();
        }

        private static function get_config() : array
        {
            return [
                PageServiceInterface::class => DI\create(PageService::class),
                MessageServiceInterface::class => DI\autowire(MessageService::class),
                CsrfTokenServiceInterface::class => DI\create(CsrfTokenService::class),
                ProjectServiceInterface::class => DI\autowire(ProjectService::class),
                UrlServiceInterface::class => DI\create(UrlService::class),
                CaptchaServiceInterface::class => DI\create(CaptchaService::class),

                MessageRepositoryInterface::class => DI\autowire(MessageRepository::class),
                ProjectRepositoryInterface::class => DI\autowire(ProjectRepository::class),

                DatabaseConnectorInterface::class => DI\create(MySqlPdoConnector::class)->constructor(
                    DatabaseInfo::get_host(),
                    DatabaseInfo::get_port(),
                    DatabaseInfo::get_name(),
                    DatabaseInfo::get_user(),
                    DatabaseInfo::get_password()),
            ];
        }
    }
