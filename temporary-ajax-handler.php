<?php

// For generate transcript pdf
function generate_transcript_pdf() {
    if (!isset($_POST['student_name']) || !isset($_POST['dob']) || !isset($_POST['courses'])) {
        wp_send_json_error('Missing required data');
        return;
    }
    $student_name = sanitize_text_field($_POST['student_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $courses_raw = json_decode(stripslashes($_POST['courses']), true);

    if (!$courses_raw || !is_array($courses_raw)) {
        wp_send_json_error('Invalid course data format');
        return;
    }

    // Process course data to handle the specific format
    $processed_courses = [];
    foreach ($courses_raw as $course) {
        if (isset($course['course_name']) && isset($course['grade'])) {
            // Clean up whitespace
            $course_name = trim($course['course_name']);
            $grade = trim($course['grade']);
            
            // Extract the academic year
            $year = isset($course['year']) ? trim($course['year']) : '';
            // Get the grade level (e.g., "11TH GRADE")
            $student_grade = isset($course['student_grade']) ? trim($course['student_grade']) : '';
            // Extract just the numeric part of the grade level if needed
            $grade_level = '';
            if (preg_match('/(\d+)/', $student_grade, $matches)) {
                $grade_level = $matches[1];
            }
            
            // Get credit value directly from the credit field
            $credits = isset($course['credit']) ? trim($course['credit']) : '0.00';
            
            // Get additional information
            $publisher = isset($course['publisher']) ? trim($course['publisher']) : '';
            $semester = isset($course['semester']) ? trim($course['semester']) : '';
            $additional = isset($course['additional']) ? trim($course['additional']) : '';
            
            $processed_courses[] = [
                'course_name' => $course_name,
                'grade' => $grade,
                'credits' => $credits,
                'year' => $grade_level, // Using grade level as year
                'publisher' => $publisher,
                'semester' => $semester,
                'additional' => $additional,
                'academic_year' => $year
            ];
        }
    }

    // Group courses by grade level (year)
    $courses_by_year = [];
    foreach ($processed_courses as $course) {
        $year = isset($course['year']) ? $course['year'] : 'Unknown';
        if (!isset($courses_by_year[$year])) {
            $courses_by_year[$year] = [];
        }
        $courses_by_year[$year][] = $course;
    }
    
    // Sort years in descending order
    krsort($courses_by_year);

    // Start output buffering
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo esc_html($student_name); ?> - Transcript</title>
        <style>
            body {
                font-family: 'Times New Roman', serif;
                margin: 0px;
                padding: 0px;
                padding-right: 40px;
                padding-top: 15px;
                box-sizing: border-box;
                font-size: 14px;
                line-height: 16px;
                background:#fff url('<?php echo plugins_url('img/watermark.png', __FILE__); ?>') repeat;
                /* height: 100vh; */
            }

            p, td {
                font-size: 15px;
                line-height: 18px;
                padding: 0px;
                margin: 0px;
            }

            .transcript-container {
                padding: 0px;
                box-sizing: border-box;
            }

            .header {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .header-text {
                font-size: 1.5em;
                font-weight: 600;
                color: #456fb6;
                text-align: left;
                text-transform: uppercase;
            }

            .document-details {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                width: 100%;
                margin-bottom: 15px;
            }

            .document-left {
                text-align: left;
            }

            .document-right {
                text-align: right;
            }

            .document-details p {
                margin: 5px 0;
            }

            .info-section {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;
            }

            .info-section h4, .course-study-section h4, .summary-section h4, .grading-scale-section h4, .commentary-section h4 {
                font-weight: bold;
                margin-bottom: 5px;
                color: #456fb6; 
                font-size: 15px;
            }

            .info-section p {
                margin: 3px 0;
            }

            .course-study-section {
                margin-bottom: 15px;
            }

            .course-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }

            .course-table th, .course-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            .course-table th {
                background-color: #f0f0f0;
                font-weight: bold;
                color: #456fb6; 
            }

            .course-table td {
                vertical-align: top;
            }

            .gpa-summary-section, .cumulative-summary-section {
                margin-bottom: 15px;
            }

            .cumulative-summary-section h4 {
                font-size: 15px;
            }

            .summary-table {
                width: 100%;
                border-collapse: collapse;
            }

            .summary-table th, .summary-table td {
                border: 1px solid #ddd;
                padding: 2px;
                text-align: center;
            }

            .summary-table th {
                background-color: #f0f0f0;
                font-weight: bold;
                color: #456fb6; 
            }

            .grading-scale-section, .commentary-section {
                margin-bottom: 15px;
            }

            .grading-scale-table th {
                background-color: #f0f0f0;
                font-weight: bold;
                color: #456fb6; 
            }

            .grading-scale-table th, .grading-scale-table td {
                border: 1px solid #ddd;
                padding: 2px;
                text-align: center;
            }

            .grading-scale-table th {
                background-color: #f0f0f0;
                font-weight: bold;
                color: #456fb6; 
            }

            .signature-section {
                text-align: right;
                margin-top: 20px;
            }

            .signature-line {
                border-bottom: 1px solid black;
                width: 200px;
                margin: 0 0 5px auto;
            }

            .signature-date {
                font-size: 0.9em;
                color: #555;
            }

            .grade-cell {
                text-align: center;
            }

            .credits-cell {
                text-align: center;
            }

            .right-align {
                text-align: right;
            }
            .noborder, .noborder td {
                border: none;
            }
            .small-header {
                font-size: 14px;
                line-height: 16px;
            }
            @media print {
                body {
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
            } 
        </style>
        </head>
        <body>
        <div class="transcript-container">
            <table width="100%" colspan="0" class="noborder">
                <tr>
                    <td>
                        <div class="header-text">Graduates Academy Transcript</div>
                        <p class="small-header">
                            (<?php 
                                if (!empty($courses_by_year)) {
                                    $grades = array_keys($courses_by_year);
                                    sort($grades);
                                    $min_grade = min($grades);
                                    $max_grade = max($grades);
                                    
                                    if ($min_grade === $max_grade) {
                                        echo "Grade - " . esc_html($min_grade);
                                    } else {
                                        echo "Grades " . esc_html($min_grade . '-' . $max_grade);
                                    }
                                } else {
                                    echo "Grades 9-12"; // Default fallback
                                }
                            ?>)
                        </p>
                        <p>Graduation Date: <span id="graduation-date"><?php echo date('m/d/Y'); ?></span></p>
                    </td>
                    <td>
                        <img src="<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>" alt="<?php echo get_bloginfo('name'); ?>" style="max-width:200px; height:auto; margin-top:10px;" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>School of Record</h4>
                        <p id="school-name">Sample School Name</p>
                        <p id="school-parent">Sample Parent</p>
                        <p id="school-address">1234 Town Road</p>
                        <p id="school-city-state-zip">Anywhere, VA 22345</p>
                        <p id="school-phone">123-456-7890</p>
                        <p id="school-email">info@fasttranscripts.com</p>
                    </td>
                    <td>
                        <h4>Student Information</h4>
                        <p id="student-name"><?php echo esc_html($student_name); ?></p>
                        <p>Gender: <span id="student-gender">M</span></p>
                        <p>Date of Birth: <span id="student-dob"><?php echo esc_html($dob); ?></span></p>
                        <p id="student-address-student">1234 Town Road</p>
                        <p id="student-city-state-zip-student">Anywhere, VA 22345</p>
                        <p id="student-phone-student">123-456-7890</p>
                        <p id="student-email-student">info@fasttranscripts.com</p>
                    </td>
                </tr>
            </table>


            <?php
            // Group courses by year
            $courses_by_year = [];
            if (!empty($processed_courses)) {
                foreach ($processed_courses as $course) {
                    $year = isset($course['year']) ? $course['year'] : 'Unknown';
                    if (!isset($courses_by_year[$year])) {
                        $courses_by_year[$year] = [];
                    }
                    $courses_by_year[$year][] = $course;
                }
                
                // Sort years in descending order
                krsort($courses_by_year);
                
                // Begin course container
                echo '<div class="courses-container">';
                
                // Display each year's courses in a 2-column layout
                $counter = 0;
                foreach ($courses_by_year as $year => $year_courses):
                    $counter++;
            ?>
                    <div class="course-column">
                        <div class="course-study-section">
                            <h4>Course Study Grade - <?php echo esc_html($year); ?> 
                            <!-- (<?php echo esc_html($year_courses[0]['academic_year']); ?>) -->
                        </h4>
                            <table class="course-table">
                                <thead>
                                    <tr>
                                        <th>Course Study</th>
                                        <th>Grade</th>
                                        <th>Credits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($year_courses as $course): ?>
                                    <tr>
                                        <td><?php echo esc_html($course['course_name']); ?></td>
                                        <td class="grade-cell"><?php echo esc_html($course['grade']); ?></td>
                                        <td class="credits-cell"><?php echo esc_html($course['credits']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="2" class="right-align">GPA</td>
                                        <td class="credits-cell">
                                            <?php 
                                            // Calculate total credits for this grade
                                            $total_credits = 0;
                                            foreach ($year_courses as $course) {
                                                $total_credits += floatval($course['credits']);
                                            }
                                            echo number_format($total_credits, 2); 
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <?php 
                endforeach;
                
                // Close course container
                echo '</div>';
            } else { 
                echo '<p>No courses available.</p>'; 
            }
            ?>

            <style>
                .courses-container {
                    display: flex;
                    flex-wrap: wrap;
                    margin: 0 -10px; /* Negative margin to offset padding */
                }
                
                .course-column {
                    flex: 0 0 50%;
                    padding: 0 10px;
                    box-sizing: border-box;
                    margin-bottom: 20px;
                }
                
                @media (max-width: 768px) {
                    .course-column {
                        flex: 0 0 100%;
                    }
                }
            </style>            

            <div class="summary-section">
                <h4>Summary By Grade</h4>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <?php
                            // Get unique grades from courses and sort them
                            $grades = [];
                            if (!empty($courses_by_year)) {
                                foreach (array_keys($courses_by_year) as $grade) {
                                    if (is_numeric($grade)) {
                                        $grades[] = $grade;
                                    }
                                }
                                sort($grades);
                                
                                // Output column headers for each grade
                                foreach ($grades as $grade) {
                                    echo '<th>' . esc_html($grade) . 'th</th>';
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Cum. GPA</th>
                            <?php
                            if (!empty($grades)) {
                                // Simple GPA calculation table
                                $gpa_values = [
                                    'A' => 4.0, 'A-' => 3.7,
                                    'B+' => 3.3, 'B' => 3.0, 'B-' => 2.7,
                                    'C+' => 2.3, 'C' => 2.0, 'C-' => 1.7,
                                    'D+' => 1.3, 'D' => 1.0, 'D-' => 0.7,
                                    'F' => 0.0
                                ];
                                
                                foreach ($grades as $grade) {
                                    if (isset($courses_by_year[$grade])) {
                                        $total_points = 0;
                                        $total_credits = 0;
                                        
                                        foreach ($courses_by_year[$grade] as $course) {
                                            $course_grade = isset($course['grade']) ? strtoupper(trim($course['grade'])) : '';
                                            $credits = isset($course['credits']) ? floatval($course['credits']) : 0;
                                            
                                            if (isset($gpa_values[$course_grade])) {
                                                $total_points += $gpa_values[$course_grade] * $credits;
                                                $total_credits += $credits;
                                            }
                                        }
                                        
                                        if ($total_credits > 0) {
                                            $gpa = $total_points / $total_credits;
                                            echo '<td>' . number_format($gpa, 2) . '</td>';
                                        } else {
                                            echo '<td>-</td>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Credits Earned</th>
                            <?php
                            if (!empty($grades)) {
                                foreach ($grades as $grade) {
                                    $total_credits = 0;
                                    if (isset($courses_by_year[$grade])) {
                                        foreach ($courses_by_year[$grade] as $course) {
                                            $total_credits += floatval($course['credits']);
                                        }
                                        echo '<td>' . number_format($total_credits, 2) . '</td>';
                                    }
                                }
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="cumulative-summary-section">
                <h4 style="color: #456fb6;">Cumulative Summary (<?php 
                    if (!empty($grades)) {
                        sort($grades);
                        $min_grade = min($grades);
                        $max_grade = max($grades);
                        
                        if ($min_grade === $max_grade) {
                            echo esc_html($min_grade . 'th');
                        } else {
                            echo esc_html($min_grade . 'th-' . $max_grade . 'th');
                        }
                    } else {
                        echo "9th-12th"; // Default fallback
                    }
                ?>)</h4>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Total Credits</th>
                            <th>GPA Credits</th>
                            <th>GPA Points</th>
                            <th>GPA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <td>25.00</td>
                            <td>24.00</td>
                            <td>83.50</td>
                            <td>3.48</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="grading-scale-section">
                <h4>Grading Scale</h4>
                <table class="grading-scale-table">
                    <thead>
                        <tr>
                            <th>90-100</th>
                            <th>80-89</th>
                            <th>70-79</th>
                            <th>60-69</th>
                            <th>0-59</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A</td>
                            <td>B</td>
                            <td>C</td>
                            <td>D</td>
                            <td>F</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="commentary-section">
                <h4>Commentary</h4>
                <p>"ACE Community College</p>
            </div>

            <div class="signature-section">
                <div class="signature-line"></div>
                <p>Authorized Signature</p>
                <p class="signature-date">Date: <span id="signature-date"><?php echo date('m/d/Y'); ?></span></p>
            </div>
        </div>
    </body>
    </html>
    <?php
    // Get the content from the buffer
    $html_content = ob_get_clean();

    // Send the complete HTML structure as a response
    wp_send_json_success(array(
        'html' => $html_content,
        'student_name' => $student_name
    ));
}
add_action('wp_ajax_generate_transcript_pdf', 'generate_transcript_pdf');
add_action('wp_ajax_nopriv_generate_transcript_pdf', 'generate_transcript_pdf');
 