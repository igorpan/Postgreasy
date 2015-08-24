<?php

namespace Postgreasy\Serializer;

use Postgreasy\Serializer\Serializers\ColumnSerializer;
use Postgreasy\Serializer\Serializers\ScalarSerializer;
use Postgreasy\Serializer\Serializers\SchemaSerializer;
use Postgreasy\Serializer\Serializers\TableSerializer;
use Postgreasy\Serializer\Serializers\TraversableSerializer;

class CompositeSerializer
{
    /**
     * @var Serializer[]
     */
    private $serializers = [];

    public function __construct()
    {
        $this->serializers[] = new SchemaSerializer();
        $this->serializers[] = new TableSerializer();
        $this->serializers[] = new ColumnSerializer();
        $this->serializers[] = new TraversableSerializer();
        $this->serializers[] = new ScalarSerializer();
    }

    public function serialize($data)
    {
        foreach ($this->serializers as $serializer) {
            if ($serializer->supports($data)) {
                return $serializer->seriailze($data, $this);
            }
        }
        throw new \RuntimeException('Can not find serializer');
    }
}