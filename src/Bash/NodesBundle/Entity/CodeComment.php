<?php
namespace Bash\NodesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="Bash\NodesBundle\Entity\Repository\CommentRepository")
 * @ORM\Table(name="code_comment")
 * @ORM\HasLifecycleCallbacks
 */
class CodeComment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $user;

    /**
     * @ORM\Column(type="text")
     */
    protected $comment;


    /**
     * @ORM\ManyToOne(targetEntity="Code", inversedBy="comments")
     * @ORM\JoinColumn(name="blog_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $blog_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;


    public function __construct()
    {
        $this->setCreated(new \DateTime());
    }


    public function getId()
    {
        return $this->id;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint(
          'comment',
          new NotBlank(array(
            'message' => 'You must enter a comment'
          ))
        );
    }



    /**
     * Set blog_id
     *
     * @param \Bash\NodesBundle\Entity\Code $blogId
     * @return Comment
     */
    public function setBlogId(\Bash\NodesBundle\Entity\Code $blogId = null)
    {
        $this->blog_id = $blogId;

        return $this;
    }

    /**
     * Get blog_id
     *
     * @return \Bash\NodesBundle\Entity\Code
     */
    public function getBlogId()
    {
        return $this->blog_id;
    }
}
