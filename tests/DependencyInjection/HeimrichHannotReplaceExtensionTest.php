<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ReplaceBundle\Tests\DependencyInjection;

use HeimrichHannot\ReplaceBundle\DependencyInjection\HeimrichHannotReplaceExtension;
use HeimrichHannot\ReplaceBundle\EventListener\HookListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class HeimrichHannotReplaceExtensionTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->container = new ContainerBuilder(new ParameterBag(['kernel.debug' => false]));
        $extension = new HeimrichHannotReplaceExtension();
        $extension->load([], $this->container);
    }

    /**
     * Tests the object instantiation.
     */
    public function testCanBeInstantiated()
    {
        $extension = new HeimrichHannotReplaceExtension();
        $this->assertInstanceOf('HeimrichHannot\ReplaceBundle\DependencyInjection\HeimrichHannotReplaceExtension', $extension);
    }

    /**
     * Tests the huh.replace.listener.hooks listener.
     */
    public function testRegistersHookListener()
    {
        $this->assertTrue($this->container->has('huh.replace.listener.hooks'));
        $definition = $this->container->getDefinition('huh.replace.listener.hooks');
        $this->assertSame(HookListener::class, $definition->getClass());
        $this->assertSame('contao.framework', (string) $definition->getArgument(0));
    }
}
