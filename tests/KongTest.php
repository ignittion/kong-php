<?php

namespace Tests;

use Ignittion\Kong\Exceptions\InvalidUrlException;
use Ignittion\Kong\Kong;

class KongTest extends AbstractTestCase
{
    public function testThrowsException()
    {
        $this->setExpectedException(InvalidUrlException::class);
        new Kong('not-a-valid-url');
    }
}
