<?php

namespace Inla18\Dice;

/**
 * A interface for a classes supporting histogram reports.
 */
interface HistogramInterface
{
    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie();


    /**
     * Get the computer serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSeries();


    /**
     * Get the added serie.
     *
     * @return array with the added serie.
     */
    public function getHistogramAddedSerie();


    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin();



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax();
}
