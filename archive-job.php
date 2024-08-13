<?php 

get_header();

if(have_posts()):
    while (have_posts()) : the_post();
        $job_title = get_post_meta(get_the_ID(), '_job_title', true);
        $salary = get_post_meta(get_the_ID(), '_salary', true);
        $location = get_post_meta(get_the_ID(), '_location', true);
?>
        <div class="job-listing">
            <h2><a href="<?php the_permalink(); ?>"> <?php echo esc_html($job_title); ?></a></h2>
            <p><strong>Salary:</strong> <?php echo esc_html($salary) ?></p>
            <p><strong>Location:</strong> <?php echo esc_html($location) ?></p>
            <p><?php the_excerpt(); ?></p>
        </div>
<?php
    endwhile;
    the_posts_navigation();
else :
    echo '<p>No job postings found.</p>';
endif;

get_footer();