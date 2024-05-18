<?php
    use PHPUnit\Framework\TestCase;
    use App\Model\Message;

    final class ExceptionTest extends TestCase
    {
        public function testSame(): void
        {
            $this->assertSame(2, 2);
        }

        public function testCreateToken()
        {
            $token = \App\Service\CsrfTokenService::create_new_token();
            $this->assertIsString($token);
        }
    }
