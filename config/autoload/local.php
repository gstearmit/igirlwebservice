<?php
return array(
   'db' => array(
      'username' => 'root',
      'password' => '',
   ),
);

return array(
  'doctrine' => array(
    'connection' => array(
      'orm_default' => array(
        'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
        'params' => array(
          'host'     => 'localhost',
          'port'     => '3306',
          'user'     => 'root',
          'password' => '',
          'dbname'   => 'igirlcomvn'
        )
      )
    )
  ),
);