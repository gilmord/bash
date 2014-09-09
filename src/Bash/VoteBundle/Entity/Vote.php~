<?php
// src/MyProject/MyBundle/Entity/Vote.php

namespace Bash\VoteBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vote_quote")
 */
class Vote
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
    protected $voter;


    /**
     * @ORM\Column(type="string")
     */
    protected $value;


    /**
     * @ORM\Column(type="integer")
     */
    protected $quote;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;


    /**
     * Get quote
     *
     * @return integer
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * Set quote
     *
     * @param integer $quote
     * @return Vote
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;

        return $this;
    }

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
     * Set value
     *
     * @param integer $value
     * @return Vote
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set voter
     *
     * @param string $voter
     * @return Vote
     */
    public function setVoter($voter)
    {
        $this->voter = $voter;

        return $this;
    }

    /**
     * Get voter
     *
     * @return string
     */
    public function getVoter()
    {
        return $this->voter;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Vote
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    public function __construct()
    {
        $this->setCreated(new \DateTime());
    }
}
