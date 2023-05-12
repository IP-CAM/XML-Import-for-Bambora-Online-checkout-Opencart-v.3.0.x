<?php
class ControllerCreateProduct extends Controller
{
    public function index()
    {
        $this->load->model('catalog/product');

        $url = 'https://www.websiteExample.ro/feed-sxml.php';
        $xml = simplexml_load_file($url);

        $limit = 20;
        $count = 0;

        foreach ($xml->result as $result) {
            if ($count == $limit) {
                break;
            }

            $imageUrl = $result->image;
            $imagePath = 'catalog/demo/custom/' . trim($result->title) . '.png';

            $imageContent = file_get_contents($imageUrl);
            file_put_contents(DIR_IMAGE . $imagePath, $imageContent);

            $data = array(
                'product_description' => array(
                    // You should replace 1 with the actual language_id for the language you want to use.
                    1 => array(
                        'name' => (string) trim($result->title),
                        'description' => (string) $result->description,
                        'meta_title' => (string) trim($result->title),
                        'meta_description' => '',
                        'meta_keyword' => '',
                        'tag' => ''
                    )
                ),
                'model' => (string) $result->sku,
                'sku' => (string) $result->sku,
                'upc' => '',
                'ean' => '',
                'jan' => '',
                'isbn' => '',
                'mpn' => '',
                'location' => 'Romania',
                'price' => (float) $result->price,
                'tax_class_id' => '9',
                'quantity' => (int) $result->stock,
                'minimum' => '1',
                'subtract' => '1',
                'stock_status_id' => '7',
                'shipping' => '1',
                'date_available' => date('Y-m-d'),
                'length' => '',
                'width' => '',
                'height' => '',
                'length_class_id' => '1',
                'weight' => '',
                'weight_class_id' => '1',
                'status' => '1',
                'sort_order' => '1',
                'manufacturer' => (string) $result->brand,
                'manufacturer_id' => "0",
                'category' => '',
                'product_category' => array(
                    0 => '59'
                ),
                'filter' => '',
                'product_store' => array(
                    0 => '0'
                ),
                'download' => '',
                'related' => '',
                'option' => '',
                'image' => $imagePath,
                'points' => '',
                'product_reward' => array(
                    1 => array(
                        'points' => ''
                    )
                ),
                'product_seo_url' => array(
                    0 => array(
                        '1' => ''
                    )
                ),
                'product_layout' => array(
                    0 => ''
                ),
            );

            $this->model_catalog_product->addProduct($data);
            $count++;
        }
    }
}
