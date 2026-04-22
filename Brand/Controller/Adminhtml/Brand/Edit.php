<?php
declare(strict_types=1);

namespace Experienceis\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    public const ADMIN_RESOURCE = 'Experienceis_Brand::brand_manage';

    public function __construct(
        Context $context,
        private PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('brand_id');
        
        $resultPage->setActiveMenu('Experienceis_Brand::brand_root');
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Brand') : __('New Brand'));

        return $resultPage;
    }
}
