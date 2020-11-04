<?php

namespace App\Library\Ofac;

class Chart
{
    /**
     * @var string id
     */
    public $id;

    /**
     * @var string title
     */
    public $title;

    /**
     * @var string data
     */
    public $data;

    /**
     * @var array path
     */
    public $path;

    /**
     * @var string type
     */
    public $type;

    /**
     * @var array legend
     */
    public $legend = array();

    /**
     * @var array xAxis
     */
    public $xAxis = array();

    /**
     * @var array yAxis
     */
    public $yAxis = array();

    /**
     * @var array series
     */
    public $series = array();


    /**
     * Chart constructor.
     * @param string $id
     * @param object $data
     * @param array $path
     * @param string $type
     */
    public function __construct($id, $data, array $path, $type)
    {
        $this->id = $id;
        $this->data = $data;
        $this->path = $path;
        $this->type = $type;

        $this->render();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdJson()
    {
        return json_encode($this->id);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        if($this->title != '') {
            return $this->title;
        } else {
            return '';
        }
    }

    /**
     * @return string
     */
    public function getTitleJson()
    {
        if($this->title != '') {
            return json_encode($this->title);
        } else {
            return json_encode('');
        }
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getDataJson()
    {
        return json_encode($this->data);
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @return string
     */
    public function getLegendJson()
    {
        return json_encode($this->legend);
    }

    /**
     * @param array $legend
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;
    }

    /**
     * @param string $legend
     */
    public function addLegend($legend)
    {
        $this->legend[] = $legend;
    }

    /**
     * @return array
     */
    public function getXAxis()
    {
        if(!empty($this->xAxis)) {
            return $this->xAxis;
        } else {
            return array();
        }
    }

    /**
     * @return string
     */
    public function getXAxisJson()
    {
        if(!empty($this->xAxis)) {
            return json_encode($this->xAxis);
        } else {
            return json_encode(array());
        }
    }

    /**
     * @param string $xAxis
     */
    public function setXAxis($xAxis)
    {
        $this->xAxis = $xAxis;
    }

    /**
     * @param string $xAxis
     */
    public function addXAxis($xAxis)
    {
        $this->xAxis[] = $xAxis;
    }

    /**
     * @return array
     */
    public function getYAxis()
    {
        if(!empty($this->yAxis)) {
            return $this->yAxis;
        } else {
            return array();
        }
    }

    /**
     * @return string
     */
    public function getYAxisJson()
    {
        if(!empty($this->yAxis)) {
            return json_encode($this->yAxis);
        } else {
            return json_encode(array());
        }
    }

    /**
     * @param string $yAxis
     */
    public function setYAxis($yAxis)
    {
        $this->yAxis = $yAxis;
    }

    /**
     * @param string $yAxis
     */
    public function addYAxis($yAxis)
    {
        $this->yAxis[] = $yAxis;
    }

    /**
     * @return array
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @return string
     */
    public function getSeriesJson()
    {
        return json_encode($this->series);
    }

    /**
     * @param string $series
     */
    public function setSeries($series)
    {
        $this->series = $series;
    }

    /**
     * @param $series
     * @return void
     */
    public function addSeries($series)
    {
        $this->series[] = $series;
    }


    protected function render()
    {

        if($this->getType() == 'bar') {
            $arrayAllColors = array(
                array('#70d79d', '#53a46f'),
                array('#344552', '#7baeb6'),
                array('#dc9375', '#c3473d')
            );

            $arrayColor = $arrayAllColors[rand(0, count($arrayAllColors) - 1)];


            $path = $this->getPath();
            $data = $this->getData();
            $pathData = '';

            // Chemin de base
            for ($i = 0; $i < count($path['path']); $i++) {
                if($i != count($path['path'])-1) {
                    $pathData .= $path['path'][$i].'->';
                } else {
                    $pathData .= $path['path'][$i];
                }
            }

            $data = static::convertStringToObject($data, $pathData);

            // Récupération des items
            for ($j = 0; $j < count($path['series']['data']); $j++) {

                $this->addLegend(ucfirst($path['series']['data'][$j]['title']));

                // Instanciation Series
                $serie = new \stdClass();
                $serie->name = ucfirst($path['series']['data'][$j]['title']);
                $serie->type = $path['series']['data'][$j]['type'];
                $serie->data = array();
                $serie->color = $arrayColor[$j];

                if(count($path['series']['data']) == 2 && $j == 1) {
                    $serie->yAxisIndex = 1;
                }

                $xAxisName = array();
                for ($i = 0; $i < count($data); $i++) {

                    if(isset($path['series']['limit']) && intval($path['series']['limit'] - 1) < $i) {
                        break;
                    }

                    // AxeX - Récupération des names
                    $xAxisName[] = ucfirst(static::convertStringToObject($data[$i], $path['series']['title']));

                    // Series - Récupération des informations
                    $pathChild = '';
                    for ($k = 0; $k < count($path['series']['data'][$j]['data']); $k++) {

                        if ($k != count($path['series']['data'][$j]['data']) - 1) {
                            $pathChild .= $path['series']['data'][$j]['data'][$k] . '->';
                        } else {
                            $pathChild .= $path['series']['data'][$j]['data'][$k];
                        }
                    }

                    $serie->data[] = static::convertStringToObject($data[$i], $pathChild);

                }

                // Series - Ajout dans l'object
                $this->addSeries($serie);

                // AxeX - Création de l'axe des X
                $axex = new \stdClass();
                $axex->type = 'category';
                $axex->data = $xAxisName ;
                $axisPointer = new \stdClass();
                $axisPointer->type = 'shadow';
                $axex->axisPointer = $axisPointer;
                $axisLabel = new \stdClass();
                $axisLabel->fontSize = 8;
                $axisLabel->rotate = 25;
                $axex->axisLabel = $axisLabel;

                $this->setXAxis(array($axex));

                // AxeY - Création de l'axe des Y
                $axey = new \stdClass();
                $axey->type = 'value';
                $axey->name = ucfirst($path['series']['data'][$j]['title']);
                $axey->color = ucfirst($path['series']['data'][$j]['title']);
                $lineStyle = new \stdClass();
                $lineStyle->color = $arrayColor[$j];
                $axisLabel = new \stdClass();
                $axisLabel->lineStyle = $lineStyle;

                $axey->axisLine = $axisLabel;

                $this->addYAxis($axey);
            }

        } elseif($this->getType() == 'bar-progress') {

            $arrayAllColors = array(
                array('#70d79d', '#53a46f'),
                array('#344552', '#7baeb6'),
                array('#dc9375', '#c3473d')
            );

            $arrayColor = $arrayAllColors[rand(0, count($arrayAllColors) - 1)];

            $path = $this->getPath();
            $data = $this->getData();
            $pathData = '';

            // Chemin de base
            for ($i = 0; $i < count($path['path']); $i++) {
                if($i != count($path['path'])-1) {
                    $pathData .= $path['path'][$i].'->';
                } else {
                    $pathData .= $path['path'][$i];
                }
            }

            $data = $this->convertStringToObject($data, $pathData);

            // Récupération des items
            for ($j = 0; $j < count($path['series']['data']); $j++) {

                $this->addLegend(ucfirst($path['series']['data'][$j]['title']));

                // Instanciation Series
                $serie = new \stdClass();
                $serie->name = 'Réalisé';
                $serie->type = $path['series']['data'][$j]['type'];
                $serie->data = array();
                $serie->color = "#c23531";
                $serie->stack = "1";

                if(count($path['series']['data']) == 2 && $j == 1) {
                    $serie->yAxisIndex = 1;
                }

                $serie2 = new \stdClass();
                $serie2->name = 'Non Réalisé';
                $serie2->type = $path['series']['data'][$j]['type'];
                $serie2->data = array();
                $serie2->color = "#c3c3c3";
                $serie2->stack = "1";

                if(count($path['series']['data']) == 2 && $j == 1) {
                    $serie2->yAxisIndex = 1;
                }

                $xAxisName = array();

                for ($i = 0; $i < count($data); $i++) {

                    if(isset($path['series']['limit']) && intval($path['series']['limit'] - 1) < $i) {
                        break;
                    }

                    // AxeX - Récupération des names
                    if(isset($path['series']['data'][$j]['subitem'])) {
                        $xAxisName[] = 'Résultat attendu n°'.($i+1);
                    } else {
                        $xAxisName[] = 'Objectif spécifique n°'.($i+1);
                    }


                    // Series - Récupération des informations
                    $pathChild = '';
                    for ($k = 0; $k < count($path['series']['data'][$j]['data']); $k++) {
                        if ($k != count($path['series']['data'][$j]['data']) - 1) {
                            $pathChild .= $path['series']['data'][$j]['data'][$k] . '->';
                        } else {
                            $pathChild .= $path['series']['data'][$j]['data'][$k];
                        }
                    }

                    $serie->data[] = $this->convertStringToObject($data[$i], $pathChild);
                    $serie2->data[] = 100 - $this->convertStringToObject($data[$i], $pathChild);

                }

                // Series - Ajout dans l'object
                $this->addSeries($serie);
                $this->addSeries($serie2);


                // AxeX - Création de l'axe des X
                $axex = new \stdClass();
                $axex->type = 'category';
                $axex->data = $xAxisName ;
                $axisPointer = new \stdClass();
                $axisPointer->type = 'shadow';
                $axex->axisPointer = $axisPointer;
                $axisLabel = new \stdClass();
                $axisLabel->fontSize = 8;
                $axisLabel->rotate = 25;
                $axex->axisLabel = $axisLabel;

                $this->setXAxis(array($axex));

                // AxeY - Création de l'axe des Y
                $axey = new \stdClass();
                $axey->type = 'value';
                $axey->name = ucfirst($path['series']['data'][$j]['title']);
                $axey->color = ucfirst($path['series']['data'][$j]['title']);
                $lineStyle = new \stdClass();
                $lineStyle->color = '#000';
                $axisLabel = new \stdClass();
                $axisLabel->lineStyle = $lineStyle;

                $axey->axisLine = $axisLabel;

                $this->addYAxis($axey);
            }



        } elseif($this->getType() == 'line') {

            $arrayColor = array('#70d79d', '#53a46f', '#a0fcc8', '#f07583', '#fff3ba', '#93c452','#ea148c', '#ffed2a', '#00adea', '#f17030', '#eb212e', '#69030a');

            $path = $this->getPath();
            $data = $this->getData();
            $pathData = '';

            // Chemin de base
            for ($i = 0; $i < count($path['path']); $i++) {
                if($i != count($path['path'])-1) {
                    $pathData .= $path['path'][$i].'->';
                } else {
                    $pathData .= $path['path'][$i];
                }
            }

            $data = static::convertStringToObject($data, $pathData);
            $dataValue = array();
            $xAxisName = array();
            // Récupération des items
            for ($j = 0; $j < count($path['series']['data']); $j++) {

                for ($i = 0; $i < count($data); $i++) {

                    $pathName = $path['series']['title'];

                    // Legend - Création de la légende
                    $this->addLegend(static::convertStringToObject($data[$i], $pathName));

                    // Series - Récupération des informations
                    $pathChild = '';
                    for ($k = 0; $k < count($path['series']['data'][$j]['data']); $k++) {
                        if ($k != count($path['series']['data'][$j]['data']) - 1) {
                            if($path['series']['data'][$j]['data'][$k] != '[n]') {
                                $pathChild .= $path['series']['data'][$j]['data'][$k]. '->';
                            } else {
                                $pathChild = str_replace('->', '', $pathChild);
                                $countN = count(static::convertStringToObject($data[$i], $pathChild));
                                $pathChild .= '[n]->';
                            }

                        } else {
                            $pathChild .= $path['series']['data'][$j]['data'][$k];
                        }
                    }

                    // Axe X - Récupération des names | Series - Récupération des informations
                    if(strpos($pathChild, '[n]') && $j == 0 ){
                        for ($n = 0; $n < $countN; $n++) {
                            $pathAxis = str_replace('[n]', '['.$n.']', $pathChild);
                            $value = static::convertStringToObject($data[$i], $pathAxis);

                            if( isset($path['series']['data'][$j]['typeof']) && $path['series']['data'][$j]['typeof'] == 'year') {
                                $dataValue[$i]['year'][] = $value;
                                if(!in_array($value, $xAxisName)) {
                                    $xAxisName[] = $value;
                                    sort($xAxisName);
                                }
                            } else {
                                $xAxisName[] = $value;
                            }
                        }
                    }

                    // Series - Récupération des informations
                    if($j == 1){
                        for ($n = 0; $n < $countN; $n++) {
                            $pathAxis = str_replace('[n]', '['.$n.']', $pathChild);
                            $value = static::convertStringToObject($data[$i], $pathAxis);

                            if(!isset($path['series']['data'][$j]['typeof'])) {
                                $dataValue[$i]['value'][] = $value;
                            }
                        }
                    }
                }

                // AxeY - Création de l'axe des Y
                $axey = new \stdClass();
                $axey->type = 'value';
                $axey->name = ucfirst($path['series']['data'][$j]['title']);
                $axey->color = ucfirst($path['series']['data'][$j]['title']);
                $lineStyle = new \stdClass();
                $lineStyle->color = $arrayColor[$j];
                $axisLabel = new \stdClass();
                $axisLabel->lineStyle = $lineStyle;
                $axey->axisLine = $axisLabel;

                $this->addYAxis($axey);

            }
            $dataValue = array_values($dataValue);

            // Séries - Création de Series
            $arrayValue = array();
            for ($l = 0; $l < count($dataValue); $l++) {
                for ($y = 0; $y < count($dataValue[$l]['year']); $y++){
                    $arrayValue[$l][$dataValue[$l]['year'][$y]] = $dataValue[$l]['value'][$y];
                }
            }

            for ($n = 0; $n < count($arrayValue); $n++) {

                // Series - Instanciation Series
                $serie = new \stdClass();
                $serie->type = 'line';
                $serie->data = array();
                $serie->color = $arrayColor[$n];

                if (count($path['series']['data']) == 2 && $j == 1) {
                    $serie->yAxisIndex = 1;
                }

                if($path['series']['style']['stack'] == true) {
                    $serie->stack = 'true';
                    $serie->areaStyle = 'true';
                }

                $serie->name = ucfirst($this->getLegend()[$n]);

                for ($m = 0; $m < count($xAxisName); $m++) {

                    if(isset($arrayValue[$n][$xAxisName[$m]]) && !empty($arrayValue[$n][$xAxisName[$m]])){
                        $serie->data[] = $arrayValue[$n][$xAxisName[$m]];
                    } else {
                        $serie->data[] = 0;
                    }

                }

                // Series - Ajout dans l'object
                $this->addSeries($serie);
            }

            // AxeX - Création de l'axe des X
            $axex = new \stdClass();
            $axex->type = 'category';
            $axex->data = $xAxisName;
            $axisPointer = new \stdClass();
            $axisPointer->type = 'shadow';
            $axex->axisPointer = $axisPointer;
            $axisLabel = new \stdClass();
            $axisLabel->fontSize = 8;
            $axisLabel->rotate = 25;
            $axex->axisLabel = $axisLabel;

            $this->setXAxis(array($axex));

        } elseif($this->getType() == 'pie') {

            $path = $this->getPath();
            $data = $this->getData();
            $pathData = '';

            // Chemin de base
            for ($i = 0; $i < count($path['path']); $i++) {
                if($i != count($path['path'])-1) {
                    $pathData .= $path['path'][$i].'->';
                } else {
                    $pathData .= $path['path'][$i];
                }
            }

            $data = static::convertStringToObject($data, $pathData);
            /*
            for ($i = 0; $i < count($data); $i++) {

                // Récupération du nom de l'élement
                if(isset($path['series']['title'])) {
                    $pathName = $path['series']['title'];
                    $name = static::convertStringToObject($data[$i], $pathName);
                } else if(isset($path['series']['titled'])){
                    $name = $path['series']['titled'].'.'.$i;
                }

                // Récupération de la valeur de l'élément
                $pathValue = '';
                for ($k = 0; $k < count($path['series']['data']); $k++) {
                    if ($k != count($path['series']['data']) - 1) {
                        if($path['series']['data'][$k] != '[n]') {
                            $pathValue .= $path['series']['data'][$k]. '->';
                        } else {
                            $pathChild = str_replace('->', '', $pathValue);
                            $countN = count(static::convertStringToObject($data[$i], $pathChild));
                            $pathChild .= '[n]->';
                        }

                    } else {
                        $pathValue .= $path['series']['data'][$k];
                    }
                }

                echo '<pre>';
                print_r($data);
                echo 'OK';

                $value = static::convertStringToObject($data[$i], $pathValue);

                $serie = new \stdClass();
                $serie->value = $value;
                $serie->name = $name;

                // Series - Ajout dans l'object
                $this->addSeries($serie);
            }
            */

            foreach ($data as $key => $item) {
                // Récupération du nom de l'élement
                if(isset($path['series']['title'])) {
                    $pathName = $path['series']['title'];
                    $name = static::convertStringToObject($item, $pathName);
                } elseif(isset($path['series']['titled'])){
                    $name = $path['series']['titled'].'.'.$key;
                }

                // Récupération de la valeur de l'élément
                $pathValue = '';
                for ($k = 0; $k < count($path['series']['data']); $k++) {
                    if ($k != count($path['series']['data']) - 1) {
                        if($path['series']['data'][$k] != '[n]') {
                            $pathValue .= $path['series']['data'][$k]. '->';
                        } else {
                            $pathChild = str_replace('->', '', $pathValue);
                            $countN = count(static::convertStringToObject($data[$i], $pathChild));
                            $pathChild .= '[n]->';
                        }

                    } else {
                        $pathValue .= $path['series']['data'][$k];
                    }
                }

                $value = static::convertStringToObject($item, $pathValue);

                $serie = new \stdClass();
                $serie->value = $value;
                $serie->name = $name;

                // Series - Ajout dans l'object
                $this->addSeries($serie);
            }

        } else {
            echo 'ERROR : The type of the chart is not recognized'; die();
        }

    }

    public static function convertStringToObject($obj, $path_str)
    {
        $val = null;

        $path = preg_split('/->/', $path_str);

        $node = $obj;
        while (($prop = array_shift($path)) !== null) {

            if (!is_object($obj)) {
                $val = null;
                break;
            }

            if(!property_exists($node, $prop)) {
                $propArray = substr($prop, 0, strpos($prop, '['));
                if(!property_exists($node, $propArray) || !is_array($node->$propArray)) {
                    $val = null;
                    break;
                } else {
                    $array = substr($prop, strpos($prop, '['));
                    $number = substr($array, 1, strlen($array) - 2);

                    foreach ($node->$propArray as $k => $item){
                        if($k == $number) {
                            $val = $item;
                            $node = $item;
                        }
                    }
                    continue;
                }
            }

            $val = $node->$prop;
            $node = $node->$prop;
        }

        return $val;
    }

    public static function reformatted($data, $format) {

        $path = $format['path'];
        $pathData = '';

        // Chemin de base
        for ($i = 0; $i < count($path); $i++) {
            if($i != count($path)-1) {
                $pathData .= $path[$i].'->';
            } else {
                $pathData .= $path[$i];
            }
        }

        $dataFormated = static::convertStringToObject($data, $pathData);
        $dataArray = array();

        foreach ($dataFormated as &$item) {
            $key = array_keys($format['order'], $item->{$format['element']});
            if(!empty($key)) {
                $item->{$format['element']} = $format['title'][$key[0]];
                $dataArray[$key[0]] = $item;
            }
        }

        ksort($dataArray);


        $data->budget->OnGoingProjectsInterventionLevelZones = $dataArray;

        return $data;

    }

}