<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ReplaceBundle\Tests;

use HeimrichHannot\ReplaceBundle\HeimrichHannotReplaceBundle;
use PHPUnit\Framework\TestCase;

class HeimrichHannotReplaceBundleTest extends TestCase
{
    /**
     * Tests the object instantiation.
     */
    public function testCanBeInstantiated()
    {
        $bundle = new HeimrichHannotReplaceBundle();

        $this->assertInstanceOf('HeimrichHannot\ReplaceBundle\HeimrichHannotReplaceBundle', $bundle);
    }

    /**
     * Tests the getContainerExtension() method.
     */
    public function testReturnsTheContainerExtension()
    {
        $bundle = new HeimrichHannotReplaceBundle();

        $this->assertInstanceOf(
            'HeimrichHannot\ReplaceBundle\DependencyInjection\HeimrichHannotReplaceExtension',
            $bundle->getContainerExtension()
        );
    }
}
