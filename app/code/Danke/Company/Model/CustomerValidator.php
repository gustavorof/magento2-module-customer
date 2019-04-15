<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Model;

use Magento\Framework\ObjectManager\TMapFactory;
use Danke\Company\Api\CustomerValidatorInterface;

Class CustomerValidator implements CustomerValidatorInterface
{

    /**
     * @var CustomerValidatorInterface[]
     */
    protected $customerValidatorList;

    /**
     * @param TMapFactory $tmapFactory
     * @param array $list
     */
    public function __construct(
        TMapFactory $tmapFactory,
        array $list = []
    )
    {
        $customerValidatorList = $tmapFactory->create(
            [
                'array' => $list,
                'type' => CustomerValidatorInterface::class,
            ]
        );
        $this->setCustomerValidatorList($customerValidatorList);
    }

    /**
     * @param string $taxvat
     * @return bool
     */
    public function isValid($taxvat)
    {

        $customerValidators = $this->getCustomerValidatorList()->getIterator();

        foreach ($customerValidators as $validator) {
            if (!$validator->isValid($taxvat)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return CustomerValidatorInterface[]
     */
    protected function getCustomerValidatorList()
    {
        return $this->customerValidatorList;
    }

    /**
     * @param CustomerValidatorInterface[] $customerValidatorList
     *
     * @return self
     */
    protected function setCustomerValidatorList($customerValidatorList)
    {
        $this->customerValidatorList = $customerValidatorList;
        return $this;
    }
}