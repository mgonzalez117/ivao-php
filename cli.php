<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

// https://symfony.com/doc/current/components/dependency_injection.html
$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/config/'));
$loader->load('services.yaml');

// https://symfony.com/doc/current/components/dependency_injection/compilation.html
//$containerBuilder->compile();

/** @var \IvaoPHP\Whazzup\WhazzupClient */
$IvaoClient = $containerBuilder->get('whazzup.ivaoClient');
echo "nb connections : ".$IvaoClient->getTotalConnections();