<?php

namespace App\Http\Controllers;

class KalmanFilter
{
    private $q; // process noise covariance
    private $r; // measurement noise covariance
    private $x; // estimated value
    private $p; // estimation error covariance
    private $k; // kalman gain

    public function __construct($q, $r, $p, $initial_value) {
        $this->q = $q;
        $this->r = $r;
        $this->p = $p;
        $this->x = $initial_value;
    }

    public function update($measurement) {
        // time update - prediction
        $this->p = $this->p + $this->q;

        // measurement update - correction
        $this->k = $this->p / ($this->p + $this->r);
        $this->x = $this->x + $this->k * ($measurement - $this->x);
        $this->p = (1 - $this->k) * $this->p;

        return $this->x;
    }
}
