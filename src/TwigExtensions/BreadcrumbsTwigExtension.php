<?php


namespace Kozhilya\BreadcrumbsBundle\TwigExtensions;

use Kozhilya\BreadcrumbsBundle\BreadcrumbsService;
use Kozhilya\BreadcrumbsBundle\Builder\Generator;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 *
 */
class BreadcrumbsTwigExtension extends AbstractExtension
{
    protected ?Generator $generator = null;

    public function __construct(protected BreadcrumbsService $breadcrumbsService, protected Environment $twig)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('set_breadcrumbs', [$this, 'setBreadcrumbs']),
            new TwigFunction('breadcrumbs', [$this, 'buildBreadcrumbs'], ['is_safe' => ['html']]),
        ];
    }

    public function setBreadcrumbs(string $action, $entity = null, ...$params): void
    {
        $this->generator = $this->breadcrumbsService->build($action, $entity, ... $params);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function buildBreadcrumbs(): string
    {
        if (is_null($this->generator)) {
            return '';
        }

        return $this->twig->render($this->breadcrumbsService->getTemplate(), [
            'items' => $this->generator->getItems()
        ]);
    }


}