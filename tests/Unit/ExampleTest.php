<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testSajatTest(): void
    {
        $valami = 2;
        $this->assertGreaterThan(1, $valami);
    }
}
