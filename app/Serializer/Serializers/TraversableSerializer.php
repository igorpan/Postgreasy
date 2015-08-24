<?php

namespace Postgreasy\Serializer\Serializers;

use Postgreasy\Serializer\CompositeSerializer;
use Postgreasy\Serializer\Serializer;

class TraversableSerializer implements Serializer
{
    /**
     * @param array|\Traversable  $data
     * @param CompositeSerializer $serializer
     *
     * @return array
     */
    public function seriailze($data, CompositeSerializer $serializer)
    {
        $array = [];
        foreach ($data as $item) {
            $array[] = $serializer->serialize($item);
        }
        return $array;
    }

    public function supports($data)
    {
        return is_array($data) || $data instanceof \Traversable;
    }
}