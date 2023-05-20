<?php
class ControllerCreateCategories extends Controller
{
    public function index()
    {
        $this->load->model('catalog/category');

        $url = 'feed-sxml.xml';
        $fileAsString = file_get_contents($url, true);
        $xml = simplexml_load_string($fileAsString);

        $categoryNames = array(); // Array to store unique category names

        foreach ($xml->result as $result) {
            $categoryName = trim((string) $result->category);

            if (!in_array($categoryName, $categoryNames)) {
                $categoryNames[] = $categoryName;
            }
        }

        // Create categories from unique category names
        foreach ($categoryNames as $categoryName) {
            $data = array(
                'category_description' => array(
                    1 => array(
                        'name' => $categoryName,
                        'description' => '',
                        'meta_title' => $categoryName,
                        'meta_description' => '',
                        'meta_keyword' => '',
                    )
                ),
                'path' => 'Magazin',
                'parent_id' => '1',
                'filter' => '',
                'category_store' => array(
                    0 => '0'
                ),
                'image' => '',
                'top' => '1',
                'column' => '1',
                'sort_order' => '0',
                'status' => '1',
                'category_seo_url' => array(
                    0 => array(
                        1 => ''
                    )
                ),
                'category_layout' => array(
                    0 => ''
                )
            );

            $this->model_catalog_category->addCategory($data);
        }
    }
}
