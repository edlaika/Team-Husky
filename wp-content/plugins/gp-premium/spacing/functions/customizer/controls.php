<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'GeneratePress_Spacing_Control' ) ) :
class GeneratePress_Spacing_Control extends WP_Customize_Control {

	public $type = 'generatepress-spacing';

	public $l10n = array();
	
	public $element = '';

	public function __construct( $manager, $id, $args = array() ) {
		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );
		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'top'            => esc_html__( 'Top', 'generate-spacing' ),
				'right'          => esc_html__( 'Right',   'generate-spacing' ),
				'bottom'         => esc_html__( 'Bottom', 'generate-spacing' ),
				'left'           => esc_html__( 'Left',  'generate-spacing' )
			)
		);
	}

	public function enqueue() {
		wp_enqueue_script( 'gp-spacing-customizer', plugin_dir_url( __FILE__ )  . '/js/spacing-customizer.js', array( 'customize-controls' ), GENERATE_SPACING_VERSION, true );
	}

	public function to_json() {
		parent::to_json();
		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {
			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);
		}
		
		$this->json[ 'element' ] = $this->element;
		$this->json[ 'title' ] = __( 'Link values','generate-spacing' );
		$this->json[ 'unlink_title' ] = __( 'Un-link values','generate-spacing' );
	}

	public function content_template() { 
		?>
		<# if ( data.label ) { #>
			<label for="{{{ data.element }}}-{{{ data.top.label }}}">
				<span class="customize-control-title">{{ data.label }}</span>
			</label>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
	
		<div class="gp-spacing-section">
			<input id="{{{ data.element }}}-{{{ data.top.label }}}" min="0" class="generate-number-control spacing-top" type="number" style="text-align: center;" {{{ data.top.link }}} value="{{{ data.top.value }}}" />
			<# if ( data.top.label ) { #>
				<span class="description" style="font-style:normal;">{{ data.top.label }}</span>
			<# } #>
		</div>
		
		<div class="gp-spacing-section">
			<input min="0" class="generate-number-control spacing-right" type="number" style="text-align: center;" {{{ data.right.link }}} value="{{{ data.right.value }}}" />
			<# if ( data.right.label ) { #>
				<span class="description" style="font-style:normal;">{{ data.right.label }}</span>
			<# } #>
		</div>
		
		<div class="gp-spacing-section">
			<input min="0" class="generate-number-control spacing-bottom" type="number" style="text-align: center;" {{{ data.bottom.link }}} value="{{{ data.bottom.value }}}" />
			<# if ( data.bottom.label ) { #>
				<span class="description" style="font-style:normal;">{{ data.bottom.label }}</span>
			<# } #>
		</div>
		
		<div class="gp-spacing-section">
			<input min="0" class="generate-number-control spacing-left" type="number" style="text-align: center;" {{{ data.left.link }}} value="{{{ data.left.value }}}" />
			<# if ( data.left.label ) { #>
				<span class="description" style="font-style:normal;">{{ data.left.label }}</span>
			<# } #>
		</div>
		
		<# if ( data.element ) { #>
			<div class="gp-spacing-section gp-link-spacing-section">
				<span class="dashicons dashicons-editor-unlink gp-link-spacing" data-element="{{ data.element }}" title="{{ data.title }}"></span>
				<span class="dashicons dashicons-admin-links gp-unlink-spacing" style="display:none" data-element="{{ data.element }}" title="{{ data.unlink_title }}"></span>
			</div>
		<# } #>
		<?php 
	}
}
endif;

if ( !class_exists('Generate_Customize_Spacing_Slider_Control') ) :
/**
 *	Create our container width slider control
 */
class Generate_Customize_Spacing_Slider_Control extends WP_Customize_Control
{
	// Setup control type
	public $type = 'gp-spacing-slider';
	public $id = '';
	public $default_value = '';
	public $unit = '';
	public $edit_field = true;
	
	public function to_json() {
		parent::to_json();
		$this->json[ 'link' ] = $this->get_link();
		$this->json[ 'value' ] = $this->value();
		$this->json[ 'id' ] = $this->id;
		$this->json[ 'default_value' ] = $this->default_value;
		$this->json[ 'reset_title' ] = esc_attr__( 'Reset','generate-spacing' );
		$this->json[ 'unit' ] = $this->unit;
		$this->json[ 'edit_field' ] = $this->edit_field;
	}
	
