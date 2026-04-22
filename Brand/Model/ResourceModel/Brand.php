<?php
declare(strict_types=1);

namespace Experienceis\Brand\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Brand Resource Model
 */
class Brand extends AbstractDb
{
    /**
     * Initialize resource model
     */
    protected function _construct(): void
    {
        // Table name and primary key field
        $this->_init('experienceis_brand', 'brand_id');
    }
}
