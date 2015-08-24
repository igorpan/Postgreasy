<?php

namespace Postgreasy\Serializer\Serializers;

use Postgreasy\Postgres\Table;
use Postgreasy\Serializer\CompositeSerializer;
use Postgreasy\Serializer\Serializer;

class TableSerializer implements Serializer
{
    /**
     * @param Table               $data
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
        return $data instanceof Table;
    }
}