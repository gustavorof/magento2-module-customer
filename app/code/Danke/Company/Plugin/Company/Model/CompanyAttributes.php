<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Plugin\Company\Model;

use \Magento\Customer\Model\CustomerFactory;
use Danke\Company\Api\Data\CompanyAttributesInterface;
use Danke\Company\Api\ExtensionRepositoryInterface;
use Magento\Customer\Model\Customer;

class CompanyAttributes
{
    /**
     * @var ExtensionRepositoryInterface
     */
    protected $extensionRepository;

    /**
     * @var CustomerFactory
     */
    protected $extensionFactory;
    /**
     * StateAttributes constructor.
     * @param ExtensionRepositoryInterface $extensionRepository
     * @param CustomerFactory $extensionFactory
     */
    public function __construct(
        ExtensionRepositoryInterface $extensionRepository,
        CustomerFactory $extensionFactory
    )
    {
        $this->setExtensionRepository($extensionRepository);
        $this->setExtensionFactory($extensionFactory);
    }
    /**
     * @param Customer $subject
     * @param CompanyAttributesInterface $extensionAttributes
     * @return  $extensionAttributes
     */
    public function afterGetCustomAttributes(Customer $subject, $extensionAttributes = null)
    {

        if (empty($extensionAttributes)) {
            $extensionAttributes = $this->getExtensionFactory()->create();
        }

        $extensionAttributes->setCompanyAttributes($this->getExtensionRepository()->getByParentId($subject->getId()));
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
     * @return CustomerFactory
     */
    protected function getExtensionFactory()
    {
        return $this->extensionFactory;
    }
    /**
     * @param CustomerFactory $extensionFactory
     * @return $this
     */
    protected function setExtensionFactory(CustomerFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
        return $this;
    }
}