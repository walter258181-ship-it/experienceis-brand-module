<?php
declare(strict_types=1);

namespace Experienceis\Brand\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Experienceis\Brand\Api\Data\BrandInterface;

/**
 * Brand Model
 */
class Brand extends AbstractModel implements BrandInterface, IdentityInterface
{
    /**#@+
     * Cache tag
     */
    public const CACHE_TAG = 'experienceis_brand';
    protected $_cacheTag = self::CACHE_TAG;
    protected $_eventPrefix = self::CACHE_TAG;
    /**#@-*/

    /**
     * Initialize model and link it to the ResourceModel
     */
    protected function _construct(): void
    {
        $this->_init(\Experienceis\Brand\Model\ResourceModel\Brand::class);
    }

    /**
     * Get identities for cache cleaning
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get Brand ID
     *
     * @return int|null
     */
    public function getBrandId(): ?int
    {
        return $this->getData(self::BRAND_ID)
            ? (int)$this->getData(self::BRAND_ID)
            : null;
    }

    /**
     * Set Brand ID
     *
     * @param int $brandId
     * @return BrandInterface
     */
    public function setBrandId(int $brandId): BrandInterface
    {
        return $this->setData(self::BRAND_ID, $brandId);
    }

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return BrandInterface
     */
    public function setName(string $name): BrandInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get Description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Set Description
     *
     * @param string|null $description
     * @return BrandInterface
     */
    public function setDescription(?string $description): BrandInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get Logo Path
     *
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->getData(self::LOGO);
    }

    /**
     * Set Logo Path
     *
     * @param string|null $logo
     * @return BrandInterface
     */
    public function setLogo(?string $logo): BrandInterface
    {
        return $this->setData(self::LOGO, $logo);
    }
}