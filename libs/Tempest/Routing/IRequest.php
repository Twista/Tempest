<?php

/**
 * Description of Request Interface
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */

namespace Tempest\Routing;

Interface IRequest {
    public function getUri();
    public function getMethod();
}