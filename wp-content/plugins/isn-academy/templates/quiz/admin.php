<?php
namespace Inc\Quiz;

use Inc\Quiz\PostType;

$_id = ! empty( $_id ) ? $_id : time();
$post = $post ?? get_post();
$questions = Quiz::get( 'questions', $post );
$questions = empty( $questions ) ? [] : $questions;

$args = [
    'textarea_rows' => 5,
    'textarea_name' => 'as_' . $post->ID . '_post_content',
    'quicktags' => true,
    'tinymce' => true,
    'media_buttons' => true,
];
wp_editor( $post->post_content, $_id . '_editor', $args );
$q = $o = 0;

?>

<label for="<?php echo $_id . '_transcript' ?>">Content</label>
<?php

?>
<div class="as-quiz js-as-quiz" data-id="<?php echo $_id ?>" id="as-quiz-<?php echo $_id ?>">
    <h3><?php _e( 'Questions', 'isn' ) ?></h3>
    <ol class="as-quiz__questions js-as-quiz__questions">
        <?php if( ! empty( $questions ) ) :
            foreach( $questions as $question ) :
                include 'parts/admin/question.php';
                $q++;
            endforeach;
        else :
            $question = [
                'question' => 'Question....',
                'type' => '',
                'explanation' => '',
                'options' => [
                    [
                        'text' => '',
                        'explanation' => '',
                        'answer' => '',
                    ],
                ],
            ];
            include 'parts/admin/question.php';
        endif;
        ?>
    </ol>
    <!-- blank templates -->
    <ul class="as-quiz__question--new js-as-quiz__question--new">
        <?php
        unset( $question, $questions, $options, $option, $q, $o );
        include 'parts/admin/question.php';
        ?>
    </ul>
    <button type="button" class="button js-as-quiz__add as-quiz__add-btn" data-type="question"><?php _e( '+ Add a question', 'isn' ) ?></button>
</div>
