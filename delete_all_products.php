<?php
class ControllerDeleteAllProducts extends Controller
{
    public function index()
    {
        $this->load->model('catalog/product');
        $this->model_catalog_product->deleteAllProducts();
    }
}
