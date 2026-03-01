<?php

require 'container.php';

$service = $container->get('UserService');
print_r($service->getUsers());
