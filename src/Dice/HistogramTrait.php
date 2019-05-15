<?php

namespace Inla18\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var array $series  The numbers stored in sequence.
     * @var array $addSerie  The numbers added in sequence.
     */
    public $serie = [];
    public $series = [];
    public $addSerie = [];
    public $addSeries = [];
    public $result = [];
    public $mergedArray = [];



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }

    public function getHistogramSeries()
    {
        return $this->series;
    }

    public function getMergedSeries()
    {
        return $this->mergedArray;
    }

    /**
     * Add series together.
     *
     * @return array with the serie.
     */
    public function getHistogramAddedSerie()
    {
        $this->addSerie = array_merge($this->addSerie, $this->serie, $this->series);
        return $this->addSerie;
    }

    // /**
    //  * Add series together.
    //  *
    //  * @return array with the serie.
    //  */
    // public function getHistogramAddedSerie()
    // {
    //     $this->addSerie = array_merge($this->addSerie, $this->mergedArray);
    //     return $this->addSerie;
    // }

    // public function getHistogramAddedSeries()
    // {
    //     $this->addSeries = array_merge($this->addSeries, $this->result);
    //     $this->series = [];
    //     return $this->addSeries;
    // }


    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return max($this->serie);
    }
}
