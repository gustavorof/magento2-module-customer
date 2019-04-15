<?php

namespace Danke\Customer\Plugin\Address;

use Magento\Backend\App\Action\Context;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterfaceFactory;
use Magento\Customer\Model\Data\Address;
use Magento\Customer\Api\AddressRepositoryInterface;
use Danke\Customer\Api\ExtensionRepositoryInterface;

class ExtensionAddressAttributes
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var CustomerAddressExtensionAttributeInterfaceFactory
     */
    protected $extensionFactory;

    /**
     * @var ExtensionRepositoryInterface
     */
    protected $extensionRepository;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        CustomerAddressExtensionAttributeInterfaceFactory $extensionFactory,
        ExtensionRepositoryInterface $extensionRepository
    )
    {
        $this->setContext($context);
        $this->setExtensionFactory($extensionFactory);
        $this->setExtensionRepository($extensionRepository);
    }
    /**
     * @param AddressRepositoryInterface $subject
     * @param Address $model
     * @return mixed
     */
    public function afterSave(AddressRepositoryInterface $subject, Address $model)
    {
        $request = $this->getContext()->getRequest();
        $addressType = $request->getParam('address_type');

        $addressExtension = $this->getExtensionFactory()->create();

        $addressExtension->setAddressId($model->getId());
        $addressExtension->setType($addressType);
        $this->getExtensionRepository()->save($addressExtension);

        return $model;
    }

    /**
     * @return Context
     */
    protected function getContext()
    {
        return $this->context;
    }

    /**
     * @param Context $context
     */
    protected function setContext(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @return CustomerAddressExtensionAttributeInterfaceFactory
     */
    protected function getExtensionFactory()
    {
        return $this->extensionFactory;
    }

    /**
     * @param CustomerAddressExtensionAttributeInterfaceFactory $extensionFactory
     */
    protected function setExtensionFactory(CustomerAddressExtensionAttributeInterfaceFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
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
     */
    protected function setExtensionRepository(ExtensionRepositoryInterface $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
    }
}