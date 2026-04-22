<?php
declare(strict_types=1);

namespace Experienceis\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Experienceis\Brand\Api\BrandRepositoryInterface;

class Delete extends Action
{
    public const ADMIN_RESOURCE = 'Experienceis_Brand::brand_manage';

    public function __construct(
        Context $context,
        private BrandRepositoryInterface $brandRepository
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('brand_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                $this->brandRepository->deleteById((int)$id);
                $this->messageManager->addSuccessMessage(__('The brand has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['brand_id' => $id]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
