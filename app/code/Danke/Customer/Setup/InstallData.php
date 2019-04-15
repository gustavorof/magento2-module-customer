<?php

namespace Danke\Customer\Setup;

/*
 * @codeCoverageIgnore
 */
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Customer\Model\Customer;
use Danke\Customer\Model\AddressType;

class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {
            $this->installVersionOneZeroZero($setup);
        }

        $setup->endSetup();
    }

    protected function installVersionOneZeroZero($setup)
    {
        $attributeCode = 'address_type';
        $attributeType = Customer::ENTITY;
        $forms = [
            'adminhtml_customer_address',
            'customer_register_address',
            'customer_address_edit',
            'adminhtml_checkout'
        ];

        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerSetup->addAttribute(
            $attributeType,
            $attributeCode,
            [
                'type' => 'varchar',
                'label' => __('Address Type'),
                'input' => 'select',
                'source' => AddressType::class,
                'backend' => ArrayBackend::class,
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'sort_order' => 1000,
                'position' => 1000,
                'system' => 0,
                'option' => [
                    'values' => [
                        0 => 'Business',
                        1 => 'Residential'
                    ]
                ],
                'used_in_forms' => $forms
            ]
        );

        $customerEntity = $customerSetup->getEavConfig()->getEntityType($attributeType);
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        /** @var AttributeSet $attributeSet */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $attribute = $customerSetup->getEavConfig()->getAttribute($attributeType, $attributeCode)
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => $forms,
            ]);
        $attribute->save();
    }
}