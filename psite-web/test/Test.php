<?php

use PHPUnit\Framework\TestCase;

final class ExceptionTest extends TestCase
{
    public function testSame(): void
    {
        $this->assertSame(2, 2);
    }
}