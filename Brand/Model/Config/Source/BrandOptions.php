<?php
declare(strict_types=1);

namespace Experienceis\Brand\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Experienceis\Brand\Model\ResourceModel\Brand\CollectionFactory;

/**
 * Source Model to provide Brand names to the product attribute dropdown
 */
class BrandOptions extends AbstractSource
{
    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        private CollectionFactory $collectionFactory
    ) {}

    /**
     * Get all options from the experienceis_brand table
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        if ($this->_options === null) {
            $collection = $this->collectionFactory->create();
            $this->_options = [['label' => __('-- Please Select a Brand --'), 'value' => '']];
            
            foreach ($collection as $brand) {
                $this->_options[] = [
                    'label' => $brand->getName(),
                    'value' => $brand->getId(),
                ];
            }
        }
        return $this->_options;
    }
}
