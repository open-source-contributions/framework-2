<?php

declare(strict_types=1);

/**
 * PHP Deal framework
 *
 * @copyright Copyright 2019, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpDeal\Functional\Ensure;

use PhpDeal\Exception\ContractViolation;
use PHPUnit\Framework\TestCase;

class ContractTest extends TestCase
{
    /**
     * @var Stub
     */
    private $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = new Stub();
    }

    public function tearDown()
    {
        unset($this->stub);
        parent::tearDown();
    }

    public function testEnsureValid(): void
    {
        $this->expectNotToPerformAssertions();
        $this->stub->increment(50);
    }

    public function testEnsureManyContractsInvalid(): void
    {
        $this->expectException(ContractViolation::class);
        $this->stub->increment(-50);
    }

    public function testEnsureInvalid(): void
    {
        $this->expectException(ContractViolation::class);
        $this->stub->badIncrement(40);
    }

    public function testEnsureCanHandleResult(): void
    {
        $this->expectNotToPerformAssertions();
        $this->stub->returnPrivateValue();
    }
}
