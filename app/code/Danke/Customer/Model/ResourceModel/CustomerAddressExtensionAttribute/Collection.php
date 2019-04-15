<?php

namespace Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Danke\Customer\Model\CustomerAddressExtensionAttribute as Model;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute as Resource;
/**
 * @codeCoverageIgnore
 * @SuppressWarnings(PHPMD)
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(
            Model::class,
            Resource::class
        );
    }
}