<!DOCTYPE html>
<html lang='en'>
   <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>
      <title>User</title>
      <meta name='theme-color' content='#0c0a0a' />
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="<?= asset('css/app.css') ?>" rel="stylesheet">
   </head>
   <body>
        <nav class="navbar navbar-light bg-light justify-content-between">
          <a class="navbar-brand">User Panel</a>
          <form class="form-inline">
            <button class="btn btn-outline-success mr-3 my-2 my-sm-0 profile">Profile</button>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a href='<?= route('user-logout') ?>'>Logout</a></button>
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
                          <select id="inputAccess" class="form-control" name="access" disabled="true">
                            <option value="2">User</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                            <button class='btn btn-primary StrBtn' type='submit'>Add</button>
                        </div>
                    </div>
                  </form>
                  <?php
                  
                    if($UserDt){
                    ?>
                    <form method='post' class='d-none' id='UpdateUserForm' onsubmit="return UserUpdate({{$UserDt->id}});">
                     <input type='hidden' name='_token' id='csrf-token' value='<?= csrf_token() ?>' />
                    <input type='hidden' id='profileId' value='{{$UserDt->id}}'>

                     
                     <div class="form-row">
                        <div class="form-group col-md-4">
                           <label for="profileName">Name</label>
                           <input type="text" class="form-control" name="userName" id="profileName" placeholder="Name" value="{{$UserDt->name}}">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="profileEmail">Email</label>
                           <input type="email" class="form-control" name="email" id="profileEmail" placeholder="Email" value="{{$UserDt->email}}">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="profileMobile">Mobile</label>
                           <input type="text" class="form-control" name="mobileno" id="profileMobile" placeholder="Mobile number" maxlength="10" value="{{$UserDt->mobile}}">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="profileAddress">Address</label>
                           <input type="text" class="form-control" name="address" id="profileAddress"placeholder="Address" value="{{$UserDt->address}}">
                        </div>
                        <div class="form-group col-md-4">
                           <label for="profileZipcode">Zipcode</label>
                           <input type="text" class="form-control" name="zipcode" id="profileZipcode" placeholder="Zipcode" maxlength="6" value="{{$UserDt->zipcode}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="profileAccess">Access</label>
                          <select id="profileAccess" class="form-control" name="access" disabled="true">
                            <option value="2">User</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                            <button class='btn btn-primary StrBtn' type='submit'>Update</button>
                        </div>
                        <div class="form-group col-md-4">
                            <button class='btn btn-primary backBtn' type='button'>Back</button>
                        </div>
                    </div>
                    </form>
                    <?php
                     }
                        ?>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src='<?= asset('js/app.js?test='.rand()) ?>'></script>

</html>