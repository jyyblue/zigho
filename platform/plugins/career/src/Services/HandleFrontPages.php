<?php

namespace Botble\Career\Services;

use Botble\Base\Supports\Helper;
use Botble\Career\Models\Career;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Models\Slug;
use Botble\Theme\Facades\Theme;

class HandleFrontPages
{
    public function handle(Slug|array $slug): array|Slug
    {
        if (! $slug instanceof Slug) {
            return $slug;
        }

        if ($slug->reference_type == Career::class) {
            $career = Career::query()
                ->wherePublished()
                ->where('id', $slug->reference_id)
                ->firstOrFail();

            SeoHelper::setTitle($career->name)
                ->setDescription($career->description);

            $meta = new SeoOpenGraph();
            $meta->setDescription($career->description);
            $meta->setUrl($career->url);
            $meta->setTitle($career->name);
            $meta->setType('article');

            SeoHelper::setSeoOpenGraph($meta);

            Theme::breadcrumb()->add($career->name);

            Helper::handleViewCount($career, 'career_viewed');

            return [
                'view' => 'career.career',
                'default_view' => 'plugins/career::themes.career',
                'data' => compact('career'),
                'slug' => $career->slug,
            ];
        }

        return $slug;
    }
}
