<section class="video">
  <div class="video__inner">
    <?php if($section['video_type'] === 'fb') : ?>
    <div class="video__video video__video--fb"><?= $section['video_fb'] ?></div>
    <?php endif; ?>
    <?php if($section['video_type'] === 'url') : ?>
    <div class="video__video video__video--url"><?= $section['video_url'] ?></div>
    <?php endif; ?>
    <?php if($section['video_type'] === 'file') : ?>
    <div class="video__video video__video--file"><video class="video__videoEl" src="<?= $section['video_file'] ?>"
        muted></video></div>
    <?php endif; ?>
  </div>
</section>