<?php

declare(strict_types=1);

namespace Pest;

function version(): string
{
<<<<<<< HEAD
    return '4.1.6';
=======
    return '4.1.3';
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}

function testDirectory(string $file = ''): string
{
    return TestSuite::getInstance()->testPath.DIRECTORY_SEPARATOR.$file;
}
