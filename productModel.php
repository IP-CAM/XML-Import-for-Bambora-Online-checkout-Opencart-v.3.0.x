	<?php
	class ModelCatalogProduct extends Model {	

	public function deleteAllProducts()
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "product");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_recurring");
		$this->db->query("DELETE FROM " . DB_PREFIX . "review");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query LIKE 'product_id=%'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_product");

		$this->cache->delete('product');
	}

	public function getProductBySKU($sku)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p WHERE p.sku = '" . (int)$sku . "'");

		return $query->row;
	}
	}
