<?php
namespace alfredogatencompanion\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class alfredogaten_term_calculator extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'alfredogaten-term-calculator';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Term Calculator', 'alfredogaten-companion' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'alfredogaten' ];
	}

	protected function _register_controls()
    {

        // add content
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_cre_term_calculator_section',
            [
                'label' => __('Text Box', 'alfredogaten-companion'),
            ]
        );

        $this->end_controls_section();
    }

    public function _styles_control(){

    }


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract($settings);

        ?>
           <div class="insuranceform_wrapper">
                <form class="row" id="insuranceform">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo*" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="birthday" class="form-label">Aniversário:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Data de nascimento*" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CÔNJUGE:</label>
                            <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="married" value="unmarried" id="married-no" autocomplete="off" required>
                                <label class="btn btn-outline-primary" for="married-no">No</label>

                                <input type="radio" class="btn-check" name="married" value="married" id="married-yes" autocomplete="off">
                                <label class="btn btn-outline-primary" for="married-yes">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Número de telefone::</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Seu número de telefone" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="annual-income-range" class="form-label">Renda anual (em lakhs)</label>
                            <div class="row">
								<div class="col text-end d-inline-flex justify-content-end">
									<span>$</span>
									<div id="annual-income-range-output">
										10
									</div>
									<span>,000</span>
								</div>
                                
                            </div>
                            <input type="range" class="form-range" value="10" min="10" max="30" step="5" id="annual-income-range" name="annual_income_range">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary calculate_Insurance" type="submit">Calcule agora</button>
                    </div>
                </form>
                <p id="result" class="mt-4 text-center"></p>
            </div>
        <?php
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
	}
}
