<?php 

get_header();
?>
<h3 class="my-3"><a href="<?php esc_url( home_url()) ?>/jobs/" class="btn-btn-primary">Back to Job Listings</a></h3>
<?php
if(have_posts()): ?>
    <div class="container mt-5">
        <div class="row">
        <?php while (have_posts()) : the_post();
            $job_title = get_post_meta(get_the_ID(), '_job_title', true);
            $salary = get_post_meta(get_the_ID(), '_salary', true);
            $location = get_post_meta(get_the_ID(), '_location', true);
        ?>
        <div class="col-md-8 off-set-md-2">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><?php echo esc_html($job_title); ?></h1>
                    <p class="card-text"><strong>Salary:</strong> <?php echo esc_html($salary) ?></p>
                    <p class="card-text"><strong>Location:</strong> <?php echo esc_html($location) ?></p>
                    <div class="job-description">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>   
<?php  endwhile;  ?>
        </div>
    </div>
   <?php else : ?>
    <p class="text-center">No job details found.</p>
<?php endif;

get_footer();