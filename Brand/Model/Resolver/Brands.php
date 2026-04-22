<?php
declare(strict_types=1);

namespace Experienceis\Brand\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Experienceis\Brand\Model\ResourceModel\Brand\CollectionFactory;

/**
 * Resolver for Brand list in GraphQL
 */
class Brands implements ResolverInterface
{
    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(private CollectionFactory $collectionFactory) {}

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $collection = $this->collectionFactory->create();
        return $collection->getData();
    }
}
