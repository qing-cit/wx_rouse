<?php
if (have_rows('pb_content')):
	// loop through the rows of Data
	while (have_rows('pb_content')):
		the_row();
    
		if (get_row_layout() == 'block_content'):
			?>
				<section class="white-section br_editor" <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?>>
				<div class="center-holder">
					<?php echo get_sub_field('editor_content'); ?>
				</div>
			</section>
	      <?php
		  
		   // COLUMNS
		  
  		elseif (get_row_layout() == 'column_content'):if (get_sub_field('columns')):
  			?>
  				<section class="white-section br_editor" <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?>>
  				<div class="stack-content stack-cols">
						<?php 	while (has_sub_field('columns')): ?>
							<div class="stack-col">
  					<?php echo get_sub_field('editor_columns'); ?>
				</div>
					<?php endwhile;
					endif; ?>
  				</div>
  			</section>
  	      <?php
		  
		// SCREENSHOTS GALLERY

		elseif (get_row_layout() == 'screenshots_content'): 
		   $pclass='';
		   if(get_sub_field('background') == 'image') {
			   $pclass = 'parallax-section';
		   }
			?>
	    <section class="<?php echo esc_attr($pclass); ?>" <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?> style="background-color:<?php echo esc_attr(get_sub_field('color')); ?>;<?php if(get_sub_field('background') == 'image') { ?>background-image:url('<?php echo esc_attr(get_sub_field('sc_image')); ?>');<?php } ?>">
					
			<div class="gallery-container">
		<h2 style="color:<?php echo esc_attr(get_sub_field('font_color')); ?>;"><?php echo esc_attr(get_sub_field('title')); ?></h2>
		<h4 style="color:<?php echo esc_attr(get_sub_field('subfont_color')); ?>;"><?php echo esc_attr(get_sub_field('subtitle')); ?></h4>
	      <div id="stack-preview">
	        <div id="imgFull">
	          <img src="https://placehold.it/150x350" alt="full-img">
	        </div>
	      </div>
	      <div class="gallery">
					<?php
					$i = 0;
					
					
					$images = get_sub_field('screenshots');

					if( $images ): 
					    $i = 0;
					      foreach( $images as $image ):
							  $i++;
							  $stutter = ($i * .2); ?>
					          <img src="<?php echo esc_url($image['url']); ?>" width="225" alt="<?php echo esc_attr($image['alt']); ?>" data-sr="ease-in 20px, over .5s, wait <?php echo esc_attr($stutter) ?>s">
					               
					        <?php endforeach; ?>
					<?php endif; ?>
					
					
					
						
							<?php
							
						 ?>
						<?php
						?>
			</div>
		</div>
		</section>
		
		
					<?php
												
		// TEAM
		
		elseif (get_row_layout() == 'team_content'): ?>
		
	    <section class="stack-team" <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?> style="background-color:<?php echo esc_attr(get_sub_field('color')); ?>;<?php if(get_sub_field('background') == 'image') { ?>background-image:url('<?php echo esc_attr(get_sub_field('image')); } ?>');">
			<div class="row">
				<div class="stack-heading">
				<h2 style="color:<?php echo esc_attr(get_sub_field('font_color')); ?>;"><?php echo esc_attr(get_sub_field('title')); ?></h2>
				<h4 style="color:<?php echo esc_attr(get_sub_field('subfont_color')); ?>;"><?php echo esc_attr(get_sub_field('subtitle')); ?></h4>
			</div>
			<div class="stack-members">
				<?php
				if (get_sub_field('team_member')):
					$t = 0;
				while (has_sub_field('team_member')): 
					$stuttert = ($t * .2)
						?>
				
				<div class="col">
		        <figure class="img-wrapper" data-sr="enter bottom, over .5s, wait <?php echo esc_attr($stuttert) ?>s">
					<?php 
					$size = 'stack-team';
					$team_img = get_sub_field('image');
					echo wp_get_attachment_image( $team_img, $size ); ?>
		            <figcaption>
		                <h2 class="title"><?php
									echo esc_attr(get_sub_field('name')); ?></h2>
		                <div class="bottom-detail">
		                    <p><?php
										echo esc_attr(get_sub_field('text')); ?></p>
		                    <ul class="social-icons">
												<?php if(get_sub_field('twitter'))
												{ ?>
		                        <li><a class="fa fa-twitter" href="<?php
												echo esc_url(get_sub_field('twitter')); ?>" target="_blank"></a></li>
										<?php } ?>
										<?php if(get_sub_field('linkedin'))
										{ ?>
								<?php if(get_sub_field('facebook'))
								{ ?>
		                        <li><a class="fa fa-facebook" href="<?php
												echo esc_url(get_sub_field('facebook')); ?>" target="_blank"></a></li>
												<?php } ?>
		                        <li><a class="fa fa-linkedin" href="<?php
												echo esc_url(get_sub_field('linkedin')); ?>" target="_blank"></a></li>
								<?php } ?>
								<?php if(get_sub_field('dribbble'))
								{ ?>
									<li><a class="fa fa-dribbble" href="<?php
												echo esc_url(get_sub_field('dribbble')); ?>" target="_blank"></a></li>
									<?php } ?>
									<?php if(get_sub_field('behance'))
									{ ?>
									<li><a class="fa fa-behance" href="<?php
												echo esc_url(get_sub_field('behance')); ?>" target="_blank"></a></li>	
									<?php } ?>
		                    </ul>
		                </div>
		            </figcaption>
		        </figure>
			</div>
				<?php
				$t++;
				endwhile; 
			endif; ?>
			</div>
		    </div>
		</section>
		<?php
			 ?>
		
		
		     
		<?php

			// TABS

			elseif (get_row_layout() == 'tabs_content'):
			$tab = get_sub_field('tab');

			if (get_sub_field('tab')):
				?>
			    <section <?php if(get_sub_field('id')) { ?>
				  id="<?php echo esc_attr(get_sub_field('id')); ?>"
							<?php } ?>>
				<div class="pc-tab">
				<input checked="checked" id="tab1" type="radio" name="pct" />
				<input id="tab2" type="radio" name="pct" />
				<input id="tab3" type="radio" name="pct" />
				<input id="tab4" type="radio" name="pct" />
				<input id="tab5" type="radio" name="pct" />
				<input id="tab6" type="radio" name="pct" />
				<input id="tab7" type="radio" name="pct" />
				<input id="tab8" type="radio" name="pct" />
				  <nav>
				    <ul>
								<?php $count=1;
								while (has_sub_field('tab')):
									if ($count == 1 ) : $tc= 'active'; else : $tc= '' ; endif  ?>
								<li class="tab<?php echo esc_attr($count); ?>"> <label for="tab<?php echo esc_attr($count); ?>"><?php
									echo esc_attr(get_sub_field('title')); ?></label></li>
									<?php
									 $count++;
								endwhile; ?>
							</ul>
						</nav>
							<?php
						endif; ?>
						<?php
						if (get_sub_field('tab')): ?>
						<section>
							<?php $count=1;
							while (has_sub_field('tab')):
								 ?>
								 
							
							<div class="tab<?php echo esc_attr($count); ?>">
							<?php
									echo wp_kses_post(get_sub_field('text')); ?>
								</div>
						
							<?php
							$count++;
						endwhile; ?>
					</section></div></section>
					<?php
				endif; ?>
				
			
			
				<?php
	
	// ACCORDION
	
	elseif (get_row_layout() == 'accordion_content'):if (get_sub_field('ac_tab')): ?>
    <section <?php if(get_sub_field('id')) { ?>
	  id="<?php echo esc_attr(get_sub_field('id')); ?>"
				<?php } ?> class="white-section">
				<ul class="accordion">
					<?php
					while (has_sub_field('ac_tab')): ?>
					<li>
						<a><?php
							echo esc_attr(get_sub_field('title')); ?></a>
							
								<?php
									echo wp_kses_post(get_sub_field('text')); ?>
								
							</li>
							<?php
						endwhile; ?>
					</ul></section>
					<?php
				endif; ?>
			
				<?php
		
		// FEATURES
		
		elseif (get_row_layout() == 'stats_content'):if (get_sub_field('stat')): ?>
		<article class="stat-section" <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?>>
			<div class="stack-content">
				<ul class="statistic-list">
					<?php
					$i = 0;
					while (has_sub_field('stat')): 
						
					$stutter = ($i * .2);
					$f_link = get_sub_field('link');?>
					<li data-sr="ease-in 50px, over 1s, wait <?php echo $stutter ?>s">
						<?php if( !empty($f_link) ) { ?>
						<a href="<?php echo esc_url($f_link); ?>">
							<?php } ?>
						<div class="box">
							
							<span class="icon fa <?php
								echo esc_attr(get_sub_field('icon')); ?>"></span>
								
							</div>
							<span class="description"><?php
								echo esc_attr(get_sub_field('title')); ?></span>
								<?php if( !empty($f_link) ) { ?>
							</a>
							<?php } ?>
								<p><?php
									echo esc_attr(get_sub_field('text')); ?></p>
							</li>
							<?php $i++;
						endwhile; ?>
						<?php
					endif; ?>
				</ul>
			</div>
		</article>
		<?php
		
		//PARALLAX HEADER
		
		elseif (get_row_layout() == 'parallax_header'):
			?>
		    <div id="stack-banner" class="do" style="background: url(<?php echo esc_url(get_sub_field('background_image')); ?>) no-repeat fixed 50% 0;">
		  	  <div class="stack-header-overlay"></div>
		    	<div id="bannertext">
					<?php 

					$iconb = get_sub_field('icon_upload');
                    $buttonb = get_sub_field('button');
					$identifierp = rand(1, 299);
					if( !empty($iconb) ) { ?>

						<img class="iconb" src="<?php echo esc_url($iconb['url']); ?>" alt="<?php echo esc_attr($iconb['alt']); ?>" data-sr="move 16px scale up 20%, over 2s">

						<?php } else { ?>
						<span class="icon fa fa-4x <?php
							echo esc_attr(get_sub_field('icon')); ?>"></span>
						<?php } ?>
		    		<h1><?php echo esc_attr(get_sub_field('title')); ?></h1>
		    		<p><?php echo esc_attr(get_sub_field('subtitle')); ?>
						<div class="buttons-ctn">
						<?php if (get_sub_field('buttons')):
							 while (has_sub_field('buttons')): 
						 ?>
						 
						 
										<?php 
											if(get_sub_field('video_link')) { ?>
									<span><a class="btn-link modal__trigger" data-modal="#stack-modal-<?php echo esc_attr($identifierp); ?>" data-color="<?php echo esc_attr(get_sub_field('background')); ?>" style="background-color:<?php echo esc_attr(get_sub_field('background')); ?>;color:<?php echo esc_attr(get_sub_field('font_color')); ?>;" href="" ><?php echo esc_attr(get_sub_field('button')); ?></a> </span>
								<div id="stack-modal-<?php echo esc_attr($identifierp); ?>" class="modal modal__bg" role="dialog" aria-hidden="true">
							  		<div class="modal__dialog vid">
							  			<div class="modal__content embed-container">
	  				
							  				<p><?php echo get_sub_field('video_link'); ?></p>
				
							  				<!-- modal close button -->
							  				<a href="" class="modal__close stack-close">
							  					<svg class="stack-mod" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
							  				</a>
							  			</div>
							  		</div>
							  	</div>
		
							<?php } else { ?>
										<span><a title="banner" data-color="<?php echo esc_attr(get_sub_field('background')); ?>" style="background-color:<?php echo esc_attr(get_sub_field('background')); ?>;color:<?php echo esc_attr(get_sub_field('font_color')); ?>;" href="<?php echo esc_attr(get_sub_field('button_link')); ?>"><?php echo esc_attr(get_sub_field('button')); ?></a></span>
								<?php } ?>
							
						
						<?php  endwhile;endif;?></p>
					 </div>
					<?php 

					$image = get_sub_field('image');
					

					if( !empty($image) ): ?>

						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

					<?php endif; ?>
		    	</div>
		    </div>
	
	<?php
	
	//SPLIT BANNER
	
	elseif (get_row_layout() == 'split_banner'):
		$banner_img = get_sub_field('image');
		$imgsize = 'stack-split';
		$imgsizebot = 'stack-jumbotron';
		$imgvalues = get_sub_field('side');
		$identifier = rand(1, 299);
		$alignment ='alignright';
		if(in_array("left", $imgvalues )): 
			$alignment = 'alightleft'?>
		<?php endif;
		$bottom = '';
		if(in_array("bottom", $imgvalues )) {
		$bottom = 'alignbottom';
	   }
	   $pclass='';
	   if(get_sub_field('background') == 'image') {
		   $pclass = 'parallax-section';
	   }
		?>
    <section class="<?php echo esc_attr($pclass); ?>" <?php if(get_sub_field('id')) { ?>
	  id="<?php echo esc_attr(get_sub_field('id')); ?>"
				<?php } ?> style="background-color:<?php echo esc_attr(get_sub_field('color')); ?>;<?php if(get_sub_field('background') == 'image') { ?>background-image:url('<?php echo esc_attr(get_sub_field('sc_image')); ?>');<?php } ?>">
		<div class="stack-content">
		<div class="img-holder <?php echo esc_attr($alignment); ?>" data-sr="move 16px scale up 20%, over 2s">
		<?php echo wp_get_attachment_image( $banner_img, $imgsize ); ?>
		</div>
		<div class="text-holder" style="color:<?php echo esc_attr(get_sub_field('textfont_color')); ?>;">
							<h2 style="color:<?php echo esc_attr(get_sub_field('font_color')); ?>;" ><?php
		echo esc_attr(get_sub_field('title')); ?></h2>
		<?php if(get_sub_field('sub_title')) : ?>
								<h4 style="color:<?php echo esc_attr(get_sub_field('subfont_color')); ?>"><?php echo esc_attr(get_sub_field('sub_title')); ?></h4>
							<?php endif; ?>
			<?php
		echo wp_kses_post(get_sub_field('text')); ?>
				<?php if(get_sub_field('button_text')) :
					if(get_sub_field('video_link')) { ?>
			<a class="btn-link modal__trigger" data-modal="#stack-modal-<?php echo esc_attr($identifier); ?>" href="" ><?php 
			echo esc_attr(get_sub_field('button_text')); ?></a> 
		<div id="stack-modal-<?php echo esc_attr($identifier); ?>" class="modal modal__bg" role="dialog" aria-hidden="true">
	  		<div class="modal__dialog vid">
	  			<div class="modal__content embed-container">
	  				
	  				<p><?php echo get_sub_field('video_link'); ?></p>
				
	  				<!-- modal close button -->
	  				<a href="" class="modal__close stack-close">
	  					<svg class="stack-mod" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
	  				</a>
	  			</div>
	  		</div>
	  	</div>
		
	<?php } else { ?>
				<a class="btn-link" href="<?php echo esc_url(get_sub_field('button_link')); ?>" ><?php 
				echo esc_attr(get_sub_field('button_text')); ?></a>
		<?php } endif; ?>

		</div>
		</div>
		</section>

