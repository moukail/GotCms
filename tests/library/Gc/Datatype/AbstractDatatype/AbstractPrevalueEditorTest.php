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

namespace Gc\Datatype\AbstractDatatype;

use Gc\Datatype\Model as DatatypeModel;
use Gc\Registry;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class AbstractPrevalueEditorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractPrevalueEditor
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
        $this->datatype = DatatypeModel::fromArray(
            array(
                'name' => 'AbstractEditorTest',
                'prevalue_value' => 's:26:"AbstractPrevalueEditorTest";',
                'model' => 'AbstractEditorTest',
            )
        );
        $this->datatype->save();

        $mockDatatype = $this->getMockForAbstractClass('Gc\Datatype\AbstractDatatype');
        $application  = Registry::get('Application');
        $mockDatatype->setRequest($application->getServiceManager()->get('Request'));
        $mockDatatype->setRouter($application->getServiceManager()->get('Router'));
        $mockDatatype->setHelperManager($application->getServiceManager()->get('viewhelpermanager'));
        $mockDatatype->load($this->datatype, 1);

        $this->object = $this->getMockForAbstractClass(
            'Gc\Datatype\AbstractDatatype\AbstractPrevalueEditor',
            array($mockDatatype)
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->datatype->delete();
        unset($this->datatype);
        unset($this->object);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetConfig()
    {
        $this->assertEquals('AbstractPrevalueEditorTest', $this->object->getConfig());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSetConfig()
    {
        $this->object->setConfig('s:27:"AbstractPrevalueEditorTest2";');
        $this->assertEquals('AbstractPrevalueEditorTest2', $this->object->getConfig());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetRequest()
    {
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Request', $this->object->getRequest());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetDatatype()
    {
        $this->assertInstanceOf('Gc\Datatype\AbstractDatatype', $this->object->getDatatype());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testRender()
    {
        $this->object->addPath(__DIR__ . '/../');
        $this->assertEquals('String' . PHP_EOL, $this->object->render('_files/template.phtml'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testAddPath()
    {
        $this->assertInstanceOf('Gc\Datatype\AbstractDatatype\AbstractPrevalueEditor', $this->object->addPath(__DIR__));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetHelper()
    {
        $this->assertInstanceOf('Gc\View\Helper\Partial', $this->object->getHelper('partial'));
    }
}
