<?php

namespace Danke\Customer\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Danke\Customer\Api\Data\CustomerAddressExtensionAttributeInterface;
use Danke\Customer\Model\ResourceModel\CustomerAddressExtensionAttribute;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {
            $this->createCustomerAddressExtensionAttributesTable($setup, $context);
        }

        $installer->endSetup();
    }

    protected function createCustomerAddressExtensionAttributesTable(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $table = $installer->getConnection()->newTable(
            $installer->getTable(CustomerAddressExtensionAttribute::SCHEMA_NAME)
        )->addColumn(
            CustomerAddressExtensionAttributeInterface::ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Entity ID'
        )->addColumn(
            CustomerAddressExtensionAttributeInterface::ADDRESS_ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Address ID'
        )->addColumn(
            CustomerAddressExtensionAttributeInterface::TYPE,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            11,
            ['nullable' => true],
            'Address Type'
        )->addIndex(
            $installer->getIdxName(
                CustomerAddressExtensionAttribute::SCHEMA_NAME,
                [CustomerAddressExtensionAttributeInterface::ADDRESS_ID]
            ),
            [CustomerAddressExtensionAttributeInterface::ADDRESS_ID]
        )->addForeignKey(
            $installer->getFkName(
                CustomerAddressExtensionAttribute::SCHEMA_NAME,
                CustomerAddressExtensionAttributeInterface::ADDRESS_ID,
                $installer->getTable('customer_address_entity'),
                'entity_id'
            ),
            CustomerAddressExtensionAttributeInterface::ADDRESS_ID,
            $installer->getTable('customer_address_entity'),
            'entity_id',
            \Magento\Framework\DB\Adapter\AdapterInterface::FK_ACTION_CASCADE
        );

        $installer->getConnection()->createTable($table);
    }

}
