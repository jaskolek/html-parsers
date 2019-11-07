<?php
declare(strict_types=1);


namespace App\NieruchomosciOnlinePl;


use App\BodyParserTest\AbstractBodyParserTest;
use App\OfferRecord;
use App\OfferRecordBuilder;

/**
 * Class NieruchomosciOnlinePlParserTest
 * @package App\NieruchomosciOnlinePl
 */
class NieruchomosciOnlinePlParserTest extends AbstractBodyParserTest
{
    /**
     * @var NieruchomosciOnlinePlParser
     */
    private $parser;

    /**
     * NieruchomosciOnlinePlParserTest constructor.
     * @param NieruchomosciOnlinePlParser $parser
     */
    public function __construct(NieruchomosciOnlinePlParser $parser)
    {
        $this->parser = $parser;
    }

    public function testParser(): void
    {
        $uri = 'https://www.nieruchomosci-online.pl/mieszkanie,z-kuchnia-z-oknem/21438481.html?i';
        $path = __DIR__ . '/../../resources/tests/nieruchomosci_online_pl/21438481.html';
        $parsedOfferRecord = $this->parser->parse(file_get_contents($path), $uri);
        $expectedOfferRecord = (new OfferRecordBuilder())
            ->setSellerType(OfferRecord::SELLER_TYPE_AGENCY)
            ->setCondition('do odświeżenia')
            ->setMarketType(OfferRecord::MARKET_TYPE_AFTERMARKET)
            ->setEstateType(OfferRecord::ESTATE_TYPE_FLAT)
            ->setAreaM2(154.6)
            ->setPrice(2450000.)
            ->setNumberOfRooms(6)
            ->setVoivodeship('mazowieckie')
            ->setCity('Warszawa')
            ->setDistrict('Sielce')
            ->setStreet('Podchorążych')
            ->setUri($uri)
            ->setSourceOfferId('21438481')
            ->setLongitude(52.2084886)
            ->setLatitude(21.0449823)
            ->setSource('nieruchomosci_online_pl')
            ->setSellerName('Izabela Surosz-Wróblewska')
            ->setSellerPhone('507056589')
            ->setDescriptionText(null)
            ->setDescriptionHtml(null)
            ->setOtherDetails([
                'images' => [
                    'https://i.st-nieruchomosci-online.pl/gw45yyx/mieszkanie-apartamentowiec-sprzedaz.jpg',
                    'https://i.st-nieruchomosci-online.pl/gw45ykx/mieszkanie-warszawa.jpg'
                ],
                'imagesCount' => 14,
                'attributes' => [
                    'Piętro' => '4/6',
                    'Stan mieszkania' => 'do odświeżenia'
                ],
                'details' => [
                    'Typ oferty' => 'mieszkanie na sprzedaż',
                    'Łazienka' => 'oddzielne WC'
                ],
                'localization' => [
                    'Adres' => 'Podchorążych, Sielce, Warszawa, mazowieckie',
                    'Otoczenie' => 'gęsta zabudowa miejska'
                ]
            ])
            ->build();
        $this->assertOfferRecordsEqual($parsedOfferRecord, $expectedOfferRecord);
    }


}