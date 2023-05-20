<?php
class ControllerOptimizerTest extends Controller
{
    public function index()
    {
        require_once 'image_optimizer.php';
        optimize_image("https://www.natur.ro/ImaginiProduse/6cded65e-ea24-48f2-9bd7-cf61cfd2cec1/balsamcorp60549_5a25aaa2-0183-48a5-9739-d10b8893c456.jpg", "custom/optimizerTestPicture.png");
    }
}
