<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ResourceBundle\Form\DataTransformer;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ResourceBundle\Form\DataTransformer\ArrayToStringTransformer;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class ArrayToStringTransformerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(',');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ArrayToStringTransformer::class);
    }

    function it_is_data_transformer()
    {
        $this->shouldImplement(DataTransformerInterface::class);
    }

    function it_transforms_array_to_string()
    {
        $this->transform(['abc', 'def', 'ghi', 'jkl'])->shouldReturn('abc,def,ghi,jkl');
    }

    function it_transforms_string_to_array()
    {
        $this->reverseTransform('abc,def,ghi,jkl')->shouldReturn(['abc', 'def', 'ghi', 'jkl']);
    }

    function it_throws_invalid_argument_exception_if_transform_argument_is_not_a_array()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('transform', [new \stdClass()]);
    }

    function it_throws_invalid_argument_exception_if_transform_argument_is_not_a_string()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('reverseTransform', [new \stdClass()]);
    }
}
