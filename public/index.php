<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    // Définir les valeurs pour APP_ENV et APP_DEBUG dans le tableau $context
    $context['APP_ENV'] = 'prod';
    $context['APP_DEBUG'] = true;

    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
