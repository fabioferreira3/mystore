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