	public function content_template() {
		?>
		<label>
			<p style="margin-bottom:0;">
				<span class="spacing-size-label customize-control-title">
					{{ data.label }}
				</span> 
				<span class="value">
					<input <# if ( '' == data.unit || ! data.edit_field ) { #>style="display:none;"<# } #> name="{{ data.id }}" type="number" {{{ data.link }}} value="{{{ data.value }}}" class="slider-input" /><span <# if ( '' == data.unit || ! data.edit_field ) { #>style="display:none;"<# } #> class="px">{{ data.unit }}</span>
					<# if ( '' !== data.unit && ! data.edit_field ) { #><span class="no-edit-field"><span class="no-edit-value">{{ data.value }}</span>{{ data.unit }}</span><# } #>
				</span>
			</p>
		</label>
		<div class="slider gp-flat-slider <# if ( '' !== data.default_value ) { #>show-reset<# } #>"></div>
		<# if ( '' !== data.default_value ) { #><span style="cursor:pointer;" title="{{ data.reset_title }}" class="gp-spacing-slider-default-value" data-default-value="{{ data.default_value }}"><span class="gp-customizer-icon-undo" aria-hidden="true"></span><span class="screen-reader-text">{{ data.reset_title }}</span></span><# } #>
		<?php
	}
	
	// Function to enqueue the right jquery scripts and styles
	public function enqueue() {
		
		wp_enqueue_script( 'gp-spacing-customizer', trailingslashit( plugin_dir_url( __FILE__ ) )  . 'js/spacing-customizer.js', array( 'customize-controls' ), GENERATE_SPACING_VERSION, true );
		wp_enqueue_style( 'gp-spacing-customizer-controls-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/customizer.css', array(), GENERATE_SPACING_VERSION );
		
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
		
		wp_enqueue_script( 'generate-spacing-slider-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/spacing-slider.js', array( 'jquery-ui-slider' ), GENERATE_SPACING_VERSION );
		
		wp_enqueue_style('generate-ui-slider', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/jquery-ui.structure.css');
		wp_enqueue_style('generate-flat-slider', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/range-slider.css');
		
	}
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Spacing_Customize_Control' ) ) :
/* 
 * Add our control for our padding options
 * @deprecated 1.2.95
 */ 
class Generate_Spacing_Customize_Control extends WP_Customize_Control {
	public $type = 'spacing';
	public $description = '';
	
	public function enqueue() {
		wp_enqueue_script( 'gp-spacing-customizer', plugin_dir_url( __FILE__ )  . '/js/spacing-customizer.js', array( 'customize-controls' ), GENERATE_SPACING_VERSION, true );
	}
	
	public function to_json() {
		parent::to_json();
		$this->json[ 'link' ] = $this->get_link();
		$this->json[ 'value' ] = absint( $this->value() );
		$this->json[ 'description' ] = esc_html( $this->description );
	}
	
	public function content_template() {
		?>
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			
			<input class="generate-number-control" type="number" style="text-align: center;" {{{ data.link }}} value="{{{ data.value }}}" />
			
			<# if ( data.description ) { #>
				<span class="description" style="font-style:normal;">{{ data.description }}</span>
			<# } #>
		</label>
		<?php
	}
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Spacing_Customize_Misc_Control' ) ) :
/* 
 * Add a class to display headings
 * @deprecated 1.2.95
 */ 
class Generate_Spacing_Customize_Misc_Control extends WP_Customize_Control {
    public $settings = 'generate_spacing_headings';
    public $description = '';
	public $areas = '';
 
    public function render_content() {
        switch ( $this->type ) {
            default:
            case 'text' : ?>
				<label>
					<span class="customize-control-title"><?php echo $this->description;?></span>
				</label>
			<?php break;
 
            case 'spacing-heading':
                if ( ! empty( $this->label ) ) echo '<span class="customize-control-title spacing-title">' . esc_html( $this->label ) . '</span>';
				if ( ! empty( $this->description ) ) echo '<span class="spacing-title-description">' . esc_html( $this->description ) . '</span>';
				if ( ! empty( $this->areas ) ) :
					echo '<div style="clear:both;display:block;"></div>';
					foreach ( $this->areas as $value => $label ) :
						echo '<span class="spacing-area">' . esc_html( $label ) . '</span>';
					endforeach;
				endif;
			break;
 
            case 'line' :
                echo '<hr />';
			break;
        }
    }
}
endif;