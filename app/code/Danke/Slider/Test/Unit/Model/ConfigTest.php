<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Slider\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Danke\Slider\Model\Config;

class ConfigTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Config
     */
    private $model;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfigInterfaceMock;


    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->scopeConfigInterfaceMock = $this->createMock(ScopeConfigInterface::class);

        $this->model = $objectManager->getObject(
            Config::class,
            [
                'storeConfig' => $this->scopeConfigInterfaceMock
            ]
        );
    }

    /**
     * @test
     */
    public function testIsSliderEnabled()
    {
        $configPath = Config::XML_PATH_SLIDER_IS_ENABLED;
        $valueMock = "1";
        $this->scopeConfigInterfaceMock
            ->expects($this->once())
            ->method('getValue')
            ->with($configPath)
            ->willReturn($valueMock);

        $result = $this->model->isSliderEnabled();

        $this->assertSame($result, $valueMock);
    }
}