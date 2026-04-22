<?php
declare(strict_types=1);

namespace Experienceis\Brand\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class BrandActions extends Column
{
    private UrlInterface $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as &$item) {
            if (!isset($item['brand_id'])) {
                continue;
            }

            $item[$this->getData('name')] = [

                'edit' => [
                    'href' => $this->urlBuilder->getUrl(
                        'experienceis_brand/brand/edit',
                        ['brand_id' => $item['brand_id']]
                    ),
                    'label' => __('Edit')
                ],

                'delete' => [
                    'href' => $this->urlBuilder->getUrl(
                        'experienceis_brand/brand/delete',
                        ['brand_id' => $item['brand_id']]
                    ),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete Brand'),
                        'message' => __('Are you sure you want to delete this brand?')
                    ]
                ]
            ];
        }

        return $dataSource;
    }
}