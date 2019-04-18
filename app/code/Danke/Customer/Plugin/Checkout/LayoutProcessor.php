<?php

namespace Danke\Customer\Plugin\Checkout;

use Danke\Customer\Model\AddressType;
/**
 * @codeCoverageIgnore
 */
class LayoutProcessor
{

    /**
     * @var AddressType
     */
    protected $addressType;

    /**
     * @param AddressType $addressType
     */
    public function __construct(
        AddressType $addressType
    )
    {
        $this->setAddressType($addressType);
    }

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {

        $customAttributeCode = 'address_type';
        $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $customAttributeCode,
            'label' => 'Address Type',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ],
            'options' => $this->getAddressType()->getAllOptions() ,
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;

        $configuration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'];
        foreach ($configuration as $paymentGroup => $groupConfig) {
            if (isset($groupConfig['component']) AND $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {

                $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']['children']['company_tax_id'] = [
                    'component' => 'Magento_Ui/js/form/element/select',
                    'config' => [
                            'customScope' => 'billingAddress.custom_attributes',
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'ui/form/element/select',
                        ],
                    'dataScope' => 'billingAddress.custom_attributes.' . $customAttributeCode,
                    'label' => 'Address Type',
                    'provider' => 'checkoutProvider',
                    'sortOrder' => 0,
                    'validation' => [
                            'required-entry' => true
                        ],
                    'options' => $this->getAddressType()->getAllOptions() ,
                    'filterBy' => null,
                    'customEntry' => null,
                    'visible' => true
                ];
            }
        }

        return $jsLayout;
    }

    /**
     * @return AddressType
     */
    protected function getAddressType()
    {
        return $this->addressType;
    }

    /**
     * @param AddressType $addressType
     */
    protected function setAddressType($addressType)
    {
        $this->addressType = $addressType;
    }


}