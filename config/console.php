<?php
$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    //'basePath' => dirname(__DIR__) . '/commands',
    'controllerNamespace' => 'app\commands',
    'components' => [
    ],
    'params' => $params,
];
