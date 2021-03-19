<?php
$_id = $_id ?? get_the_ID();
$is_new = ! isset( $question );
$q = $q ?? '#q#';
if( $is_new ) {
    $question = [
        'question' => '',
        'description' => '',
        'explanation' => '',
        'type' => '',
        'options' => [
            [
                'text' => '',
                'explanation' => '',
                'answer' => '',
            ],
        ],
    ];
}

$question = wp_parse_args( $question, [ 'question' => '', 'description' => '', 'explanation' => '', 'type' => '' ] );
if( empty( $question['options'] ) ) {
    $question['options'] = [
        [
            'text' => '',
            'explanation' => '',
            'answer' => '',
        ],
    ];
}
$collapsed = isset( $questions ) && count( $questions ) > 1 ? ' in' : '';
?>
<li class="as-quiz__question" data-q="<?php echo esc_attr( $q ) ?>" data-parent="question">
    <h2 class="as-quiz__question-title js-as-quiz-collapse <?php echo $collapsed ?>">
        <?php echo $question['question'] ?>
        <label>
            <button type="button" class="button js-as-quiz__option-remove-btn" data-target="[data-parent=question]:eq(0)"> &times;</button>
        </label>
    </h2>
    <div class="as-quiz__question-row">
        <label<?php echo (int) $q ? ' for="as_' . $_id . '_questions_' . $q . '_question"' : '' ?>>
            <?php _e( 'Question', 'isn' ) ?> *
        </label>
        <input type="text"<?php echo (int) $q ? ' id="as_' . $_id . '_questions_' . $q . '_question"' : '' ?>
            name="as_<?php echo $_id ?>_questions[<?php echo $q ?>][question]"
            value="<?php echo esc_attr( $question['question'] ) ?>" style="width:100%" />
    </div>
    <div class="as-quiz__question-row">
        <label<?php echo (int) $q ? ' for="as_' . $_id . '_questions_' . $q . '_description"' : '' ?>>
            <?php _e( 'Description', 'isn' ) ?>
        </label>
        <input type="text"<?php echo (int) $q ? ' id="as_' . $_id . '_questions_' . $q . '_description"' : '' ?>
            name="as_<?php echo $_id ?>_questions[<?php echo $q ?>][description]"
            value="<?php echo esc_attr( $question['description'] ) ?>" style="width:100%">
    </div>
    <div class="as-quiz__question-row">
        <label>
            <input type="radio" name="as_<?php echo $_id ?>_questions[<?php echo $q ?>][type]"
                value="checkbox"
                title="<?php esc_attr_e( 'Multiple correct answers (uses checkboxes)', 'isn' ) ?>"
                <?php checked( $question['type'] === 'checkbox' ) ?>>
            <?php _e( 'Multiple correct answers', 'isn' ) ?>
        </label>
        <label>
            <input type="radio" name="as_<?php echo $_id ?>_questions[<?php echo $q ?>][type]" value="radio"
                title="<?php esc_attr_e( 'Single correct answer (uses radio select)', 'isn' ) ?>"
                <?php checked( $question['type'] === 'radio' ) ?>>
            <?php _e( 'Single correct answer', 'isn' ) ?>
        </label>
    </div>
    <div class="as-quiz__question-row">
        <label<?php echo (int) $q ? ' for="as_' . $_id . '_questions_' . $q . '_explanation"' : '' ?>>
            <?php _e( 'Explanation', 'isn' ) ?>:</label>
        <textarea rows="3"<?php echo (int) $q ? ' id="as_' . $_id . '_questions_' . $q . '_explanation"' : '' ?>
            name="as_<?php echo $_id ?>_questions[<?php echo $q ?>][explanation]"><?php echo $question['explanation'] ?>
        </textarea>
    </div>
    <h3 class="as-quiz__options-title">Options</h3>
    <ul class="as-quiz__option<?php echo $is_new ? '--new' : 's' ?> js-as-quiz__option<?php echo $is_new ? '--new' : 's' ?>">
        <?php
            for( $i = 0, $oMax = count( $question['options'] ); $i < $oMax; $i++ ) {
                if( isset( $question['options'][ $i ] ) ) {
                    $option = $question['options'][ $i ];
                    include 'option.php';
                }
            }
        ?>
    </ul>
    <div class="as-quiz__question-row">
        <label>
            <button type="button" class="button js-as-quiz__add as-quiz__add-btn" data-type="option" data-q="<?php echo $q ?>">
                + <?php _e( 'Add an option', 'isn' ) ?>
            </button>
        </label>
    </div>
</li>
