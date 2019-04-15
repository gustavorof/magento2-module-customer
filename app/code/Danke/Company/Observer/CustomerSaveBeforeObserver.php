<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http;
use Danke\Company\Api\CustomerValidatorInterface;
use Magento\Framework\Exception\InputException;


class CustomerSaveBeforeObserver implements ObserverInterface
{

    protected $httpRequest;
    protected $customerValidator;

    public function __construct(
        Http $httpRequest,
        CustomerValidatorInterface $customerValidator
    )
    {
        $this->setRequest($httpRequest);
        $this->setCustomerValidator($customerValidator);
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this|void
     * @throws InputException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $taxVat = $this->getRequest()->getParam('taxvat');

        $response = $this->getCustomerValidator()->isValid($taxVat);

        if (!$response) {
            throw new InputException(__('The field CPF is invalid.'));
        }

        $observer->getCustomer()->setTaxvat(preg_replace('/[^0-9]/','',$taxVat));

        return $this;
    }

    /**
     * @return \Magento\Framework\App\Request\Http
     */
    protected function getRequest()
    {
        return $this->httpRequest;
    }

    /**
     * @param \Magento\Framework\App\Request\Http $httpRequest
     * @return $this
     */
    protected function setRequest($httpRequest)
    {
        $this->httpRequest = $httpRequest;
        return $this;
    }

    /**
     * @return CustomerValidatorInterface
     */
    protected function getCustomerValidator()
    {
        return $this->customerValidator;
    }

    /**
     * @param CustomerValidatorInterface $customerValidator
     * @return $this
     */
    protected function setCustomerValidator($customerValidator)
    {
        $this->customerValidator = $customerValidator;
        return $this;
    }


}