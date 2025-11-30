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

use DOMElement;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final readonly class Method
{
    private DOMElement $contextNode;

<<<<<<< HEAD
    public function __construct(
        DOMElement $context,
        string $name,
        string $signature,
        string $start,
        ?string $end,
        string $executable,
        string $executed,
        string $coverage,
        string $crap
    ) {
        $this->contextNode = $context;

        $this->contextNode->setAttribute('name', $name);
        $this->contextNode->setAttribute('signature', $signature);

=======
    public function __construct(DOMElement $context, string $name)
    {
        $this->contextNode = $context;

        $this->setName($name);
    }

    public function setSignature(string $signature): void
    {
        $this->contextNode->setAttribute('signature', $signature);
    }

    public function setLines(string $start, ?string $end = null): void
    {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $this->contextNode->setAttribute('start', $start);

        if ($end !== null) {
            $this->contextNode->setAttribute('end', $end);
        }
<<<<<<< HEAD

        $this->contextNode->setAttribute('crap', $crap);

=======
    }

    public function setTotals(string $executable, string $executed, string $coverage): void
    {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $this->contextNode->setAttribute('executable', $executable);
        $this->contextNode->setAttribute('executed', $executed);
        $this->contextNode->setAttribute('coverage', $coverage);
    }
<<<<<<< HEAD
=======

    public function setCrap(string $crap): void
    {
        $this->contextNode->setAttribute('crap', $crap);
    }

    private function setName(string $name): void
    {
        $this->contextNode->setAttribute('name', $name);
    }
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}
