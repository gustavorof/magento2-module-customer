<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Api;

use Magento\Framework\Model\AbstractExtensibleModel;

interface ExtensionRepositoryInterface
{
    /**
     * @param int $parentId
     * @return mixed
     */
    public function getByParentId($parentId);
    /**
     * @param AbstractExtensibleModel $model
     * @return AbstractExtensibleModel
     */
    public function save(AbstractExtensibleModel $model);


}