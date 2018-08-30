<?php
/**
 * The style "pie" of the Skills
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_skills');

trx_addons_enqueue_script( 'trx_addons-chart', trx_addons_get_file_url('shortcodes/skills/chart.min.js'), array('jquery'), null, true );

$icon_present = '';
$legend = '';
$data = '';

foreach ($args['values'] as $v) {
	$icon = !empty($v['icon_type']) && !empty($v['icon_' . $v['icon_type']]) && $v['icon_' . $v['icon_type']] != 'empty' ? $v['icon_' . $v['icon_type']] : '';
	if (!empty($icon) && strpos($icon_present, $v['icon_type'])===false)
		$icon_present .= (!empty($icon_present) ? ',' : '') . $v['icon_type'];
	$ed = substr($v['value'], -1)=='%' ? '%' : '';
	$value = str_replace('%', '', $v['value']);
	$percent = round($value / $args['max'] * 100);
	$start = 0;
	$stop = $value;
	$steps = 100;
	$step = max(1, round($args['max']/$steps));
	$speed = mt_rand(10,40);
	$animation = round(($stop - $start) / $step * $speed);
	$item_color = !empty($v['color']) ? $v['color'] : (!empty($args['color']) ? $args['color'] : '#efa758');
	if ($args['compact']==1) {
		$legend .= '<div class="sc_skills_legend_item">'
						. '<span class="sc_skills_legend_marker" style="background-color:'.esc_attr($item_color).'"></span>'
						. '<span class="sc_skills_legend_title">' . esc_html($v['title']) . '</span>'
						. '<span class="sc_skills_legend_value">' . esc_html($v['value']) . '</span>'
					. '</div>';
		$data .= '<div class="pie"'
					. ' data-start="'.esc_attr($start).'"'
					. ' data-stop="'.esc_attr($stop).'"'
					. ' data-step="'.esc_attr($step).'"'
					. ' data-steps="'.esc_attr($steps).'"'
					. ' data-max="'.esc_attr($args['max']).'"'
					. ' data-speed="'.esc_attr($speed).'"'
					. ' data-duration="'.esc_attr($animation).'"'
					. ' data-color="'.esc_attr($item_color).'"'
					. ' data-bg_color="'.esc_attr($args['bg_color']).'"'
					. ' data-border_color="'.esc_attr($args['border_color']).'"'
					. ' data-cutout="'.esc_attr($args['filled']==0 ? $args['cutout'] : 0).'"'
					. ' data-easing="easeOutCirc"'
					. ' data-ed="'.esc_attr($ed).'"'
			. '>'
				. '<input type="hidden" class="text" value="'.esc_attr($v['title']).'" />'
				. '<input type="hidden" class="percent" value="'.esc_attr($percent).'" />'
				. '<input type="hidden" class="color" value="'.esc_attr($item_color).'" />'
			. '</div>';
	} else {
		$item_id = 'sc_skills_canvas_'.str_replace('.','',mt_rand());
		$data .= ($args['columns'] > 0 ? '<div class="sc_skills_column '.esc_attr(trx_addons_get_column_class(1, $args['columns'])).'">' : '')
				. '<div class="sc_skills_item_wrap">'
					. '<div class="sc_skills_item">'
						. '<canvas id="'.esc_attr($item_id).'"></canvas>'
						. '<div class="sc_skills_total"'
							. ' data-start="'.esc_attr($start).'"'
							. ' data-stop="'.esc_attr($stop).'"'
							. ' data-step="'.esc_attr($step).'"'
							. ' data-steps="'.esc_attr($steps).'"'
							. ' data-max="'.esc_attr($args['max']).'"'
							. ' data-speed="'.esc_attr($speed).'"'
							. ' data-duration="'.esc_attr($animation).'"'
							. ' data-color="'.esc_attr($item_color).'"'
							. ' data-bg_color="'.esc_attr($args['bg_color']).'"'
							. ' data-border_color="'.esc_attr($args['border_color']).'"'
							. ' data-cutout="'.esc_attr($args['filled']==0 ? $args['cutout'] : 0).'"'
							. ' data-easing="easeOutCirc"'
							. ' data-ed="'.esc_attr($ed).'">'
							. ($start) . ($ed)
						. '</div>'
					. '</div>'
					. (!empty($v['title']) 
							? '<div class="sc_skills_item_title">'
									. (!empty($icon) ? '<span class="sc_skills_icon '.esc_attr($icon).'"></span>' : '') 
									. nl2br(str_replace('|', "\n", esc_html($v['title'])))
								. '</div>' 
							: '')
				. '</div>'
			. ($args['columns'] > 0 ? '</div>' : '');
	}
}

?><div id="<?php echo esc_attr($args['id']); ?>"
		class="sc_skills sc_skills_pie sc_skills_compact_<?php echo esc_attr($args['compact']>0 ? 'on' : 'off'); ?><?php echo !empty($args['class']) ? ' '.esc_attr($args['class']) : ''; ?>"
		<?php echo !empty($args['css']) ? ' style="'.esc_attr($args['css']).'"' : ''; ?>
		data-type="pie"
		><?php

		trx_addons_sc_show_titles('sc_skills', $args);

		if ($args['columns'] > 1) {
			?><div class="sc_skills_columns sc_item_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?> columns_padding_bottom"><?php
		}
		if ($args['compact']==1) {
			?><div class="sc_skills_legend"><?php echo trim($legend); ?></div>
				<div id="<?php echo esc_attr($args['id']); ?>_pie_item" class="sc_skills_item">
					<canvas id="<?php echo esc_attr($args['id']); ?>_pie" class="sc_skills_pie_canvas"></canvas>
					<div class="sc_skills_data" style="display:none;"><?php echo trim($data); ?></div>
				</div><?php
		} else
			echo trim($data);

		if ($args['columns'] > 1) {
			?></div><?php
		}

		trx_addons_sc_show_links('sc_skills', $args);

?></div><?php

trx_addons_enqueue_icons($icon_present);
?>