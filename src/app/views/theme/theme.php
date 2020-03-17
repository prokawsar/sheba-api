:root{
  --logoBackground: <?=$themer->logoBackground?>;

  --gradient_start_color: <?=$themer->gradientStart?>;
  --gradient_start_colorInverted: <?=$themer->findColorInvert($themer->gradientStart)?>;
  --gradient_end_color: <?=$themer->gradientEnd?>;
  --gradient_end_colorInverted: <?=$themer->findColorInvert($themer->gradientEnd)?>;

  --primary: <?=$themer->primary?>;
  --primaryInverted: <?=$themer->findColorInvert($themer->primary) ?>;
  --darken10_saturated10_adjustHue-10_primary: <?=$themer->darken($themer->saturate($themer->adjustHue($themer->primary, -10), 10), 10)?>;
  --darken10_saturated10_adjustHue-10_primaryInverted: <?= $themer->darken($themer->saturate($themer->adjustHue($themer->findColorInvert($themer->primary), -10), 10), 10) ?>;
  --lighten5_saturated5_adjustHue10_primary: <?=$themer->lighten($themer->saturate($themer->adjustHue($themer->primary, 10), 5), 5)?>;
  <?php
    $colorLuminance = $themer->colorLuminance($themer->primary);
    $darkenPercentage = $colorLuminance * 70;
    $desaturatePercentage = $colorLuminance * 30;
  ?>
  --desaturated_darken_primary: <?=$themer->desaturate($themer->darken($themer->primary, $darkenPercentage), $desaturatePercentage)?>;
  --lightenMax_primary: <?=$themer->lighten($themer->primary, max((100 - $themer->lightness($themer->primary)) - 2, 0))?>;
  --darken10_primary: <?=$themer->darken($themer->primary, 10)?>;
  --darken5_primary: <?=$themer->darken($themer->primary, 5)?>;
  --darken5_primaryInverted: <?=$themer->darken($themer->findColorInvert($themer->primary), 5)?>;
  --darken2_5_primary: <?=$themer->darken($themer->primary, 2.5)?>;
  --darken2_5_primaryInvert: <?=$themer->darken($themer->findColorInvert($themer->primary), 2.5)?>;
  --darken10_primaryInverted: <?=$themer->darken($themer->findColorInvert($themer->primary), 10)?>;
  --rgba0_25_primary: <?=$themer->rgba($themer->primary, 0.25)?>;
  --rgba0_5_primary: <?=$themer->rgba($themer->primary, 0.5)?>;
  --rgba0_9_primaryInverted: <?=$themer->rgba($themer->findColorInvert($themer->primary), 0.9)?>;
  --rgba0_7_primaryInverted: <?=$themer->rgba($themer->findColorInvert($themer->primary), 0.7)?>;

  --info: <?=$themer->info?>;
  --infoInverted: <?=$themer->findColorInvert($themer->info) ?>;
  --darken10_saturated10_adjustHue-10_info: <?=$themer->darken($themer->saturate($themer->adjustHue($themer->info, -10), 10), 10)?>;
  --darken10_saturated10_adjustHue-10_infoInverted: <?= $themer->darken($themer->saturate($themer->adjustHue($themer->findColorInvert($themer->info), -10), 10), 10) ?>;
  --lighten5_saturated5_adjustHue10_info: <?=$themer->lighten($themer->saturate($themer->adjustHue($themer->info, 10), 5), 5)?>;
  <?php
    $colorLuminance = $themer->colorLuminance($themer->info);
    $darkenPercentage = $colorLuminance * 70;
    $desaturatePercentage = $colorLuminance * 30;
  ?>
  --desaturated_darken_info:  <?=$themer->desaturate($themer->darken($themer->info, $darkenPercentage), $desaturatePercentage)?>;
  --darken10_info: <?=$themer->darken($themer->info, 10)?>;
  --darken5_info: <?=$themer->darken($themer->info, 5)?>;
  --darken2_5_info: <?=$themer->darken($themer->info, 2.5)?>;
  --darken10_infoInverted: <?=$themer->darken($themer->findColorInvert($themer->info), 10)?>;
  --darken5_infoInverted: <?=$themer->darken($themer->findColorInvert($themer->info), 5)?>;
  --rgba0_25_info: <?=$themer->rgba($themer->info, 0.25)?>;
  --rgba0_5_info: <?=$themer->rgba($themer->info, 0.5)?>;
  --rgba0_9_info: <?=$themer->rgba($themer->info, 0.9)?>;
  --rgba0_9_infoInverted: <?=$themer->rgba($themer->findColorInvert($themer->info), 0.9)?>;
  --rgba0_7_info: <?=$themer->rgba($themer->info, 0.7)?>;
  --rgba0_7_infoInverted: <?=$themer->rgba($themer->findColorInvert($themer->info), 0.7)?>;
}