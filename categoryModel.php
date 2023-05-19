<?php
class ModelCatalogCategory extends Model
{	

	public function getCategoriesNameId()
	{
		$query = $this->db->query("SELECT category_id As id, name AS name FROM " . DB_PREFIX . "category_description");

		return $query->rows;
	}
	
	public function deleteAllCategories()
	{
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_path");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_description");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_filter");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_to_store");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_to_layout");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_to_category");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "seo_url");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "coupon_category");

		$this->cache->delete('category');
	}
}
