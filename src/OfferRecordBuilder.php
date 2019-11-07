<?php
declare(strict_types=1);


namespace App;


use InvalidArgumentException;

/**
 * Builder class for OfferRecord. Use it for creating OfferRecord instead of calling new OfferRecord() directly
 *
 * Class OfferRecordBuilder
 * @package App
 */
class OfferRecordBuilder
{
    /**
     * @var string
     */
    private $sourceOfferId;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $source;

    /**
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
     * @var int|null
     */
    private $availabilityYear;

    /**
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
    private $otherDetails = [];

    /**
     * @param string $sourceOfferId
     * @return OfferRecordBuilder
     */
    public function setSourceOfferId(string $sourceOfferId): OfferRecordBuilder
    {
        $this->sourceOfferId = $sourceOfferId;
        return $this;
    }

    /**
     * @param string $uri
     * @return OfferRecordBuilder
     */
    public function setUri(string $uri): OfferRecordBuilder
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param string $source
     * @return OfferRecordBuilder
     */
    public function setSource(string $source): OfferRecordBuilder
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param float|null $price
     * @return OfferRecordBuilder
     */
    public function setPrice(?float $price): OfferRecordBuilder
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param int|null $availabilityYear
     * @return OfferRecordBuilder
     */
    public function setAvailabilityYear(?int $availabilityYear): OfferRecordBuilder
    {
        $this->availabilityYear = $availabilityYear;
        return $this;
    }

    /**
     * @param int|null $availabilityQuarter
     * @return OfferRecordBuilder
     */
    public function setAvailabilityQuarter(?int $availabilityQuarter): OfferRecordBuilder
    {
        $this->availabilityQuarter = $availabilityQuarter;
        return $this;
    }

    /**
     * @param float|null $latitude
     * @return OfferRecordBuilder
     */
    public function setLatitude(?float $latitude): OfferRecordBuilder
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @param float|null $longitude
     * @return OfferRecordBuilder
     */
    public function setLongitude(?float $longitude): OfferRecordBuilder
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @param float|null $areaM2
     * @return OfferRecordBuilder
     */
    public function setAreaM2(?float $areaM2): OfferRecordBuilder
    {
        $this->areaM2 = $areaM2;
        return $this;
    }

    /**
     * @param int|null $numberOfRooms
     * @return OfferRecordBuilder
     */
    public function setNumberOfRooms(?int $numberOfRooms): OfferRecordBuilder
    {
        $this->numberOfRooms = $numberOfRooms;
        return $this;
    }

    /**
     * @param string|null $voivodeship
     * @return OfferRecordBuilder
     */
    public function setVoivodeship(?string $voivodeship): OfferRecordBuilder
    {
        $this->voivodeship = $voivodeship;
        return $this;
    }

    /**
     * @param string|null $city
     * @return OfferRecordBuilder
     */
    public function setCity(?string $city): OfferRecordBuilder
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string|null $street
     * @return OfferRecordBuilder
     */
    public function setStreet(?string $street): OfferRecordBuilder
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param string|null $zip
     * @return OfferRecordBuilder
     */
    public function setZip(?string $zip): OfferRecordBuilder
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @param string|null $district
     * @return OfferRecordBuilder
     */
    public function setDistrict(?string $district): OfferRecordBuilder
    {
        $this->district = $district;
        return $this;
    }


    /**
     * @param string $sellerType
     * @return OfferRecordBuilder
     */
    public function setSellerType(string $sellerType): OfferRecordBuilder
    {
        if (!in_array($sellerType, [
            OfferRecord::SELLER_TYPE_DEVELOPER,
            OfferRecord::SELLER_TYPE_AGENCY,
            OfferRecord::SELLER_TYPE_PRIVATE
        ], true)) {
            throw new InvalidArgumentException("$sellerType is not valid value for sellerType");
        }

        $this->sellerType = $sellerType;
        return $this;
    }


