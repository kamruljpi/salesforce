Hi <?php echo strtolower(isset($applicant_name) ? $applicant_name : ''); ?>,<br/><br/><br/>

<?php if($exam_status == 'Fail'){
    echo "Sorry to inform you that,<br>
        You have failed in the Written Exam<br/>";
    }
    else{
        echo "Congratulations,<br>
        You have passed in the Written Exam<br/>";
    }
?>