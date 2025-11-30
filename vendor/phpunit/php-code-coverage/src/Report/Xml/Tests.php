<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use function assert;
<<<<<<< HEAD
use function sprintf;
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use DOMElement;
use SebastianBergmann\CodeCoverage\CodeCoverage;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 *
 * @phpstan-import-type TestType from CodeCoverage
 */
final readonly class Tests
{
    private DOMElement $contextNode;

    public function __construct(DOMElement $context)
    {
        $this->contextNode = $context;
    }

    /**
     * @param TestType $result
     */
    public function addTest(string $test, array $result): void
    {
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
<<<<<<< HEAD
                Facade::XML_NAMESPACE,
=======
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                'test',
            ),
        );

        assert($node instanceof DOMElement);

        $node->setAttribute('name', $test);
        $node->setAttribute('size', $result['size']);
        $node->setAttribute('status', $result['status']);
<<<<<<< HEAD
        $node->setAttribute('time', sprintf('%F', $result['time']));
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
