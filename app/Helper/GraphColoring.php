<?php
/**
* Implementation of a New Graph Coloring Algorithm
*
* @PHPVER : 5.0
* @author : MA Razzaque Rupom <rupom_315@yahoo.com>, <rupom.bd@gmail.com>
* Moderator, phpResource (http://groups.yahoo.com/group/phpresource/)
* URL: http://www.rupom.info
*
* @version : 1.0
* Date : 05/16/2006
* Purpose : Coloring Connected Graph with a New Approach
*/

namespace EasyShop\Helper;

class GraphColoring
{
   private $graph = array();
   private $savedGraph = array();
   private $colored = array();
   private $colors = array();
   private $k = 1;
   private $d = 0;
   private $source;
   private $sourceType;
   private $vertexTotal;
   private $vertexNo;
   private $addedToGraph = [];
   private $map = [];
   private $flippedMap = false;

    function getFromFlippedMap($mappedKey)
    {
        if ($this->flippedMap === false)
        {
            $this->flippedMap = array_flip($this->map);
        }
        return $this->flippedMap[$mappedKey];
    }

    function needToAddToGraph($key)
    {
        return !in_array($key, $this->addedToGraph);
    }

    /* insert and return mapped keys */
    function mapSomeKeys($keys)
    {
       $result = [];
       $mappedValue = empty($this->map) ? 2 : max($this->map) + 1;
       $keys = is_array($keys) ? $keys : [$keys];
       foreach ($keys as $key)
       {
           if (!isset($this->map[$key]))
           {
               $result[] = $mappedValue;
               $this->map[$key] = $mappedValue;
               $mappedValue++;
           }
           else
           {
               $result[] = $this->map[$key];
           }
       }
       return $result;
    }

   /*
   No. of Colors : count($this->colors))
   foreach($this->colors as $i=>$v)
   {
      "Color : $i"
      'Vertices : '.implode(",", $v)
   }
   */
   function getColors()
   {
       return $this->colors;
   }

   function addToGraph($from, $toArray = [])
   {
       $addedToGraph[] = $from;
       $toArray = is_array($toArray) ? $toArray : [$toArray];
       foreach ($toArray as $dest)
       {
           $this->graph[$from][$dest] = 1;
           $this->graph[$dest][$from] = 1;
           $this->savedGraph[$from][$dest] = 1;
           $this->savedGraph[$dest][$from] = 1;
       }
   }

    function fillGaps() {
        $this->vertexTotal = count($this->graph);

        if(count($this->graph))
        {
          for($i=1; $i <= $this->vertexTotal; $i++)
          {
             for($j=1; $j <= $this->vertexTotal; $j++)
             {
                if(!isset($this->graph[$i])
                    || !isset($this->graph[$i][$j])
                    || $this->graph[$i][$j] != 1)
                {
                   $this->graph[$i][$j] = 0;
                   $this->savedGraph[$i][$j] = 0;
                }
             }
          }
        }
   }

   /**
   * Initializes the source and source type
   * @param $source, $source type
   * @return none
   */
   function initSource($source, $sourceType = "file")
   {
      $this->source = $source;
      //$this->vertexTotal = $vertexTotal;
      $this->sourceType = $sourceType;
   }

   /**
   * Initializes the graph to be colored
   * @param none
   * @return none
   */
   function initGraph()
   {
      $isValidFile = ($this->sourceType == "file" && file_exists(trim($this->source)));

      if($isValidFile)
      {
         $this->getGraphFromFile($this->source);
      }
      elseif($this->sourceType == "DB")
      {
         $this->getGraphFromDb($this->source);
      }
      else
      {
         die("Invalid Information");
      }

   }//EO initGraph()

   /**
   * Colors and recovers the graph repeatedly
   * @param none
   * @return none
   */
   function initColoring()
   {
      $this->vertexNo = $this->vertexTotal;
      $this->dBug('No. of Vertices of the Input Graph : '.$this->vertexNo);
      $this->dBug('------ Array Representation of the Input Graph --------');
      $this->dBug($this->graph);
      $this->dBug('-------------------------------------------------------');


      while($this->vertexNo)
      {
             $this->colorTheGraph();
          $this->recoverTheGraph();
      }


   }//EOFn

   /**
   * Colors the graph
   * @param none
   * @return none
   */
   function colorTheGraph()
   {
      $this->d++; //No. of colors

      for($i=1;$i<=$this->vertexTotal;$i++)
      {
          for($j=1;$j<=$this->vertexTotal;$j++)
          {
             if($this->graph[$i][$j] == 1)
             {
                $this->vertexNo = $this->vertexNo - 1; //remaining vertices
                $this->k++;
                $this->colored[$this->k] = $i; // storage of colored vertices
                $this->colors[$this->d][$this->k] = $i; // storage of colored vertices
                $this->processGraph($i);
             }
             else
             {
                $this->graph[$i][$j] = 0;
             }
          }
      }
   }//EOFn

