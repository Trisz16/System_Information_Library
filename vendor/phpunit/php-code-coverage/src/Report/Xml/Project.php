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
use DateTimeImmutable;
use DOMDocument;
use DOMElement;
use SebastianBergmann\Environment\Runtime;
=======
use DOMDocument;
use DOMElement;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Project extends Node
{
<<<<<<< HEAD
    private readonly string $directory;

    public function __construct(string $directory)
    {
        $dom = new DOMDocument;
        $dom->loadXML('<?xml version="1.0" ?><phpunit xmlns="https://schema.phpunit.de/coverage/1.0"><build/><project/></phpunit>');

        parent::__construct(
            $dom->getElementsByTagNameNS(
                Facade::XML_NAMESPACE,
                'project',
            )->item(0),
        );

        $this->directory = $directory;
=======
    /**
     * @phpstan-ignore constructor.missingParentCall
     */
    public function __construct(string $directory)
    {
        $this->init();
        $this->setProjectSourceDirectory($directory);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public function projectSourceDirectory(): string
    {
<<<<<<< HEAD
        return $this->directory;
    }

    public function buildInformation(
        Runtime $runtime,
        DateTimeImmutable $buildDate,
        string $phpUnitVersion,
        string $coverageVersion
    ): void {
        $buildNode = $this->dom->getElementsByTagNameNS(
            Facade::XML_NAMESPACE,
            'build',
        )->item(0);

        assert($buildNode instanceof DOMElement);

        new BuildInformation(
            $buildNode,
            $runtime,
            $buildDate,
            $phpUnitVersion,
            $coverageVersion,
        );
=======
        return $this->contextNode()->getAttribute('source');
    }

    public function buildInformation(): BuildInformation
    {
        $buildNode = $this->dom()->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            'build',
        )->item(0);

        if ($buildNode === null) {
            $buildNode = $this->dom()->documentElement->appendChild(
                $this->dom()->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
                    'build',
                ),
            );
        }

        assert($buildNode instanceof DOMElement);

        return new BuildInformation($buildNode);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public function tests(): Tests
    {
<<<<<<< HEAD
        $testsNode = $this->contextNode()->appendChild(
            $this->dom->createElementNS(
                Facade::XML_NAMESPACE,
                'tests',
            ),
        );
=======
        $testsNode = $this->contextNode()->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            'tests',
        )->item(0);

        if ($testsNode === null) {
            $testsNode = $this->contextNode()->appendChild(
                $this->dom()->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
                    'tests',
                ),
            );
        }
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        assert($testsNode instanceof DOMElement);

        return new Tests($testsNode);
    }

    public function asDom(): DOMDocument
    {
<<<<<<< HEAD
        $this->contextNode()->setAttribute('source', $this->directory);

        return $this->dom;
=======
        return $this->dom();
    }

    private function init(): void
    {
        $dom = new DOMDocument;
        $dom->loadXML('<?xml version="1.0" ?><phpunit xmlns="https://schema.phpunit.de/coverage/1.0"><build/><project/></phpunit>');

        $this->setContextNode(
            $dom->getElementsByTagNameNS(
                'https://schema.phpunit.de/coverage/1.0',
                'project',
            )->item(0),
        );
    }

    private function setProjectSourceDirectory(string $name): void
    {
        $this->contextNode()->setAttribute('source', $name);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
