<?php

namespace Danke\Slider\Block;

use Magento\Framework\View\Element\Template;
use Danke\Slider\Api\ConfigInterface;

class Slider extends \Magento\Framework\View\Element\Template
{

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @param Template\Context $context
     * @param ConfigInterface $config
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ConfigInterface $config,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->setConfig($config);
    }

    /**
     * @return bool

     */
    public function isSliderEnabled()
    {
        return $this->getConfig()->isSliderEnabled();
    }


    /**
     * @return ConfigInterface
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @param ConfigInterface $config
     */
    protected function setConfig($config)
    {
        $this->config = $config;
    }



}
