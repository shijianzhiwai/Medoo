## 说明
基于Medoo二次开发的数据库组件，用于支持阿里云的数据库的读写分离设定，支持更多的Raw写法。

## 安装
```bash
composer require shijianzhiwai/medoo:1.5.4a
```

## 新增语法
```php
$db = new \Medoo\Medoo([
    'database_type' => 'mysql',
    'database_name' => 'test',
    'server'        => '127.0.0.1',
    'username'      => 'root',
    'password'      => '123456',
    'charset'       => 'utf8',
    'port'          => 3306,
]);

//阿里云RDS读写分离下强制主库查询
$db->forceMaster()->select('test', '*', ['id' => 1]);

//新增的RAW写法 select 部分新增自定义select字段部分
//生成的语句 /*FORCE_MASTER*/SELECT `id` as asName FROM `test` WHERE `id` = 1
$db->forceMaster()->select('test', \Medoo\Medoo::raw('`id` as asName'),  ['id' => 1]);
```

## 测试
测试数据库：
```php
[
    'database_type' => 'mysql',
    'database_name' => 'test',
    'server'        => '127.0.0.1',
    'username'      => 'root',
    'password'      => '123456',
    'charset'       => 'utf8',
    'port'          => 3306,
]

```

```sql
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `test`
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;

```

```bash
cd Medoo
phpunit
```

## License

Medoo is under the MIT license.

## Links

* Official website: [https://medoo.in](https://medoo.in)

* Documentation: [https://medoo.in/doc](https://medoo.in/doc)