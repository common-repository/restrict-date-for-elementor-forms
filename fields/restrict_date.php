<?php
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
class Superaddons_Restrict_Date_Field extends \ElementorPro\Modules\Forms\Fields\Field_Base
{
	public function get_type()
	{
		return 'restrict_date';
	}
	public function get_name()
	{
		return esc_html__('Restrict Date', 'restrict-dates-for-elementor-forms');
	}
	public function editor_preview_footer()
	{
		add_action('wp_footer', array($this, "rednumber_restrict_date_content_template_script"));
	}
	function rednumber_restrict_date_content_template_script()
	{
		?>
		<script>
		jQuery(document).ready(() => {
			elementor.hooks.addFilter(
				'elementor_pro/forms/content_template/field/restrict_date',
				function(inputField, item, i) {
					return `<input type="date" />`;
				}, 10, 3
			);
		});
		</script>
		<?php
	}
	/**
	 * @param Widget_Base $widget
	 */
	public function update_controls($widget)
	{
		$elementor = \ElementorPro\Plugin::elementor();
		$control_data = $elementor->controls_manager->get_control_from_stack($widget->get_unique_name(), 'form_fields');
		if (is_wp_error($control_data)) {
			return;
		}
		$check_pro = get_option('_redmuber_item_1523');
		if ($check_pro == "ok") {
			$field_controls = [
				'placeholder' => [
					'name' => 'placeholder',
					'label' => esc_html__('Placeholder', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'disable_input' => [
					'name' => 'disable_input',
					'label' => esc_html__('Disable input', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => "yes",
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__('Do not allow users to enter input', 'restrict-dates-for-elementor-forms'),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'format' => [
					'name' => 'format',
					'label' => esc_html__('Format', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'yy-mm-dd',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min' => [
					'name' => 'min',
					'label' => esc_html__('Min', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => array("" => "None", "current_date" => "Current date", "special" => "Set date"),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_plus' => [
					'name' => 'min_plus',
					'label' => esc_html__('Min Plus/minus', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '+',
					'options' => array("-" => "-", "+" => "+"),
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_number' => [
					'name' => 'min_number',
					'label' => esc_html__('Min Number', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '0',
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_type' => [
					'name' => 'min_type',
					'label' => esc_html__('Min Type', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'd',
					'options' => array("d" => "Day(s)", "m" => "Month(s)", "y" => "Year(s)"),
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_pick' => [
					'name' => 'min_pick',
					'label' => esc_html__('Min Date Pick', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::DATE_TIME,
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => 'special'
					],
					'label_block' => false,
					'picker_options' => [
						'enableTime' => false,
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'sync_min' => [
					'name' => 'sync_min',
					'label' => esc_html__('Link min field', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max' => [
					'name' => 'max',
					'label' => esc_html__('Max', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => array("" => "None", "current_date" => "Current date", "special" => "Set date"),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_plus' => [
					'name' => 'max_plus',
					'label' => esc_html__('Max Plus/minus', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '+',
					'options' => array("-" => "-", "+" => "+"),
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_number' => [
					'name' => 'max_number',
					'label' => esc_html__('Max Number', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '0',
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_type' => [
					'name' => 'max_type',
					'label' => esc_html__('Max Type', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'd',
					'options' => array("d" => "Day(s)", "m" => "Month(s)", "y" => "Year(s)"),
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_pick' => [
					'name' => 'max_pick',
					'label' => esc_html__('Max Date Pick', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::DATE_TIME,
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => 'special'
					],
					'label_block' => false,
					'picker_options' => [
						'enableTime' => false,
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'sync_max' => [
					'name' => 'sync_max',
					'label' => esc_html__('Link max field', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'week' => [
					'name' => 'week',
					'label' => esc_html__('Weeks', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => array("1" => "Mon", "2" => "Tue", "3" => "Wed", "4" => "Thu", "5" => "Fri", "6" => "Sat", "0" => "Sun"),
					'default' => array("0", "1", "2", "3", "4", "5", "6"),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'exception' => [
					'name' => 'exception',
					'label'       => esc_html__('Exceptions (y-m-d)', 'restrict-dates-for-elementor-forms'),
					'type'        => \Elementor\Controls_Manager::TEXTAREA,
					'description' => 'Enter each option in a separate line (format : y-m-d). For example 2023-12-30',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_dependent' => [
					'name' => 'min_dependent',
					'label' => esc_html__('Min number of dependent days', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_dependent' => [
					'name' => 'max_dependent',
					'label' => esc_html__('Max number of dependent days', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'default_value' => [
					'name' => 'default_value',
					'label'       => esc_html__('Default Value', 'restrict-dates-for-elementor-forms'),
					'description' => 'use "current" to get the current date',
					'type'        => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_advanced_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
			];
		} else {
			$field_controls = [
				'placeholder' => [
					'name' => 'placeholder',
					'label' => esc_html__('Placeholder', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'disable_input' => [
					'name' => 'disable_input',
					'label' => esc_html__('Disable input', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => "yes",
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__('Do not allow users to enter input', 'restrict-dates-for-elementor-forms'),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'format' => [
					'name' => 'format',
					'label' => esc_html__('Format', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'yy-mm-dd',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min' => [
					'name' => 'min',
					'label' => esc_html__('Min', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => array("" => "None", "current_date" => "Current date", "special" => "Set date"),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_plus' => [
					'name' => 'min_plus',
					'label' => esc_html__('Min Plus/minus', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '+',
					'options' => array("-" => "-", "+" => "+"),
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_number_pro' => [
					'name' => 'min_number_pro',
					'label' => esc_html__('Min Number', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__('Max Number( default = 0 Upgrade to pro to change it )', 'repeater-for-elementor'),
					'default' => '0',
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_type' => [
					'name' => 'min_type',
					'label' => esc_html__('Min Type', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'd',
					'options' => array("d" => "Day(s)", "m" => "Month(s)", "y" => "Year(s)"),
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_pick' => [
					'name' => 'min_pick',
					'label' => esc_html__('Min Date Pick', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::DATE_TIME,
					'condition' => [
						'field_type' => $this->get_type(),
						'min' => 'special'
					],
					'label_block' => false,
					'picker_options' => [
						'enableTime' => false,
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'sync_min_pro' => [
					'name' => 'sync_min_pro',
					'label' => esc_html__('Link min field', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__('Min dependent days with field( Upgrade to pro to change it )', 'repeater-for-elementor'),
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max' => [
					'name' => 'max',
					'label' => esc_html__('Max', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => array("" => "None", "current_date" => "Current date", "special" => "Set date"),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_plus' => [
					'name' => 'max_plus',
					'label' => esc_html__('Max Plus/minus', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '+',
					'options' => array("-" => "-", "+" => "+"),
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_number_pro' => [
					'name' => 'max_number_pro',
					'label' => esc_html__('Max Number', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__('Max Number( default = 0 Upgrade to pro to change it )', 'repeater-for-elementor'),
					'default' => '0',
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_type' => [
					'name' => 'max_type',
					'label' => esc_html__('Max Type', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'd',
					'options' => array("d" => "Day(s)", "m" => "Month(s)", "y" => "Year(s)"),
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => "current_date"
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_pick' => [
					'name' => 'max_pick',
					'label' => esc_html__('Max Date Pick', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::DATE_TIME,
					'condition' => [
						'field_type' => $this->get_type(),
						'max' => 'special'
					],
					'label_block' => false,
					'picker_options' => [
						'enableTime' => false,
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'sync_max_pro' => [
					'name' => 'sync_max_pro',
					'label' => esc_html__('Link max field', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__('Min dependent days with field( Upgrade to pro to change it ) ( Upgrade to pro to change it )', 'repeater-for-elementor'),
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'week' => [
					'name' => 'week',
					'label' => esc_html__('Weeks', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => array("1" => "Mon", "2" => "Tue", "3" => "Wed", "4" => "Thu", "5" => "Fri", "6" => "Sat", "0" => "Sun"),
					'default' => array("0", "1", "2", "3", "4", "5", "6"),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'exception_pro' => [
					'name' => 'exception_pro',
					'label'       => esc_html__('Exceptions (y-m-d)', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__('Enter each option in a separate line (format : y-m-d). For example 2023-12-30 ( Upgrade to pro to change it )', 'repeater-for-elementor'),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'min_number_dependent' => [
					'name' => 'min_number_dependent',
					'label' => esc_html__('Min number of dependent days', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__('Upgrade to pro to change it', 'repeater-for-elementor'),
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'max_number_dependent_pro' => [
					'name' => 'max_number_dependent_pro',
					'label' => esc_html__('Max number of dependent days', 'restrict-dates-for-elementor-forms'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__('Upgrade to pro to change it', 'repeater-for-elementor'),
					'default' => '',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'default_value' => [
					'name' => 'default_value',
					'label'       => esc_html__('Default Value', 'restrict-dates-for-elementor-forms'),
					'description' => 'use "current" to get the current date',
					'type'        => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_advanced_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
			];
		}

		$control_data['fields'] = $this->inject_field_controls($control_data['fields'], $field_controls);
		$widget->update_control('form_fields', $control_data);
	}
	/**
	 * @param      $item
	 * @param      $item_index
	 * @param Form $form
	 */
	public function render($item, $item_index, $form)
	{
		$form->add_render_attribute('input' . $item_index, 'class', 'elementor-field-restrict_date elementor-field-textual');
		$form->add_render_attribute('input' . $item_index, 'type', 'text', true);
		if ($item['disable_input'] == "yes") {
			$form->add_render_attribute('input' . $item_index, 'readonly', 'true', true);
		}
		$format   = ! empty($item['format']) ? $item['format'] : '';
		$laceholder   = ! empty($item['placeholder']) ? $item['placeholder'] : '';
		$form->add_render_attribute('input' . $item_index, 'placeholder', $laceholder, true);
		$min   = ! empty($item['min']) ? $item['min'] : '';
		$min_pick   = ! empty($item['min_pick']) ? $item['min_pick'] : '';
		$min_plus   = ! empty($item['min_plus']) ? $item['min_plus'] : '+';
		$min_number   = ! empty($item['min_number']) ? $item['min_number'] : '0';
		$min_type   = ! empty($item['min_type']) ? $item['min_type'] : 'd';
		$sync_min   = ! empty($item['sync_min']) ? $item['sync_min'] : '';
		$max   = ! empty($item['max']) ? $item['max'] : '';
		$max_pick   = ! empty($item['max_pick']) ? $item['max_pick'] : '';
		$max_plus   = ! empty($item['max_plus']) ? $item['max_plus'] : '+';
		$max_number   = ! empty($item['max_number']) ? $item['max_number'] : '0';
		$max_type   = ! empty($item['max_type']) ? $item['max_type'] : 'd';
		$week = ! empty($item['week']) ? $item['week'] : array("0", "1", "2", "3", "4", "5", "6");
		$exception = ! empty($item['exception']) ? $item['exception'] : '';
		$weekdays = implode("|", $week);
		$special = preg_replace("/\\\n/", "|", $exception);
		$sync_max   = ! empty($item['sync_max']) ? $item['sync_max'] : '';
		$default_value   = ! empty($item['default_value']) ? $item['default_value'] : '';
		$sync_min_number   = ! empty($item['min_dependent']) ? $item['min_dependent'] : '';
		$sync_max_number   = ! empty($item['max_dependent']) ? $item['max_dependent'] : '';
		if ($default_value == "current") {
			$new_fm = str_replace(array("yy", "YY", "mm", "MM", "dd", "DD"), array("Y", "Y", "m", "m", "d", "d"), $format);
			$default_value = date($new_fm);
		}
		$data_attr = "";
		$datas = array(
			"data-format" => $format,
			"data-min" => $min,
			"data-min_pick" => $min_pick,
			"data-max_plus_min" => $min_plus,
			"data-max_number_min" => $min_number,
			"data-max_type_min" => $min_type,
			"data-max" => $max,
			"data-max_pick" => $max_pick,
			"data-max_plus" => $max_plus,
			"data-max_number" => $max_number,
			"data-max_type" => $max_type,
			"data-weekdays" => $weekdays,
			"data-special" => $special,
			"data-sync_min" => $sync_min,
			"data-sync_max" => $sync_max,
			"data-sync_min_number" => $sync_min_number,
			"data-sync_max_number" => $sync_max_number,
		);
		foreach ($datas as $k => $v) {
			$data_attr .= " " . $k . '="' . $v . '"';
		}
		$data_attr .= ' value="' . $default_value . '"';
		$input = sprintf(
			'<input type="text" %s %s>',
			$form->get_render_attribute_string('input' . $item_index),
			$data_attr
		);
		printf("%s", $input);
	}
	public function __construct()
	{
		parent::__construct();
		add_action("wp_enqueue_scripts", array($this, "add_lib"), 1000);
		add_action('elementor/preview/init', array($this, 'editor_preview_footer'));
	}
	function add_lib()
	{
		wp_enqueue_style(
			'jquery-ui',
			SUPERADDONS_ELEMENTOR_RESTRICT_DATE_PLUGIN_URL . 'libs/css/jquery-ui.css',
			array(),
			'1.9.0'
		);
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script(
			'restrict-dates-for-elementor-forms',
			SUPERADDONS_ELEMENTOR_RESTRICT_DATE_PLUGIN_URL . 'libs/js/date_restrict.js',
			array("jquery", "moment"),
			time(),
			true
		);
		wp_localize_jquery_ui_datepicker();
		wp_localize_script("restrict-dates-for-elementor-forms", "restrict_dates_for_elementor_forms", array("start_of_week" => get_option("start_of_week", 0)));
	}
}