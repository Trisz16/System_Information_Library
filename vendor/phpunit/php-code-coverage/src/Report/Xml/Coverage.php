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
<<<<<<< HEAD
=======
use SebastianBergmann\CodeCoverage\ReportAlreadyFinalizedException;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use XMLWriter;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Coverage
{
<<<<<<< HEAD
    private readonly DOMElement $contextNode;
    private readonly string $line;
=======
    private readonly XMLWriter $writer;
    private readonly DOMElement $contextNode;
    private bool $finalized = false;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    public function __construct(DOMElement $context, string $line)
    {
        $this->contextNode = $context;
<<<<<<< HEAD
        $this->line        = $line;
    }

    public function finalize(array $tests): void
    {
        $writer = new XMLWriter;
        $writer->openMemory();
        $writer->startElementNs(null, $this->contextNode->nodeName, Facade::XML_NAMESPACE);
        $writer->writeAttribute('nr', $this->line);

        foreach ($tests as $test) {
            $writer->startElement('covered');
            $writer->writeAttribute('by', $test);
            $writer->endElement();
        }
        $writer->endElement();

        $fragment = $this->contextNode->ownerDocument->createDocumentFragment();
        $fragment->appendXML($writer->outputMemory());
=======

        $this->writer = new XMLWriter;
        $this->writer->openMemory();
        $this->writer->startElementNs(null, $context->nodeName, 'https://schema.phpunit.de/coverage/1.0');
        $this->writer->writeAttribute('nr', $line);
    }

    /**
     * @throws ReportAlreadyFinalizedException
     */
    public function addTest(string $test): void
    {
        if ($this->finalized) {
            // @codeCoverageIgnoreStart
            throw new ReportAlreadyFinalizedException;
            // @codeCoverageIgnoreEnd
        }

        $this->writer->startElement('covered');
        $this->writer->writeAttribute('by', $test);
        $this->writer->endElement();
    }

    public function finalize(): void
    {
        $this->writer->endElement();

        $fragment = $this->contextNode->ownerDocument->createDocumentFragment();
        $fragment->appendXML($this->writer->outputMemory());
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        $this->contextNode->parentNode->replaceChild(
            $fragment,
            $this->contextNode,
        );
<<<<<<< HEAD
=======

        $this->finalized = true;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
