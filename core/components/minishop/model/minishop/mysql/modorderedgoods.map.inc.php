<?php
$xpdo_meta_map['ModOrderedGoods']= array (
  'package' => 'minishop',
  'version' => '1.1',
  'table' => 'ms_modOrderedGoods',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'gid' => NULL,
    'oid' => NULL,
    'num' => 1,
    'price' => NULL,
    'weight' => 0,
    'sum' => NULL,
    'data' => NULL,
  ),
  'fieldMeta' => 
  array (
    'gid' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'oid' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'num' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 1,
    ),
    'price' => 
    array (
      'dbtype' => 'float',
      'precision' => '10,2',
      'phptype' => 'float',
      'null' => false,
    ),
    'weight' => 
    array (
      'dbtype' => 'float',
      'precision' => '10,3',
      'phptype' => 'float',
      'null' => false,
      'default' => 0,
    ),
    'sum' => 
    array (
      'dbtype' => 'float',
      'precision' => '10,2',
      'phptype' => 'float',
      'null' => false,
    ),
    'data' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
  'indexes' => 
  array (
    'gid' => 
    array (
      'alias' => 'gid',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'gid' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'oid' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
