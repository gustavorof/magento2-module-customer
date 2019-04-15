<?php

namespace Danke\Customer\Model;


use Magento\Framework\Model\AbstractExtensibleModel;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterface;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute as ResourceModel;

/**
 * @codeCoverageIgnore
 * @SuppressWarnings(PHPMD)
 */
class CustomerAddressExtensionAttribute extends AbstractExtensibleModel implements CustomerAddressExtensionAttributeInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getType()
    {
        return $this->getData(static::TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setType($value)
    {
        $this->setData(static::TYPE, $value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(static::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($value)
    {
        $this->setData(static::ID, $value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAddressId()
    {
        return $this->getData(static::ADDRESS_ID);
    }

    /**
     * @inheritDoc
     */
    public function setAddressId($value)
    {
        $this->setData(static::ADDRESS_ID, $value);
        return $this;
    }

}
