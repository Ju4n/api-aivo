<?php

namespace Aivo\Rest\Resource;

use JsonSerializable;
use stdClass;

/**
 * Facebook Profile
 *
 * @author Juan Deladoey
 */
class FacebookProfileResource implements JsonSerializable
{

    private $data;

    /**
     * __construct
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $resource            = new stdClass();
        $resource->id        = $this->data->getId();
        $resource->firstName = $this->data->getFirstName();
        $resource->lastName  = $this->data->getLastName();

        return $resource;
    }
}
