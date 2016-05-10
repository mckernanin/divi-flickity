<?php
class DVFL_Builder_Module_Slider extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Slider', 'et_builder' );
		$this->slug            = 'et_pb_slider';
		$this->child_slug      = 'et_pb_slide';
		$this->child_item_text = esc_html__( 'Slide', 'et_builder' );

		$this->whitelisted_fields = array(
			'show_arrows',
			'show_pagination',
			'auto',
			'auto_speed',
			'auto_ignore_hover',
			'parallax',
			'parallax_method',
			'remove_inner_shadow',
			'background_position',
			'background_size',
			'admin_label',
			'module_id',
			'module_class',
			'top_padding',
			'bottom_padding',
			'hide_content_on_mobile',
			'hide_cta_on_mobile',
			'show_image_video_mobile',
			'top_padding_tablet',
			'top_padding_phone',
			'bottom_padding_tablet',
			'bottom_padding_phone',
		);

		$this->fields_defaults = array(
			'show_arrows'             => array( 'on' ),
			'show_pagination'         => array( 'on' ),
			'auto'                    => array( 'off' ),
			'auto_speed'              => array( '7000' ),
			'auto_ignore_hover'       => array( 'off' ),
			'parallax'                => array( 'off' ),
			'parallax_method'         => array( 'off' ),
			'remove_inner_shadow'     => array( 'off' ),
			'background_position'     => array( 'default' ),
			'background_size'         => array( 'default' ),
			'hide_content_on_mobile'  => array( 'off' ),
			'hide_cta_on_mobile'      => array( 'off' ),
			'show_image_video_mobile' => array( 'off' ),
		);

		$this->main_css_element = '%%order_class%%.divi_flickity_slider';
		$this->advanced_options = array(
			'fonts' => array(
				'header' => array(
					'label'    => esc_html__( 'Header', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .divi_flickity_slide_description .divi_flickity_slide_title",
					),
				),
				'body'   => array(
					'label'    => esc_html__( 'Body', 'et_builder' ),
					'css'      => array(
						'line_height' => "{$this->main_css_element}",
						'main' => "{$this->main_css_element} .divi_flickity_slide_content",
					),
				),
			),
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
				),
			),
		);
		$this->custom_css_options = array(
			'slide_description' => array(
				'label'    => esc_html__( 'Slide Description', 'et_builder' ),
				'selector' => '.divi_flickity_slide_description',
			),
			'slide_title' => array(
				'label'    => esc_html__( 'Slide Title', 'et_builder' ),
				'selector' => '.divi_flickity_slide_description .divi_flickity_slide_title',
			),
			'slide_button' => array(
				'label'    => esc_html__( 'Slide Button', 'et_builder' ),
				'selector' => 'a.divi_flickity_more_button',
			),
			'slide_controllers' => array(
				'label'    => esc_html__( 'Slide Controllers', 'et_builder' ),
				'selector' => '.et-pb-controllers',
			),
			'slide_active_controller' => array(
				'label'    => esc_html__( 'Slide Active Controller', 'et_builder' ),
				'selector' => '.et-pb-controllers .et-pb-active-control',
			),
			'slide_image' => array(
				'label'    => esc_html__( 'Slide Image', 'et_builder' ),
				'selector' => '.divi_flickity_slide_image',
			),
			'slide_arrows' => array(
				'label'    => esc_html__( 'Slide Arrows', 'et_builder' ),
				'selector' => '.et-pb-slider-arrows a',
			),
		);
	}

	function get_fields() {
		$fields = array(
			'show_arrows'         => array(
				'label'           => esc_html__( 'Arrows', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Show Arrows', 'et_builder' ),
					'off' => esc_html__( 'Hide Arrows', 'et_builder' ),
				),
				'description'     => esc_html__( 'This setting will turn on and off the navigation arrows.', 'et_builder' ),
			),
			'show_pagination' => array(
				'label'             => esc_html__( 'Show Controls', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'       => esc_html__( 'This setting will turn on and off the circle buttons at the bottom of the slider.', 'et_builder' ),
			),
			'auto' => array(
				'label'           => esc_html__( 'Automatic Animation', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'Off', 'et_builder' ),
					'on'  => esc_html__( 'On', 'et_builder' ),
				),
				'affects' => array(
					'#divi_flickity_auto_speed, #divi_flickity_auto_ignore_hover',
				),
				'description'        => esc_html__( 'If you would like the slider to slide automatically, without the visitor having to click the next button, enable this option and then adjust the rotation speed below if desired.', 'et_builder' ),
			),
			'auto_speed' => array(
				'label'             => esc_html__( 'Automatic Animation Speed (in ms)', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'depends_default'   => true,
				'description'       => esc_html__( "Here you can designate how fast the slider fades between each slide, if 'Automatic Animation' option is enabled above. The higher the number the longer the pause between each rotation.", 'et_builder' ),
			),
			'auto_ignore_hover' => array(
				'label'           => esc_html__( 'Continue Automatic Slide on Hover', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'depends_default' => true,
				'options'         => array(
					'off' => esc_html__( 'Off', 'et_builder' ),
					'on'  => esc_html__( 'On', 'et_builder' ),
				),
				'description' => esc_html__( 'Turning this on will allow automatic sliding to continue on mouse hover.', 'et_builder' ),
			),
			'parallax' => array(
				'label'           => esc_html__( 'Use Parallax effect', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects'           => array(
					'#divi_flickity_parallax_method',
					'#divi_flickity_background_position',
					'#divi_flickity_background_size',
				),
				'description'        => esc_html__( 'Enabling this option will give your background images a fixed position as you scroll.', 'et_builder' ),
			),
			'parallax_method' => array(
				'label'           => esc_html__( 'Parallax method', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'CSS', 'et_builder' ),
					'on'  => esc_html__( 'True Parallax', 'et_builder' ),
				),
				'depends_show_if'   => 'on',
				'description'       => esc_html__( 'Define the method, used for the parallax effect.', 'et_builder' ),
			),
			'remove_inner_shadow' => array(
				'label'           => esc_html__( 'Remove Inner Shadow', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
			),
			'background_position' => array(
				'label'           => esc_html__( 'Background Image Position', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options' => array(
					'default'       => esc_html__( 'Default', 'et_builder' ),
					'top_left'      => esc_html__( 'Top Left', 'et_builder' ),
					'top_center'    => esc_html__( 'Top Center', 'et_builder' ),
					'top_right'     => esc_html__( 'Top Right', 'et_builder' ),
					'center_right'  => esc_html__( 'Center Right', 'et_builder' ),
					'center_left'   => esc_html__( 'Center Left', 'et_builder' ),
					'bottom_left'   => esc_html__( 'Bottom Left', 'et_builder' ),
					'bottom_center' => esc_html__( 'Bottom Center', 'et_builder' ),
					'bottom_right'  => esc_html__( 'Bottom Right', 'et_builder' ),
				),
				'depends_show_if'   => 'off',
			),
			'background_size' => array(
				'label'           => esc_html__( 'Background Image Size', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'default' => esc_html__( 'Default', 'et_builder' ),
					'contain' => esc_html__( 'Fit', 'et_builder' ),
					'initial' => esc_html__( 'Actual Size', 'et_builder' ),
				),
				'depends_show_if'   => 'off',
			),
			'top_padding' => array(
				'label'           => esc_html__( 'Top Padding', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
				'validate_unit'   => true,
			),
			'bottom_padding' => array(
				'label'           => esc_html__( 'Bottom Padding', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
				'validate_unit'   => true,
			),
			'hide_content_on_mobile' => array(
				'label'           => esc_html__( 'Hide Content On Mobile', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'tab_slug'          => 'advanced',
			),
			'hide_cta_on_mobile' => array(
				'label'           => esc_html__( 'Hide CTA On Mobile', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'tab_slug'          => 'advanced',
			),
			'show_image_video_mobile' => array(
				'label'           => esc_html__( 'Show Image / Video On Mobile', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'tab_slug'        => 'advanced',
			),
			'top_padding_tablet' => array(
				'type' => 'skip',
			),
			'top_padding_phone' => array(
				'type' => 'skip',
			),
			'bottom_padding_tablet' => array(
				'type' => 'skip',
			),
			'bottom_padding_phone' => array(
				'type' => 'skip',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'divi_flickity_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'divi_flickity_custom_css_regular',
			),
		);
		return $fields;
	}

	function pre_shortcode_content() {
		global $et_pb_slider_has_video, $et_pb_slider_parallax, $et_pb_slider_parallax_method, $et_pb_slider_hide_mobile, $et_pb_slider_custom_icon, $et_pb_slider_item_num;

		$et_pb_slider_item_num = 0;

		$parallax                = $this->shortcode_atts['parallax'];
		$parallax_method         = $this->shortcode_atts['parallax_method'];
		$hide_content_on_mobile  = $this->shortcode_atts['hide_content_on_mobile'];
		$hide_cta_on_mobile      = $this->shortcode_atts['hide_cta_on_mobile'];
		$button_custom           = $this->shortcode_atts['custom_button'];
		$custom_icon             = $this->shortcode_atts['button_icon'];

		$et_pb_slider_has_video = false;

		$et_pb_slider_parallax = $parallax;

		$et_pb_slider_parallax_method = $parallax_method;

		$et_pb_slider_hide_mobile = array(
			'hide_content_on_mobile'  => $hide_content_on_mobile,
			'hide_cta_on_mobile'      => $hide_cta_on_mobile,
		);

		$et_pb_slider_custom_icon = 'on' === $button_custom ? $custom_icon : '';

	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		wp_enqueue_script( 'flickity' );
		wp_enqueue_style( 'flickity' );

		$module_id               = $this->shortcode_atts['module_id'];
		$module_class            = $this->shortcode_atts['module_class'];
		$show_arrows             = $this->shortcode_atts['show_arrows'];
		$show_pagination         = $this->shortcode_atts['show_pagination'];
		$parallax                = $this->shortcode_atts['parallax'];
		$parallax_method         = $this->shortcode_atts['parallax_method'];
		$auto                    = $this->shortcode_atts['auto'];
		$auto_speed              = $this->shortcode_atts['auto_speed'];
		$auto_ignore_hover       = $this->shortcode_atts['auto_ignore_hover'];
		$top_padding             = $this->shortcode_atts['top_padding'];
		$body_font_size 		 = $this->shortcode_atts['body_font_size'];
		$bottom_padding          = $this->shortcode_atts['bottom_padding'];
		$top_padding_tablet      = $this->shortcode_atts['top_padding_tablet'];
		$top_padding_phone       = $this->shortcode_atts['top_padding_phone'];
		$bottom_padding_tablet   = $this->shortcode_atts['bottom_padding_tablet'];
		$bottom_padding_phone    = $this->shortcode_atts['bottom_padding_phone'];
		$remove_inner_shadow     = $this->shortcode_atts['remove_inner_shadow'];
		$hide_content_on_mobile  = $this->shortcode_atts['hide_content_on_mobile'];
		$hide_cta_on_mobile      = $this->shortcode_atts['hide_cta_on_mobile'];
		$show_image_video_mobile = $this->shortcode_atts['show_image_video_mobile'];
		$background_position     = $this->shortcode_atts['background_position'];
		$background_size         = $this->shortcode_atts['background_size'];

		global $et_pb_slider_has_video, $et_pb_slider_parallax, $et_pb_slider_parallax_method, $et_pb_slider_hide_mobile, $et_pb_slider_custom_icon;

		$content = $this->shortcode_content;

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		if ( '' !== $top_padding || '' !== $top_padding_tablet || '' !== $top_padding_phone ) {
			$padding_values = array(
				'desktop' => $top_padding,
				'tablet'  => $top_padding_tablet,
				'phone'   => $top_padding_phone,
			);

			et_pb_generate_responsive_css( $padding_values, '%%order_class%% .divi_flickity_slide_description, .divi_flickity_slider_fullwidth_off%%order_class%% .divi_flickity_slide_description', 'padding-top', $function_name );
		}

		if ( '' !== $bottom_padding || '' !== $bottom_padding_tablet || '' !== $bottom_padding_phone ) {
			$padding_values = array(
				'desktop' => $bottom_padding,
				'tablet'  => $bottom_padding_tablet,
				'phone'   => $bottom_padding_phone,
			);

			et_pb_generate_responsive_css( $padding_values, '%%order_class%% .divi_flickity_slide_description, .divi_flickity_slider_fullwidth_off%%order_class%% .divi_flickity_slide_description', 'padding-bottom', $function_name );
		}

		if ( '' !== $bottom_padding || '' !== $top_padding ) {
			ET_Builder_Module::set_style( $function_name, array(
				'selector'    => '%%order_class%% .divi_flickity_slide_description, .divi_flickity_slider_fullwidth_off%%order_class%% .divi_flickity_slide_description',
				'declaration' => 'padding-right: 0; padding-left: 0;',
			) );
		}

		if ( 'default' !== $background_position && 'off' === $parallax ) {
			$processed_position = str_replace( '_', ' ', $background_position );

			ET_Builder_Module::set_style( $function_name, array(
				'selector'    => '%%order_class%% .divi_flickity_slide',
				'declaration' => sprintf(
					'background-position: %1$s;',
					esc_html( $processed_position )
				),
			) );
		}

		if ( 'default' !== $background_size && 'off' === $parallax ) {
			ET_Builder_Module::set_style( $function_name, array(
				'selector'    => '%%order_class%% .divi_flickity_slide',
				'declaration' => sprintf(
					'-moz-background-size: %1$s;
					-webkit-background-size: %1$s;
					background-size: %1$s;',
					esc_html( $background_size )
				),
			) );
		}

		$fullwidth = 'divi_flickity_fullwidth_slider' === $function_name ? 'on' : 'off';

		$class  = '';
		$class .= 'off' === $fullwidth ? ' divi_flickity_slider_fullwidth_off' : '';
		$class .= 'off' === $show_arrows ? ' divi_flickity_slider_no_arrows' : '';
		$class .= 'off' === $show_pagination ? ' divi_flickity_slider_no_pagination' : '';
		$class .= 'on' === $parallax ? ' divi_flickity_slider_parallax' : '';
		$class .= 'on' === $auto ? ' divi_flickity_slider_auto et_slider_speed_' . esc_attr( $auto_speed ) : '';
		$class .= 'on' === $auto_ignore_hover ? ' divi_flickity_slider_auto_ignore_hover' : '';
		$class .= 'on' === $remove_inner_shadow ? ' divi_flickity_slider_no_shadow' : '';
		$class .= 'on' === $show_image_video_mobile ? ' divi_flickity_slider_show_image' : '';

		$output = sprintf(
			'<div%4$s class="et_pb_module divi_flickity_slider%1$s%3$s%5$s">
				<div class="divi_flickity_slides js-flickity">
					%2$s
				</div> <!-- .divi_flickity_slides -->
			</div> <!-- .divi_flickity_slider -->
			',
			$class,
			$content,
			( $et_pb_slider_has_video ? ' divi_flickity_preload' : '' ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);
		return $output;
	}
}
