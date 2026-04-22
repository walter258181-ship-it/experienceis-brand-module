<?php
declare(strict_types=1);

namespace Experienceis\Brand\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Experienceis\Brand\Api\BrandRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * ViewModel for providing Brand information to the product frontend page.
 */
class BrandInfo implements ArgumentInterface
{
    /**
     * XML Path for the module configuration
     */
    private const XML_PATH_ENABLED = 'experienceis_brand/general/enabled';

    /**
     * @param RequestInterface $request
     * @param ProductRepositoryInterface $productRepository
     * @param BrandRepositoryInterface $brandRepository
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private RequestInterface $request,
        private ProductRepositoryInterface $productRepository,
        private BrandRepositoryInterface $brandRepository,
        private StoreManagerInterface $storeManager,
        private ScopeConfigInterface $scopeConfig
    ) {}

    /**
     * Check if the brand display is enabled in System Configuration
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get the current product from the request
     *
     * @return \Magento\Catalog\Api\Data\ProductInterface|null
     */
    public function getProduct()
    {
        $productId = (int)$this->request->getParam('id');
        if (!$productId) {
            return null;
        }

        try {
            return $this->productRepository->getById($productId);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get Brand data associated with the product
     *
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return \Experienceis\Brand\Api\Data\BrandInterface|null
     */
    public function getBrandData($product)
    {
        $brandId = $product->getCustomAttribute('brand_id')?->getValue();
        if (!$brandId) {
            return null;
        }

        try {
            return $this->brandRepository->getById((int)$brandId);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Build the full URL for the brand logo
     *
     * @param string|null $logoName
     * @return string
     */
    public function getLogoUrl(?string $logoName): string
    {
        if (!$logoName) {
            return '';
        }

        return $this->storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'brand/logo/' . $logoName;
    }
}
