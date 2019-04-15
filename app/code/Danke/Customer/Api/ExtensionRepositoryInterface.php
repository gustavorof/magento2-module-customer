<?php

namespace Danke\Customer\Api;

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