<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Model\Resource;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Danke\Company\Api\Data\CompanyAttributesInterface;

class CompanyAttributes extends AbstractDb
{
    const SCHEMA_NAME = 'danke_company_attribute';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(static::SCHEMA_NAME, CompanyAttributesInterface::ID);
    }
}
