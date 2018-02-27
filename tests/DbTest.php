<?php

use Tests\TestCase;

class DbTest extends TestCase {

    protected function setUp() {
        parent::setUp();
    }

    public function testHello() {
        $this->assertEquals('', '');
    }

    public function testDb() {

        //插入测试
        $this->app->insert('test', ['value' => 'test']);
        $id = $this->app->id();
        $this->assertTrue(is_numeric($id ));

        //查询测试
        $res = $this->app->select('test','*',['id'=>$id]);
        $this->assertTrue(is_array($res));

        //删除测试
        $pdo = $this->app->delete('test', ['id'=>$id]);
        $num = $pdo->rowCount();
        $this->assertTrue(is_numeric($num) && $num>0);
    }
}