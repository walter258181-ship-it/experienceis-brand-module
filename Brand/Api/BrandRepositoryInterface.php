<?php
declare(strict_types=1);

namespace Experienceis\Brand\Api;

use Experienceis\Brand\Api\Data\BrandInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Experienceis\Brand\Api\Data\BrandSearchResultsInterface;

/**
 * Brand Repository Interface
 * @api
 */
interface BrandRepositoryInterface
{
    /**
     * Save brand
     *
     * @param \Experienceis\Brand\Api\Data\BrandInterface $brand
     * @return \Experienceis\Brand\Api\Data\BrandInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(BrandInterface $brand);

    /**
     * Get brand by ID
     *
     * @param int $brandId
     * @return \Experienceis\Brand\Api\Data\BrandInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $brandId);

    /**
     * Get brand list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Experienceis\Brand\Api\Data\BrandSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete brand
     *
     * @param \Experienceis\Brand\Api\Data\BrandInterface $brand
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(BrandInterface $brand);

    /**
     * Delete brand by ID
     *
     * @param int $brandId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $brandId);
}
