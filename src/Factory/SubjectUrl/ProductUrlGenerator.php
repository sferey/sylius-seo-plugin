<?php

declare(strict_types=1);

namespace Dedi\SyliusSEOPlugin\Factory\SubjectUrl;

use Dedi\SyliusSEOPlugin\Domain\SEO\Adapter\RichSnippetSubjectInterface;
use Dedi\SyliusSEOPlugin\Domain\SEO\Factory\SubjectUrl\SubjectUrlGeneratorInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class ProductUrlGenerator implements SubjectUrlGeneratorInterface
{
    protected RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function can($subject): bool
    {
        return $subject instanceof ProductInterface;
    }

    public function generateUrl($subject): string
    {
        if (!$this->can($subject)) {
            throw new \LogicException('This case only works with a subject which implement ProductInterface');
        }

        return $this->router->generate('sylius_shop_product_show', ['slug' => $subject->getSlug()], UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
