<?php
class block_overall_course_progress_renderer extends plugin_renderer_base {
    public function render_overall_course_progress($progress) {
        return $this->render_from_template('block_overall_course_progress/overall_course_progress', [
            'progress' => $progress
        ]);
    }
}