<?php
	
		// DEVICE SWITCHER
		
		elseif (get_row_layout() == 'device_switcher'):if (get_sub_field('devices')):
			?>
	    <section class="device-switcher parallax-section" style="background-color:<?php echo esc_attr(get_sub_field('background_main')); ?>;background-image:url('<?php echo esc_url(get_sub_field('background_image')); ?>');" <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?>>
					<?php 
					$rows = get_sub_field( 'devices');
					$device = $rows[0]['device']; ?>
		    <div class="container container--<?php echo esc_attr($device); ?>">
				<h2 style="color:<?php echo esc_attr(get_sub_field('title_color')); ?>;" ><?php 
				echo esc_attr(get_sub_field('title')); ?></h2>
				<h4 style="color:<?php echo esc_attr(get_sub_field('subtitle_color')); ?>;" ><?php 
				echo esc_attr(get_sub_field('subtitle')); ?></h4>
		     <ul class="nav" id="device-switcher">
			<?php while (has_sub_field('devices')): ?>
				<?php if(get_sub_field('device') == 'phone') { ?>
		      <li><a href="#" data-device="" data-background="<?php 
				echo esc_attr(get_sub_field('screenshot')); ?>">Phone</a></li>
			  <?php } elseif(get_sub_field('device') == 'mini-tablet') { ?>
		     <li><a href="#" data-device="tablet-mini" data-background="<?php 
				echo esc_attr(get_sub_field('screenshot')); ?>">Mini Tablet</a></li>
			  <?php } elseif(get_sub_field('device') == 'tablet') { ?>
			 <li><a href="#" data-device="tablet" data-background="<?php 
				echo esc_attr(get_sub_field('screenshot')); ?>">Tablet</a></li>
			  <?php  } elseif(get_sub_field('device') == 'browser') { ?>
			  <li><a href="#" data-device="browser" data-background="<?php 
				echo esc_attr(get_sub_field('screenshot')); ?>">Browser</a></li>
			<?php } endwhile; ?>
            </ul>
			<?php while(has_sub_field('devices')): 
			    $bg_img = get_sub_field('screenshot');
				$device = get_sub_field('device');
				?>
			<?php break; endwhile;  ?>
		  <div class="device device--<?php echo esc_attr($device); ?>" data-sr="ease-in 50px, over 1s">
		    <div class="device__header"></div>
			
		    <div class="device__content" style="background:url(<?php echo esc_url($bg_img); ?>);">
		    </div>
		    <div class="device__footer"></div>
		  </div>
		</div>
		</section>
				
			<?php endif; ?> 
				
			
			
			<?php 
		
	
		// HEADINGS
				
	elseif (get_row_layout() == 'heading_block'):
		$size       = get_sub_field('size');
		$color     = get_sub_field('color');
		$sub_size       = get_sub_field('sub_size');
		$sub_color       = get_sub_field('sub_color');
		$line_size       = get_sub_field('line_size');
		$position       = get_sub_field('alignment');
		$heading_text       = get_sub_field('text');
		$heading_subtext      = get_sub_field('subtext');
		?>
	    <section <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?> style="background-color:<?php echo esc_attr(get_sub_field('bg_color')); ?>;background-image:url('<?php echo esc_attr(get_sub_field('background_image')); ?>');">
		<div class="white-section br_editor stack-heading" style="text-align:<?php echo esc_attr($position); ?>;">
			<?php 

			$icona = get_sub_field('icon_upload');

			if( !empty($icona) ) { ?>

				<img src="<?php echo esc_url($icona['url']); ?>" alt="<?php echo esc_attr($icona['alt']); ?>" data-sr="move 16px scale up 20%, over 2s">

				<?php } else { ?>
				<span class="icon fa <?php
					echo esc_attr(get_sub_field('icon')); ?>"></span>
				<?php } ?>
		<h2 style="font-size:<?php echo $size; ?>px;color:<?php echo esc_attr($color); ?>;"><?php echo esc_attr($heading_text); ?></h2>
		<span style="font-size:<?php echo esc_attr($sub_size); ?>px;line-height:<?php echo esc_attr($line_size);?>px;color:<?php echo esc_attr($sub_color); ?>;"><?php echo esc_attr(wp_strip_all_tags($heading_subtext)); ?></span>
	</div>
	</section>
		<?php	
		
		// POI
				
	elseif (get_row_layout() == 'poi_block'):
		
		?>
	    <section <?php if(get_sub_field('id')) { ?>
		  id="<?php echo esc_attr(get_sub_field('id')); ?>"
					<?php } ?> style="background-color:<?php echo esc_attr(get_sub_field('color')); ?>;background-image:url('<?php echo esc_attr(get_sub_field('bg_image')); ?>');">
					
    <?php
		$poi_img = get_sub_field('image');
		$poiimgsize = 'stack-split';
		?>
	    	<div class="stack-content">
				<div class="stack-product">
			<div class="stack-product-intro">
				
				
				
				<h2 style="color:<?php echo esc_attr(get_sub_field('font_color')); ?>;" ><?php
								echo esc_attr(get_sub_field('title')); ?></h2>
				<?php if(get_sub_field('subtitle')) : ?>
										<h4 style="color:<?php echo esc_attr(get_sub_field('subfont_color')); ?>"><?php echo esc_attr(get_sub_field('subtitle')); ?></h4>
									<?php endif; ?>
				<?php echo get_sub_field('text'); ?>
				<div class="stack-triggers">
					<a href="stack-product-tour" id="stack-start" class="btn-link"><?php echo esc_attr(get_sub_field('button')); ?></a>
				</div>
			</div>

			<div id="stack-product-tour" class="stack-product-mockup">
				<?php echo wp_get_attachment_image( $poi_img, $poiimgsize ); 
				if (get_sub_field('poi')):
				?>
				<ul class="stack-points-container">
			<?php while (has_sub_field('poi')): 
				$stack_left = get_sub_field('left');
				$stack_top = get_sub_field('top');
				 ?>

					<li class="stack-single-point" style="left:<?php echo esc_attr($stack_left); ?>%;top:<?php echo esc_attr($stack_top); ?>%;">
						<a class="stack-img-replace" href="#0">More info</a>
						<div class="stack-expand__card active">
						   <?php echo esc_attr(get_sub_field('content')); ?>
						    </div>
					</li> <!-- .stack-single-point -->
				<?php endwhile; ?>
				</ul> <!-- .stack-points-container -->
