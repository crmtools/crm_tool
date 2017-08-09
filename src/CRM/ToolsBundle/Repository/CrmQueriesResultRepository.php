<?php

namespace CRM\ToolsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Tests\EventListener\ValidateRequestListenerTest;

/**
 * CrmQueriesResultRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CrmQueriesResultRepository extends EntityRepository
{
    public function getDataQualityTable($groupsName, $date_array){

//        $sql= "SELECT * FROM P1RCST.ERR_BOOKING_CP  WHERE ID_CONTACT = 675039";
//        $sql= "select count(*) AS NB_Queries from P1RCST.CLI_CONTACT";


        $groupsName = $groupsName;
        $dataQualities= array();
        foreach ($groupsName as $group) {
            $sql =
                "SELECT crm_queries.id, crm_queries_result.queryName, \n";

            foreach($date_array as $key => $current_date) {
                $tmp = 1;
                $array_length = sizeof($date_array);

                if ($key == ($array_length - $tmp)) {
                    $sql .= "max(case when queryDate = '$current_date' then queryResult end) as '$current_date' \n";
                } else {
                    $sql .= "max(case when queryDate = '$current_date' then queryResult end) as '$current_date', \n";
                }
            }

            $sql = substr($sql,0,strlen($sql) - 2);
            $sql .= " \n";
            $sql .= "FROM crm_queries_result INNER JOIN crm_queries ON crm_queries_result.queryName = crm_queries.queryName 
		    WHERE crm_queries.pageName = 'error_analysis' AND crm_queries.GroupName = '".$group['groupName']."' group by queryName order by enableDisplay";
            $em = $this->getEntityManager();
            $query = $em->getConnection()->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $groupName= $group['groupName'];
            $dataQualities[$groupName]= $result;

        }
        return $dataQualities;
    }

    public function getOneQueryText($query_id, $current_date){

        if($current_date){
            $sqlDeleteQueryResult = "DELETE FROM crm_queries_result WHERE queryDate = '" . $current_date . "' AND query_id = '" . $query_id . "'";
            $em = $this->getEntityManager();
            $query = $em->getConnection()->prepare($sqlDeleteQueryResult);
            $query->execute();
        }
        $sqlQueryText = "SELECT queryText FROM crm_queries WHERE id = '" . $query_id . "'";
//        echo $sqlQueryText;die;

        $em = $this->getEntityManager();
        $query = $em->getConnection()->prepare($sqlQueryText);
        $query->execute();
        $queryTextArray = $query->fetchAll();
        $queryText = $queryTextArray[0]['queryText'];
        return $queryText;
    }

    public function getResultFromUcr($queryText){

//        $sql= $queryText;
//        echo $sql;die;
//        var_dump($queryText);die;
//        $sql = "select count(*) AS NB_Queries from P1RCST.CLI_CONTACT";
        $sql = "select count(*) AS NB_Contact from Q5RCPV.CLI_CONTACT";
//        echo $queryTest;die;

        $em = $this->getEntityManager();
        $query = $em->getConnection()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
//        var_dump($result);die;
        return $result;

//        delete from result_quality where Query_Date = '$date' and Query_Name = 'Incoherence_MD5_Email'
//        var_dump($queryText);die;
//
//        $sqlGrpName = "SELECT groupName from crm_queries WHERE pageName = 'brahim' group by groupName";
//        $em = $this->getEntityManager();
//        $query = $em->getConnection()->prepare($sqlGrpName);
//        $query->execute();
//        $groupsName = $query->fetchAll();
//        return $groupsName;
    }

    public function test(){

        $queryTest = "select count(*) AS NB_Queries from P1RCST.CLI_CONTACT";
//        echo $queryTest;die;
        $em = $this->getEntityManager();
        $query = $em->getConnection()->prepare($queryTest);
        $query->execute();
        $test = $query->fetchAll();
        var_dump($test);die;
    }
}
