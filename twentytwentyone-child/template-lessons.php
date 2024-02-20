

<?php /* Template Name: Lessons Template*/ ?>
<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container section text-center">


<?php

global $wp_query;
$original_query = $wp_query;

$paged = get_query_var('paged');
$args = array(
    'post_type' => 'page',
    'paged' => $paged,
    'post_parent' => get_the_ID(),
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'orderby' => 'post_parent__in'
);
$wp_query = null;
$wp_query = new WP_Query( $args );

$post_count = $wp_query->found_posts;

$cur_post_num = $paged > 0 ? $paged : 1;

$cur_percent = floor(100/($post_count/($cur_post_num)));

?>

        <div class="progress mb-3">
                <div class="progress-bar" role="progressbar" style="width: <?php echo $cur_percent; ?>%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <h1><?php the_title(); ?></h1>

<?php

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>

        <h2>Lesson <?php echo $cur_post_num; ?></h2>

        <div class="row lesson-wrapper">
            <div class="col col-sm-12 col-md-12 col-lg-12">

                <?php

                    // if child post has childrent print as tiles otherwise print content
                    $args2 = array(
                        'post_type' => 'page',
                        'post_parent' => get_the_ID(),
                        'post_status' => 'publish',
                        'orderby' => 'post_parent__in'
                    );
                    $tile_query = new WP_Query( $args2 );

                    $tile_count = $tile_query->found_posts;

                    if ($tile_count > 0) {
                        ?>
                            <div class="row lesson-grid">
                        <?php
                        while ( $tile_query->have_posts() ) {
                            $tile_query->the_post();
                            ?>
                                <div class="col col-sm-12 col-md-12 col-lg-6 lesson-tile">
                                    <h3><?php the_title(); ?></h3>

                                    <?php
                                        $content = apply_filters( 'the_content', get_the_content() );
                                        echo $content;
                                    ?>
                                </div>
                            <?php
                        }
                        ?>
                            </div>
                        <?php
                    } else {
                        $content = apply_filters( 'the_content', get_the_content() );
                        echo $content;
                    }
                ?>
            </div>
        </div>

        <?php
        endwhile;
        ?>
        <!-- End of the main loop -->

        <!-- Start the pagination functions after the loop. -->
        <p class="mt-4 pagination-buttons">
            <?php previous_posts_link( 'Previous Lesson' ); ?>
            <?php next_posts_link( 'Next Lesson' ); ?>
        </p>
        <!-- End the pagination functions after the loop. -->
        <?php
        else:
            echo 'no posts found';
        endif;

        // reset to original page query
        $wp_query = null;
        $wp_query = $original_query;
        wp_reset_postdata();
        ?>

        </div>
    </main><!-- .site-main -->
    <?php //get_sidebar( 'content-bottom' ); ?>
</div><!-- .content-area -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>

