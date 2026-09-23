<?php
/**
 * Plugin Name: MAGNA Tech Project Details
 * Description: Adds structured project details to the MAGNA Tech Projects content type.
 * Version: 1.0.0
 * Author: MAGNA Tech
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function magna_project_details_meta_box() {
	add_meta_box(
		'magna_project_details',
		'Project Details',
		'magna_project_details_render',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'magna_project_details_meta_box' );

function magna_project_details_render( $post ) {
	wp_nonce_field( 'magna_project_details_save', 'magna_project_details_nonce' );

	$client       = get_post_meta( $post->ID, '_magna_client', true );
	$category     = get_post_meta( $post->ID, '_magna_category', true );
	$technologies = get_post_meta( $post->ID, '_magna_technologies', true );
	$website      = get_post_meta( $post->ID, '_magna_website', true );
	$status       = get_post_meta( $post->ID, '_magna_status', true );

	?>
	<table class="form-table" role="presentation">
		<tr>
			<th><label for="magna_client">Client</label></th>
			<td><input type="text" class="regular-text" id="magna_client" name="magna_client" value="<?php echo esc_attr( $client ); ?>" placeholder="e.g. ABC Company"></td>
		</tr>
		<tr>
			<th><label for="magna_category">Category</label></th>
			<td><input type="text" class="regular-text" id="magna_category" name="magna_category" value="<?php echo esc_attr( $category ); ?>" placeholder="e.g. Website Development"></td>
		</tr>
		<tr>
			<th><label for="magna_technologies">Technologies</label></th>
			<td><input type="text" class="regular-text" id="magna_technologies" name="magna_technologies" value="<?php echo esc_attr( $technologies ); ?>" placeholder="e.g. WordPress, PHP, CSS"></td>
		</tr>
		<tr>
			<th><label for="magna_website">Website URL</label></th>
			<td><input type="url" class="regular-text" id="magna_website" name="magna_website" value="<?php echo esc_attr( $website ); ?>" placeholder="https://example.com"></td>
		</tr>
		<tr>
			<th><label for="magna_status">Project Status</label></th>
			<td>
				<select id="magna_status" name="magna_status">
					<option value="">Select status</option>
					<option value="Completed" <?php selected( $status, 'Completed' ); ?>>Completed</option>
					<option value="In Progress" <?php selected( $status, 'In Progress' ); ?>>In Progress</option>
					<option value="Ongoing" <?php selected( $status, 'Ongoing' ); ?>>Ongoing</option>
				</select>
			</td>
		</tr>
	</table>
	<?php
}

function magna_project_details_save( $post_id ) {
	if ( ! isset( $_POST['magna_project_details_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['magna_project_details_nonce'] ) ), 'magna_project_details_save' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( get_post_type( $post_id ) !== 'project' ) {
		return;
	}

	$fields = array(
		'magna_client'       => '_magna_client',
		'magna_category'     => '_magna_category',
		'magna_technologies' => '_magna_technologies',
		'magna_website'      => '_magna_website',
		'magna_status'       => '_magna_status',
	);

	foreach ( $fields as $input => $meta_key ) {
		if ( ! isset( $_POST[ $input ] ) ) {
			continue;
		}

		$value = wp_unslash( $_POST[ $input ] );

		if ( 'magna_website' === $input ) {
			$value = esc_url_raw( $value );
		} else {
			$value = sanitize_text_field( $value );
		}

		update_post_meta( $post_id, $meta_key, $value );
	}
}
add_action( 'save_post_project', 'magna_project_details_save' );
