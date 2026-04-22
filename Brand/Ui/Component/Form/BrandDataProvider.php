<?php
declare(strict_types=1);

namespace Experienceis\Brand\Ui\Component\Form;

use Experienceis\Brand\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class BrandDataProvider extends AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        private StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collection = $collectionFactory->create();
    }

    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        $mediaUrl = $this->storeManager
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        foreach ($items as $brand) {
            $brandData = $brand->getData();

            if (
                isset($brandData["logo"]) &&
                $brandData["logo"] &&
                is_string($brandData["logo"])
            ) {
                $logoName = $brandData["logo"];

                $fullUrl = $mediaUrl . "brand/logo/" . ltrim($logoName, "/");

                $brandData["logo"] = [
                    [
                        "name" => $logoName,
                        "url" => $fullUrl,
                        "size" => 0,
                    ],
                ];
            }

            $this->loadedData[$brand->getId()] = $brandData;

            $this->loadedData["items"][] = $brand->getData();
        }

        if (
            $this->getName() === "experienceis_brand_brand_listing_data_source"
        ) {
            return [
                "totalRecords" => $this->collection->getSize(),
                "items" => array_values($this->loadedData["items"] ?? []),
            ];
        }

        return $this->loadedData ?? [];
    }
}
