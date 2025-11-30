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

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
abstract class Node
{
<<<<<<< HEAD
    protected readonly DOMDocument $dom;
    private readonly DOMElement $contextNode;

    public function __construct(DOMElement $context)
    {
        $this->dom         = $context->ownerDocument;
        $this->contextNode = $context;
=======
    private DOMDocument $dom;
    private DOMElement $contextNode;

    public function __construct(DOMElement $context)
    {
        $this->setContextNode($context);
    }

    public function dom(): DOMDocument
    {
        return $this->dom;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public function totals(): Totals
    {
        $totalsContainer = $this->contextNode()->firstChild;

        if ($totalsContainer === null) {
            $totalsContainer = $this->contextNode()->appendChild(
                $this->dom->createElementNS(
<<<<<<< HEAD
                    Facade::XML_NAMESPACE,
=======
                    'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                    'totals',
                ),
            );
        }

        assert($totalsContainer instanceof DOMElement);

        return new Totals($totalsContainer);
    }

    public function addDirectory(string $name): Directory
    {
<<<<<<< HEAD
        $dirNode = $this->dom->createElementNS(
            Facade::XML_NAMESPACE,
=======
        $dirNode = $this->dom()->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            'directory',
        );

        $dirNode->setAttribute('name', $name);
        $this->contextNode()->appendChild($dirNode);

        return new Directory($dirNode);
    }

<<<<<<< HEAD
    public function addFile(string $name, string $href, string $hash): File
    {
        $fileNode = $this->dom->createElementNS(
            Facade::XML_NAMESPACE,
=======
    public function addFile(string $name, string $href): File
    {
        $fileNode = $this->dom()->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            'file',
        );

        $fileNode->setAttribute('name', $name);
        $fileNode->setAttribute('href', $href);
<<<<<<< HEAD
        $fileNode->setAttribute('hash', $hash);
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $this->contextNode()->appendChild($fileNode);

        return new File($fileNode);
    }

<<<<<<< HEAD
=======
    protected function setContextNode(DOMElement $context): void
    {
        $this->dom         = $context->ownerDocument;
        $this->contextNode = $context;
    }

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    protected function contextNode(): DOMElement
    {
        return $this->contextNode;
    }
}
