<?php
// src/Blogger/BlogBundle/Entity/Blog.php

namespace Bash\NodesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
//use Iphp\FileStoreBundle\Tests\Functional\TestXmlConfigBundle\Entity\File;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
//use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


use Eko\FeedBundle\Item\Writer\ItemInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="Bash\NodesBundle\Entity\Repository\BashRepository")
 * @ORM\Table(name="quote")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Quote implements ItemInterface
{
    /**
     * @Assert\File(
     *    maxSize="2M",
     *    mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255, name="image_name", nullable=true)
     *
     * @var string $imageName
     */
    protected $imageName;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    public function getFeedItemTitle() { return $this->subject; }
    public function getFeedItemDescription() { return $this->author; }
    public function getFeedItemPubDate() { return $this->date; }
    public function getFeedItemLink() { return 0; }


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="text")
     */
    protected $subject;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $author;


    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="id")
     */
    protected $comments = array();

    /**
     * @ORM\Column(type="integer")
     */
    protected $rating;

    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

    }

    public function getComments()
    {
        return $this->comments;
    }


//    /**
//     * @ORM\Column(type="array")
//     * @FileStore\UploadableField(mapping="quotes")
//     **/
//    protected $photos;
//
//    /**
//     * Set photo
//     *
//     * @param array $photos
//     * @return Quote
//     */
//    public function setPhotos($photos)
//    {
//        $this->photos = $photos;
//
//        return $this;
//    }
//
//    /**
//     * Get photos
//     *
//     * @return array
//     */
//    public function getPhotos()
//    {
//        return $this->photos;
//    }

//    /**
//     * @ORM\OneToMany(targetEntity="Photo", mappedBy="blog_id")
//     */
//    protected $photos = array();
//
//    public function addPhoto(Photo $photo)
//    {
//        $this->photos[] = $photo;
//    }
//
//    public function getPhotos()
//    {
//        return $this->photos;
//    }


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
     * Set subject
     *
     * @param string $subject
     * @return Quote
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Quote
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Quote
     */
    public function setDate($date)
    {

        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->setDate(new \DateTime());
    }

    /**
     * Remove comments
     *
     * @param \Bash\NodesBundle\Entity\Comment $comments
     */
    public function removeComment(\Bash\NodesBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
//        $metadata->addPropertyConstraint(
//          'subject',
//          new NotBlank(array(
//            'message' => 'You must enter subject'
//          ))
//        );
    }

    public function __toString()
    {
        $string = (string) $this->getId();

        return $string;
    }







    /**
     * Set rating
     *
     * @param integer $rating
     * @return Quote
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }
}
