	public function getCategoriesNameId()
	{
		$query = $this->db->query("SELECT category_id As id, name AS name FROM " . DB_PREFIX . "category_description");

		return $query->rows;
	}
