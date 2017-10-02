<?php
return array(
 'doctrine' => array(
 'connection' => array(
 'orm_default' => array(
 'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
 'params' => array(
 'host' => 'mysql91.1gb.ru',
 'port' => '3306',
 'user' => 'gb_iodogsdb',
 'password' => 'a2eef5afz2',
 'driverOptions' => array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'),
 'dbname' => 'gb_iodogsdb',
 )
 )
 ),
 ),
);