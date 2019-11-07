<?php
declare(strict_types=1);

use App\BodyParserTest\BodyParserTestInterface;
use App\NieruchomosciOnlinePl\NieruchomosciOnlinePlParser;
use App\NieruchomosciOnlinePl\NieruchomosciOnlinePlParserTest;

require_once __DIR__ . '/../vendor/autoload.php';

/** @var BodyParserTestInterface[] $tests */
$tests = [
    new NieruchomosciOnlinePlParserTest(new NieruchomosciOnlinePlParser())
];

foreach ($tests as $test) {
    $test->testParser();
}