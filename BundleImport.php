<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 09.03.18
 * Time: 15:13
 */

namespace CoreBundle\Model;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class BundleImport
 * @package CoreBundle\Model
 */
class BundleImport
{
    /**
     * @var UploadedFile|File
     *
     * @Assert\File(
     *     maxSize="16M",
     *     mimeTypes = {"application/zip", "application/x-pdf"}
     * )
     * @AppAssert\ProperMimeType
     */
    protected $file;
}
