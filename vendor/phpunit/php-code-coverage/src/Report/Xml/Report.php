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
use function basename;
use function dirname;
use DOMDocument;
use DOMElement;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Report extends File
{
<<<<<<< HEAD
    private readonly string $name;
    private readonly string $sha1;

    public function __construct(string $name, string $sha1)
=======
    public function __construct(string $name)
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $dom = new DOMDocument;
        $dom->loadXML('<?xml version="1.0" ?><phpunit xmlns="https://schema.phpunit.de/coverage/1.0"><file /></phpunit>');

        $contextNode = $dom->getElementsByTagNameNS(
<<<<<<< HEAD
            Facade::XML_NAMESPACE,
=======
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            'file',
        )->item(0);

        parent::__construct($contextNode);

<<<<<<< HEAD
        $this->name = $name;
        $this->sha1 = $sha1;
=======
        $this->setName($name);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public function asDom(): DOMDocument
    {
<<<<<<< HEAD
        $this->contextNode()->setAttribute('name', basename($this->name));
        $this->contextNode()->setAttribute('path', dirname($this->name));
        $this->contextNode()->setAttribute('hash', $this->sha1);

        return $this->dom;
    }

    public function functionObject(
        string $name,
        string $signature,
        string $start,
        ?string $end,
        string $executable,
        string $executed,
        string $coverage,
        string $crap
    ): void {
        $node = $this->contextNode()->appendChild(
            $this->dom->createElementNS(
                Facade::XML_NAMESPACE,
=======
        return $this->dom();
    }

    public function functionObject(string $name): Method
    {
        $node = $this->contextNode()->appendChild(
            $this->dom()->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                'function',
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
    }

    public function classObject(
        string $name,
        string $namespace,
        int $start,
        int $executable,
        int $executed,
        float $crap
    ): Unit {
        $node = $this->contextNode()->appendChild(
            $this->dom->createElementNS(
                Facade::XML_NAMESPACE,
                'class',
            ),
        );

        assert($node instanceof DOMElement);

        return new Unit($node, $name, $namespace, $start, $executable, $executed, $crap);
    }

    public function traitObject(
        string $name,
        string $namespace,
        int $start,
        int $executable,
        int $executed,
        float $crap
    ): Unit {
        $node = $this->contextNode()->appendChild(
            $this->dom->createElementNS(
                Facade::XML_NAMESPACE,
                'trait',
            ),
        );

        assert($node instanceof DOMElement);

        return new Unit($node, $name, $namespace, $start, $executable, $executed, $crap);
=======
        return new Method($node, $name);
    }

    public function classObject(string $name): Unit
    {
        return $this->unitObject('class', $name);
    }

    public function traitObject(string $name): Unit
    {
        return $this->unitObject('trait', $name);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public function source(): Source
    {
<<<<<<< HEAD
        $source = $this->contextNode()->appendChild(
            $this->dom->createElementNS(
                Facade::XML_NAMESPACE,
                'source',
            ),
        );
=======
        $source = $this->contextNode()->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            'source',
        )->item(0);

        if ($source === null) {
            $source = $this->contextNode()->appendChild(
                $this->dom()->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
                    'source',
                ),
            );
        }
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        assert($source instanceof DOMElement);

        return new Source($source);
    }
<<<<<<< HEAD
=======

    private function setName(string $name): void
    {
        $this->contextNode()->setAttribute('name', basename($name));
        $this->contextNode()->setAttribute('path', dirname($name));
    }

    private function unitObject(string $tagName, string $name): Unit
    {
        $node = $this->contextNode()->appendChild(
            $this->dom()->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
                $tagName,
            ),
        );

        assert($node instanceof DOMElement);

        return new Unit($node, $name);
    }
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}
