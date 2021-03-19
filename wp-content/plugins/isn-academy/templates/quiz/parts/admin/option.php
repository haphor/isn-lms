<?php
$_id = $_id ?? get_the_ID();
$q = ! $is_new ? $q : '#q#';
$o_value = ! $is_new ? $o : '#o#';
$questions_stats = $questions_stats ?? [];
if( ! isset( $option['explanation'] ) ) {
    return;
}
?>
<li class="as-quiz__option" data-parent="option">
    <div class="as-quiz__option-row">
        <label<?php echo (int) $q && (int) $o_value ? ' for="as_' . $_id . '_questions_' . $q . '_options_' . $o_value . '_text"' : '' ?>>Option:</label>
        <input type="text"<?php echo (int) $q && (int) $o_value ? ' id="as_' . $_id . '_questions_' . $q . '_options_' . $o_value . '_text"' : '' ?> name="as_<?php echo esc_attr( $_id ) ?>_questions[<?php echo esc_attr( $q ) ?>][options][<?php echo esc_attr( $o_value ) ?>][text]" value="<?php echo esc_attr( $option['text'] ) ?>" placeholder="Enter option description"/> <label>
            <button type="button" class="button js-as-quiz__option-remove-btn" title="Remove option" data-target="[data-parent=option]:eq(0)"> &times;</button>
        </label>
    </div>
    <div class="as-quiz__option-row">
        <label>Explanation:</label>
        <textarea cols="2" type="text" name="as_<?php echo esc_attr( $_id ) ?>_questions[<?php echo esc_attr( $q ) ?>][options][<?php echo esc_attr( $o_value ) ?>][explanation]"><?php echo $option['explanation'] ?></textarea>
    </div>
    <div class="as-quiz__option-row">
        <input type="hidden" name="as_<?php echo esc_attr( $_id ) ?>_questions[<?php echo esc_attr( $q ) ?>][options][<?php echo $o_value ?>][answer]" value="0"/>
        <label class="checkbox"><input type="checkbox" name="as_<?php echo esc_attr( $_id ) ?>_questions[<?php echo esc_attr( $q ) ?>][options][<?php echo esc_attr( $o_value ) ?>][answer]" value="1" <?php checked( (int) ( $option['answer'] ?? 0 ) === 1 ) ?>/>
            <?php _e( 'Correct answer', 'isn' ) ?>
        </label>
    </div>
    <?php if( ! empty( $questions_stats ) && isset( $questions_stats[ $q ][ $o ] ) ) : ?>
        <p>
            <em><?php printf( __( '%s choose this option to be correct', 'isn' ), number_format_i18n( ( (int) $questions_stats[ $q ][ $o ] / (int) $questions_stats['all_attempts'] ) * 100, 1 ) . '%' ) ?></em>
        </p>
    <?php endif; ?>
</li>