<?php endif; ?>
				<div class="stack-3d-right-side"></div>
				<div class="stack-3d-bottom-side"></div>
			</div> <!-- .stack-product-mockup -->
			<a href="#0" class="stack-close-product-tour stack-img-replace"></a>
		</div>
	</div>
		</section> 
	
	
	<?php
	             	// TESTIMONIALS
							
										elseif (get_row_layout() == 'testimonials_block'):if (get_sub_field('new_testimonial')):
											?>
										    <section class="testimonial" <?php if(get_sub_field('id')) { ?>
											  id="<?php echo esc_attr(get_sub_field('id')); ?>"
														<?php } ?> style="background-color:<?php echo esc_attr(get_sub_field('color')); ?>;)">
										 
											<?php  while (has_sub_field('new_testimonial')): 
												$tm_img = get_sub_field('image');
												$tmimgsize = 'stack-testimonial';
												?>
										    <div class="inner testimonial">
										        <div class="quote-wrapper">
										        <div class="quote">
										          <blockquote class="quote-quote"><?php echo esc_attr(get_sub_field('testimonial')); ?></blockquote><cite><?php echo esc_attr(get_sub_field('signature')); ?>, <?php echo esc_attr(get_sub_field('company')); ?></cite>
										        </div>
										        <div class="portrait" data-sr="move 16px scale up 20%, over 2s"><?php echo wp_get_attachment_image( $tm_img, $tmimgsize ); ?></div>
										      </div>
										    </div>
		<?php
	endwhile; ?>
	
						
										      <button class="prev-testimonial">Prev</button>
										      <button class="next-testimonial">Next</button>
										  </section>
										  <?php
