<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\FunctionLike\FunctionLikeToFirstClassCallableRector;
use Rector\Config\RectorConfig;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    ->withSkip([
        ReadOnlyPropertyRector::class,
        EncapsedStringsToSprintfRector::class,
        DisallowedEmptyRuleFixerRector::class,
<<<<<<< HEAD
        FunctionLikeToFirstClassCallableRector::class,
=======
        FunctionLikeToFirstClassCallableRector::class => [
            __DIR__.'src/Install/CodeEnvironmentsDetector.php',
        ],
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        earlyReturn: true,
    )->withPhpSets(php81: true);
