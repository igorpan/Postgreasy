<?php

namespace Postgreasy\Serializer\Serializers;

use Postgreasy\Postgres\Column;
use Postgreasy\Serializer\CompositeSerializer;
use Postgreasy\Serializer\Serializer;

class ColumnSerializer implements Serializer
{
    /**
     * @param Column              $data
     * @param CompositeSerializer $serializer
     *
     * @return array
     */
    public function seriailze($data, CompositeSerializer $serializer)
    {
        return [
            'name' => $data->getName(),
            'type' => $data->getType(),
        ];
    }

    public function supports($data)
    {
        return $data instanceof Column;
    }
}