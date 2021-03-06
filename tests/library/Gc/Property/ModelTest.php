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

namespace Gc\Property;

use Gc\Datatype\Model as DatatypeModel;
use Gc\Document\Model as DocumentModel;
use Gc\DocumentType\Model as DocumentTypeModel;
use Gc\Layout\Model as LayoutModel;
use Gc\Registry;
use Gc\User\Model as UserModel;
use Gc\View\Model as ViewModel;
use Gc\Tab\Model as TabModel;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Model
     */
    protected $object;

    /**
     * @var ViewModel
     */
    protected $view;

    /**
     * @var LayoutModel
     */
    protected $layout;

    /**
     * @var UserModel
     */
    protected $user;

    /**
     * @var DocumentTypeModel
     */
    protected $documentType;

    /**
     * @var TabModel
     */
    protected $tab;

    /**
     * @var DatatypeModel
     */
    protected $datatype;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->view = ViewModel::fromArray(
            array(
                'name' => 'View Name',
                'identifier' => 'View identifier',
                'description' => 'View Description',
                'content' => 'View Content'
            )
        );
        $this->view->save();

        $this->layout = LayoutModel::fromArray(
            array(
                'name' => 'Layout Name',
                'identifier' => 'Layout identifier',
                'description' => 'Layout Description',
                'content' => 'Layout Content'
            )
        );
        $this->layout->save();

        $this->user = UserModel::fromArray(
            array(
                'lastname' => 'User test',
                'firstname' => 'User test',
                'email' => 'pierre.rambaud86@gmail.com',
                'login' => 'test',
                'user_acl_role_id' => 1,
            )
        );
        $this->user->setPassword('test');
        $this->user->save();

        $this->documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'Document Type Name',
                'description' => 'Document Type description',
                'icon_id' => 1,
                'defaultview_id' => $this->view->getId(),
                'user_id' => $this->user->getId(),
            )
        );
        $this->documentType->save();

        $this->tab = TabModel::fromArray(
            array(
                'name' => 'TabTest',
                'description' => 'TabTest',
                'sort_order' => 1,
                'document_type_id' => $this->documentType->getId(),
            )
        );
        $this->tab->save();

        $this->datatype = DatatypeModel::fromArray(
            array(
                'name' => 'BooleanTest',
                'prevalue_value' => '',
                'model' => 'Boolean',
            )
        );
        $this->datatype->save();

        $this->object = Model::fromArray(
            array(
                'name' => 'DatatypeTest',
                'identifier' => 'DatatypeTest',
                'description' => 'DatatypeTest',
                'required' => false,
                'sort_order' => 1,
                'tab_id' => $this->tab->getId(),
                'datatype_id' => $this->datatype->getId(),
            )
        );

        $this->object->save();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->object->delete();
        $this->datatype->delete();
        $this->tab->delete();
        $this->documentType->delete();
        $this->user->delete();
        $this->layout->delete();
        $this->view->delete();
        unset($this->datatype);
        unset($this->tab);
        unset($this->documentType);
        unset($this->user);
        unset($this->layout);
        unset($this->view);
        unset($this->object);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testIsRequired()
    {
        $this->assertFalse($this->object->isRequired());
        $this->assertInstanceOf('Gc\Property\Model', $this->object->isRequired(true));
        $this->assertTrue($this->object->isRequired());
        $this->assertInstanceOf('Gc\Property\Model', $this->object->isRequired(false));
        $this->assertFalse($this->object->isRequired());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSetValue()
    {
        $this->assertInstanceOf('Gc\Property\Model', $this->object->setValue('string'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testLoadValue()
    {
        $this->assertInstanceOf('Gc\Property\Model', $this->object->loadValue());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetValue()
    {
        $this->assertEquals('', $this->object->getValue());
        $this->object->setValue('string');
        $this->assertEquals('string', $this->object->getValue());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetValueModel()
    {
        $this->assertInstanceOf('Gc\Property\Value\Model', $this->object->getValueModel());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSaveValue()
    {
        $documentModel = DocumentModel::fromArray(
            array(
                'name' => 'DocumentTest',
                'url_key' => 'document-test',
                'status' => DocumentModel::STATUS_ENABLE,
                'sort_order' => 1,
                'show_in_nav' => true,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => 0,
            )
        );
        $documentModel->save();
        $this->object->setDocumentId($documentModel->getId());
        $this->assertTrue($this->object->saveValue());
        $this->object->isRequired(true);
        $this->assertFalse($this->object->saveValue());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSave()
    {
        $this->assertInternalType('integer', (int) $this->object->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSaveWithWrongValues()
    {
        $configuration = Registry::get('Application')->getConfig();
        if ($configuration['db']['driver'] == 'pdo_mysql') {
            $this->markTestSkipped('Mysql does not thrown exception.');
        }

        $this->setExpectedException('Gc\Exception');
        $this->object->setIdentifier(null);
        $this->assertFalse($this->object->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDelete()
    {
        $this->assertTrue($this->object->delete());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteWithNoId()
    {
        $model = new Model();
        $this->assertFalse($model->delete());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromArray()
    {
        $model = Model::fromArray(
            array(
                'name' => 'DatatypeTest',
                'identifier' => 'DatatypeTest',
                'description' => 'DatatypeTest',
                'required' => false,
                'sort_order' => 1,
                'tab_id' => $this->tab->getId(),
                'datatype_id' => $this->datatype->getId(),
            )
        );
        $this->assertInstanceOf('Gc\Property\Model', $model);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromId()
    {
        $this->assertInstanceOf('Gc\Property\Model', Model::fromId($this->object->getId()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromWithWrongId()
    {
        $this->assertFalse(Model::fromId('undefined'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromIdentifierWithNoDocumentId()
    {
        $this->assertFalse(Model::fromIdentifier($this->object->getIdentifier(), 0));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromIdentifier()
    {
        $documentModel = DocumentModel::fromArray(
            array(
                'name' => 'DocumentTest',
                'url_key' => 'document-test',
                'status' => DocumentModel::STATUS_ENABLE,
                'sort_order' => 1,
                'show_in_nav' => true,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => 0,
            )
        );
        $documentModel->save();
        $this->assertInstanceOf(
            'Gc\Property\Model',
            Model::fromIdentifier($this->object->getIdentifier(), $documentModel->getId())
        );
    }
}
