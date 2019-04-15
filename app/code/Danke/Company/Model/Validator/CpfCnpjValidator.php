<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Model\Validator;

use Danke\Company\Api\CustomerValidatorInterface;
use Danke\Company\Helper\Customer\Validator\CpfCnpjValidatorHelper;


class CpfCnpjValidator implements CustomerValidatorInterface
{

    protected $cpfCnpjvalidatorHelper;

    /**
     * CpfCnpjValidator constructor.
     */
    public function __construct(
        CpfCnpjValidatorHelper $cpfCnpjvalidatorHelper
    )
    {
        $this->setCpfCnpjvalidatorHelper($cpfCnpjvalidatorHelper);
    }

    /**
     * @param string $taxvat
     * @return bool
     */
    public function isValid($taxvat)
    {
        if ($this->getCpfCnpjvalidatorHelper()->isValidCpf($taxvat) || $this->getCpfCnpjvalidatorHelper()->isValidCnpj($taxvat)) {
            return true;
        }

        return false;
    }

    /**
     * @return CpfCnpjValidatorHelper
     */
    protected function getCpfCnpjvalidatorHelper()
    {
        return $this->cpfCnpjvalidatorHelper;
    }

    /**
     * @param CpfCnpjValidatorHelper $cpfCnpjvalidatorHelper
     * @return $this
     */
    protected function setCpfCnpjvalidatorHelper($cpfCnpjvalidatorHelper)
    {
        $this->cpfCnpjvalidatorHelper = $cpfCnpjvalidatorHelper;
        return $this;
    }


}