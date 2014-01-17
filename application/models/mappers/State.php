<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @Table(name="state")
 * @Entity
 */
class DB_State
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
     * @Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;
    
    /**
     * @var string $uf
     *
     * @Column(name="uf", type="string", length=2, nullable=false)
     */
    private $uf;

    /**
     * @var Country
     *
     * @ManyToOne(targetEntity="DB_Country")
     * @JoinColumns({
     *   @JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;



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
     * @return State
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
     * Set uf
     *
     * @param string $uf
     * @return State
     */
    public function setUf($uf)
    {
    	$this->uf = $uf;
    	return $this;
    }
    
    /**
     * Get uf
     *
     * @return string
     */
    public function getUf()
    {
    	return $this->uf;
    }

    /**
     * Set country
     *
     * @param DB_Country $country
     * @return State
     */
    public function setCountry(\DB_Country $country = null)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return DB_Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}