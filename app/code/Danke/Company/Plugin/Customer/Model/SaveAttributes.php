<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Plugin\Customer\Model;

use Magento\Backend\App\Action\Context;
use Danke\Company\Api\Data\CompanyAttributesInterfaceFactory;
use Danke\Company\Api\ExtensionRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class SaveAttributes
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var CompanyAttributesInterfaceFactory
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
        CompanyAttributesInterfaceFactory $extensionFactory,
        ExtensionRepositoryInterface $extensionRepository
    )
    {
        $this->setContext($context);
        $this->setExtensionFactory($extensionFactory);
        $this->setExtensionRepository($extensionRepository);
    }
    /**
     * @param CustomerRepositoryInterface $subject
     * @param \Magento\Customer\Model\Customer $model
     * @return mixed
     */
    public function afterSave(CustomerRepositoryInterface $subject, \Magento\Customer\Model\Customer $model)
    {
        $this->saveCompanyAttributes($model);

        return $model;
    }

    /**
     * @param $model
     */
    protected function saveCompanyAttributes($model)
    {
/*
        $requestAttributes = $this->getCompanyAttributesFromRequest();
        $warehouseStateAttributes = $requestAttributes['warehouse_state_attributes'];

        $warehouseExtension = $model->getCustomAttributes()->getWarehouseStateAttributes();

        if (! $warehouseExtension) {
            $warehouseExtension = $this->getExtensionFactory()->create();
        }

        $warehouseExtension->setWarehouseId($model->getId());
        $warehouseExtension->setIsEnabled($warehouseStateAttributes['is_enabled']);
        $warehouseExtension->setCountry($warehouseStateAttributes['country']);
        $warehouseExtension->setState(implode(',', $warehouseStateAttributes['state']));
        $this->getExtensionRepository()->save($warehouseExtension);
*/
        return $this;
    }

    protected function getCompanyAttributesFromRequest()
    {
        $request = $this->getContext()->getRequest();
        $warehouseStateAttributes = [
            "customer_account_create" => [
                'is_enabled' => $request->getParam('is_enabled'),
                'country' => $request->getParam('country_allowed'),
                'state' => $request->getParam('state_allowed_id')
            ]
        ];

        return $warehouseStateAttributes;
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
     * @return CompanyAttributesInterfaceFactory
     */
    protected function getExtensionFactory()
    {
        return $this->extensionFactory;
    }

    /**
     * @param CompanyAttributesInterfaceFactory $extensionFactory
     */
    protected function setExtensionFactory(CompanyAttributesInterfaceFactory $extensionFactory)
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