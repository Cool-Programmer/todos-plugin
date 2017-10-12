<?php
	// List todos
	function tdl_list_todos($atts, $content = null)
	{
		global $post; 
		// Attributes for shortcode
		$atts = shortcode_atts([
			'title' => 'My Todos',
			'count' => 10,
			'category' => 'all'
		], $atts);

		// Check category attribute
		if ($atts['category'] == 'all') {
			$terms = '';
		}else{
			$terms = [
				[
					'taxonomy' 	=> 'category',
					'field'		=> 'slug',
					'terms'		=> $atts['category']
				]
			];
		}

		// Query args
		$args = [
			'post_type' 	=> 'todo',
			'post_status'	=> 'publish',
			'orderby'		=> 'due_date',
			'order'			=> 'ASC',
			'post_per_page'	=> $atts['count'],
			'tax_query'		=> $terms
		];

		// Fetch todos
		$todos = new WP_Query($args);

		// Check for todos
		if ($todos->have_posts()) {
			// Get category slug
			$category = str_replace('-', ' ', $atts['category']);
			$category = strtolower($category);

			// Init output
			$output = '';

			// Build output
			$output .= '<div class="todo-list">';
				while ($todos->have_posts()) {
					$todos->the_post();

					// Get field values
					$priority = get_post_meta($post->ID, 'priority', true);
					$details = get_post_meta($post->ID, 'details', true);
					$due_date = get_post_meta($post->ID, 'due_date', true);

					$output .= '<div class="todo">';
						$output .= '<h4>' . get_the_title() . '</h4>';
						$output .= '<div>' . $details . '</div>';
						$output .= '<div class="priority-'.strtolower($priority).'">Priority: '.$priority.' </div>';
						$output .= '<div class="due_date">Due date: '.$due_date.'</div>';
					$output .= '</div>';
				}
			$output .= '</div>';

			// Reset post data
			wp_reset_postdata();
			return $output;
		}else{
			return '<p>No todos found</p>';
		}
	}


	// Create shortcode
	add_shortcode('todos', 'tdl_list_todos');