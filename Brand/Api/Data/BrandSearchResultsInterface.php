<?php
declare(strict_types=1);

namespace Experienceis\Brand\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for brand search results.
 * @api
 */
interface BrandSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get brands list.
     *
     * @return \Experienceis\Brand\Api\Data\BrandInterface[]
     */
    public function getItems();

    /**
     * Set brands list.
     *
     * @param \Experienceis\Brand\Api\Data\BrandInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
