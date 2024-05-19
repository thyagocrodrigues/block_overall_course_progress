<?php
class block_overall_course_progress extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_overall_course_progress');
    }

    public function get_content() {
        global $USER, $DB, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $courses = enrol_get_users_courses($USER->id, true, null, 'visible DESC, fullname ASC');
        $total_courses = count($courses);
        $completed_courses = 0;

        foreach ($courses as $course) {
            $completion = new completion_info($course);
            if ($completion->is_course_complete($USER->id)) {
                $completed_courses++;
            }
        }

        $progress = ($total_courses > 0) ? ($completed_courses / $total_courses) * 100 : 0;

        $this->content->text = $OUTPUT->render_from_template('block_overall_course_progress/overall_course_progress', [
            'progress' => round($progress)
        ]);

        return $this->content;
    }
}
