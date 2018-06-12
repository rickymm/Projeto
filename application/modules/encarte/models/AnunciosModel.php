<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnunciosModel extends Crud {

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(false);
    }

}
