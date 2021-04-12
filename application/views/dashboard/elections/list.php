<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $title ?></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <a class="btn btn-primary" role="button" href="<?= base_url() ?>admin/elections//candidat/create?election=<?= $election['slug'] ?>">Ajouter un candidat</a>
          <a class="btn btn-warning my-3" href="<?= base_url() ?>cache/delete_all" role="button">Supprimer cache après avoir ajouté un candidat</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <table id="table_votes_datan" class="table table-bordered table-striped" data-order='[[6, "desc"]]'>
            <thead>
              <tr>
                <th>député</th>
                <th>district</th>
                <th>position</th>
                <th>nuance</th>
                <th>source</th>
                <th>visible</th>
                <th>dernière modif</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!isset($candidats)) $candidats = [] ?>
              <?php foreach ($candidats as $candidat) : ?>
                <tr>
                  <td><a target="_blank" href="<?php echo base_url(); ?>deputes/<?php echo $candidat['dptSlug'].'/depute_'.$candidat['nameUrl'] ?>"><?php echo $candidat['nameFirst'] .' ' . $candidat['nameLast'] ?></a></td>
                  <td><?= $candidat['districtLibelle'] ?></td>
                  <td><?= $candidat['position'] ?></td>
                  <td><?= $candidat['nuance'] ?></td>
                  <td>
                    <a href="<?= $candidat['source'] ?>" target="_blank" rel="nofollow noopener noreferrer"><?= $candidat['source'] ?></a>
                  </td>
                  <td><?= $candidat['visible'] ?></td>
                  <td><?= $candidat['modified_at'] ?></td>
                  <td>
                    <a class="btn btn-link" href="<?= base_url() ?>admin/elections/candidat/modify/<?= $candidat['mpId'] ?>?election=<?= $election['slug'] ?>" ?>modifier</a><br/>
                    <a class="btn btn-link" href="<?= base_url() ?>admin/elections/candidat/delete/<?= $candidat['mpId'] ?>?election=<?= $election['slug'] ?>">supprimer</a><br/>
                    <a class="btn btn-link" target="_blank" href="<?php echo base_url(); ?>deputes/<?php echo $candidat['dptSlug'].'/depute_'.$candidat['nameUrl'].'?regionales2021' ?>">preview</a><br/>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->

</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->