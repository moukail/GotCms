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

namespace Gc\Module;

use Gc\Registry;
use ReflectionClass;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class AbstractModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractModule
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
        $this->object = $this->getMockForAbstractClass('Gc\Module\AbstractModule');
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
    public function testGetAdapter()
    {
        $class = $this->getMethod('getAdapter');
        $this->assertInstanceOf('Zend\Db\Adapter\Adapter', $class->invokeArgs($this->object, array()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetDriverName()
    {
        $configuration = Registry::get('Application')->getConfig();
        $class         = $this->getMethod('getDriverName');
        $this->assertEquals($configuration['db']['driver'], $class->invokeArgs($this->object, array()));
    }

    /**
     * Retrieve protected method
     *
     * @param string $name Name
     *
     * @return mixed
     */
    protected function getMethod($name)
    {
        $class  = new ReflectionClass('Gc\Module\AbstractModule');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
