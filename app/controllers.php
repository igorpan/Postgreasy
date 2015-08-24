<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
/** @var $app \Silex\Application */

$app->register($service = new \Postgreasy\Service());

$app->get('', function () use ($service) {
    $manager = $service->schemaManager();
    ob_start();
    require __DIR__ . '/view.php';
    return ob_get_clean();
});

$app->get('/schemas', function () use ($service) {
    $schemas = $service->schemaManager()->getSchemas();

    return json_encode($service->serializer()->serialize($schemas));
});

$app->get('/schemas/{name}/tables', function ($name) use ($service) {
    $tables = $service->schemaManager()->getSchema($name)->getTables();

    return json_encode($service->serializer()->serialize($tables));
});

$app->get(
    '/schemas/{schemaName}/tables/{tableName}/columns',
    function ($schemaName, $tableName) use ($service) {
        $columns = $service->schemaManager()
            ->getSchema($schemaName)
            ->getTable($tableName)
            ->getColumns();

        return json_encode($service->serializer()->serialize($columns));
    }
);

$app->get(
    '/schemas/{schemaName}/tables/{tableName}/rows',
    function (Request $request, $schemaName, $tableName) use ($service) {
        $offset = $request->query->get('offset');
        $limit  = $request->query->get('limit');
        if (null === $offset || null === $limit) {
            throw new BadRequestHttpException(
                '"offset" and "limit" query parameters must be supplied'
            );
        }
        $rows = $service->schemaManager()
            ->getSchema($schemaName)
            ->getTable($tableName)
            ->getRows($offset, $limit);

        return json_encode($service->serializer()->serialize($rows));
    }
);