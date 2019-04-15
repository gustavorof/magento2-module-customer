<?php

namespace Danke\Customer\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterface;

class CustomerAddressExtensionAttribute extends AbstractDb
{
    const SCHEMA_NAME = 'danke_customer_address_extension_attribute';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(static::SCHEMA_NAME, CustomerAddressExtensionAttributeInterface::ID);
    }
}
