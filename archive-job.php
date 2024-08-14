<?php 

get_header();

if(have_posts()): ?>
    <div class="container">
        <div class="row">
        <?php 
        $counter = 1;
        while (have_posts()) : the_post();
            // get custom meta data for each job
            $job_title = get_post_meta(get_the_ID(), '_job_title', true);
            $salary = get_post_meta(get_the_ID(), '_salary', true);
            $location = get_post_meta(get_the_ID(), '_location', true);
        ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $counter . '. ' ?>
                        <a href="<?php the_permalink(); ?>"> <?php echo esc_html($job_title); ?></a>
                    </h5>
                    <p class="card-text"><strong>Salary:</strong> <?php echo esc_html($salary) ?></p>
                    <p class="card-text"><strong>Location:</strong> <?php echo esc_html($location) ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Job</a>
                </div>
            </div>
        </div>   
<?php
    $counter++;
    endwhile;  
?>
        </div>
    </div>
   <?php  the_posts_navigation();
else : ?>
    <p>No job postings found.</p>
<?php endif;

get_footer();