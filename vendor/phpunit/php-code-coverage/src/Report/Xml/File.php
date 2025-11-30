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
use DOMDocument;
use DOMElement;
<<<<<<< HEAD
use DOMNode;
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
class File
{
<<<<<<< HEAD
    protected readonly DOMDocument $dom;
    private readonly DOMElement $contextNode;
    private ?DOMNode $lineCoverage = null;
=======
    private readonly DOMDocument $dom;
    private readonly DOMElement $contextNode;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    public function __construct(DOMElement $context)
    {
        $this->dom         = $context->ownerDocument;
        $this->contextNode = $context;
    }

    public function totals(): Totals
    {
<<<<<<< HEAD
        $totalsContainer = $this->contextNode->appendChild(
            $this->dom->createElementNS(
                Facade::XML_NAMESPACE,
                'totals',
            ),
        );
=======
        $totalsContainer = $this->contextNode->firstChild;

        if ($totalsContainer === null) {
            $totalsContainer = $this->contextNode->appendChild(
                $this->dom->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
                    'totals',
                ),
            );
        }
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        assert($totalsContainer instanceof DOMElement);

        return new Totals($totalsContainer);
    }

    public function lineCoverage(string $line): Coverage
    {
<<<<<<< HEAD
        if ($this->lineCoverage === null) {
            $this->lineCoverage = $this->contextNode->appendChild(
                $this->dom->createElementNS(
                    Facade::XML_NAMESPACE,
=======
        $coverage = $this->contextNode->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            'coverage',
        )->item(0);

        if ($coverage === null) {
            $coverage = $this->contextNode->appendChild(
                $this->dom->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                    'coverage',
                ),
            );
        }
<<<<<<< HEAD
        assert($this->lineCoverage instanceof DOMElement);

        $lineNode = $this->lineCoverage->appendChild(
            $this->dom->createElementNS(
                Facade::XML_NAMESPACE,
=======

        $lineNode = $coverage->appendChild(
            $this->dom->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                'line',
            ),
        );

        assert($lineNode instanceof DOMElement);

        return new Coverage($lineNode, $line);
    }

    protected function contextNode(): DOMElement
    {
        return $this->contextNode;
    }
<<<<<<< HEAD
=======

    protected function dom(): DOMDocument
    {
        return $this->dom;
    }
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}
