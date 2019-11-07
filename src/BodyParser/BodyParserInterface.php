<?php
declare(strict_types=1);


namespace App\BodyParser;


use App\OfferRecord;

/**
 * Interface BodyParserInterface
 * Base interface for all the parsers.
 * @package App\BodyParser
 */
interface BodyParserInterface
{
    /**
     * Method that parses the $body and returns the OfferRecord as the result
     * $uri parameter is added to help handling relative paths
     *
     * @param string $body
     * @param string $uri
     * @return OfferRecord
     */
    public function parse(string $body, string $uri): OfferRecord;
}