    /**
     * @param string $estateType
     * @return OfferRecordBuilder
     */
    public function setEstateType(string $estateType): OfferRecordBuilder
    {
        if (!in_array($estateType, [
            OfferRecord::ESTATE_TYPE_FLAT,
            OfferRecord::ESTATE_TYPE_HOUSE
        ], true)) {
            throw new InvalidArgumentException("$estateType is not valid value for estate type");
        }

        $this->estateType = $estateType;
        return $this;
    }

    /**
     * @param string $marketType
     * @return OfferRecordBuilder
     */
    public function setMarketType(string $marketType): OfferRecordBuilder
    {
        if (!in_array($marketType, [
            OfferRecord::MARKET_TYPE_AFTERMARKET,
            OfferRecord::MARKET_TYPE_PRIMARY
        ], true)) {
            throw new InvalidArgumentException("$marketType is not valid value for market type");
        }
        $this->marketType = $marketType;
        return $this;
    }


    /**
     * @param array $otherDetails
     * @return OfferRecordBuilder
     */
    public function setOtherDetails(array $otherDetails): OfferRecordBuilder
    {
        $this->otherDetails = $otherDetails;
        return $this;
    }

    /**
     * @param string|null $sellerName
     * @return OfferRecordBuilder
     */
    public function setSellerName(?string $sellerName): OfferRecordBuilder
    {
        $this->sellerName = $sellerName;
        return $this;
    }

    /**
     * @param string|null $sellerPhone
     * @return OfferRecordBuilder
     */
    public function setSellerPhone(?string $sellerPhone): OfferRecordBuilder
    {
        if (!preg_match('@^\d+$@', $sellerPhone)) {
            throw new InvalidArgumentException("\"$sellerPhone\" is not valid phone. Seller phone should contain only digits.");
        }

        $this->sellerPhone = $sellerPhone;
        return $this;
    }

    /**
     * @param string|null $descriptionText
     * @return OfferRecordBuilder
     */
    public function setDescriptionText(?string $descriptionText): OfferRecordBuilder
    {
        $this->descriptionText = $descriptionText;
        return $this;
    }

    /**
     * @param string|null $descriptionHtml
     * @return OfferRecordBuilder
     */
    public function setDescriptionHtml(?string $descriptionHtml): OfferRecordBuilder
    {
        $this->descriptionHtml = $descriptionHtml;
        return $this;
    }


    /**
     * @param string $condition
     * @return OfferRecordBuilder
     */
    public function setCondition(string $condition): OfferRecordBuilder
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return OfferRecord
     */
    public function build(): OfferRecord
    {
        if ($this->sourceOfferId === null) {
            throw new InvalidArgumentException('$sourceOfferId can not be null!');
        }
        if ($this->uri === null) {
            throw new InvalidArgumentException('$uri can not be null!');
        }
        if ($this->source === null) {
            throw new InvalidArgumentException('$source can not be null!');
        }
        if ($this->estateType === null) {
            throw new InvalidArgumentException('$estateType can not be null!');
        }
        if ($this->marketType === null) {
            throw new InvalidArgumentException('$marketType can not be null!');
        }
        if ($this->condition === null) {
            throw new InvalidArgumentException('$condition can not be null!');
        }
        if ($this->sellerType === null) {
            throw new InvalidArgumentException('$sellerType can not be null!');
        }

        return new OfferRecord(
            $this->sourceOfferId,
            $this->uri,
            $this->source,
            $this->price,
            $this->estateType,
            $this->marketType,
            $this->condition,
            $this->availabilityYear,
            $this->availabilityQuarter,
            $this->latitude,
            $this->longitude,
            $this->areaM2,
            $this->numberOfRooms,
            $this->voivodeship,
            $this->city,
            $this->street,
            $this->zip,
            $this->sellerType,
            $this->district,
            $this->sellerName,
            $this->sellerPhone,
            $this->descriptionText,
            $this->descriptionHtml,
            $this->otherDetails
        );


    }

}