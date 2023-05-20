<?php
class ControllerCreateProduct extends Controller
{
    public function index()
    {
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        require_once 'image_optimizer.php';

        $start = microtime(true);

        $categories = $this->model_catalog_category->getCategoriesNameId();

        $url = 'feed-sxml.xml';
        $fileAsString = file_get_contents($url, true);
        // $xml = simplexml_load_file($url); use this when I pass the xml feed url instead of file.
        $xml = simplexml_load_string($fileAsString);

        $limit = (intval($this->request->get['limit']) == 0) ? 51 : intval($this->request->get['limit']); // limit set as default to 51 but if parameter limit is provided can be overwritten
        $count = 0;

        // Product Foreach
        foreach ($xml->result as $result) {
            if ($count == $limit) {
                break;
            }

            $existingProduct = $this->model_catalog_product->getProductBySKU(trim($result->sku));
            if ($existingProduct) {
                continue;
            }
            echo 'Counter: ' . $count . '<br>';
            echo 'Limit number: ' . $limit . '<br>';
            echo 'Product Name: ' . $result->title . '<br>';

            // Check if the category exists based on the XML data
            $categoryName = (string)$result->category;
            $categoryId = $this->getCategoryIdByName($categories, $categoryName);
            if ($categoryId) {
                $imageUrl = $result->image;
                $translationTable = [
                    '/' => '',
                    ' ' => ''
                ];
                $imgName = strtr(trim((string)$result->title), $translationTable);
                $imagePath = 'custom/' . $imgName . '.' . pathinfo($imageUrl, PATHINFO_EXTENSION);

                $imageContent = file_get_contents($imageUrl);
                file_put_contents(DIR_IMAGE . $imagePath, $imageContent);

                optimize_image($imageUrl, $imagePath);

                $data = array(
                    'product_description' => array(
                        // You should replace 1 with the actual language_id for the language you want to use.
                        1 => array(
                            'name' => (string) trim($result->title),
                            'description' => trim((string) $result->description),
                            'meta_title' => (string) trim($result->title),
                            'meta_description' => '',
                            'meta_keyword' => '',
                            'tag' => ''
                        )
                    ),
                    'model' => trim((string) $result->sku),
                    'sku' => trim((string) $result->sku),
                    'upc' => '',
                    'ean' => '',
                    'jan' => '',
                    'isbn' => '',
                    'mpn' => '',
                    'location' => 'Romania',
                    'price' => (float) $result->price,
                    'tax_class_id' => '0',
                    'quantity' => (int) $result->stock,
                    'minimum' => '1',
                    'subtract' => '1',
                    'stock_status_id' => '6',
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
                    'manufacturer' => '',
                    'manufacturer_id' => "0",
                    'category' => '',
                    'product_category' => array(
                        0 => $categoryId
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

                if ($existingProduct) {
                    $this->model_catalog_product->editProduct($existingProduct['product_id'], $data);
                } else {
                    $this->model_catalog_product->addProduct($data);
                }
            }

            $count++;
        }
        $end = microtime(true);
        $executionTime = $end - $start;
        $executionTimeSeconds = round($executionTime, 2);
        echo 'Script total run time is: ' . $executionTimeSeconds . '<br>';
    }

    // Helper function to get the category ID based on its name
    private function getCategoryIdByName($categories, $name)
    {
        foreach ($categories as $category) {
            if ($category['Name'] == $name) {
                return $category['CategoryId'];
            }
        }

        return 0; // Return 0 if the category is not found
    }
}
