<?php

namespace Playground;

use Midnight\Block\BlockInterface;
use Midnight\Block\MutableBlock;
use Midnight\Block\Renderer\PsrContainerRenderer;
use Midnight\Block\Renderer\RendererInterface;
use Midnight\Block\Renderer\ZendTemplateRenderer;
use Midnight\Block\Type\Attribute\Attribute;
use Midnight\Block\Type\BlockType;
use Psr\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplateMapResolver;

require_once __DIR__ . '/vendor/autoload.php';

$attributeValues = ['video_id' => 'dQw4w9WgXcQ'];
$videoId = new Attribute('video_id');
$youTubeVideo = new BlockType('youtube_video', $videoId);
$twoUp = new BlockType('two_up', new Attribute('left'), new Attribute('right'));
$videoOne = new MutableBlock($youTubeVideo, $attributeValues);
$videoTwo = new MutableBlock($youTubeVideo, $attributeValues);
$container = new MutableBlock($twoUp, ['left' => $videoOne->getId(), 'right' => $videoTwo->getId()]);

$zendRenderer = new PhpRenderer();
$zendRenderer->setResolver(new TemplateMapResolver([
    'youtube-video' => __DIR__ . '/youtube-video.phtml',
    'two-up' => __DIR__ . '/two-up.phtml',
]));
$zendRenderer->setHelperPluginManager(new HelperPluginManager([
    'factories' => [
        'block' => function () {
            return new class extends AbstractHelper
            {
                public function __invoke(BlockInterface $block): string
                {

                }
            };
        },
    ],
]));
$rendererContainer = new class([
    $youTubeVideo->getName() => new ZendTemplateRenderer($zendRenderer, 'youtube-video'),
    $twoUp->getName() => new ZendTemplateRenderer($zendRenderer, 'two-up'),
]) implements ContainerInterface
{
    /** @var RendererInterface[] */
    private $map;

    /**
     * @param RendererInterface[] $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function get($id)
    {
        return $this->map[$id];
    }

    public function has($id)
    {
        return isset($this->map[$id]);
    }
};
$renderer = new PsrContainerRenderer($rendererContainer);
echo $renderer->render($container);
