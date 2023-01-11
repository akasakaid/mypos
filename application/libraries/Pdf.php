<?php 
// defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/fpdf185/fpdf.php';

class Pdf extends FPDF
{
    public function __construct()
    {
        parent::__construct(orientation: 'P', unit: 'mm', size: [200,80]);
    }

}


/* End of file Pdf.php and path \application\libraries\Pdf.php */