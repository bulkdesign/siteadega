<?php
/**
 * Team info below image template
 */
global $fleur_IconCollections;
$number_of_social_icons = 5;
?>

<div class="mkd-team-item-wrapper">
    <div class="mkd-team <?php echo esc_attr($team_type) ?>">
        <div class="mkd-team-inner">
            <?php if($team_image !== '') { ?>
                <div class="mkd-team-image">
					<div class="mkd-team-image-inner" style="background-image:url(<?php print $team_image_src;?>)">

					</div>
                </div>
            <?php } ?>

            <?php if($team_name !== '' || $team_position !== '' || $team_description != "" || $show_skills == 'yes') { ?>
                <div class="mkd-team-info">
                <?php if($team_name !== '' || $team_position !== '') { ?>
                <div class="mkd-team-title-holder <?php echo esc_attr($team_social_icon_type) ?>">
                    <?php if($team_name !== '') { ?>
                        <<?php echo esc_attr($team_name_tag); ?> class="mkd-team-name <?php echo esc_attr($light_class); ?>">
                        <?php echo esc_attr($team_name); ?>
                        </<?php echo esc_attr($team_name_tag); ?>>
                    <?php } ?>
                    <?php if($team_position !== "") { ?>
                        <h5 class="mkd-team-position <?php echo esc_attr($light_class); ?>">
							<?php echo esc_attr($team_position) ?>
						</h5>
                    <?php } ?>
                    </div>
                <?php } ?>

                <?php if($team_description != "") { ?>
                    <div class='mkd-team-text'>
                        <div class='mkd-team-text-inner'>
                            <div class='mkd-team-description <?php echo esc_attr($light_class); ?>'>
                                <p><?php echo esc_attr($team_description) ?></p>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>

            <div class="mkd-team-social-holder-between">
                <div class="mkd-team-social <?php echo esc_attr($team_social_icon_type) ?>">
                    <div class="mkd-team-social-inner">
                        <div class="mkd-team-social-wrapp <?php echo esc_attr($light_class); ?>">

                            <?php foreach($team_social_icons as $team_social_icon) {
                                print $team_social_icon;
                            } ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>