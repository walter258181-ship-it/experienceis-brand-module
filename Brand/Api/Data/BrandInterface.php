<?php
declare(strict_types=1);

namespace Experienceis\Brand\Api\Data;

/**
 * Brand Interface
 * @api
 */
interface BrandInterface
{
    public const BRAND_ID   = 'brand_id';
    public const NAME       = 'name';
    public const DESCRIPTION = 'description';
    public const LOGO       = 'logo';

    /**
     * @return int|null
     */
    public function getBrandId(): ?int;

    /**
     * @param int $brandId
     * @return \Experienceis\Brand\Api\Data\BrandInterface
     */
    public function setBrandId(int $brandId): BrandInterface;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $name
     * @return \Experienceis\Brand\Api\Data\BrandInterface
     */
    public function setName(string $name): BrandInterface;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     * @return \Experienceis\Brand\Api\Data\BrandInterface
     */
    public function setDescription(?string $description): BrandInterface;

    /**
     * @return string|null
     */
    public function getLogo(): ?string;

    /**
     * @param string|null $logo
     * @return \Experienceis\Brand\Api\Data\BrandInterface
     */
    public function setLogo(?string $logo): BrandInterface;
}
