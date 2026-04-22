<?php
declare(strict_types=1);

namespace Experienceis\Brand\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

/**
 * Handles upload and storage of brand logo images.
 * Responsible for temporary upload handling and final file relocation.
 */
class ImageUploader
{
    private WriteInterface $mediaDirectory;

    public function __construct(
        private Filesystem $filesystem,
        private UploaderFactory $uploaderFactory,
        private StoreManagerInterface $storeManager,
        private string $baseTmpPath = 'brand/tmp/logo',
        private string $basePath = 'brand/logo',
        private array $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png']
    ) {
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * Upload file to temporary media directory
     *
     * @param string $fileId
     * @return array
     * @throws \Exception
     */
    public function saveFileToTmpDir(string $fileId): array
    {
        $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);

        $uploader->setAllowedExtensions($this->allowedExtensions);
        $uploader->setAllowRenameFiles(true);
        $uploader->setFilesDispersion(false);

        $result = $uploader->save(
            $this->mediaDirectory->getAbsolutePath($this->baseTmpPath)
        );

        // Build public URL for UI preview
        $result['url'] = $this->storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . $this->baseTmpPath . '/'
            . $result['file'];

        return $result;
    }

    /**
     * Move file from temporary directory to final destination
     *
     * This ensures uploaded files are persisted after form submission
     * and moved from tmp storage to permanent media location.
     *
     * @param string $fileName
     * @return string
     */
    public function moveFileFromTmp(string $fileName): string
    {
        $sourcePath = $this->mediaDirectory->getAbsolutePath($this->baseTmpPath) . '/' . $fileName;
        $destinationDir = $this->mediaDirectory->getAbsolutePath($this->basePath);

        // Ensure destination directory exists
        if (!$this->mediaDirectory->isDirectory($this->basePath)) {
            $this->mediaDirectory->create($this->basePath);
        }

        $destinationPath = $destinationDir . '/' . $fileName;

        // Move file only if it exists in temporary location
        if ($this->mediaDirectory->isFile($sourcePath)) {
            $this->mediaDirectory->renameFile(
                $sourcePath,
                $destinationPath
            );
        }

        return $fileName;
    }
}