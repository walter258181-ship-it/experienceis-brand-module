<?php
declare(strict_types=1);

namespace Experienceis\Brand\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Experienceis\Brand\Api\BrandRepositoryInterface;
use Experienceis\Brand\Model\BrandFactory;
use Experienceis\Brand\Model\ImageUploader;
use Magento\Framework\Exception\LocalizedException;
use Experienceis\Brand\Model\ResourceModel\Brand\CollectionFactory;

class Save extends Action
{
    /**
     * @param Context $context
     * @param BrandRepositoryInterface $brandRepository
     * @param BrandFactory $brandFactory
     * @param ImageUploader $imageUploader
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        private BrandRepositoryInterface $brandRepository,
        private BrandFactory $brandFactory,
        private ImageUploader $imageUploader,
        private CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Execute save action
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $postData = $this->getRequest()->getPostValue();

        if (!$postData) {
            return $resultRedirect->setPath("*/*/");
        }

        $entityId =
            (int) ($this->getRequest()->getParam("brand_id") ?:
            $postData["brand_id"] ?? 0);

        try {
            $data = $postData["general"] ?? $postData;

            $brandName = $data["name"] ?? "";
            if ($brandName) {
                $collection = $this->collectionFactory
                    ->create()
                    ->addFieldToFilter("name", $brandName);

                if ($entityId) {
                    $collection->addFieldToFilter("brand_id", [
                        "neq" => $entityId,
                    ]);
                }

                if ($collection->getSize() > 0) {
                    throw new LocalizedException(
                        __(
                            'The brand name "%1" already exists. Please use a unique name.',
                            $brandName
                        )
                    );
                }
            }

            $model = $this->getModel($entityId);
            $data = $this->prepareData($data);

            if ($entityId) {
                $model->setBrandId($entityId);
            }

            $model->addData($data);
            $this->brandRepository->save($model);

            $this->messageManager->addSuccessMessage(
                __("The brand has been saved successfully.")
            );
            return $resultRedirect->setPath("*/*/");
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __("Something went wrong while saving the brand.")
            );
        }

        return $resultRedirect->setPath("*/*/edit", ["brand_id" => $entityId]);
    }

    /**
     * Load existing model or create new instance
     */
    private function getModel(int $entityId)
    {
        if ($entityId > 0) {
            return $this->brandRepository->getById($entityId);
        }

        return $this->brandFactory->create();
    }

    /**
     * Prepare and normalize incoming request data
     */
    private function prepareData(array $data): array
    {
        if (isset($data["logo"]) && is_array($data["logo"])) {
            if (
                isset($data["logo"][0]["name"]) &&
                isset($data["logo"][0]["tmp_name"])
            ) {
                $fileName = $data["logo"][0]["name"];
                $this->imageUploader->moveFileFromTmp($fileName);
                $data["logo"] = $fileName;
            } elseif (isset($data["logo"][0]["name"])) {
                $data["logo"] = $data["logo"][0]["name"];
            }
        } else {
            $data["logo"] = null;
        }

        if (isset($data["brand_id"])) {
            unset($data["brand_id"]);
        }

        return $data;
    }
}
