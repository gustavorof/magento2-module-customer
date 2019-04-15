<?php

namespace Danke\Customer\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Danke\Customer\Api\ExtensionRepositoryInterface;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute\CollectionFactory;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute\Collection;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterface;

class AddressExtensionAttributeRepository implements ExtensionRepositoryInterface
{
    protected $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->setCollectionFactory($collectionFactory);
    }
    /**
     * @inheritDoc
     */
    public function getByParentId($parentId)
    {
        /** @var Collection $collection */
        $collection = $this->getCollectionFactory()->create();
        $collection
            ->addFieldToFilter(CustomerAddressExtensionAttributeInterface::ADDRESS_ID, [
                'eq' => $parentId
            ])
            ->setPageSize(1);
        return $collection->getFirstItem(); // @codingStandardsIgnoreLine
    }
    /**
     * @inheritDoc
     * @return AbstractExtensibleModel
     */
    public function save(AbstractExtensibleModel $model)
    {
        $model->save();
        return $model;
    }
    /**
     * @return CollectionFactory
     */
    protected function getCollectionFactory()
    {
        return $this->collectionFactory;
    }
    /**
     * @param CollectionFactory $collectionFactory
     * @return $this
     */
    protected function setCollectionFactory(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        return $this;
    }
}