<?php
declare(strict_types=1);

namespace Experienceis\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Brand Index Controller
 * This controller handles the main listing page in the Admin.
 */
class Index extends Action
{
    /**
     * Authorization level of a basic admin session
     * Matches the resource defined in acl.xml
     */
    public const ADMIN_RESOURCE = 'Experienceis_Brand::brand_manage';

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        private PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Execute the action and return the result page
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        
        // Mark the menu item as active
        $resultPage->setActiveMenu('Experienceis_Brand::brand_root');
        
        // Set the title of the page
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Brands'));

        return $resultPage;
    }
}
