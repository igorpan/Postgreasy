<?php

namespace Postgreasy\Serializer\Serializers;

use Postgreasy\Serializer\CompositeSerializer;
use Postgreasy\Serializer\Serializer;

class ScalarSerializer implements Serializer
{
    public function seriailze($data, CompositeSerializer $serializer)
    {
        return $data;
    }

    public function supports($data)
    {
        return is_scalar($data);
    }
}