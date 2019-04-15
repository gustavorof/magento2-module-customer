<?php

namespace Danke\Customer\Plugin\Address;

use Magento\Customer\Model\Data\Address;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterfaceFactory;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterface;
use Danke\Customer\Api\ExtensionRepositoryInterface;


class CustomerAddressAttributes
{
    /**
     * @var ExtensionRepositoryInterface
     */
    protected $extensionRepository;

    /**
     * @var CustomerAddressExtensionAttributeInterfaceFactory
     */
    protected $extensionFactory;
    /**
     * StateAttributes constructor.
     * @param ExtensionRepositoryInterface $extensionRepository
     * @param CustomerAddressExtensionAttributeInterfaceFactory $extensionFactory
     */
    public function __construct(
        ExtensionRepositoryInterface $extensionRepository,
        CustomerAddressExtensionAttributeInterfaceFactory $extensionFactory
    )
    {
        $this->setExtensionRepository($extensionRepository);
        $this->setExtensionFactory($extensionFactory);
    }
    /**
     * @param Address $subject
     * @param CustomerAddressExtensionAttributeInterface $extensionAttributes
     * @return $extensionAttributes
     */
    public function afterGetExtensionAttributes(Address $subject, $extensionAttributes = null)
    {

        if (empty($extensionAttributes)) {
            $extensionAttributes = $this->getExtensionFactory()->create();
        }

        $extensionAttributes->setCustomAttribute("address_type", $this->getExtensionRepository()->getByParentId($subject->getId()));
        return $extensionAttributes;
    }
    /**
     * @return ExtensionRepositoryInterface
     */
    protected function getExtensionRepository()
    {
        return $this->extensionRepository;
    }
    /**
     * @param ExtensionRepositoryInterface $extensionRepository
     * @return $this
     */
    protected function setExtensionRepository(ExtensionRepositoryInterface $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
        return $this;
    }
    /**
     * @return CustomerAddressExtensionAttributeInterface
     */
    protected function getExtensionFactory()
    {
        return $this->extensionFactory;
    }
    /**
     * @param CustomerAddressExtensionAttributeInterfaceFactory $extensionFactory
     * @return $this
     */
    protected function setExtensionFactory(CustomerAddressExtensionAttributeInterfaceFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
        return $this;
    }
}