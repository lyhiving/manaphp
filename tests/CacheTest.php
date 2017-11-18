<?php
namespace Tests;

use ManaPHP\Cache;
use ManaPHP\Cache\Engine\File;
use ManaPHP\Di\FactoryDefault;
use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{
    /**
     * @var \ManaPHP\DiInterface
     */
    protected $_di;

    public function setUp()
    {
        parent::setUp();

        $this->_di = new FactoryDefault();
        $this->_di->alias->set('@data', sys_get_temp_dir());
    }

    public function test_exists()
    {
        $cache = new Cache(new File());
        $cache->delete('country');

        $this->assertFalse($cache->exists('country'));

        $cache->set('country', 'china', 100);
        $this->assertTrue($cache->exists('country'));
    }

    public function test_get()
    {
        $cache = new Cache(new File());

        $cache->delete('country');
        $this->assertFalse($cache->get('country'));

        $cache->set('country', 'china', 100);
        $this->assertEquals('china', $cache->get('country'));
    }

    public function test_set()
    {
        $cache = new Cache(new File());
        $cache->delete('var');

        $this->assertFalse($cache->get('var'));

        //null
        $cache->set('var', null, 100);
        $this->assertNull($cache->get('var'));

        // false, not support
        try {
            $cache->set('var', false, 100);
            $this->fail('why not!');
        } catch (\Exception $e) {
            $this->assertEquals('`var` key cache value can not `false` boolean value', $e->getMessage());
        }

        // true
        $cache->set('var', true, 100);
        $this->assertSame(true, $cache->get('var'));

        // int
        $cache->set('var', 199, 100);
        $this->assertSame(199, $cache->get('var'));

        // float
        $cache->set('var', 1.5, 100);
        $this->assertSame(1.5, $cache->get('var'));

        //string
        $cache->set('var', 'value', 100);
        $this->assertSame('value', $cache->get('var'));

        $cache->set('var', '', 100);
        $this->assertSame('', $cache->get('var'));

        $cache->set('var', '{', 100);
        $this->assertSame('{', $cache->get('var'));

        $cache->set('var', '[', 100);
        $this->assertSame('[', $cache->get('var'));

        //array
        $cache->set('var', [1, 2, 3], 100);
        $this->assertSame([1, 2, 3], $cache->get('var'));

        $cache->set('var', ['_wrapper_' => 123], 100);
        $this->assertSame(['_wrapper_' => 123], $cache->get('var'));

        //object
        $value = new \stdClass();
        $value->a = 123;
        $value->b = 'bbbb';

        $cache->set('val', $value, 100);
        $this->assertEquals((array)$value, $cache->get('val'));
    }

    public function test_delete()
    {
        $cache = new Cache(new File());
        $cache->delete('val');

        // delete a not existed
        $this->assertFalse($cache->exists('val'));
        $cache->delete('val');

        // delete an existed
        $cache->set('country', 'china', 100);
        $this->assertTrue($cache->exists('country'));
        $cache->delete('country');
        $this->assertFalse($cache->exists('country'));
    }
}