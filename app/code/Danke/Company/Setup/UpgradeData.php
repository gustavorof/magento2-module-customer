<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Setup;

/*
 * @codeCoverageIgnore
 */
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;


class UpgradeData implements UpgradeDataInterface
{
    private $customerSetupFactory;
    private $eavSetupFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $this->upgradeVersionZeroZeroTwo($setup);
        }

        $setup->endSetup();
    }

    public function upgradeVersionZeroZeroTwo($setup)
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $this->setTaxVatVisibleAndRequired($customerSetup);
        $this->addTaxVatInputToCustomerForm($customerSetup);
    }

    protected function addTaxVatInputToCustomerForm($customerSetup)
    {
        $forms = [
            'customer_account_create',
            'customer_account_edit',
            'adminhtml_checkout'
        ];

        $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'taxvat')
            ->addData([
                'used_in_forms' => $forms,
            ]);
    }

    protected function setTaxVatVisibleAndRequired($customerSetup)
    {
        $customerSetup->updateAttribute(Customer::ENTITY, 'taxvat', 'is_required', 1);
        $customerSetup->updateAttribute(Customer::ENTITY, 'taxvat', 'is_visible', 1);
    }
}