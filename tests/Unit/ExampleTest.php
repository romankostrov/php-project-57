<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $valami = true;
        // dd($valami);
        $this->assertTrue($valami);
    }

    public function test_sajat_test(): void
    {
        $valami = 2;
        $this->assertGreaterThan(1,$valami);
    }
}
