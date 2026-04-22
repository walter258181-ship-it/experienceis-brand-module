<?php
declare(strict_types=1);

namespace Experienceis\Brand\Model\ResourceModel\Brand;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Experienceis\Brand\Model\Brand as BrandModel;
use Experienceis\Brand\Model\ResourceModel\Brand as BrandResource;

/**
 * Brand Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'brand_id';

    /**
     * Initialize collection
     */
    protected function _construct(): void
    {
        $this->_init(BrandModel::class, BrandResource::class);
    }
}
