<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Truncater;

class TruncaterTest extends TestCase
{
    public function testTruncate(): void
    {
        $title = 'Биушкин Денис Витальевич';

        $truncater1 = new Truncater();

        $this->assertSame($title, $truncater1->truncate($title));

        $expected = "Биушкин Денис...";
        $this->assertSame($expected, $truncater1->truncate($title, ['length' => 13]));

        $this->assertSame($title, $truncater1->truncate($title));

        $expected = "Биушкин Денис***";
        $this->assertSame($expected, $truncater1->truncate($title, ['length' => 13, 'separator' => '***']));

        $expected = "Биушкин Денис...";
        $this->assertSame($expected, $truncater1->truncate($title, ['length' => -11]));

        $truncater2 = new Truncater(['length' => 13, 'separator' => '!!!']);

        $expected = "Биушкин Денис!!!";
        $this->assertSame($expected, $truncater2->truncate($title));
    }
}
