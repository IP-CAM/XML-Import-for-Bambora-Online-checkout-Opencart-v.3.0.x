<?php
class ControllerDeleteAllCategories extends Controller
{
    public function index()
    {
        $this->load->model('catalog/category');
        $this->model_catalog_category->deleteAllCategories();
    }
}
