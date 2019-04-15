<?php


namespace Danke\Customer\Model;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class AddressType extends AbstractSource
{
    /**
     * @inheritDoc
     */
    public function getAllOptions()
    {
        if (null === $this->_options) {
            $this->_options = [
                ['label' => __('Residential'), 'value' => 'residential'],
                ['label' => __('Business'), 'value' => 'business']
            ];
        }

        return $this->_options;
    }
}
