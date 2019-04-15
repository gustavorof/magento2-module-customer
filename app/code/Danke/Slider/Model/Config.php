<?php

namespace Danke\Slider\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Danke\Slider\Api\ConfigInterface;

class Config implements ConfigInterface
{

    const XML_PATH_SLIDER_IS_ENABLED= 'danke_slider/general/slider_enabled';

    /**
     * @var ScopeConfigInterface
     */
    protected $storeConfig;

    /**
     * @param ScopeConfigInterface $storeConfig
     */
    public function __construct(
        ScopeConfigInterface $storeConfig
    )
    {
        $this->setStoreConfig($storeConfig);
    }

    public function isSliderEnabled()
    {
        return $this->getConfig(self::XML_PATH_SLIDER_IS_ENABLED);

    }

    /**
     * @return ScopeConfigInterface
     */
    protected function getStoreConfig()
    {
        return $this->storeConfig;
    }

    protected function getConfig($path, $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        return $this->getStoreConfig()->getValue($path, $scopeType, $scopeCode);
    }

    /**
     * @param ScopeConfigInterface $storeConfig
     * @return self
     */
    protected function setStoreConfig(ScopeConfigInterface $storeConfig)
    {
        $this->storeConfig = $storeConfig;
        return $this;
    }
}