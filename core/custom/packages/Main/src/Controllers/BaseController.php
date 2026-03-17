<?php

namespace EvolutionCMS\Main\Controllers;

use EvolutionCMS\TemplateController;

class BaseController extends TemplateController
{
    protected array $data = [];
    protected int $docid = 0;

    public function process(): void
    {
        $this->docid = (int) \evo()->documentIdentifier;

        $this->data['pagetitle'] = $this->getDocumentField('pagetitle');
        $this->data['introtext'] = $this->getDocumentField('introtext');

        $this->setPageData();

        $this->addViewData($this->data);
    }

    protected function setPageData(): void
    {
    }

    protected function getDocumentField(string $key): string
    {
        $value = \evo()->documentObject[$key] ?? '';

        if (is_array($value)) {
            $value = $value[1] ?? $value[0] ?? '';
        }

        return trim((string) $value);
    }
}
