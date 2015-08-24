<?php

namespace Postgreasy\Serializer\Serializers;

use Postgreasy\Postgres\Schema;
use Postgreasy\Serializer\CompositeSerializer;
use Postgreasy\Serializer\Serializer;

class SchemaSerializer implements Serializer
{
    /**
     * @param Schema              $data
     * @param CompositeSerializer $serializer
     *
     * @return array
     */
    public function seriailze($data, CompositeSerializer $serializer)
    {
        return [
            'name' => $data->getName(),
        ];
    }

    public function supports($data)
    {
        return $data instanceof Schema;
    }
}