<?php
declare(strict_types=1);

namespace Experienceis\Brand\Model;

use Experienceis\Brand\Api\BrandRepositoryInterface;
use Experienceis\Brand\Api\Data\BrandInterface;
use Experienceis\Brand\Api\Data\BrandSearchResultsInterfaceFactory;
use Experienceis\Brand\Model\ResourceModel\Brand as BrandResource;
use Experienceis\Brand\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface; // AÑADIR ESTO
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class BrandRepository implements BrandRepositoryInterface
{
    public function __construct(
        private BrandResource $resource,
        private BrandFactory $brandFactory,
        private CollectionFactory $collectionFactory,
        private BrandSearchResultsInterfaceFactory $searchResultsFactory,
        private CollectionProcessorInterface $collectionProcessor // INYECTAR ESTO
    ) {}

    public function save(BrandInterface $brand)
    {
        try {
            $this->resource->save($brand);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $brand;
    }

    public function getById(int $brandId)
    {
        $brand = $this->brandFactory->create();
        $this->resource->load($brand, $brandId);
        if (!$brand->getId()) {
            throw new NoSuchEntityException(__('Brand with ID "%1" does not exist.', $brandId));
        }
        return $brand;
    }

    public function delete(BrandInterface $brand)
    {
        try {
            $this->resource->delete($brand);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    public function deleteById(int $brandId)
    {
        return $this->delete($this->getById($brandId));
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        
        // ESTA LÍNEA ES CLAVE: Aplica filtros, orden y paginación de la API
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
