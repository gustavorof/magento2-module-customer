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
use Danke\Slider\Block\Slider;
use Danke\Slider\Model\Config;
use Magento\Framework\View\Element\Template\Context;

class SliderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Slider
     */
    private $model;

    /**
     * @var Context
     */
    private $contextMock;

    /**
     * @var Config
     */
    private $configMock;


    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->contextMock = $this->createMock(Context::class);
        $this->configMock = $this->createMock(Config::class);

        $this->model = $objectManager->getObject(
            Slider::class,
            [
                'context' => $this->contextMock,
                'config' => $this->configMock
            ]
        );
    }

    /**
     * @test
     */
    public function testIsSliderEnabled()
    {
        $valueMock = "1";

        $this->configMock
            ->expects($this->once())
            ->method('isSliderEnabled')
            ->willReturn($valueMock);

        $result = $this->model->isSliderEnabled();

        $this->assertSame($result, $valueMock);
    }
}