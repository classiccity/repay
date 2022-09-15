<?php
Class HeroSection {

    /**
     * @var WP_Post object
     */
    public $post;

    /**
     * @var string
     */
    public $title = "";

    /**
     * @var string
     */
    public $subtitle = "";

    /**
     * @var string
     */
    public $description = "";

    /**
     * @var array
     */
    public $buttons;

    /**
     * @var string
     */
    public $style = "";

    /**
     * @var string - Image URL
     */
    public $featured_image = "";

    /**
     * @var string - default hero prefix
     */
    public $prefix = "";

    /**
     * @var string - is it light or dark
     */
    public $color = "";

    /**
     * @var array - array of CSS classes
     */
    public $css_classes = array();

    /**
     * @var array
     */
    public $meta;


    public function __construct($post){

        // If we passed in an integer, get the post object
        if(is_numeric($post)) {
            $this->post = get_post($post);
        }

        // Else, we already have a post object
        else {
            $this->post = $post;
        }

        // Get all fields from the hero section
        $fields = get_fields($this->post->ID);

        // Make sure we should even output a hero
        if($fields['turn_off_hero'] !== true) {

            // // Remove extra CSS classes because that's at the "body" level
            // unset($fields['extra_css_classes']);

            // Remove turn off hero since we're already done with that
            unset($fields['turn_off_hero']);

            // Set the prefix
            $this->prefix = prefix().'-hero';

            // Do we have a title override? (yes, use it; else, use the Post Title)
            if(strlen($fields['title_override']) > 1) {

                // Use the override
                $this->title = $fields['title_override'];

                // Unset the array (so we only have "extra" fields remaining)
                unset($fields['title_override']);

            }

            // Using the default Post Title for the title
            else {
                $this->title = $this->post->post_title;
            }

            // Set the subtitle
            $this->subtitle = $fields['subtitle'];

            // Unset the subtitle field (so we only have "extra" fields remaining)
            unset($fields['subtitle']);

            // Set the buttons
            $this->buttons = $fields['buttons'];

            // Unset the buttons field (so we only have "extra" fields remaining)
            unset($fields['buttons']);

						// Set the padding choice (boolean)
						$this->small = $fields['small'];

						// Unset the padding choice field
						unset($fields['small']);

            // Set the style
            $this->style = $fields['hero_style'];

            // Unset the style field (so we only have "extra" fields remaining)
            unset($fields['hero_style']);

            // Add the leftover fields to the object (these are typically style-specific features)
            $this->meta = $fields;

            // Let's remove any weird text from the background color
            if(isset($this->meta['hero_background_color'])) {
                $this->meta['hero_background_color'] = str_replace('has-','',$this->meta['hero_background_color']);
                $this->meta['hero_background_color'] = str_replace('-background-color','',$this->meta['hero_background_color']);
            } else {
							$this->meta['hero_background_color'] = '';
						}

            // Should we apply defaults?
            $this->should_apply_default_data_points();

            // Let's apply some generic CSS classes
            $this->add_basic_css_classes();

            // -- Now let's figure out which HTML output to use -- //
            $this->choose_html_output();

        }

    }

    /**
     * Conditionals to determine whether we should apply default data points.
     *
     * Use this function to do page-specific overrides (or page-type-specific overrides), etc.
     */
    public function should_apply_default_data_points() {

        // Is this a Single Page?
        if(is_page($this->post->ID)) {

            // Do we have a Style?
            if(strlen($this->style) < 1) {
                $this->style = "standard";
            }

						$background_image_url = "";
						$background_image_override = $this->meta['background_image_override'];

						if( ! empty( $background_image_override ) &&  ! empty( $background_image_override['url'] ) ) {
							$background_image_url = $background_image_override['url'];
						} else {
							$background_image_url = get_the_post_thumbnail_url($this->post, prefix().'-background-image');
							if( empty( $background_image_url )) {
								$background_image_url = get_the_post_thumbnail_url($this->post, 'full');
							}
						}
						$this->background_image_url = $background_image_url;

            // // If it's the Full Video style, we want the text to be WHITE
            // if($this->style === "full-height-video") {
            //     $this->color = "is-dark";
            // }

            // // Do we have a Color?
            // if(strlen($this->meta['hero_background_color']) < 1) {
            //     $this->meta['hero_background_color'] = "primary-dark";
            // }

        }

    }

    /**
     * Add the basic CSS classes based on the object
     */
    public function add_basic_css_classes() {

        $this->css_classes[] = $this->prefix;
        $this->css_classes[] = "is-".$this->style;
        $this->css_classes[] = $this->color;
				if( $this->small) {
					$this->css_classes[] = "is-small";
				}

    }

    /**
     * Dynamically pick which header HTML to utilize
     * Go into Advanced Custom Fields and edit the *Style* dropdown menu
     * to add more style options.
     */
    public function choose_html_output() {

        // If it's the Simple style
        if($this->style === "standard" || $this->style === "standard-image-right") {
          $this->html_simple();
        } elseif($this->style === "info-with-form") {
					$this->html_info_with_form();
				}


				// elseif($this->style === "double-image") {
        //     $this->html_double_image();
        // } elseif($this->style === "contained") {
        //     $this->html_contained();
        // } elseif($this->style === "two-column") {
        //     $this->html_two_column();
        // } elseif($this->style === "full-height-video") {
        //     $this->html_full_height_video();
        // }

        else {
            $this->html_simple();
        }

    }




    public function html_simple() {

        // Adding in specific CSS classes
        $this->css_classes[] = "has-overlay";
        $this->css_classes[] = "alignfull";
				$this->css_classes[] = "html_simple";

        ?>

        <div class="<?=implode(" ",$this->css_classes)?>">

          <div class="<?=$this->prefix?>__background-image" style="background-image: url(<?php echo $this->background_image_url; ?>);"></div>
					<div class="<?=$this->prefix?>__overlay has-<?=$this->meta['hero_background_color']?>-background-color has-background-color"></div>

            <div class="<?=$this->prefix?>__content container xalignwide">
                <div class="group">
                    <div class="<?=$this->prefix?>__content-wrapper">

											<div class="<?=$this->prefix?>__glass-box">

												<?php if(strlen($this->title) > 1) { ?>
													<h1>
														<?=apply_shortcodes($this->title)?>
													</h1>
												<?php } ?>

												<?php if(strlen($this->subtitle) > 1) { ?>
														<p class="is-subtitle">
															<?=$this->subtitle?>
														</p>
												<?php } ?>

												<?php if( is_array($this->buttons) && ! empty($this->buttons) ) { ?>
														<div class="wp-block-buttons">
																<?php
																foreach($this->buttons as $button) {
																	UI::html_acf_link( $button['button'], 'button has-repay-lime-background-color' );
																} ?>
														</div>
												<?php } ?>

											</div>


                    </div>
                </div>
            </div>
        </div>

    <?php }

		public function html_info_with_form() {

			// Adding in specific CSS classes
			$this->css_classes[] = "has-overlay";
			$this->css_classes[] = "alignfull";
			$this->css_classes[] = "html_info_with_form";
			?>

			<div class="<?=implode(" ",$this->css_classes)?>" style="background-image: url(<?php echo $this->background_image_url; ?>);">
				<div class="<?=$this->prefix?>__overlay has-<?=$this->meta['hero_background_color']?>-background-color has-background-color"></div>
				<div class="<?=$this->prefix?>__content xcontainer alignwide">
					<div class="group">

						<div class="c c-12 <?=$this->prefix?>__hero-info-with-form">
							<div class="<?=$this->prefix?>__hero-form" id="hero-form">

								<?php echo do_shortcode('[ninja_form id='.$this->meta['form_id'].']'); ?>

							</div>
							<div class="<?=$this->prefix?>__hero-info">

								<h1>
									<?php echo apply_shortcodes($this->title); ?>
								</h1>

								<div>
									<?php echo $this->meta['info']; ?>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>

			<script>
				function moveFormClasses( tries = 10 ) {
					const hero_form = document.getElementById('hero-form');
					const repay_50s = hero_form.getElementsByClassName('repay-50');
					if(repay_50s[0]) {
						for(let i=0; repay_50s[i]; i++) {
							repay_50s[i].parentElement.classList.add('repay-50');
						}
					}
					else if(tries) {
						tries--;
						window['moveFormClasses_tries'] = tries;

						setTimeout(function() {
							tries = window['moveFormClasses_tries'];
							moveFormClasses(tries);
						}, 500);
					}
				}
				setTimeout(moveFormClasses, 500);
			</script>

		<?php }

}