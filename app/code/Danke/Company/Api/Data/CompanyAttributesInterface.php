<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Api\Data;

use Magento\Customer\Model\Customer;

interface CompanyAttributesInterface
{

    /**
     * @return Customer
     */
    public function getCustomer();

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $value
     * @return int
     */
    public function setId($value);

    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @param int $value
     * @return int
     */
    public function setCustomerId($value);

    /**
     * @return string
     */
    public function getCnpj();

    /**
     * @param string $value
     * @return self
     */
    public function setCnpj($value);

    /**
     * @return string
     */
    public function getRazaoSocial();

    /**
     * @param string $value
     * @return self
     */
    public function setRazaoSocial($value);

    /**
     * @return string
     */
    public function getNomeFantasia();

    /**
     * @param string $value
     * @return self
     */
    public function setNomeFantasia($value);

    /**
     * @return string
     */
    public function getInscricaoEstadual();

    /**
     * @param string $value
     * @return self
     */
    public function setInscricaoEstadual($value);

    /**
     * @return string
     */
    public function getInscricaoMunicipal();

    /**
     * @param string $value
     * @return self
     */
    public function setInscricaoMunicipal($value);



    /**
     * @return string
     */
    public function getTelefone();

    /**
     * @param string $value
     * @return self
     */
    public function setTelefone($value);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $value
     * @return self
     */
    public function setEmail($value);

    /**
     * @return string
     */
    public function getLogradouro();

    /**
     * @param string $value
     * @return self
     */
    public function setLogradouro($value);

    /**
     * @return string
     */
    public function getNumero();

    /**
     * @param string $value
     * @return self
     */
    public function setNumero($value);

    /**
     * @return string
     */
    public function getComplemento();

    /**
     * @param string $value
     * @return self
     */
    public function setComplemento($value);

    /**
     * @return string
     */
    public function getBairro();

    /**
     * @param string $value
     * @return self
     */
    public function setBairro($value);

    /**
     * @return string
     */
    public function getCep();

    /**
     * @param string $value
     * @return self
     */
    public function setCep($value);

    /**
     * @return string
     */
    public function getEstado();

    /**
     * @param string $value
     * @return self
     */
    public function setEstado($value);

    /**
     * @return string
     */
    public function getCidade();

    /**
     * @param string $value
     * @return self
     */
    public function setCidade($value);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $value
     * @return self
     */
    public function setCountry($value);
}