   /**
   * Displays color result
   * @param none
   * @return none
   */
   function displayColorResult()
   {
         $this->dBug('------------ Coloring Result ---------------------');
      $this->dBug('No. of Colors : '.count($this->colors));
      foreach($this->colors as $i=>$v)
      {
         $this->dBug("Color : $i");
         $this->dBug('Vertices : '.implode(",", $v));
      }

      $this->dBug('--------------------------------------------------');

   }//EOFn

   /**
   * Disconnects a colered vertex from its connected ones -- duplex disconnection
   * @param colored vertex
   * @return none
   */
   function processGraph($j)
   {
      for($i=1;$i<=$this->vertexTotal; $i++)
      {
         if($this->graph[$j][$i]==1)
         {
            $this->graph[$j][$i]=0;
            $this->subProcess($i);
         }
      }
   }//EOfn

   /**
   * Disconnects a vertex(which is connected to a colored vertex) from its connected ones -- simplex disconnection
   * @param a vertex connected to the newly colored vertex
   * @return none
   */
   function subProcess($m)
   {
      for($i=1;$i<=$this->vertexTotal;$i++)
      {
         if($this->graph[$m][$i]==1)
         {
            $this->graph[$m][$i]=0;
         }
      }

   }//EOFn

  function recoverTheGraph()
  {
      for($i=1 ; $i<=$this->vertexTotal ; $i++)
      {
         for($j=1 ; $j<=$this->vertexTotal ; $j++)
         {
             if(!array_search($i, $this->colored))
             {
                  $this->graph[$i][$j]=$this->savedGraph[$i][$j];
             }
             else
             {
                  $this->graph[$i][$j]=0;
                  $this->graph[$j][$i]=0;
             }
         }
      }

  }//EOFn

  /**
  * Gets graph data from file
  * @param filename
  * @return none
  */
  function getGraphFromFile($file)
  {
       if(file_exists($file))
       {

        $verttices = array();
        $vertices = file($file);

        if(count($vertices))
        {
           if(count($vertices))
           {
              foreach($vertices as $v)
              {
                 list($i, $j) = explode(' ', trim($v));

                 // Initializing the graph - Initializing the connections
                 $this->graph[$i][$j] = 1;
                 $this->graph[$j][$i] = 1;
                 $this->savedGraph[$i][$j] = 1;
                 $this->savedGraph[$j][$i] = 1;
              }

           }
        }
        else
        {
           die("Error : Graph Does Not Exist");
        }

     }
     else
     {
        die("Error : File Does Not Exist");
     }

     $this->vertexTotal = count($this->graph); //Total vertices

     if(count($this->graph))
     {
        for($i=1; $i <= $this->vertexTotal; $i++)
        {
           for($j=1; $j <= $this->vertexTotal; $j++)
           {
              if($this->graph[$i][$j]!=1)
              {
                 $this->graph[$i][$j] = 0;
                 $this->savedGraph[$i][$j] = 0;
              }
           }
        }
     }

  }//EOFn

  /**
  * Gets graph data from database
  * @param tablename
  * @return none
  */
  function getGraphFromDb($sourceTable)
  {
       //DB Connection
     mysql_connect("localhost","root","");
     mysql_select_db("test");

     $q = "SELECT * FROM $sourceTable";
     $res = mysql_query($q);

     // If data found
     if(mysql_num_rows($res))
     {
        while($row = mysql_fetch_array($res))
        {
              $i = trim($row['vertex']);
              $j = trim($row['connected_to']);

             // Initializing the graph - Initializing the connections
           $this->graph[$i][$j] = 1;
           $this->graph[$j][$i] = 1;
           $this->savedGraph[$i][$j] = 1;
           $this->savedGraph[$j][$i] = 1;
        }
     }
     else
     {
        die("Data Invalid OR Does Not Exist..");
     }

     $this->vertexTotal = count($this->graph); //Total vertices

     //Filling up the reminding connections with zero
     if(count($this->graph))
     {
        for($i=1; $i <= $this->vertexTotal; $i++)
        {
           for($j=1; $j <= $this->vertexTotal; $j++)
           {
              if($this->graph[$i][$j]!=1)
              {
                 $this->graph[$i][$j] = 0;
                 $this->savedGraph[$i][$j] = 0;
              }
           }
        }
     }
  }//EOFn

  /**
  * Displays/dumps data
  * @param data to be dumped
  * @return none
  */
  function dBug($dump)
  {
      return;
     echo "<PRE>";
     print_r($dump);
     echo "</PRE>";
  }//EOFn

}//EO Class GraphColoring
