<?php
declare(strict_types=1);


namespace App\BodyParserTest;


/**
 * Base interface for all the tests
 * Interface BodyParserTestInterface
 * @package App\BodyParserTest
 */
interface BodyParserTestInterface
{
    /**
     * Method that tests the parser. It does not return any value, instead it should echo all the info directly to the output
     */
    public function testParser(): void;
}