<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Model;

use Danke\Company\Api\Data\CompanyAttributesInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Model\AbstractModel;
use Danke\Company\Model\Resource\CompanyAttributes as ResourceModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;

class CompanyAttributes extends AbstractModel implements CompanyAttributesInterface
{
    const ID                    = 'entity_id';
    const CUSTOMER_ID           = 'customer_id';
    const CUSTOMER              = 'customer';
    const CNPJ                  = 'cnpj';
    const NOME_FANTASIA         = 'nome_fantasia';
    const RAZAO_SOCIAL          = 'razao_social';
    const INSCRICAO_ESTADUAL    = 'inscricao_estadual';
    const INSCRICAO_MUNICIPAL   = 'inscricao_municipal';
    const TELEFONE              = 'telefone';
    const EMAIL                 = 'email';
    const LOGRADOURO            = 'logradouro';
    const NUMERO                = 'numero';
    const COMPLEMENTO           = 'complemento';
    const BAIRRO                = 'bairro';
    const CEP                   = 'cep';
    const ESTADO                = 'estado';
    const CIDADE                = 'cidade';
    const COUNTRY               = 'pais';

    protected $customerFactory;
    protected $customer;

    public function __construct(
        Context $context,
        Registry $registry,
        CustomerFactory $customerFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        $this->setCustomerFactory($customerFactory);
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getCustomer()
    {
        if (! $this->customer) {
            if (! $this->getCustomerId()) {
                return false;
            }

            $this->customer = $this->getCustomerFactory()->create();
            $this->customer->load($this->getCustomerId());

            if (! $this->customer->getId()) {
                $this->customer = false;
            }
        }

        return $this->customer;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(static::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($value)
    {
        $this->setData(static::ID, $value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->getData(static::TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($value)
    {
        $this->setData(static::CUSTOMER_ID, $value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getNomeFantasia()
    {
        return $this->getData(static::NOME_FANTASIA);
    }

    /**
     * @inheritDoc
     */
    public function setNomeFantasia($value)
    {
        $this->setData(static::NOME_FANTASIA, $value);
        return $this;
    }

    public function getCnpj()
    {
        return $this->getData(static::CNPJ);
    }

    public function setCnpj($value)
    {
        $this->setData(static::CNPJ, $value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRazaoSocial()
    {
        return $this->getData(static::RAZAO_SOCIAL);
    }

    /**
     * @inheritDoc
     */
    public function setRazaoSocial($value)
    {
        $this->setData(static::RAZAO_SOCIAL, $value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getInscricaoEstadual()
    {
        return $this->getData(static::INSCRICAO_ESTADUAL);
    }

    /**
     * @inheritDoc
     */
    public function setInscricaoEstadual($value)
    {
        $this->setData(static::INSCRICAO_ESTADUAL, $value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getInscricaoMunicipal()
    {
        return $this->getData(static::INSCRICAO_MUNICIPAL);
    }

    /**
     * @inheritDoc
     */
    public function setInscricaoMunicipal($value)
    {
        $this->setData(static::INSCRICAO_MUNICIPAL, $value);
        return $this;
    }

    /**
     * @return CustomerFactory
     */
    protected function getCustomerFactory()
    {
        return $this->customerFactory;
    }

    /**
     * @param CustomerFactory $customerFactory
     * @return $this
     */
    protected function setCustomerFactory(CustomerFactory $customerFactory)
    {
        $this->customerFactory = $customerFactory;
        return $this;
    }

    public function getTelefone()
    {
        return $this->getData(static::TELEFONE);
    }

    public function setTelefone($value)
    {
        $this->setData(static::TELEFONE, $value);
        return $this;
    }

    public function getEmail()
    {
        return $this->getData(static::EMAIL);
    }

    public function setEmail($value)
    {
        $this->setData(static::EMAIL, $value);
        return $this;
    }

    public function getLogradouro()
    {
        return $this->getData(static::LOGRADOURO);
    }

    public function setLogradouro($value)
    {
        $this->setData(static::LOGRADOURO, $value);
        return $this;
    }

    public function getNumero()
    {
        return $this->getData(static::NUMERO);
    }

    public function setNumero($value)
    {
        $this->setData(static::NUMERO, $value);
        return $this;
    }

    public function getComplemento()
    {
        return $this->getData(static::COMPLEMENTO);
    }

    public function setComplemento($value)
    {
        $this->setData(static::COMPLEMENTO, $value);
        return $this;
    }

    public function getBairro()
    {
        return $this->getData(static::BAIRRO);
    }

    public function setBairro($value)
    {
        $this->setData(static::BAIRRO, $value);
        return $this;
    }

    public function getCep()
    {
        return $this->getData(static::CEP);
    }

    public function setCep($value)
    {
        $this->setData(static::CEP, $value);
        return $this;
    }

    public function getEstado()
    {
        return $this->getData(static::ESTADO);
    }

    public function setEstado($value)
    {
        $this->setData(static::ESTADO, $value);
        return $this;
    }

    public function getCidade()
    {
        return $this->getData(static::CIDADE);
    }

    public function setCidade($value)
    {
        $this->setData(static::CIDADE, $value);
        return $this;
    }

    public function getCountry()
    {
        return $this->getData(static::COUNTRY);
    }

    public function setCountry($value)
    {
        $this->setData(static::COUNTRY, $value);
        return $this;
    }


}
