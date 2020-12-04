<section class="pageTeam">
  <div class="pageTeam__inner">
    <div class="pageTeam__items">
      <?php
        if ($section['person']):
          foreach ($section['person'] as $person):
      ?>
      <div class="pageTeam__item">
        <div class="container">
          <div class="row">
            <div class="col-xl-4">
              <div class="pageTeam__itemImage" data-color-bg="<?= $person['color_bg']; ?>" data-aos="fade-right" data-aos-once='true'>
                <span class="pageTeam__itemImage--bg1"></span>
                <span class="pageTeam__itemImage--bg2"></span>
                <img class="pageTeam__itemImageElement"src="<?= $person['image']['sizes']['large']; ?>"
                  alt="<?= $person['image']['alt']; ?>">
              </div>
              <div class="pageTeam__itemButtons
                     <?= ($person['color_bg'] === 'blue') ? 'pageTeam__itemButtons--moreSpace' : ''; ?>" data-aos="fade-up" data-aos-once='true'>
                <a class="pageTeam__itemButton button button--blue" href="<?= $person['check_opinion']['url']; ?>">
                  <?= $person['check_opinion']['title']; ?>
                </a>
                <a class="pageTeam__itemButton button button--arrow button--border"
                  href="<?= $person['add_opinion']['url']; ?>">
                  <?= $person['add_opinion']['title']; ?>
                </a>
              </div>
            </div>
            <div class="col-xl-8">
              <div class="pageTeam__itemContent" data-aos="fade-left" data-aos-once='true'>
                <h3 class="pageTeam__itemName"><?= $person['name']; ?></h3>
                <div class="pageTeam__itemDesc wysiwyg wysiwyg--flex"><?= $person['desc']; ?></div>
                <div class="pageTeam__itemProfessionNumber wysiwyg wysiwyg--pink">
                  <?= $person['profession_number']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php
        endforeach;
      endif;
    ?>
  </div>
</section>