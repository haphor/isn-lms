<div class="wrap tutor-emails-lists-wrap">
    <h2><?php _e('E-Mails', 'tutor-pro'); ?></h2>

    <table class="wp-list-table widefat striped">
        <thead>

        <tr>
            <th><?php _e('Event', 'tutor-pro'); ?></th>
            <th><?php _e('Content type', 'tutor-pro'); ?></th>
            <th>#</th>
            <th><?php _e('Variables that can be used inside templates', 'tutor-pro'); ?></th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td><?php _e('Quiz Finished','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
				<?php
				$is_on = tutor_utils()->get_option('email_to_students.quiz_completed');
				if($is_on){
					echo '<span class="result-pass">On</span>';
				}
				?>
            </td>

            <td>
                <code>
                    {username}, {quiz_name}, {course_name}, {submission_time}, {quiz_url}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Course Completed (to students)','tutor-pro'); ?></td>
            <td>text/html</td>

            <td>
				<?php
				$is_on = tutor_utils()->get_option('email_to_students.completed_course');
				if($is_on){
					echo '<span class="result-pass">On</span>';
				}
				?>
            </td>
            <td>
                <code>
                    {student_username},{course_name},{completion_time},{course_url}
                </code>

            </td>
        </tr>
        <tr>
            <td><?php _e('Course Completed (to teacher)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
				<?php
				$is_on = tutor_utils()->get_option('email_to_teachers.a_student_completed_course');
				if($is_on){
					echo '<span class="result-pass">On</span>';
				}
				?>
            </td>
            <td>
                <code>
                    {teacher_username},{student_username},{course_name},{completion_time},{course_url}
                </code>

            </td>
        </tr>
        <tr>
            <td><?php _e('Course Enrolled (to teacher)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
				<?php
				$is_on = tutor_utils()->get_option('email_to_teachers.a_student_enrolled_in_course');
				if($is_on){
					echo '<span class="result-pass">On</span>';
				}
				?>
            </td>
            <td>
                <code>
                    {teacher_username},{student_username},{course_name},{enroll_time},{course_url}
                </code>

            </td>
        </tr>
        <tr>
            <td><?php _e('Asked Question (to teacher)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
				<?php
				$is_on = tutor_utils()->get_option('email_to_teachers.a_student_placed_question');
				if($is_on){
					echo '<span class="result-pass">On</span>';
				}
				?>
            </td>
            <td>
                <code>
                    {teacher_username},{student_username},{course_name},{course_url},{question_title},{question}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Student completed a lesson (to teacher)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
				<?php
				$is_on = tutor_utils()->get_option('email_to_teachers.a_student_completed_lesson');
				if($is_on){
					echo '<span class="result-pass">On</span>';
				}
				?>
            </td>
            <td>
                <code>
                    {teacher_username},{student_username},{course_name},{lesson_name},{completion_time},{lesson_url}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Student completed Submitted quiz','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_teachers.student_submitted_quiz');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {instructor_username}, {username}, {quiz_name}, {course_name}, {submission_time}, {quiz_review_url},
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('New Instructor Sign Up (to admin)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_admin.new_instructor_signup');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {instructor_name}, {instructor_email}, {signup_time}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('New Student Sign Up (to admin)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_admin.new_student_signup');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {student_name}, {student_email}, {signup_time}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('New Course Submitted for Review (to admin)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_admin.new_course_submitted');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {instructor_name}, {course_name}, {course_url}, {submitted_time}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('New Course Published (to admin)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_admin.new_course_published');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {instructor_name}, {course_name}, {course_url}, {published_time}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Course Edited/Updated (to admin)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_admin.course_updated');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {instructor_name}, {course_name}, {course_url}, {updated_time}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('New Assignment Submitted (to instructor)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_teachers.student_submitted_assignment');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {student_name}, {course_name}, {course_url}, {assignment_name}, {review_link}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Assignment has been Evaluate (to student)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_students.assignment_graded');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {course_name}, {course_url}, {assignment_name}, {assignemnt_score}, {assignment_comment}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Student removed from course (to student)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_students.remove_from_course');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {course_name}, {course_url}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Notify student when enrolled manually','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_students.manual_enrollment');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {course_name}, {course_url}, {course_start_url}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('New announcement posted to course (to students)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_students.new_announcement_posted');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {site_name}, {course_name}, {course_url}, {announcement}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Q&A message answered (to student)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_students.after_question_answered');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {answer}, {answer_by}, {question}, {question_title}, {course_name}, {course_url}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Feedback submitted for quizname (to student)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_students.feedback_submitted_for_quiz');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {quiz_name}, {total_marks}, {earned_marks}, {course_name}, {instructor_name}, {instructor_feedback}
                </code>
            </td>
        </tr>
        <tr>
            <td><?php _e('Rate course and instructor (to student)','tutor-pro'); ?></td>
            <td>text/html</td>
            <td>
                <?php
                $is_on = tutor_utils()->get_option('email_to_students.rate_course_and_instructor');
                if($is_on){
                    echo '<span class="result-pass">On</span>';
                }
                ?>
            </td>
            <td>
                <code>
                    {site_url}, {course_name}, {course_url}, {instructor_url}
                </code>
            </td>
        </tr>

        </tbody>
    </table>

</div>