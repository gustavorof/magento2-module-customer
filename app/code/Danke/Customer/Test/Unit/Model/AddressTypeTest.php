<?php

namespace Danke\Test\Unit\Model;

use Danke\Customer\Model\AddressType;

class AddressTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AddressType
     */
    private $model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->model = $objectManager->getObject(
            AddressType::class,
            []
        );
    }

    public function testGetAllOptions()
    {
        $optionsMock = [
            ['label' => __('Residential'), 'value' => 'residential'],
            ['label' => __('Business'), 'value' => 'business']
        ];

        $result = $this->model->getAllOptions();

        $this->assertEquals($optionsMock, $result);
    }

}