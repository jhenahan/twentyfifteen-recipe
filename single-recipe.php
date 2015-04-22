<?php

/**
 * The template for displaying all single recipes
 *
 * @package    WordPress
 * @subpackage Twenty_Fifteen_Recipes
 * @since      Twenty Fifteen Recipes 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $args = array(
            'post_type' => 'recipe',
            'posts_per_page' => 10
        );
        $loop = new WP_Query( $args );
        // Start the loop.
        while ($loop->have_posts()) :
        $loop->the_post();
        $metas = get_post_meta( get_the_ID() );
        extract( $metas );
        ?>
        <div itemscope itemtype="http://schema.org/Recipe">
            <header class="entry-header">
                <?php the_title(
                    '<h1 class="entry-title" itemprop="name">', '</h1>'
                ); ?>
                <p>By <span itemprop="author"><?php the_author(); ?></span></p>
            </header>
            <div class="entry-content">
                <div itemprop="description">
                    <?php the_content(); ?>
                </div>
                <?php if(isset($recipe_yield)): ?>
                <div><span
                        itemprop="recipeYield"><?php echo $recipe_yield[ 0 ]?></span>
                    Serving
                </div>
                <?php endif; ?>
                <div>
                    <?php if(isset($recipe_yield)): ?>
                    Prep Time:
                    <time
                        itemprop="prepTime"><?php echo $recipe_prep_time[ 0 ] ?></time>
                    <br/>
                    <?php endif; ?>
                    <?php if(isset($recipe_yield)): ?>
                    Cook Time:
                    <time
                        itemprop="cookTime"><?php echo $recipe_cook_time[ 0 ] ?></time>
                    <br/>
                    <?php endif; ?>
                    <?php if(isset($recipe_yield)): ?>
                    Ready In:
                    <time
                        itemprop="totalTime"><?php echo $recipe_total_time[ 0 ] ?></time>
                    <br/>
                    <?php endif; ?>
                </div>
                <?php if(isset($recipe_ingredients)): ?>
                <div>
                    <h3> Ingredients</h3>
                    <ul>
                        <?php
                        multibox_microdata_list_render(
                            $recipe_ingredients, 'ingredients'
                        );
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if(isset($recipe_instructions)): ?>
                <div itemprop="recipeInstructions">
                    <h3> Directions</h3>
                    <ol>
                        <?php
                        multibox_microdata_list_render( $recipe_instructions );
                        ?>
                    </ol>
                </div>
                <?php endif; ?>

                <div itemprop="nutrition">
                    <span itemscope
                          itemtype="http://schema.org/NutritionInformation">
                        <h3> Nutritional Information </h3>
                        <p><strong>Amount Per Serving</strong>&nbsp; Calories:
                            <span itemprop="calories">405</span>
                            | Total Fat: <span itemprop="fatContent">18g</span>
                            |
                            Cholesterol: <span itemprop="cholesterolContent">44mg</span>
                        </p>
      </span>
                </div>
            </div>
            <?php
            endwhile;
            ?>

    </main>
    <!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
