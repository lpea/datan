  <div class="container-fluid bloc-img-deputes async_background" id="container-always-fluid" style="height: 13em"></div>
  <?php if (!empty($depute['couleurAssociee'])): ?>
    <div class="liseret-groupe" style="background-color: <?= $depute['couleurAssociee'] ?>"></div>
  <?php endif; ?>
  <div class="container pg-depute-individual">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-4 offset-md-2 offset-lg-0 px-lg-4">
        <div style="margin-top: -110px; top: 110px;">
          <div class="card card-profile">
            <div class="card-body">
              <!-- IMAGE MP -->
              <div class="img">
                <div class="d-flex justify-content-center">
                  <div class="depute-img-circle">
                    <?php if ($depute['img']): ?>
                      <picture>
                        <source srcset="<?= asset_url(); ?>imgs/deputes_nobg_webp/depute_<?= $depute['idImage'] ?>_webp.webp" type="image/webp">
                        <source srcset="<?= asset_url(); ?>imgs/deputes_nobg/depute_<?= $depute['idImage'] ?>.png" type="image/png">
                        <img src="<?= asset_url(); ?>imgs/deputes_original/depute_<?= $depute['idImage'] ?>.png" width="130" height="166" alt="<?= $title ?>">
                      </picture>
                      <?php else: ?>
                        <picture>
                          <source srcset="<?= asset_url() ?>imgs/placeholder/placeholder-face-2.png" type="image/png">
                          <img src="<?= asset_url() ?>imgs/placeholder/placeholder-face-2.png" width="130" height="166" alt="<?= $title ?>">
                        </picture>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <!-- INFOS GENERALES -->
              <div class="bloc-infos">
                <h1 class="text-center text-lg-left"><?= $title ?></h1>
                <div class="link-group text-center text-lg-left mt-1">
                  <a href="<?= base_url() ?>groupes/legislature-<?= $depute['legislature'] ?>/<?= mb_strtolower($depute['libelleAbrev']) ?>" style="color: <?= $depute['couleurAssociee'] ?>; --color-group: <?= $depute['couleurAssociee'] ?>">
                    <?= $depute['libelle'] ?>
                  </a>
                </div>
              </div>
              <!-- BIOGRAPHIE -->
              <div class="bloc-bref mt-3 d-flex justify-content-center justify-content-lg-start">
                <ul>
                  <li class="first">
                    <div class="label"><?= file_get_contents(asset_url().'imgs/icons/geo-alt-fill.svg') ?></div>
                    <div class="value"><?= $depute['departementNom'].' ('.$depute['departementCode'].')'?></div>
                  </li>
                  <li>
                    <div class="label"><?= file_get_contents(asset_url().'imgs/icons/person-fill.svg') ?></div>
                    <div class="value"><?= $depute['age'] ?> ans</div>
                  </li>
                  <li class="mb-0">
                    <div class="label"><?= file_get_contents(asset_url().'imgs/icons/briefcase-fill.svg') ?></div>
                    <div class="value">Commission <?= $commission_parlementaire['commissionAbrege'] ?></div>
                  </ul>
              </div>
            </div>
            <?php if ($active): ?>
              <div class="mandats d-flex justify-content-center align-items-center active">
                <span class="active"><?= mb_strtoupper($mandat_edito) ?> MANDAT</span>
              </div>
              <?php else: ?>
                <div class="mandats d-flex justify-content-center align-items-center inactive">
                  <span class="inactive">PLUS EN ACTIVITÉ</span>
                </div>
            <?php endif; ?>
          </div> <!-- END CARD PROFILE -->
        </div> <!-- END STICKY TOP -->
        <div class="sticky-top mt-5" style="margin-top: -110px; top: 110px;">
          <div class="card">
            <div class="card-body badges-filter px-4 py-3">
              <span class="title">Filtrer par catégorie</span>
              <div class="filters" id="filter">
                <div class="mt-2">
                  <?php foreach ($fields as $field): ?>
                    <button type="button" class="badge badge-field popover_focus is-selected" value=".<?= strtolower($field['slug']) ?>"><?= $field['name'] ?></button>
                  <?php endforeach; ?>
                </div>
                <div class="mt-2">
                  <button type="button" id="all-categories" class="btn btn-primary" value="*">Toutes les catégories</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-3">
            <div class="card-body badges-filter px-4 py-3">
              <input type="text" id="quicksearch" placeholder="Cherchez un vote..." />
            </div>
          </div>
        </div>
      </div> <!-- END COL -->
      <!-- BLOC VOTES -->
      <div class="col-md-10 col-lg-8 offset-md-1 offset-lg-0 pl-lg-5 bloc-votes-datan">
        <div class="row mt-4">
          <div class="col-12 btn-back text-center text-lg-left">
            <a class="btn btn-outline-primary mx-2" href="<?= base_url() ?>deputes/<?= $depute['dptSlug'] ?>/depute_<?= $depute['nameUrl'] ?>">
              <?= file_get_contents(asset_url().'imgs/icons/arrow_left.svg') ?>
              Retour profil
            </a>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <h2>Les votes de <?= $title ?></h2>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-7 col-lg-6">
            <p>
              L'équipe de Datan décrypte pour vous les votes les plus intéressants de la législature. Il s'agit des votes qui ont fait l'objet d'attention médiatique, ou sur lesquels un ou plusieurs groupes parlementaires étaient fortement divisés. Ces votes font l'objet d'une reformulation et d'une contextualisation, afin de les rendre plus compréhensibles.
            </p>
            <p>
              Vous trouverez sur cette page les positions de <b><?= $title ?></b> sur ces votes.
            </p>
            <p>
              Pour avoir accès à tous les votes de <?= $title ?> à l'Assemblée nationale, <a href="<?= base_url() ?>deputes/<?= $depute['dptSlug'] ?>/depute_<?= $depute['nameUrl'] ?>/votes/all">cliquez ici</a>.
            </p>
          </div>
          <div class="d-none d-md-block col-md-5 col-lg-6 vote-svg">
            <?= file_get_contents(asset_url()."imgs/svg/undraw_voting_nvu7.svg") ?>
          </div>
        </div>
        <div class="row mt-4 sorting">
          <?php foreach ($votes as $vote): ?>
            <div class="col-md-6 sorting-item <?= $vote['category_slug'] ?>">
              <div class="d-flex justify-content-center my-3">
                <?php $this->load->view('deputes/partials/card_vote.php', array('vote' => $vote)) ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div> <!-- END CONTAINER -->
  <!-- AUTRES DEPUTES -->
  <div class="container-fluid pg-depute-individual bloc-others-container mt-5">
    <div class="container bloc-others">
      <div class="row">
        <div class="col-12">
          <?php if ($active): ?>
            <h2>Les autres députés <?= $depute['libelle'] ?> (<?= $depute['libelleAbrev'] ?>)</h2>
            <?php else: ?>
            <h2>Les autres députés plus en activité</h2>
          <?php endif; ?>
          <div class="row mt-3">
            <?php foreach ($other_deputes as $mp): ?>
              <div class="col-6 col-md-3 py-2">
                <a class="membre no-decoration underline" href="<?= base_url(); ?>deputes/<?= $mp['dptSlug'] ?>/depute_<?= $mp['nameUrl'] ?>"> <?= $mp['nameFirst'].' '.$mp['nameLast'] ?></a>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="mt-3">
            <?php if ($active): ?>
              <a href="<?= base_url() ?>groupes/legislature-<?= $depute['legislature'] ?>/<?= mb_strtolower($depute['libelleAbrev']) ?>/membres">Voir tous les députés membres du groupe <?= $depute['libelle'] ?> (<?= $depute['libelleAbrev'] ?>)</a>
              <?php else: ?>
              <a href="<?= base_url(); ?>deputes/inactifs">Tous les députés plus en activité</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12">
          <h2>Les députés en activité du département <?= $depute['dptLibelle2'] ?><?= $depute['departementNom'].' ('.$depute['departementCode'].')'?></h2>
          <div class="row mt-3">
            <?php foreach ($other_deputes_dpt as $mp): ?>
              <div class="col-6 col-md-3 py-2">
                <a class="membre no-decoration underline" href="<?= base_url(); ?>deputes/<?= $mp['dptSlug'] ?>/depute_<?= $mp['nameUrl'] ?>"> <?= $mp['nameFirst'].' '.$mp['nameLast'] ?></a>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="mt-3">
            <a href="<?= base_url() ?>deputes/<?= $depute['dptSlug'] ?>">Voir tous les députés élus dans le département <?= $depute['dptLibelle2'] ?><?= $depute['departementNom'] ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
