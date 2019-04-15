<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Danke\Company\Model\CompanyAttributes as CompanyAttributesModel;
use Danke\Company\Model\Resource\CompanyAttributes as CompanyAttributesResource;

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

        if (version_compare($context->getVersion(), '0.1.0') < 0) {
            $this->createCompanyAttributesTable($setup, $context);
        }

        $installer->endSetup();
    }

    protected function createCompanyAttributesTable(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $table = $installer->getConnection()->newTable(
            $installer->getTable(CompanyAttributesResource::SCHEMA_NAME)
        )->addColumn(
            CompanyAttributesModel::ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Entity ID'
        )->addColumn(
            CompanyAttributesModel::CUSTOMER_ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Customer ID'
        )->addColumn(
            CompanyAttributesModel::CNPJ,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            11,
            ['nullable' => false],
            'CNPJ'
        )->addColumn(
            CompanyAttributesModel::RAZAO_SOCIAL,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Razao Social'
        )->addColumn(
            CompanyAttributesModel::NOME_FANTASIA,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Nome fantasia'
        )->addColumn(
            CompanyAttributesModel::INSCRICAO_ESTADUAL,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Inscrição Estadual'
        )->addColumn(
            CompanyAttributesModel::INSCRICAO_MUNICIPAL,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Inscrição Municipal'
        )->addColumn(
            CompanyAttributesModel::TELEFONE,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Telefone'
        )->addColumn(
            CompanyAttributesModel::EMAIL,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'E-mail'
        )->addColumn(
            CompanyAttributesModel::LOGRADOURO,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Logradouro'
        )->addColumn(
            CompanyAttributesModel::NUMERO,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Numero'
        )->addColumn(
            CompanyAttributesModel::COMPLEMENTO,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Complemento'
        )->addColumn(
            CompanyAttributesModel::BAIRRO,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'bairro'
        )->addColumn(
            CompanyAttributesModel::CEP,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'CEP'
        )->addColumn(
            CompanyAttributesModel::CIDADE,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'cidade'
        )->addColumn(
            CompanyAttributesModel::ESTADO,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Estado'
        )->addColumn(
            CompanyAttributesModel::COUNTRY,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'País'
        )->addIndex(
            $installer->getIdxName(
                CompanyAttributesResource::SCHEMA_NAME,
                [CompanyAttributesModel::CUSTOMER_ID]
            ),
            [CompanyAttributesModel::CUSTOMER_ID]
        )->addForeignKey(
            $installer->getFkName(
                CompanyAttributesResource::SCHEMA_NAME,
                CompanyAttributesModel::CUSTOMER_ID,
                $installer->getTable('customer_entity'),
                'entity_id'
            ),
            CompanyAttributesModel::CUSTOMER_ID,
            $installer->getTable('customer_entity'),
            'entity_id',
            \Magento\Framework\DB\Adapter\AdapterInterface::FK_ACTION_CASCADE
        );

        $installer->getConnection()->createTable($table);
    }

}
