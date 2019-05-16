<?php

namespace Inla18\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var array $series The numbers stored in sequence
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    public $series = [];
    public $addSerie = [];
    private $min;
    private $max;



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Add series together.
     *
     * @return array with the serie.
     */
    public function getAddedSerie()
    {
        return $this->addSerie;
    }

    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $count = array_count_values($this->addSerie);
        $res = [];

        foreach ($count as $key => $value) {
            $res[$key] = $key . str_repeat(" *", $value);
        }

        for ($i = $this->min; $i <= 6; $i++) {
            if (!in_array($i, $res)) {
                $res[$i] = (string) $i;
            }
        }

        sort($res);
        foreach ($res as $key => $value) {
            if (substr($value, 0, 1) !== "0") {
                echo $value . "\n";
            }
        }
    }


    /**
    * Inject the object to use as base for the histogram data.
    *
    * @param HistogramInterface $object The object holding the serie.
    *
    * @return void.
    */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->series = $object->getHistogramSeries();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
        $this->addSerie = $object->getHistogramAddedSerie();
    }
}
