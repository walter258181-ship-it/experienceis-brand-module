<?php
declare(strict_types=1);

namespace Experienceis\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Experienceis\Brand\Model\ImageUploader;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Upload Controller for AJAX image handling
 */
class Upload extends Action
{
    public const ADMIN_RESOURCE = 'Experienceis_Brand::brand_manage';

    public function __construct(
        Context $context,
        private ImageUploader $imageUploader
    ) {
        parent::__construct($context);
    }

    /**
     * Upload file and return JSON result
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('logo');
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
