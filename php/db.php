<?php

/**
 * db
 */
class Db {

	/**
	 * Table name for query
	 */
	private string $table_name;

	/**
	 * Wpdb object
	 */
	private $db;

	/**
	 * When object created
	 * @param table
	 * @since 0.1.0
	 */
	function __construct(string $table) {
		global $wpdb;

		$this->table_name = $table;
		$this->db = $wpdb;
	}

	/**
	 * Create a table
	 * @param name Name of table
	 * @param options Options of Table. for example -> name, age ...
	 * @since 0.0.1
	 */
	public static function create_table(string $name, string $options): void {
		// Use Wordpress db var as global
		// Code refrence : https://developer.wordpress.org/reference/classes/wpdb/
		global $wpdb;
		
		$charset_collate = $wpdb->get_charset_collate();
		
		// Create table name
		$table_name = $wpdb->prefix . $name;
		
		// Set query
		$sql = "CREATE TABLE IF NOT EXISTS $table_name ( $options ) $charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
	
	/**
	 * Inserts to table
	 * @param data data to insert
	 * @return void
	 * @since 0.0.1
	 * @since 0.1.0 Code fixed
	 */
	public function insert(array $data, array $format): void {
		// get table
		$table = $this->db->prefix . $this->table_name;

		// Insert to table
		$this->db->insert($table, $data, $format);
	}

	/**
	 * Replace to table
	 * @param data data to replace
	 * @param format format of data 
	 * @return void
	 * @since 0.0.1
	 * @since 0.1.0 Code fixed
	 */
	public function replace(array $data, array $format): void {
		// get table
		$table = $this->db->prefix . $this->table_name;

		// Replace data
		$this->db->replace($table, $data, $format);
	}

	/**
	 * Get result from db
	 * @param query
	 * @return array|object|null
	 * @since 0.0.1
	 * @since 0.1.0 Code fixed
	 */
	public function get(string $query) {
		$result = $this->db->get_results($query);

		return $result;
	}

	/**
	 * Update data in table
	 * @param data
	 * @param where
	 * @since 0.0.2
	 * @since 0.1.0 Code fixed
	 * @return void
	 */
	public function update(array $data, array $where): void {
		// get table
		$table = $this->db->prefix . $this->table_name;
		
		// Update data
		$this->db->update($table, $data, $where);
	}
}

?>
