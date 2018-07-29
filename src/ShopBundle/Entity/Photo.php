<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SplFileInfo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="photos")
 */
class Photo
{
    const SERVER_PATH_TO_IMAGE_FOLDER = '/images';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="photos")
     */
    protected $product;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Photo
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param UploadedFile|null $url
     * @return $this
     */
    public function setFile(UploadedFile $url = null)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set product
     *
     * @param \ShopBundle\Entity\Product $product
     *
     * @return Photo
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return \ShopBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     *
     */
    public function upload()
    {
        if (null === $this->getUrl() || !($this->getUrl() instanceof File)) {
            return;
        }
        $info = new SplFileInfo($this->getUrl()->getClientOriginalName());
        $fileName = date('U') . '.' . $info->getExtension();
        $this->getUrl()->move(WEB_DIRECTORY . Photo::SERVER_PATH_TO_IMAGE_FOLDER, $fileName);
        $this->url = Photo::SERVER_PATH_TO_IMAGE_FOLDER . '/' . $fileName;
    }


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }

    /**
     *
     */
    public function refreshUpdated() { }

    function __toString()
    {
        return ($this->getUrl() != null) ? $this->getUrl() : '';
    }


}
