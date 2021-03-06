<?php
$show_title = true;
$columns = max(1, min(4, (int) themerex_substr($opt['style'], -1)));
?>
	<article class="isotopeElement <?php
		echo 'post_format_'.esc_attr($post_data['post_format'])
			. ($opt['number']%2==0 ? ' even' : ' odd')
			. ($opt['number']==0 ? ' first' : '')
			. ($opt['number']==$opt['posts_on_page'] ? ' last' : '')
			. ($opt['add_view_more'] ? ' viewmore' : '')
			. ($opt['filters']!=''
				? ' flt_'.join(' flt_', $opt['filters']=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
				: '');
		?>">
		<div class="isotopePadding<?php echo esc_attr(get_custom_option('show_portfolio_spacing')=='no' ? ' ellNOspacing' :  ''); ?>">
			<?php
			if ($post_data['post_thumb'] || $post_data['post_gallery'] || $post_data['post_video']) { ?>

				<?php if ($post_data['post_video'] || $post_data['post_gallery']) { ?>
					<div class="sc_section">
				<?php } else { ?>
					<div class="thumb hoverIncrease hoverTwo" <?php echo (esc_attr($post_data['post_url_target']) ? 'data-target="'.esc_attr($post_data['post_url_target']).'" ' : ''); ?>data-link="<?php echo esc_url($post_data['post_link']); ?>" data-image="<?php echo esc_url($post_data['post_attachment']); ?>" data-title="<?php echo esc_attr($post_data['post_title']); ?>">
				<?php }
						if ($post_data['post_video']) {
							echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], false);
						} else if ($post_data['post_thumb'] && ($post_data['post_format']!='gallery' || !$post_data['post_gallery'] || get_custom_option('gallery_instead_image')=='no')) {
							echo balanceTags($post_data['post_thumb']);
						} else if ($post_data['post_gallery']) {
							echo balanceTags($post_data['post_gallery']);
						}
						?>
					</div>
				<?php
			}
			?>

			<?php if (!$post_data['post_video'] && !$post_data['post_gallery'] && $columns != 4) {  ?>
					<div class="portfolioInfo">
						<?php
						if ($show_title) {
							if (!isset($opt['links']) || $opt['links']) {
								?><h4><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_title']); ?></a></h4><?php
							} else {
								?><h4><?php echo esc_html($post_data['post_title']); ?></h4><?php
							}
						}
						if (!isset($opt['info']) || $opt['info']) {
							if (!empty($post_data['post_tags_links']) && get_custom_option('show_post_info')=='yes') { ?>
								<span class="infoTags"><?php echo balanceTags($post_data['post_tags_links']); ?></span>
							<?php } ?>
						<?php } ?>
					</div>
			<?php } ?>

		</div>
	</article>
