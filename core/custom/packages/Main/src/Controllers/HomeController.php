<?php

namespace EvolutionCMS\Main\Controllers;

class HomeController extends BaseController
{
    protected function setPageData(): void
    {
        $portfolioItems = array_values(array_filter(array_map(function ($item) {
            if (!is_array($item)) {
                return null;
            }

            $title = trim((string) ($item['title'] ?? ''));
            $image = trim((string) ($item['image'] ?? ''));
            $type = trim((string) ($item['type'] ?? ''));

            if ($title === '') {
                return null;
            }

            return [
                'title' => $title,
                'image' => $image,
                'type' => $type !== '' ? $type : 'residential',
                'type_label' => $this->getPortfolioTypeLabel($type),
            ];
        }, $this->getMultiTvValue('portfolio-item'))));

        $this->data['portfolioItems'] = $portfolioItems;
        $this->data['portfolioCount'] = count($portfolioItems);
    }

    protected function getPortfolioTypeLabel(string $type): string
    {
        return [
            'residential' => 'Жилые комплексы',
            'commercial' => 'Коммерческие',
            'private' => 'Частные',
        ][$type] ?? 'Жилые комплексы';
    }
}
