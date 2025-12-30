<?php
/**
 * The main template file
 *
 * @package VMST_Solutions
 */

get_header();
?>

<div class="content-area">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php
                    if (is_singular()) {
                        the_title('<h1 class="entry-title">', '</h1>');
                    } else {
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    }
                    ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    if (is_singular()) {
                        the_content();
                    } else {
                        the_excerpt();
                    }
                    ?>
                </div>

                <footer class="entry-footer">
                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                    <span class="byline"><?php esc_html_e('by', 'vmst-solutions'); ?> <?php the_author(); ?></span>
                </footer>
            </article>
            <?php
        }

        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('&laquo; Previous', 'vmst-solutions'),
            'next_text' => __('Next &raquo;', 'vmst-solutions'),
        ));
    } else {
        ?>
        <div class="no-results">
            <h2><?php esc_html_e('Nothing Found', 'vmst-solutions'); ?></h2>
            <p><?php esc_html_e('It seems we can\'t find what you\'re looking for.', 'vmst-solutions'); ?></p>
        </div>
        <?php
    }
    ?>
</div>

<?php
get_footer();

