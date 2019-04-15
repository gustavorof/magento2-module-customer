<?php

namespace Danke\Customer\Test\Unit\Plugin\Adddress;

use Danke\Customer\Plugin\Address\CustomerAddressAttributes;
use Danke\Customer\Api\ExtensionRepositoryInterface;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterfaceFactory;
use Magento\Customer\Model\Data\Address;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute;

class CustomerAddressAttributesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CustomerAddressAttributes
     */
    private $model;

    /**
     * @var ExtensionRepositoryInterface
     */
    private $extensionRepositoryInterfaceMock;

    /**
     * @var CustomerAddressExtensionAttributeInterfaceFactory
     */
    private $addressAttributeInterfaceFactoryMock;

    /**
     * @var Address
     */
    private $addressMock;

    /**
     * @var CustomerAddressExtensionAttribute
     */
    private $addressAttributesMock;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->extensionRepositoryInterfaceMock = $this->createMock(ExtensionRepositoryInterface::class);
        $this->addressAttributeInterfaceFactoryMock = $this->getMockBuilder(CustomerAddressExtensionAttributeInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->allowMockingUnknownTypes()
            ->setMethods(['create'])
            ->getMock();
        $this->addressMock =  $this->createMock(Address::class);
        $this->addressAttributesMock =  $this->createMock(CustomerAddressExtensionAttribute::class);

        $this->model = $objectManager->getObject(
            CustomerAddressAttributes::class,
            [
                'extensionRepository' => $this->extensionRepositoryInterfaceMock,
                'extensionFactory' => $this->addressAttributeInterfaceFactoryMock
            ]
        );
    }

    public function testAfterGetCustomAttributes()
    {
        $addressIdMock = 5;
        $this->addressMock
            ->expects($this->once())
            ->method('getid')
            ->willReturn($addressIdMock);

        $this->extensionRepositoryInterfaceMock
            ->expects($this->once())
            ->method('getByParentId')
            ->with($addressIdMock)
            ->willReturn($this->addressAttributesMock);

        $this->addressAttributeInterfaceFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->addressMock);

        $this->model->afterGetExtensionAttributes($this->addressMock);
    }
}