<?php

namespace Danke\Customer\Api\Data;


interface CustomerAddressExtensionAttributeInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    const ID            = 'entity_id';
    const TYPE          = 'type';
    const ADDRESS_ID    = 'address_id';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $value
     * @return int
     */
    public function setId($value);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $value
     * @return self
     */
    public function setType($value);

    /**
     * @return int
     */
    public function getAddressId();

    /**
     * @param int $value
     * @return int
     */
    public function setAddressId($value);
}
