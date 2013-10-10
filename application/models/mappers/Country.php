<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @Table(name="country")
 * @Entity
 */
class DB_Country
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;
    
    /**
     * @var string $iso
     *
     * @Column(name="iso", type="string", length=2, nullable=false)
     */
    private $iso;
    
    /**
     * @var string $iso3
     *
     * @Column(name="iso3", type="string", length=3, nullable=false)
     */
    private $iso3;
    
    /**
     * @var string $numCode
     *
     * @Column(name="num_code", type="string", nullable=false)
     */
    private $numCode;



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
     * Set name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set iso
     *
     * @param string $iso
     * @return Country
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
        return $this;
    }

    /**
     * Get iso
     *
     * @return string 
     */
    public function getIso()
    {
        return $this->iso;
    }
    
    /**
     * Set iso3
     *
     * @param string $iso3
     * @return Country
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;
        return $this;
    }

    /**
     * Get iso3
     *
     * @return string 
     */
    public function getIso3()
    {
        return $this->iso3;
    }
    
    /**
     * Set num_code
     *
     * @param string $numCode
     * @return Country
     */
    public function setNumCode($numCode)
    {
        $this->numCode = $numCode;
        return $this;
    }

    /**
     * Get num_code
     *
     * @return string 
     */
    public function getNumCode()
    {
        return $this->numCode;
    }
    
    
}