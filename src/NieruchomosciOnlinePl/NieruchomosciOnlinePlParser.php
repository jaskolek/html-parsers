<?php
declare(strict_types=1);


namespace App\NieruchomosciOnlinePl;


use App\BodyParser\BodyParserInterface;
use App\OfferRecord;
use App\OfferRecordBuilder;
use InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class NieruchomosciOnlinePlParser
 * @package App\NieruchomosciOnlinePl
 */
class NieruchomosciOnlinePlParser implements BodyParserInterface
{
    public const SOURCE = 'nieruchomosci_online_pl';

    /**
     * Method that parses the $body and returns the OfferRecord as the result
     * $uri parameter is added to help handling relative paths
     *
     * @param string $body
     * @param string $uri
     * @return OfferRecord
     */
    public function parse(string $body, string $uri): OfferRecord
    {
        $crawler = new Crawler($body, $uri);

        $offerRecordBuilder = new OfferRecordBuilder();
        $offerRecordBuilder->setUri($uri);
        $offerRecordBuilder->setSource(self::SOURCE);
        $offerRecordBuilder->setSourceOfferId(
            $crawler->filter('[name="idData"]')->attr('value')
        );

        $details = [];
        $crawler->filter('#detailsTable ul li')->each(static function (Crawler $crawler) use (&$details) {
            $key = trim($crawler->filter('strong')->text(), ': ');
            $value = trim($crawler->filter('span')->text());

            $details[$key] = $value;
        });

        $attributes = [];
        $crawler->filter('#attributesTable td')->each(static function (Crawler $crawler) use (&$attributes) {
            $key = trim($crawler->filter('.fheader')->text(), ': ');
            $value = trim($crawler->filter('span')->last()->text());

            $attributes[$key] = $value;
        });

        $offerRecordBuilder->setEstateType($this->getEstateType($details['Typ oferty']));
        $offerRecordBuilder->setMarketType($this->getMarketType($details['Rynek']));
        $offerRecordBuilder->setCondition($attributes['Stan mieszkania']);

        $offerRecordBuilder->setSellerType($this->getSellerType($body));
        $images = $this->getImages($body);
        $offerRecordBuilder->setOtherDetails([
            'images' => $images,
            'imagesCount' => count($images),
            'details' => $details,
            'attributes' => $attributes,
            'localization' => []
        ]);

        return $offerRecordBuilder->build();
    }

    /**
     * @param string $estateTypeString
     * @return string
     */
    private function getEstateType(string $estateTypeString): string
    {
        $estateTypeMap = [
            'mieszkanie na sprzedaż' => OfferRecord::ESTATE_TYPE_FLAT,
            'dom na sprzedaż' => OfferRecord::ESTATE_TYPE_HOUSE
        ];

        if (!isset($estateTypeMap[$estateTypeString])) {
            throw new InvalidArgumentException('Can not map estate type from string "' . $estateTypeString . '"');
        }

        return $estateTypeMap[$estateTypeString];
    }

    /**
     * @param string $marketTypeString
     * @return string
     */
    private function getMarketType(string $marketTypeString): string
    {
        $marketTypeMap = [
            'wtórny' => OfferRecord::MARKET_TYPE_AFTERMARKET,
            'pierwotny' => OfferRecord::MARKET_TYPE_PRIMARY
        ];

        if (!isset($marketTypeMap[$marketTypeString])) {
            throw new InvalidArgumentException('Can not map estate type from string "' . $marketTypeString . '"');
        }

        return $marketTypeMap[$marketTypeString];
    }

    /**
     * @param string $body
     * @return string
     */
    private function getSellerType(string $body): string
    {
        preg_match('@isPrivate: \'(\d)\'@', $body, $matches);
        $isPrivate = $matches[1] === '1';

        return $isPrivate ? OfferRecord::SELLER_TYPE_PRIVATE : OfferRecord::SELLER_TYPE_AGENCY;
    }

    /**
     * @param string $body
     * @return array
     */
    private function getImages(string $body): array
    {
        preg_match('@photos: ({.*?}),$@m', $body, $matches);
        $photosVar = json_decode($matches[1], true);

        return $photosVar['x'];
    }
}