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
use function phpversion;
use DateTimeImmutable;
use DOMElement;
use SebastianBergmann\Environment\Runtime;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final readonly class BuildInformation
{
    private DOMElement $contextNode;

<<<<<<< HEAD
    public function __construct(
        DOMElement $contextNode,
        Runtime $runtime,
        DateTimeImmutable $buildDate,
        string $phpUnitVersion,
        string $coverageVersion
    ) {
        $this->contextNode = $contextNode;

=======
    public function __construct(DOMElement $contextNode)
    {
        $this->contextNode = $contextNode;
    }

    public function setRuntimeInformation(Runtime $runtime): void
    {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $runtimeNode = $this->nodeByName('runtime');

        $runtimeNode->setAttribute('name', $runtime->getName());
        $runtimeNode->setAttribute('version', $runtime->getVersion());
        $runtimeNode->setAttribute('url', $runtime->getVendorUrl());

        $driverNode = $this->nodeByName('driver');

        if ($runtime->hasXdebug()) {
            $driverNode->setAttribute('name', 'xdebug');
            $driverNode->setAttribute('version', phpversion('xdebug'));
        }

        if ($runtime->hasPCOV()) {
            $driverNode->setAttribute('name', 'pcov');
            $driverNode->setAttribute('version', phpversion('pcov'));
        }
<<<<<<< HEAD

        $this->contextNode->setAttribute('time', $buildDate->format('D M j G:i:s T Y'));

=======
    }

    public function setBuildTime(DateTimeImmutable $date): void
    {
        $this->contextNode->setAttribute('time', $date->format('D M j G:i:s T Y'));
    }

    public function setGeneratorVersions(string $phpUnitVersion, string $coverageVersion): void
    {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $this->contextNode->setAttribute('phpunit', $phpUnitVersion);
        $this->contextNode->setAttribute('coverage', $coverageVersion);
    }

    private function nodeByName(string $name): DOMElement
    {
<<<<<<< HEAD
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                Facade::XML_NAMESPACE,
                $name,
            ),
        );
=======
        $node = $this->contextNode->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            $name,
        )->item(0);

        if ($node === null) {
            $node = $this->contextNode->appendChild(
                $this->contextNode->ownerDocument->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
                    $name,
                ),
            );
        }
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        assert($node instanceof DOMElement);

        return $node;
    }
}
