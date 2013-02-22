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
 * @category Gc_Application
 * @package  Config
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

define('GC_APPLICATION_PATH', getcwd());
define('GC_MEDIA_PATH', GC_APPLICATION_PATH . '/public/media');

// Composer autoloading
if(file_exists('vendor/autoload.php'))
{
    $loader = include 'vendor/autoload.php';
}

$zf_path = false;
// Support for ZF2_PATH environment variable or git submodule
if(getenv('ZF2_PATH'))
{
    $zf_path = getenv('ZF2_PATH');
}
elseif(get_cfg_var('zf2_path')) // Support for zf2_path directive value
{
    $zf_path = get_cfg_var('zf2_path');
}
elseif(is_dir('vendor/Zend'))
{
    $zf_path = 'vendor';
}

if($zf_path)
{
    // Get application stack configuration
    $configuration = include 'config/application.config.php';
    if(isset($loader))
    {
        $loader->add('Zend', $zf_path);
    }
    else
    {
        include $zf_path . '/Zend/Loader/AutoloaderFactory.php';
        Zend\Loader\AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => $configuration['autoloader'],
        ));

        require $zf_path . '/Zend/Stdlib/compatibility/autoload.php';
        require $zf_path . '/Zend/Session/compatibility/autoload.php';
    }
}

if(!class_exists('Zend\Loader\AutoloaderFactory'))
{
    throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
}