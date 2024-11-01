<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class Zeek_Button extends Widget_Base {

	public function get_name() {
		return 'zeek-addons-button';
	}

  public function get_title() {
      return esc_html__('ZK Button', 'zeek-addons-for-elementor');
  }

  public function get_icon() {
      return 'eicon-button';
  }

  public function get_categories() {
      return ['zeek-addons-elementor'];
  }

  public function get_keywords() {
      return [
          'button',
          'zk button',
          'zeek button',
          'animated button',
          'cta',
          'call to action',
          'zk',
          'marketing button',
          'zeek addons',
      ];
  }

	protected function _register_controls() {

		// Content Controls
		$this->start_controls_section(
				'zeek_addons_button_content',
				[
						'label' => esc_html__( 'Button Content', 'zeek-addons-for-elementor' ),
				]
		);


    $this->add_control(
      'zeek_addons_button_text',
      [
        'label'   =>  esc_html__( 'Text', 'zeek-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 'Learn More',
        'placeholder' => __( 'Button text', 'zeek-addons-for-elementor' ),
      ]
    );

    $this->add_control(
      'zeek_addons_button_url',
      [
        'label'   =>  esc_html__( 'URL', 'zeek-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'placeholder' => __( 'http://zeek.studio/', 'zeek-addons-for-elementor' ),
        'default' => [
					'url' => '',
				],
      ]
    );

    $this->add_control(
      'zeek_addons_button_hover_style',
      [
        'label'   =>  esc_html__( 'Hover Style', 'zeek-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default' => 'slide',
        'options' => [
					'none'  => __( 'none', 'zeek-addons-for-elementor' ),
					'slide' => __( 'Slide', 'zeek-addons-for-elementor' ),
          'shutter' => __( 'Shutter', 'zeek-addons-for-elementor' ),
				],
      ]
    );


    $this->add_control(
      'zeek_addons_button_hover_slide_dir',
      [
        'label'   =>  esc_html__( 'Slide Direction', 'zeek-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default' => 'stl',
        'options' => [
					'stl' => __( 'Slide to left', 'zeek-addons-for-elementor' ),
          'str' => __( 'Slide to right', 'zeek-addons-for-elementor' ),
          'stt' => __( 'Slide to top', 'zeek-addons-for-elementor' ),
          'stb' => __( 'Slide to bottom', 'zeek-addons-for-elementor' ),
				],
        'condition' =>  [
          'zeek_addons_button_hover_style' => 'slide',
        ]
      ]
    );

    $this->add_control(
      'zeek_addons_button_hover_shutter_dir',
      [
        'label'   =>  esc_html__( 'Shutter Direction', 'zeek-addons-for-elementor'),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default' => 'shutter-1',
        'options' => [
					'shutter-1' => __( 'Shutter out horizontal', 'zeek-addons-for-elementor' ),
          'shutter-2' => __( 'Slide out vertical', 'zeek-addons-for-elementor' ),
				],
        'condition' =>  [
          'zeek_addons_button_hover_style' => 'shutter',
        ]
      ]
    );


    $this->add_responsive_control(
      'zeek_addons_button_alignment',
      [
        'label' =>  __('Align', 'zeek-addons-for-elementor'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
					'left' => [
						'title' => __( 'Left', 'zeek-addons-for-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zeek-addons-for-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'zeek-addons-for-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
        'default' => 'left',
				'toggle' => true,
        'selectors' => [
  					'{{WRAPPER}} .zeek-addons-button-wrapper' => 'text-align: {{value}};',
  			]
      ]
    );

    $this->add_control(
			'zeek_addons_button_seprator',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

    $this->add_control(
      'zeek_addons_icon_switch',
      [
        'label' =>  __( 'Enable Icon', 'zeek-addons-for-elementor' ),
        'type'  =>  Controls_Manager::SWITCHER,
        'default' =>  'no',
      ]
    );


    $this->add_control(
			'zeek_addons_button_icon',
			[
				'label' => __( 'Select Icon', 'zeek-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
        'fa4compatibility' => 'zeek_addons_button_icon_comp',
        'condition' =>  [
          'zeek_addons_icon_switch' => 'yes',
        ]
			]
		);

    $this->add_control(
      'zeek_addons_button_icon_position',
      [
        'label'   =>  __( 'Icon Position', 'zeek-addons-for-elementor'),
        'type'    =>  Controls_Manager::SELECT,
        'default' =>  'after',
        'options' =>  [
          'after'  => __( 'After', 'zeek-addons-for-elementor' ),
					'before' => __( 'before', 'zeek-addons-for-elementor' ),
        ],
        'condition' =>  [
          'zeek_addons_icon_switch' => 'yes',
        ]
      ]
    );

    $this->add_responsive_control(
      'zeek_addons_button_icon_size',
      [
        'label'   =>  __( 'Icon Size', 'zeek-addons-for-elementor'),
        'type'    =>  Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em' , '%' ],
        'default' => [
					'unit' => 'px',
					'size' => 13,
				],
        'condition' =>  [
          'zeek_addons_icon_switch' => 'yes',
        ],
        'selectors' => [
  					'{{WRAPPER}} .zeek-addons-button-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .zeek-addons-button-wrapper svg' => 'width: {{SIZE}}{{UNIT}};',
  			]
      ]
    );


    $this->add_responsive_control(
      'zeek_addons_button_icon_spacing_before',
      [
        'label'   =>  __( 'Icon Spacing', 'zeek-addons-for-elementor'),
        'type'    =>  Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em' , '%' ],
        'condition' => [
            'zeek_addons_button_icon_position'  =>  'before',
            'zeek_addons_icon_switch' => 'yes',
        ],
        'selectors' => [
  					'{{WRAPPER}} .zeek-addons-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
  			]
      ]
    );

    $this->add_responsive_control(
      'zeek_addons_button_icon_spacing_after',
      [
        'label'   =>  __( 'Icon Spacing', 'zeek-addons-for-elementor'),
        'type'    =>  Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em' , '%' ],
        'condition' => [
            'zeek_addons_button_icon_position'  =>  'after',
            'zeek_addons_icon_switch' => 'yes',
        ],
        'selectors' => [
  					'{{WRAPPER}} .zeek-addons-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
  			]
      ]
    );

    $this->end_controls_section();

    //style section
    $this->start_controls_section(
      'zeek_addons_button_style',
      [
        'label'   => __( 'Button Style', 'zeek-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name'     => 'zeek_addons_button_typography',
            'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .zeek-addons-button-text',
        ]
    );

    $this->start_controls_tabs( 'zeek_addons_button_tabs' );

      $this->start_controls_tab( 'normal', ['label' => esc_html__( 'Normal', 'zeek-addons-for-elementor' )] );

      $this->add_control(
        'zeek_addons_button_text_color',
        [
          'label' =>  __( 'Text Color', 'zeek-addons-for-elementor'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#fff',
          'selectors' => [
              '{{WRAPPER}} .zeek-addons-button-inner--none,
              {{WRAPPER}} .zeek-addons-button-inner--stl,
              {{WRAPPER}} .zeek-addons-button-inner--str,
              {{WRAPPER}} .zeek-addons-button-inner--stb,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-1,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-2,
              {{WRAPPER}} .zeek-addons-button-inner--stt'  => 'color: {{VALUE}};',

          ],
        ]
      );

      $this->add_control(
        'zeek_addons_button_icon_color',
        [
          'label' =>  __( 'Icon Color', 'zeek-addons-for-elementor'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#fff',
          'selectors' => [
              '{{WRAPPER}} .zeek-addons-button--none i'  => 'color: {{VALUE}};',
              '{{WRAPPER}} .zeek-addons-button i'  => 'color: {{VALUE}};',
          ],
        ]
      );

      $this->add_control(
        'zeek_addons_button_background_color',
        [
          'label' =>  __( 'Background Color', 'zeek-addons-for-elementor'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#6185D7',
          'selectors' => [
              '{{WRAPPER}} .zeek-addons-button-inner--none,
              {{WRAPPER}} .zeek-addons-button-inner--stl,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-1,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-2,
              {{WRAPPER}} .zeek-addons-button-inner--str,
              {{WRAPPER}} .zeek-addons-button-inner--stb,
              {{WRAPPER}} .zeek-addons-button-inner--stt'  => 'background-color: {{VALUE}};'
          ],
        ]
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'zeek_addons_button_border',
          'label' => __( 'Border', 'zeek-addons-for-elementor' ),
          'selector' => '{{WRAPPER}} .zeek-addons-button',
        ]
      );

      $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'zeek_addons_button_shadow',
				'label' => __( 'Box Shadow', 'zeek-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .zeek-addons-button',
			]
		);

    $this->end_controls_tab();

    $this->start_controls_tab( 'hover', ['label' => esc_html__( 'Hover', 'zeek-addons-for-elementor' )] );

      $this->add_control(
        'zeek_addons_button_text_color_hover',
        [
          'label' =>  __( 'Text Color', 'zeek-addons-for-elementor'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#fff',
          'selectors' => [
              '{{WRAPPER}} .zeek-addons-button-inner--none:hover,
              {{WRAPPER}} .zeek-addons-button-inner--stl:hover,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-1:hover,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-2:hover,
              {{WRAPPER}} .zeek-addons-button-inner--str:hover,
              {{WRAPPER}} .zeek-addons-button-inner--stb:hover,
              {{WRAPPER}} .zeek-addons-button-inner--stt:hover'  => 'color: {{VALUE}};',
          ],
        ]
      );

      $this->add_control(
        'zeek_addons_button_icon_color_hover',
        [
          'label' =>  __( 'Icon Color', 'zeek-addons-for-elementor'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#fff',
          'selectors' => [
              '{{WRAPPER}} .zeek-addons-button:hover i'  => 'color: {{VALUE}} !important;',
          ],
        ]
      );

      $this->add_control(
        'zeek_addons_button_background_color_hover',
        [
          'label' =>  __( 'Background Color', 'zeek-addons-for-elementor'),
          'type'      => Controls_Manager::COLOR,
          'default'   => '#000',
          'selectors' => [
              '{{WRAPPER}} .zeek-addons-button-inner--none:hover,
              {{WRAPPER}} .zeek-addons-button-inner--stl::before,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-1::before,
              {{WRAPPER}} .zeek-addons-button-inner--shutter-2::before,
              {{WRAPPER}} .zeek-addons-button-inner--str::before,
              {{WRAPPER}} .zeek-addons-button-inner--stb::before,
              {{WRAPPER}} .zeek-addons-button-inner--stt::before'  => 'background-color: {{VALUE}};',
          ],
        ]
      );


      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'zeek_addons_button_border_hover',
          'label' => __( 'Border', 'zeek-addons-for-elementor' ),
          'selector' => '{{WRAPPER}} .zeek-addons-button:hover',
        ]
      );

      $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'zeek_addons_button_shadow_hover',
				'label' => __( 'Box Shadow', 'zeek-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .zeek-addons-button:hover',
			]
		);

    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->add_control(
			'zeek_addons_button_seprator1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

    $this->add_control(
      'zeek_addons_button_padding',
      [
        'label' => __( 'Padding', 'zeek-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .zeek-addons-button-inner--none,
            {{WRAPPER}} .zeek-addons-button-inner--stl,
            {{WRAPPER}} .zeek-addons-button-inner--shutter-1,
            {{WRAPPER}} .zeek-addons-button-inner--shutter-2,
            {{WRAPPER}} .zeek-addons-button-inner--str,
            {{WRAPPER}} .zeek-addons-button-inner--stb,
            {{WRAPPER}} .zeek-addons-button-inner--stt'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ]
      ]
    );

    $this->add_control(
      'zeek_addons_button_margin',
      [
        'label' => __( 'Margin', 'zeek-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .zeek-addons-button'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ]
      ]
    );


  $this->end_controls_section();

	}

	protected function render() {

  	$settings = $this->get_settings();

    $this->add_render_attribute( 'zeek_addons_button_url', [
        'href'  => esc_attr( $settings['zeek_addons_button_url']['url'] ),
        'class' => ['zeek-addons-button'],
    ] );

    if( $settings['zeek_addons_button_hover_style'] == 'none' ){
      $this->add_render_attribute( 'zeek_addons_button', [
          'class' => ['zeek-addons-button zeek-addons-button-inner--none'],
      ] );
    }
    if( $settings['zeek_addons_button_hover_style'] == 'slide' ){
      $this->add_render_attribute( 'zeek_addons_button', [
          'class' => ['zeek-addons-button zeek-addons-button-inner--' . esc_attr( $settings['zeek_addons_button_hover_slide_dir'] )],
      ] );
    }
    if( $settings['zeek_addons_button_hover_style'] == 'shutter' ){
      $this->add_render_attribute( 'zeek_addons_button', [
          'class' => ['zeek-addons-button zeek-addons-button-inner--' . esc_attr( $settings['zeek_addons_button_hover_shutter_dir'] )],
      ] );
    }


  	?>

    <div class="zeek-addons-button-wrapper">
      <a <?php echo $this->get_render_attribute_string( 'zeek_addons_button_url' ); ?>>
        <div <?php echo $this->get_render_attribute_string( 'zeek_addons_button' ); ?>>
          <?php if( $settings['zeek_addons_button_icon_position'] == 'before' && $settings['zeek_addons_icon_switch'] == 'yes'){ ?>
            <span class="zeek-addons-icon-before">
              <?php \Elementor\Icons_Manager::render_icon( $settings['zeek_addons_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
          <?php } ?>
          <span class="zeek-addons-button-text">
            <?php echo $settings['zeek_addons_button_text']; ?>
          </span>
          <?php if( $settings['zeek_addons_button_icon_position'] == 'after' && $settings['zeek_addons_icon_switch'] == 'yes'){ ?>
            <span class="zeek-addons-icon-after">
              <?php \Elementor\Icons_Manager::render_icon( $settings['zeek_addons_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
          <?php } ?>
        </div>
      </a>
    </div>



	<?php
	}

}
