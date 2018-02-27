<?php

namespace Tests;

use PDO;
use Medoo\Medoo;

//由于是在根目录执行命令，路径应该是相对于根路径的
require_once "src/Medoo.php";

class Testcase extends \PHPUnit\Framework\TestCase {

    /**
     * @var Medoo
     */
    protected $app;

    /**
     * setUp
     */
    protected function setUp() {
        if (!defined("INIT")) {
            $this->initMedoo();
        }
    }


    private function initMedoo() {
        define("INIT", 1);

        $this->app = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server'        => '127.0.0.1',
            'username'      => 'root',
            'password'      => '123456',
            'charset'       => 'utf8',
            'port'          => 3306,
            'prefix'        => '',
            'logging'       => false,
            // [optional] driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            'option'        => [
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION, //异常抛出用于前端显示
            ]
        ]);
    }

    /**
     * 打印
     * @param $str
     */
    public function cprint($str) {
        fwrite(STDOUT, is_string($str) ? $str : var_export($str, 1));
    }

    /**
     * 打印前后都有换行符的一行
     * @param $str
     */
    public function cprintlnn($str) {
        fwrite(STDOUT, "\n" . (is_string($str) ? $str : var_export($str, 1)) . "\n");
    }

    /**
     * 打印一行字符串，后面有换行符号
     * @param $str
     */
    public function cprintln($str) {
        fwrite(STDOUT, (is_string($str) ? $str : var_export($str, 1)) . "\n");
    }

    /**
     * 打印换行符号
     */
    public function cprintn() {
        fwrite(STDOUT, "\n");
    }
}