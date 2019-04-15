<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Model\Resource\CompanyAttributes;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Danke\Company\Model\CompanyAttributes as Model;
use Danke\Company\Model\Resource\CompanyAttributes as Resource;

/**
 * @codeCoverageIgnore
 * @SuppressWarnings(PHPMD)
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(
            Model::class,
            Resource::class
        );
    }
}