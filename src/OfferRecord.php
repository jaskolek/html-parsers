<?php
declare(strict_types=1);


namespace App;


/**
 * Base model class for parsed offer.
 *
 * Class OfferRecord
 * @package App
 */
class OfferRecord
{
    /**
     * Possible $estateType values. Feel free to add more, but remember to add them to OfferRecordBuilder::setEstateType as well
     */
    public const ESTATE_TYPE_HOUSE = 'house';
    public const ESTATE_TYPE_FLAT = 'flat';

    /**
     * Possible $marketType values. Feel free to add more, but remember to add them to OfferRecordBuilder::setMarketType as well
     */
    public const MARKET_TYPE_PRIMARY = 'primary';
    public const MARKET_TYPE_AFTERMARKET = 'aftermarket';

    /**
     * Possible $sellerType values. Feel free to add more, but remember to add them to OfferRecordBuilder::setSellerType as well
     */
    public const SELLER_TYPE_PRIVATE = 'private';
    public const SELLER_TYPE_AGENCY = 'agency';
    public const SELLER_TYPE_DEVELOPER = 'developer';

    /**
     * Unique offer id on the source website. Usually can be found in the URI
     * @var string
     */
    private $sourceOfferId;

    /**
     * URI when the offer can be found
     * @var string
     */
    private $uri;

    /**
     * Source website id. Has to be unique for each parser.
     * @var string
     */
    private $source;

    /**
     * Price in PLN. If for negotiation, set to null
     * @var float|null
     */
    private $price;

    /**
     * @var string
     */
    private $estateType;

    /**
     * @var string
     */
    private $marketType;

    /**
     * @var string
     */
    private $condition;

    /**
     * Only for investments where estate is not ready yet
     * @var int|null
     */
    private $availabilityYear;

    /**
     * Only for investments where estate is not ready yet
     * @var int|null
     */
    private $availabilityQuarter;

    /**
     * @var float|null
     */
    private $latitude;

    /**
     * @var float|null
     */
    private $longitude;

    /**
     * @var float|null
     */
    private $areaM2;

    /**
     * @var int|null
     */
    private $numberOfRooms;

    /**
     * @var string|null
     */
    private $voivodeship;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     */
    private $street;

    /**
     * @var string|null
     */
    private $zip;

    /**
     * @var string
     */
    private $sellerType;

    /**
     * @var string|null
     */
    private $district;

    /**
     * @var string|null
     */
    private $sellerName;

    /**
     * @var string|null
     */
    private $sellerPhone;

    /**
     * @var string|null
     */
    private $descriptionText;

    /**
     * @var string|null
     */
    private $descriptionHtml;
    /**
     * @var array
     */
    private $otherDetails;

    /**
     * OfferRecord constructor.
     * @param string $sourceOfferId
     * @param string $uri
     * @param string $source
     * @param float|null $price
     * @param string $estateType
     * @param string $marketType
     * @param string $condition
     * @param int|null $availabilityYear
     * @param int|null $availabilityQuarter
     * @param float|null $latitude
     * @param float|null $longitude
     * @param float|null $areaM2
     * @param int|null $numberOfRooms
     * @param string|null $voivodeship
     * @param string|null $city
     * @param string|null $street
     * @param string|null $zip
     * @param string $sellerType
     * @param string|null $district
     * @param string|null $sellerName
     * @param string|null $sellerPhone
     * @param string|null $descriptionText
     * @param string|null $descriptionHtml
     * @param array $otherDetails
     */
    public function __construct(string $sourceOfferId, string $uri, string $source, ?float $price, string $estateType, string $marketType, string $condition, ?int $availabilityYear, ?int $availabilityQuarter, ?float $latitude, ?float $longitude, ?float $areaM2, ?int $numberOfRooms, ?string $voivodeship, ?string $city, ?string $street, ?string $zip, string $sellerType, ?string $district, ?string $sellerName, ?string $sellerPhone, ?string $descriptionText, ?string $descriptionHtml, array $otherDetails)
    {
        $this->sourceOfferId = $sourceOfferId;
        $this->uri = $uri;
        $this->source = $source;
        $this->price = $price;
        $this->estateType = $estateType;
        $this->marketType = $marketType;
        $this->condition = $condition;
        $this->availabilityYear = $availabilityYear;
        $this->availabilityQuarter = $availabilityQuarter;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->areaM2 = $areaM2;
        $this->numberOfRooms = $numberOfRooms;
        $this->voivodeship = $voivodeship;
        $this->city = $city;
        $this->street = $street;
        $this->zip = $zip;
        $this->sellerType = $sellerType;
        $this->district = $district;
        $this->sellerName = $sellerName;
        $this->sellerPhone = $sellerPhone;
        $this->descriptionText = $descriptionText;
        $this->descriptionHtml = $descriptionHtml;
        $this->otherDetails = $otherDetails;
    }

    /**
     * @return string
     */
    public function getSourceOfferId(): string
    {
        return $this->sourceOfferId;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getEstateType(): string
    {
        return $this->estateType;
    }

    /**
     * @return string
     */
    public function getMarketType(): string
    {
        return $this->marketType;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return int|null
     */
    public function getAvailabilityYear(): ?int
    {
        return $this->availabilityYear;
    }

    /**
     * @return int|null
     */
    public function getAvailabilityQuarter(): ?int
    {
        return $this->availabilityQuarter;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @return float|null
     */
    public function getAreaM2(): ?float
    {
        return $this->areaM2;
    }

    /**
     * @return int|null
     */
    public function getNumberOfRooms(): ?int
    {
        return $this->numberOfRooms;
    }

    /**
     * @return string|null
     */
    public function getVoivodeship(): ?string
    {
        return $this->voivodeship;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getSellerType(): string
    {
        return $this->sellerType;
    }

    /**
     * @return array
     */
    public function getOtherDetails(): array
    {
        return $this->otherDetails;
    }

    /**
     * @return string|null
     */
    public function getSellerName(): ?string
    {
        return $this->sellerName;
    }

    /**
     * @return string|null
     */
    public function getSellerPhone(): ?string
    {
        return $this->sellerPhone;
    }


    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @return string|null
     */
    public function getDescriptionText(): ?string
    {
        return $this->descriptionText;
    }

    /**
     * @return string|null
     */
    public function getDescriptionHtml(): ?string
    {
        return $this->descriptionHtml;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}