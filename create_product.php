<?php
class ControllerCreateProduct extends Controller
{
    public function index()
    {
        $this->load->model('catalog/product');

        $data = array(
            'product_description' => array(
                // You should replace 1 with the actual language_id for the language you want to use.
                1 => array(
                    'name' => 'uzspace.ro hahah',
                    'description' => 'Product Description',
                    'tag' => 'Product Tags',
                    'meta_title' => 'Product Meta Title',
                    'meta_description' => 'Product Meta Description',
                    'meta_keyword' => 'Product Meta Keyword'
                )
            ),
            'model' => 'Product Model',
            'sku' => 'Product SKU',
            'upc' => 'Product UPC',
            'ean' => 'Product EAN',
            'jan' => 'Product JAN',
            'isbn' => 'Product ISBN',
            'mpn' => 'Product MPN',
            'location' => 'Product Location',
            'price' => 'Product Price',
            'tax_class_id' => 'Tax Class ID',
            'quantity' => 'Product Quantity',
            'minimum' => 'Minimum Quantity',
            'subtract' => 'Subtract Stock',
            'stock_status_id' => 'Out Of Stock Status',
            'shipping' => 'Requires Shipping',
            'date_available' => 'Date Available',
            'length' => 'Product Length',
            'width' => 'Product Width',
            'height' => 'Product Height',
            'length_class_id' => 'Length Class',
            'weight' => 'Product Weight',
            'weight_class_id' => 'Weight Class',
            'status' => 1,
            'sort_order' => 'Sort Order',
            'manufacturer_id' => 'Manufacturer ID',
            'category_id' => array('Category ID'),
            'filter_id' => array('Filter ID'),
            'download_id' => array('Download ID'),
            'related_id' => array('Related ID'),
            'option' => array('Option'),
            'image' => '../image/catalog/demo/banners/iPhone6.jpg',
            'points' => 'Reward Points',
            'product_store' => array('Store ID'),
        );

        $this->model_catalog_product->addProduct($data);
    }
}
