<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
       <?php echo $title ?>

    </h1>

  </section>

  <!-- Main content -->
   <section class="content">
     <!-- Info boxes -->
     <!-- <?php echo $this->session->flashdata('notify');?> -->
     <!-- /.row -->

     <div class="row">
       <div class="col-md-6">
         <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title"><?php echo $title ?></h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">

             <div class="row">
               <div class="col-md-12">
                 <?php echo form_open('guru/store');?>
                    <input type="hidden" name="method" value="update">
                    <input type="hidden" name="id" value="<?php echo $set->id ?>">
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" name="username" id="" class="form-control" value="<?php echo $set->username ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">Nama Lengkap</label>
                      <input type="text" name="name" id="" class="form-control" value="<?php echo $set->name ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" name="password" id="" class="form-control" >
                    </div>


                    <input type="submit" value="Generate" class="btn btn-success">
                 <?php echo form_close();?>
               </div>
             </div>

           </div>

         </div>
         <!-- /.box -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->

</div>
