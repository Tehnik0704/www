<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/news-and-shares/shares/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news-and-shares/shares/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/news-and-shares/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news-and-shares/news/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/zhilye-kompleksy/#',
    'RULE' => '',
    'ID' => 'citrus.developer:residental.complex',
    'PATH' => '/zhilye-kompleksy/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/docs/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/docs/index.php',
    'SORT' => 100,
  ),
);
