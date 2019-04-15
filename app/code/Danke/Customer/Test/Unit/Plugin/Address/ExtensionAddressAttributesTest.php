<?php

namespace Danke\Customer\Test\Unit\Plugin\Address;

use Danke\Customer\Plugin\Address\ExtensionAddressAttributes;
use Magento\Customer\Api\AddressRepositoryInterface;

use Magento\Backend\App\Action\Context;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterfaceFactory;
use Danke\Customer\Api\ExtensionRepositoryInterface;

use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Data\Address;
use Danke\Customer\Model\CustomerAddressExtensionAttribute;

class ExtensionAddressAttributesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ExtensionAddressAttributes
     */
    private $model;

    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepositoryInterfaceMock;

    /**
     * @var Context
     */
    private $contextMock;

    /**
     * @var CustomerAddressExtensionAttributeInterfaceFactory
     */
    private $attributesInterfaceFactoryMock;

    /**
     * @var ExtensionRepositoryInterface
     */
    private $extensionRepositoryInterfaceMock;

    /**
     * @var RequestInterface
     */
    private $requestInterfaceMock;

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

        $this->addressRepositoryInterfaceMock = $this->createMock(AddressRepositoryInterface::class);
        $this->extensionRepositoryInterfaceMock = $this->createMock(ExtensionRepositoryInterface::class);
        $this->contextMock = $this->createMock(Context::class);
        $this->attributesInterfaceFactoryMock = $this->getMockBuilder(CustomerAddressExtensionAttributeInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->allowMockingUnknownTypes()
            ->setMethods(['create'])
            ->getMock();

        $this->requestInterfaceMock = $this->createMock(RequestInterface::class);
        $this->addressMock = $this->createMock(Address::class);
        $this->addressAttributesMock = $this->createMock(CustomerAddressExtensionAttribute::class);


        $this->model = $objectManager->getObject(
            ExtensionAddressAttributes::class,
            [
                'context' => $this->contextMock,
                'extensionFactory' => $this->attributesInterfaceFactoryMock,
                'extensionRepository' => $this->extensionRepositoryInterfaceMock
            ]
        );
    }

    public function testAfterSaveWithAttributesSet()
    {
        $addressTypeMock = "Business";

        $this->contextMock
            ->expects($this->once())
            ->method('getRequest')
            ->willReturn($this->requestInterfaceMock);

        $this->requestInterfaceMock
            ->expects($this->once())
            ->method('getParam')
            ->with('address_type')
            ->willReturn($addressTypeMock);

        $this->attributesInterfaceFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->addressAttributesMock);

        $addressIdMock = 5;
        $this->addressMock
            ->expects($this->once())
            ->method('getId')
            ->willReturn($addressIdMock);

        $this->addressAttributesMock
            ->expects($this->once())
            ->method('setAddressId')
            ->with($addressIdMock)
            ->willReturnSelf();

        $this->addressAttributesMock
            ->expects($this->once())
            ->method('setType')
            ->with($addressTypeMock)
            ->willReturnSelf();

        $this->extensionRepositoryInterfaceMock
            ->expects($this->once())
            ->method('save')
            ->with($this->addressAttributesMock)
            ->willReturnSelf();


        $this->model->afterSave($this->addressRepositoryInterfaceMock, $this->addressMock);
    }

}