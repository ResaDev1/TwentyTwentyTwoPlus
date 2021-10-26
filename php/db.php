<?php

/**
 * db
 */
class Db {
	
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
	 * @param table_name Name of table
	 * @param data data to insert
	 * @return void
	 * @since 0.0.1
	 */
	public static function insert(string $table_name, array $data, array $format): void {
		global $wpdb;

		// get table
		$table = $wpdb->prefix . $table_name;

		// Insert to table
		$wpdb->insert($table, $data, $format);
	}

	/**
	 * Replace to table
	 * @param table_name Name of table
	 * @param data data to replace
	 * @return void
	 * @since 0.0.1
	 */
	public static function replace(string $table_name, array $data, array $format): void {
		global $wpdb;

		// get table
		$table = $wpdb->prefix . $table_name;

		// Replace data
		$wpdb->replace($table, $data, $format);
	}

	/**
	 * Get result from db
	 * @param query
	 * @return array|object|null
	 * @since 0.0.1
	 */
	public static function get(string $query) {
		global $wpdb;

		$result = $wpdb->get_results($query);

		return $result;
	}

	/**
	 * Update data in table
	 * @since 0.0.2
	 * @return void
	 */
	public static function update(string $table_name, array $data, array $where): void {
		global $wpdb;

		// get table
		$table = $wpdb->prefix . $table_name;
		
		// Update data
		$wpdb->update($table, $data, $where);
	}
}

?>