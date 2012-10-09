<?php

namespace Icans\Platforms\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IcansPlatformsUserBundle extends Bundle
{
    /**
     * Define the FOSUserBundle as parent to be able to overwrite.
     *
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
