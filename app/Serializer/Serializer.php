<?php

namespace Postgreasy\Serializer;

interface Serializer
{
    /**
     * @param mixed $data
     * @param CompositeSerializer $serializer
     *
     * @return array
     */
    public function seriailze($data, CompositeSerializer $serializer);

    /**
     * @param mixed $data
     *
     * @return bool
     */
    public function supports($data);
}