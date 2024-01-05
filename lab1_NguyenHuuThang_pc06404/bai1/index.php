<?php
$course = [
    's1' => 'course',
    's2' => 'course',
    's3' => 'course'
];
//models
function get_course(){
    global $course;
    return array_values($course);
}
function find_by_semester($semester){
    global $course;
    return (array_key_exists($semester,$course)?$course[$semester]:'Invalid course');

}
//controller
$list_of_course = get_course();
$semester = (!empty($_GET['semester'])? $_GET['semester']:'');
$course_name = find_by_semester($semester);
$page_content = $course_name;
?>
<!-- view -->
<?=$page_content;?>
<select name="courses" id="">
    <?php
        foreach($list_of_course as $course_name): ?>
        <option value=""><?=$course_name?></option>
        <?php endforeach;?>
</select>