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
use DOMElement;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final readonly class Unit
{
    private DOMElement $contextNode;

<<<<<<< HEAD
    public function __construct(
        DOMElement $context,
        string $name,
        string $namespace,
        int $start,
        int $executable,
        int $executed,
        float $crap
    ) {
        $this->contextNode = $context;

        $this->contextNode->setAttribute('name', $name);
        $this->contextNode->setAttribute('start', (string) $start);
        $this->contextNode->setAttribute('executable', (string) $executable);
        $this->contextNode->setAttribute('executed', (string) $executed);
        $this->contextNode->setAttribute('crap', (string) $crap);

        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                Facade::XML_NAMESPACE,
                'namespace',
            ),
        );
=======
    public function __construct(DOMElement $context, string $name)
    {
        $this->contextNode = $context;

        $this->setName($name);
    }

    public function setLines(int $start, int $executable, int $executed): void
    {
        $this->contextNode->setAttribute('start', (string) $start);
        $this->contextNode->setAttribute('executable', (string) $executable);
        $this->contextNode->setAttribute('executed', (string) $executed);
    }

    public function setCrap(float $crap): void
    {
        $this->contextNode->setAttribute('crap', (string) $crap);
    }

    public function setNamespace(string $namespace): void
    {
        $node = $this->contextNode->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            'namespace',
        )->item(0);

        if ($node === null) {
            $node = $this->contextNode->appendChild(
                $this->contextNode->ownerDocument->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
                    'namespace',
                ),
            );
        }

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        assert($node instanceof DOMElement);

        $node->setAttribute('name', $namespace);
    }

<<<<<<< HEAD
    public function addMethod(
        string $name,
        string $signature,
        string $start,
        ?string $end,
        string $executable,
        string $executed,
        string $coverage,
        string $crap
    ): void {
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                Facade::XML_NAMESPACE,
=======
    public function addMethod(string $name): Method
    {
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                'method',
            ),
        );

        assert($node instanceof DOMElement);

<<<<<<< HEAD
        new Method(
            $node,
            $name,
            $signature,
            $start,
            $end,
            $executable,
            $executed,
            $coverage,
            $crap,
        );
=======
        return new Method($node, $name);
    }

    private function setName(string $name): void
    {
        $this->contextNode->setAttribute('name', $name);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
