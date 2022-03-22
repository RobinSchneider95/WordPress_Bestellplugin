<?php
	defined('ABSPATH') or die("Thanks");
	/*
	* Plugin Name:  EasyFoodStore
	* Description: Ein Plugin zur Integration eines Bestellformular und Lieferdienst
	* Version: 0.1.2
	* Author: Robin Schneider
	* License: GPL2
	* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
	* Text Domain:  EasyFoodStore
	*/
    //------------------------------------------------------------------
    //Backend Menü Optionen
	function easyfoodstore_admin_menu(){
		add_menu_page('EasyFoodStore', 'EasyFoodStore', 'manage_options', 'easyfoodstore_menu', 'easyfoodstore_admin_menu_site', 'dashicons-food', 20);
	}

	function easyfoodstore_admin_submenus(){
		add_submenu_page("easyfoodstore_menu", "Einstellungen", "Einstellungen", "manage_options", "easyfoodstore_menu", "easyfoodstore_admin_menu_site");
		add_submenu_page("easyfoodstore_menu", "Gerichtkategorien", "Gerichtkategorien", "manage_options", "category_menu", "category_admin_submenu_site");
		add_submenu_page("easyfoodstore_menu", "Gerichte", "Gerichte", "manage_options", "gerichte_menu", "gerichte_admin_submenu_site");
		add_submenu_page("easyfoodstore_menu", "Bestellungen", "Bestellungen", "manage_options", "bestellungen_menu", "bestellungen_admin_submenu_site");
	}

	add_action("admin_menu", "easyfoodstore_admin_menu");
	add_action('admin_menu', 'easyfoodstore_admin_submenus');
	//------------------------------------------------------------------
	//Benutzeroberfläche im Backend
	//Einstellungen
	function easyfoodstore_admin_menu_site(){
		?>
		<h1>Einstellungen</h1>
		<form action="options.php" method="post">
		<?php
			settings_fields("general_option_group");
			do_settings_sections("general_menu");
			submit_button("Änderungen Speichern");
		?>
		</form>
		<?php
    }
	//------------------------------------------------------------------
	//Gericht Kategorien
	function category_admin_submenu_site(){
		?>
		<h1>Gerichtkategorien</h1>
		<form action="options.php" method="post">
		<?php
		settings_fields("category_option_group");
		do_settings_sections("category_menu");
		submit_button("Änderungen Speichern");
		?>
		</form>
		<?php
	}

	//Fügt Benutzeroberfläche im Backend hinzu
	function category_admin_init(){
		register_setting("category_option_group", "first_option");
		add_settings_section("category_section", "Name der Kategorie", "category_menu");
		add_settings_field("first_option_field", "Name", "category_first_option_markup", "category_menu", "category_section");
	}

	add_action("categorie_admin", "category_admin_init");
	
	function counter_first_option_markup(){
		?>
			<input type="text" id="first_option" name="first_option" value="<?php echo get_option("first_option"); ?>">
		<?php
	}

	//------------------------------------------------------------------
	//Gerichte
	function gerichte_admin_submenu_site(){
		?>
		<h1>Gerichte</h1>
		<form action="options.php" method="post">
		<?php
		settings_fields("dish_option_group");
		do_settings_sections("dish_menu");
		submit_button("Änderungen Speichern");
		?>
		</form>
		<?php
	}
	//------------------------------------------------------------------
	//Bestellungen
	function bestellungen_admin_submenu_site(){
		?>
		<h1>Bestellungen</h1>
		<form action="options.php" method="post">
		<?php
		

		?>
		</form>
		<?php
	}

	


	//------------------------------------------------------------------
	//Frontend

	function storepage(){
		include('storepage.php');
	}

	add_shortcode("easyfoodstore_shortcode", "storepage");
?>