<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ResourceBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class NewResourceFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ResourceBundle\Controller\NewResourceFactory');
    }
    
    function it_implements_new_resource_factory_interface()
    {
        $this->shouldImplement('Sylius\Bundle\ResourceBundle\Controller\NewResourceFactoryInterface');
    }

    function it_calls_proper_factory_methods_based_on_configuration(RequestConfiguration $requestConfiguration, FactoryInterface $factory)
    {
        $requestConfiguration->getFactoryMethod('createNew')->willReturn('createNew');
        $requestConfiguration->getFactoryArguments()->willReturn(array('00032'));

        $factory->createNew('00032')->shouldBeCalled()->willReturn(array('foo', 'bar'));

        $this->create($requestConfiguration, $factory)->shouldReturn(array('foo', 'bar'));
    }
}
