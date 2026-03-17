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
        $this->data['companyName'] = $this->getConfigValue('client_company_name');
        $this->data['companyPhone'] = $this->getConfigValue('client_phone');
        $this->data['companyPhoneHref'] = preg_replace('/[^\d+]/', '', $this->data['companyPhone']);

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

    protected function getConfigValue(string $key): string
    {
        $candidates = [$key];

        if (strpos($key, 'client_') === 0) {
            $candidates[] = 'client_' . $key;
        }

        foreach (array_unique($candidates) as $candidate) {
            $value = trim((string) \evo()->getConfig($candidate, ''));

            if ($value !== '') {
                return $value;
            }
        }

        return '';
    }

    protected function getMultiTvValue(string $key): array
    {
        $raw = '';
        $keys = array_unique([$key, str_replace('-', '_', $key)]);

        foreach ($keys as $candidate) {
            $output = \evo()->getTemplateVarOutput($candidate, $this->docid);

            if (!empty($output[$candidate])) {
                $raw = $output[$candidate];
                break;
            }
        }

        if ($raw === '') {
            foreach ($keys as $candidate) {
                if (!isset(\evo()->documentObject[$candidate])) {
                    continue;
                }

                $raw = \evo()->documentObject[$candidate];

                if (is_array($raw)) {
                    $raw = $raw[1] ?? $raw[0] ?? '';
                }

                if ($raw !== '') {
                    break;
                }
            }
        }

        $decoded = json_decode((string) $raw, true);
        $items = $decoded['fieldValue'] ?? [];

        return is_array($items) ? $items : [];
    }
}
