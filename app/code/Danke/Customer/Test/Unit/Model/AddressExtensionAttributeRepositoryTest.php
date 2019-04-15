<?php

namespace Danke\Test\Unit\Model;

use Danke\Customer\Model\AddressExtensionAttributeRepository;
use Danke\Customer\Model\CustomerAddressExtensionAttribute;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute\CollectionFactory;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute\Collection;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute as Resource;

class AddressExtensionAttributeRepositoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AddressExtensionAttributeRepository
     */
    private $model;

    /**
     * @var CollectionFactory
     */
    private $collectionFactoryMock;

    /**
     * @var Collection
     */
    private $collectionMock;

    /**
     * @var Resource
     */
    private $addressAttributeMock;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->collectionFactoryMock = $this->getMockBuilder(CollectionFactory::class)
            ->disableOriginalConstructor()
            ->allowMockingUnknownTypes()
            ->setMethods(['create'])
            ->getMock();

        $this->collectionMock = $this->createMock(Collection::class);
        $this->addressAttributeMock = $this->createMock(Resource::class);

        $this->model = $objectManager->getObject(
            AddressExtensionAttributeRepository::class,
            [
                'collectionFactory' => $this->collectionFactoryMock
            ]
        );
    }

    public function testGetByParentId()
    {
        $parenIdMock = 10;
        $expectedResult = $this->addressAttributeMock;

        $this->collectionFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->collectionMock);

        $this->collectionMock
            ->expects($this->once())
            ->method('addFieldToFilter')
            ->with(CustomerAddressExtensionAttribute::ADDRESS_ID, ['eq' => $parenIdMock])
            ->willReturnSelf();

        $this->collectionMock
            ->expects($this->once())
            ->method('setPageSize')
            ->with(1)
            ->willReturnSelf();

        $this->collectionMock
            ->expects($this->once())
            ->method('getFirstItem')
            ->willReturn($this->addressAttributeMock);

        $result = $this->model->getByParentId($parenIdMock);

        $this->assertSame($expectedResult, $result);
    }

    public function testSave()
    {
        $modelAddressAttributeMock = $this->createMock(CustomerAddressExtensionAttribute::class);
        $expectedResult = $modelAddressAttributeMock;

        $modelAddressAttributeMock
            ->expects($this->once())
            ->method('save')
            ->willReturnSelf();

        $result = $this->model->save($modelAddressAttributeMock);

        $this->assertSame($expectedResult, $result);
    }
}