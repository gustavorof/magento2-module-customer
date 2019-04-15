<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Danke\Company\Api\ExtensionRepositoryInterface;
use Danke\Company\Model\Resource\CompanyAttributes\CollectionFactory;
use Danke\Company\Model\Resource\CompanyAttributes\Collection;

class CompanyAttributesRepository implements ExtensionRepositoryInterface
{
    protected $collectionFactory;
    /**
     * WarehouseStateRepository constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->setCollectionFactory($collectionFactory);
    }
    /**
     * @inheritDoc
     */
    public function getByParentId($parentId)
    {
        /** @var Collection $collection */
        $collection = $this->getCollectionFactory()->create();
        $collection
            ->addFieldToFilter(CompanyAttributes::CUSTOMER_ID, [
                'eq' => $parentId
            ])
            ->setPageSize(1);
        return $collection->getFirstItem(); // @codingStandardsIgnoreLine
    }
    /**
     * @inheritDoc
     * @return WarehouseStateAttributes|AbstractExtensibleModel
     */
    public function save(AbstractExtensibleModel $model)
    {
        $model->save();
        return $model;
    }
    /**
     * @return CollectionFactory
     */
    protected function getCollectionFactory()
    {
        return $this->collectionFactory;
    }
    /**
     * @param CollectionFactory $collectionFactory
     * @return $this
     */
    protected function setCollectionFactory(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        return $this;
    }
}