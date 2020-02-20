<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ReplaceBundle;

use HeimrichHannot\ReplaceBundle\DependencyInjection\HeimrichHannotReplaceExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class HeimrichHannotReplaceBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new HeimrichHannotReplaceExtension();
    }
}
