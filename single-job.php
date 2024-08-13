<?php 

get_header();

if(have_posts()):
    while (have_posts()) : the_post();
        $job_title = get_post_meta(get_the_ID(), '_job_title', true);
        $salary = get_post_meta(get_the_ID(), '_salary', true);
        $location = get_post_meta(get_the_ID(), '_location', true);
?>
        <div class="job-details">
            <h1><?php echo esc_html($job_title); ?></h1>
            <p><strong>Salary:</strong><?php echo esc_html($salary) ?></p>
            <p><strong>Location:</strong><?php echo esc_html($location) ?></p>
            <div class="job-description">
                <?php the_content(); ?>
            </div>
        </div>
<?php
    endwhile;
else :
    echo '<p>No job details found.</p>';
endif;

get_footer();
