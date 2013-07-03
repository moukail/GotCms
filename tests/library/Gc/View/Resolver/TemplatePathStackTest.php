<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Library
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Gc\View\Resolver;

use Gc\View\Stream;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:07.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class TemplatePathStackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TemplatePathStack
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new TemplatePathStack;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testNormalResolve()
    {
        $this->object->addPath(__DIR__ . '/_templates');

        $markup = $this->object->resolve('one.phtml');
        $this->assertEquals(__DIR__ . '/_templates/one.phtml', $markup);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testWithoutPaths()
    {
        $markup = $this->object->resolve('one.phtml');
        $this->assertFalse($markup);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testResolveWithoutDefaultSuffix()
    {
        $this->object->setDefaultSuffix('.bar');
        $this->object->addPath(__DIR__ . '/_templates');

        $markup = $this->object->resolve('two.phtml');
        $this->assertEquals(__DIR__ . '/_templates/two.phtml.bar', $markup);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testResolveWithLfiProtection()
    {
        $this->object->setLfiProtection(true)
            ->addPath(__DIR__ . '/_templates');

        $this->setExpectedException('Zend\View\Exception\ExceptionInterface');
        $this->object->resolve('../one.phtml');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testResolveWithStream()
    {
        Stream::register();
        $this->object->setUseStreamWrapper(true);
        $markup = $this->object->resolve('foo.bar');
        $this->assertEquals('zend.view://foo.bar', $markup);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testResolveWithStreamAndNoStreamWrapperActive()
    {
        $markup = $this->object->resolve('foo.bar');
        $this->assertFalse($markup);

    }

    /**
     * Test
     *
     * @return void
     */
    public function testResolveWithPharProtocol()
    {
        $path = 'phar://' . __DIR__
            . DIRECTORY_SEPARATOR . '_templates'
            . DIRECTORY_SEPARATOR . 'view.phar'
            . DIRECTORY_SEPARATOR . 'start'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'views';
        $this->object->addPath($path);
        $markup = $this->object->resolve('foo' . DIRECTORY_SEPARATOR . 'hello.phtml');
        $this->assertEquals($path . DIRECTORY_SEPARATOR . 'foo' . DIRECTORY_SEPARATOR . 'hello.phtml', $markup);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testResolveWithFakePharProtocol()
    {
        $path = 'phar://' . __DIR__
            . DIRECTORY_SEPARATOR . '_templates'
            . DIRECTORY_SEPARATOR . 'fake-view.phar';
        $this->object->addPath($path);
        $markup = $this->object->resolve('hello.phtml');
        $this->assertFalse($markup);
    }
}
