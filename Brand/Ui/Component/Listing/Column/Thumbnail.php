<?php
declare(strict_types=1);

namespace Experienceis\Brand\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Thumbnail extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        private StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['logo']) && $item['logo']) {
                    $url = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) 
                        . 'brand/logo/' . $item['logo'];
                    $item[$fieldName . '_src'] = $url;
                    $item[$fieldName . '_alt'] = $item['name'] ?? '';
                    $item[$fieldName . '_link'] = $this->context->getUrl(
                        'experienceis_brand/brand/edit', 
                        ['brand_id' => $item['brand_id']]
                    );
                    $item[$fieldName . '_orig_src'] = $url;
                }
            }
        }
        return $dataSource;
    }
}
