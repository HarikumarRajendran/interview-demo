<!DOCTYPE html>
<html lang='en'>
   <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>
      <title>ADMIN</title>
      <meta name='theme-color' content='#0c0a0a' />
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="<?= asset('css/app.css') ?>" rel="stylesheet">
   </head>
   <body>
        <nav class="navbar navbar-light bg-light justify-content-between">
          <a class="navbar-brand">Admin Panel</a>
          <form class="form-inline">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a href='<?= route('admin-logout') ?>'>Logout</a></button>
          </form>
        </nav>
      <div class='sub-category bg-white'>
         <div class='body-top'>
            <div class='col-md-12 col-sm-12 zeropadding'>
               <div class='body-body-top-2 col-md-12 col-sm-12'>
                  <span class='err'></span>
                  <form method='post' id='UserForm' onsubmit="return AddUser();">
                     <input type='hidden' name='_token' id='csrf-token' value='<?= csrf_token() ?>' />
                     <input type='hidden' id='e-br-in' class='input-class' value=''>
                     <input type='hidden' id='dataRow' class='dataRow' value=''>
                     <div class="form-row">
                        <div class="form-group col-md-4">
                           <label for="inputName">Name</label>
                           <input type="text" class="form-control" name="userName" id="inputName" placeholder="Name">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="inputEmail">Email</label>
                           <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="inputMobile">Mobile</label>
                           <input type="text" class="form-control" name="mobileno" id="inputMobile" placeholder="Mobile number" maxlength="10">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="inputAddress">Address</label>
                           <input type="text" class="form-control" name="address" id="inputAddress"placeholder="Address">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="inputZipcode">Zipcode</label>
                           <input type="text" class="form-control" name="zipcode" id="inputZipcode" placeholder="Zipcode" maxlength="6">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAccess">Access</label>
                          <select id="inputAccess" class="form-control" name="access">
                            <option value="">Select access</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                            <button class='btn btn-primary StrBtn' type='submit'>Add</button>
                        </div>
                  </form>
                  </div>
               </div>
               <div class='body-body-top-3 col-sm-12 col-md-12 zeropadding'>
                  <div class='store-mn-reports bg-white'>
                     <table class='table table-striped table-bordered dt-responsive nowrap e-br' width='100%' cellspacing='0' id='table-value'>
                        <thead>
                           <tr>
                              <th style='width:5%'>S.No</th>
                              <th style='width:10%'>Name</th>
                              <th style='width:20%'>Email</th>
                              <th style='width:5%'>Mobile</th>
                              <th style='width:10%'>Address</th>
                              <th style='width:10%'>Zipcode</th>
                              <th style='width:5%'>Access</th>
                              <th style='width:10%'>Status</th>
                              <th style='width:10%'>Edit</th>
                              <th style='width:20%'>Change Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $i = 1;
                              
                              if ($AdminDt) {
                              
                                      foreach ($AdminDt as $SepAdminDt) {
                                      ?>
                           <tr id='row-<?= $i ?>'>
                              <td><?= $i ?></td>
                              <td><?= trim($SepAdminDt->name) ?></td>
                              <td><?= trim($SepAdminDt->email) ?></td>
                              <td><?= trim($SepAdminDt->mobile) ?></td>
                              <td><?= trim($SepAdminDt->address) ?></td>
                              <td><?= trim($SepAdminDt->zipcode) ?></td>
                              <td><?= $SepAdminDt->access == 1 ? 'Admin' : 'User' ?></td>
                              <td><?= $SepAdminDt->status == 1 ? 'Active' : 'In-active' ?></td>
                              <td><i class='fa fa-edit cursor-pointer' id='e-br-in-<?= $SepAdminDt->id ?>' data-row='<?= $i ?>'  data-id='<?= $SepAdminDt->id ?>' data-value='<?= json_encode($SepAdminDt) ?>' onclick='EditUser(this)'></i></td>
                              <td><i class="fa fa-power-off chng-sts cursor-pointer" data-row='<?= $i ?>' data='<?= $SepAdminDt->id ?>' data-td-act='7' onclick='StatusUser(this)'></i></td>
                           </tr>
                           <?php
                              $i++;
                              }
                              }
                              ?>
                        </tbody>
                     </table>
                     <input type='hidden' id='table-row-cnt' value='<?= ($i - 1) ?>'>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src='<?= asset('js/app.js?test='.rand()) ?>'></script>
   <script type="text/javascript">
      $('#table-value').DataTable();
   </script>
</html>