endif; ?>
															<?php
	
		// TOGGLE BUTTONS
				
	elseif (get_row_layout() == 'toggle_block'):if (get_sub_field('buttons')):
		
		?>
    <section class="toggle-btn" <?php if(get_sub_field('id')) { ?>
	  id="<?php echo esc_attr(get_sub_field('id')); ?>"
				<?php } ?> style="background-color:<?php echo esc_attr(get_sub_field('color')); ?>;<?php if(get_sub_field('background') == 'image') { ?>background-image:url('<?php echo esc_attr(get_sub_field('image')); } ?>');">
				<div class="stack-divider">	</div>
	<div class="buttons-ctn">
		<?php  $button_no = 1;
		
			 
		 while (has_sub_field('buttons')): 
			 if ($button_no == 1) {
				 $btn_class = 'button--left';
				 $content_class = 'button__content--left';
				 $btn_str = 'enter left move 46px scale up 20%, over 1s';
			 } else {
				 $btn_class = 'button--right';
				 $content_class = 'button__content--right';
				 $btn_str = 'enter right move 46px scale up 20%, over 1s';
			 }
			
			 
			 if (get_sub_field('stack_form') !='none' && get_sub_field('stack_form') !='' ) { ?>
	  <a href="" class="btn-link modal__trigger" data-sr="<?php echo esc_attr($btn_str);?>" data-modal="#stack-modal-<?php echo esc_attr($button_no); ?>" data-color="<?php echo esc_attr(get_sub_field('background')); ?>" style="background-color:<?php echo esc_attr(get_sub_field('background')); ?>;color:<?php echo esc_attr(get_sub_field('font_color')); ?>;"><span><?php echo esc_attr(get_sub_field('button_label')); ?></span></a>
  
 
	<div id="stack-modal-<?php echo esc_attr($button_no); ?>" class="modal modal__bg" role="dialog" aria-hidden="true">
  		<div class="modal__dialog">
  			<div class="modal__content">
  				
					<div class="form">
		
						<?php $form = get_sub_field('stack_form');
						echo esc_attr($form);
						        echo do_shortcode( '[contact-form-7 title="'.$form.'"]' ); ?>
            	
				          </div>
						  <a class="modal__close stack-close" href="">
						    					<svg viewBox="0 0 24 24" class="stack-mod"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path fill="none" d="M0 0h24v24h-24z"/></svg>
						    				</a>
				</div>
			
  			</div>
  		</div>
	
	<?php 
} else { ?>
		
		<a href="<?php echo esc_url(get_sub_field('button_link'));?>" class="btn-link" data-sr="<?php echo esc_attr($btn_str);?>" data-color="<?php echo esc_attr(get_sub_field('background')); ?>" style="background-color:<?php echo esc_attr(get_sub_field('background')); ?>;color:<?php echo esc_attr(get_sub_field('font_color')); ?>;"><span><?php echo esc_attr(get_sub_field('button_label')); ?></span></a>
		
<?php }
	
	
	$button_no++; ?>
  <?php endwhile; ?>
	
</div>
	
	<?php endif; ?>
	
	</section>
		<?php	

endif; ?>
 <?php
endwhile; else :
// no layouts found
endif;
wp_reset_query();
?> 
