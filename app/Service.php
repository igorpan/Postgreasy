<?php

namespace Postgreasy;

use Silex\Application;
use Silex\ServiceProviderInterface;

final class Service implements ServiceProviderInterface
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @return \Postgreasy\Postgres\Manager
     */
    public function schemaManager()
    {
        return $this->app['schema_manager'];
    }

    /**
     * @return \Postgreasy\Serializer\CompositeSerializer
     */
    public function serializer()
    {
        return $this->app['serializer'];
    }

    public function register(Application $app)
    {
        $this->app = $app;

        $app['schema_manager'] = $app->share(function () {
            return new \Postgreasy\Postgres\Manager('127.0.0.1', 'rounded_dev', 'rounded_dev');
        });

        $app['serializer'] = $app->share(function () {
            return new \Postgreasy\Serializer\CompositeSerializer();
        });
    }

    public function boot(Application $app)
    {
    }
}