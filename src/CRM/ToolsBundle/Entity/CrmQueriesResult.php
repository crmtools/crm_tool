<?php

namespace CRM\ToolsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmQueriesResult
 *
 * @ORM\Table(name="crm_queries_result")
 * @ORM\Entity(repositoryClass="CRM\ToolsBundle\Repository\CrmQueriesResultRepository")
 */
class CrmQueriesResult
{
    /**
     * @ORM\ManyToOne(targetEntity="CRM\ToolsBundle\Entity\CrmQueries")
     * @ORM\JoinColumn(name="query_id")
     */
    private $crmQueries;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="queryName", type="string", length=255)
     */
    private $queryName;

    /**
     * @var int
     *
     * @ORM\Column(name="queryResult", type="integer")
     */
    private $queryResult;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="queryDate", type="date")
     */
    private $queryDate;


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
     * Set queryName
     *
     * @param string $queryName
     * @return CrmQueriesResult
     */
    public function setQueryName($queryName)
    {
        $this->queryName = $queryName;

        return $this;
    }

    /**
     * Get queryName
     *
     * @return string 
     */
    public function getQueryName()
    {
        return $this->queryName;
    }

    /**
     * Set queryResult
     *
     * @param integer $queryResult
     * @return CrmQueriesResult
     */
    public function setQueryResult($queryResult)
    {
        $this->queryResult = $queryResult;

        return $this;
    }

    /**
     * Get queryResult
     *
     * @return integer 
     */
    public function getQueryResult()
    {
        return $this->queryResult;
    }

    /**
     * Set queryDate
     *
     * @param \DateTime $queryDate
     * @return CrmQueriesResult
     */
    public function setQueryDate($queryDate)
    {
        $this->queryDate = $queryDate;

        return $this;
    }

    /**
     * Get queryDate
     *
     * @return \DateTime 
     */
    public function getQueryDate()
    {
        return $this->queryDate;
    }

    /**
     * Set crmQueries
     *
     * @param \CRM\ToolsBundle\Entity\CrmQueries $crmQueries
     * @return CrmQueriesResult
     */
    public function setCrmQueries(\CRM\ToolsBundle\Entity\CrmQueries $crmQueries = null)
    {
        $this->crmQueries = $crmQueries;

        return $this;
    }

    /**
     * Get crmQueries
     *
     * @return \CRM\ToolsBundle\Entity\CrmQueries 
     */
    public function getCrmQueries()
    {
        return $this->crmQueries;
    }
}
