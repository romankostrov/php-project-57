<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     */
    public function testThatTrueIsTrue(): void
    {
        $valami = true;
        // dd($valami);
        $this->assertTrue($valami);
    }

    public function testSajatTest(): void
    {
        $valami = 2;
        $this->assertGreaterThan(1,$valami);
    }
}
