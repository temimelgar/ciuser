<style>
    .div1 {
    width: 100px;
    height: 100px;
    padding: 10px;
    }
    #divv {
    width: 400px;
    height: 400px;
    padding: 10px;
    border: 1px solid #aaaaaa;
    }

</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                
                <div class="box-body">
                    <!--  <div class="row"> -->
                    <div class="col-md-12">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                     <!--        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal">Add Member</button> -->
                        </div>
                        <div id="" ondrop="drop(event)" ondragover="allowDrop(event)" >
                            <table class="table table-striped table-hover" id="tbl_data" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th class="dark"></th>
                                        <th class="dark">ID</th>
                                        <th class="dark">Name</th>
                                        <th class="dark">Username</th>
                                        <th class="dark">Address</th>
                                        <th class="dark">Contacts</th>
                                        <th class="dark">Position</th>
                                        <th class="dark">Department</th>
                                        <th class="dark">Date Hired</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $row) {
                                    $id = $row->id;
                                    $lastname = $row->lastname;
                                    $firstname = $row->firstname;
                                    $mi = $row->mi;
                                    $username = $row->username;
                                    $address = $row->address;
                                    $contact = $row->contact;
                                    $position = $row->position;
                                    $department = $row->department;
                                    $date_hired = $row->date_hired;
                                    $password = $row->password;
                                    $province = $row->province;
                                    $city = $row->city;
                                    $barangay = $row->barangay;
                                    $noblocklot = $row->noblocklot;
                                    $street = $row->street;
                                    $subvilbuil = $row->subvilbuil;
                                    $brgyDesc = $row->brgyDesc;
                                    $citymunDesc = $row->citymunDesc;
                                    $provDesc = $row->provDesc;
                                    $fullname = $lastname . ", " . $firstname . " " . $mi;
                                    ?>
                                    <tr>
                                        
                                        <td  data-id="<?php echo $id; ?>" data-fullname="<?php echo $fullname; ?>" data-provincename="<?php echo $provDesc; ?>" data-province="<?php echo $province; ?>" data-username="<?php echo $username; ?>" data-address="<?php echo $address; ?>" data-contact="<?php echo $contact; ?>" data-position="<?php echo $position; ?>" data-password ="<?php echo $password; ?>" data-department="<?php echo $department; ?>"  data-date_hired="<?php echo $date_hired; ?>" data-date-format="dd-mm-yyyy" data-address="<?php echo $address; ?>" data-contact="<? echo $contact; ?>"><a href="<?php echo site_url('adduser/get_edit/'.$row->id);?>"  class="btn btn-danger" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a></td>
                                        <td id ="tdid" class="table_details"><?php echo $id; ?></td>
                                        <td class="table_details"><?php echo $fullname; ?></td>
                                        <td class="table_details"><?php echo $row->username; ?></td>
                                        <td class="table_details"><?php echo $noblocklot . ' ' . $street . ' ' . $subvilbuil . ' ' .  $brgyDesc . ' ' . $citymunDesc . ' ' . $provDesc; ?></td>
                                        <td class="table_details"><?php echo $row->contact; ?></td>
                                        <td class="table_details"><?php echo $row->position; ?></td>
                                        <td class="table_details"><?php echo $row->department; ?></td>
                                        <td class="table_details"><?php echo $row->date_hired; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New User</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group" style="display: none">
                        <span  >ID: </span>
                        <input type="text" class="form-control" id="id">
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label  >Full Name: </label>
                                <input type="text" class="form-control" id="fullname" placeholder="Lastname, Firstname M.I">
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <span>Username: </span>
                                <input type="text" class="form-control" id="username">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Password: </span>
                                <input type="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span> Confirm Password: </span>
                                <input type="password" class="form-control" id="confirmpassword">
                            </div>     
                        </div>
                       </div> 
                    <div class="row">
                       <div class="col-lg-4">     
                            <div class="form-group">
                                <span>Province: </span>
                                    <select class="form-control" id="province">
                                        <option value="">Please Choose...</option>
                                    <?php
                                    foreach ($provinces as $province) {
                                        ?>
                                        <option value="<?php echo $province->provCode; ?>" 
                
                                        ><?php echo $province->descrip; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-4">     
                            <div class="form-group">
                                <span>City/Municipality: </span>
                                <select class="form-control" id="city">
                                      <option>Please Choose...</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-4">     
                            <div class="form-group">
                                <span>Barangay: </span>
                                <select class="form-control" id="barangay">
                                      <option>Please Choose...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                            <span>Number / Block / Lot: </span>
                            <input type="text" class="form-control" id="noblocklot">
                            </div>
                        </div>     
                        <div class="col-lg-4">
                            <div class="form-group">
                            <span>Street </span>
                            <input type="text" class="form-control" id="street">
                            </div> 
                        </div> 
                        <div class="col-lg-4">
                            <div class="form-group">
                            <span>Subdivision / Village / Building Name: </span>
                            <input type="text" class="form-control" id="subvilbuil">
                            </div> 
                        </div>                                                
                    </div>
                        
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <span>Contact Details: </span>
                            <input type="text" class="form-control" id="contactdetails">
                            </div>      
                        </div>
                        <div class='col-lg-6'>
                            <div class="form-group">
                                <span>Position: </span>
                                <input type="text" class="form-control" id="position">
                            </div>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <span>Department: </span>
                            <input type="text" class="form-control" id="department">
                            </div>  
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <span>Date Hired: </span>
                            <input type="date" class="form-control" id="date_hired">
                            </div>
                        </div>
                    </div>

  
  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="addMemberButton" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Details</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group" style="display:none">
                        <span  >ID: </span>
                        <input type="text" class="form-control" id="updateID" >
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <span  >Full Name: </span>
                                <input type="text" class="form-control" id="updateFullname" >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Username: </span>
                                <input type="text" class="form-control" id="updateUsername" readonly>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Password: </span>
                                <input type="password" class="form-control" id="updatePassword">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Confirm Password: </span>
                                <input type="password" class="form-control" id="updateConfirmPassword">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                           <div class="form-group">
                                <span>Province: </span>
                                    <select class="form-control" id="updateProvince" name="updateProvince">
                                        <option>Please Choose...</option>
                                      <!--   <option value="<?php echo $data[0]->province; ?>" id=""><?php echo $data[0]->provDesc; ?></option> -->
                                    <?php
                                    foreach ($provinces as $province) {
                                     // $is_selected = ($province->provCode == $data[0]->province ? "selected" : "");
                                     ?>    
                                        <option value="<?php echo $province->provCode?>"><?php echo $province->descrip; ?></option>
                                     <?php  } ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                                <span>City/Municipality: </span>
                                    <select class="form-control" id="updateCity">
                                        <option>Please Choose...</option>
                                    </select>                           
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Barangay: </span>
                                <select class="form-control" id="updateBarangay">
                                      <option>Please Choose...</option>
                                </select>
                            </div>                             
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Number / Block / Lot: </span>
                                <input type="text" class="form-control" id="updateNoblocklot">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Street: </span>
                                <input type="text" class="form-control" id="updateStreet">
                            </div>                            
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Subdivision / Village / Building Name: </span>
                                <input type="text" class="form-control" id="updateSubvilbuil">
                            </div>                               
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Contact Details: </span>
                                <input type="text" class="form-control" id="updateContactDetails">
                            </div>                              
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Position: </span>
                                <input type="text" class="form-control" id="updatePosition">
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-lg-6'>
                            <div class="form-group">
                                <span>Department: </span>
                                <input type="text" class="form-control" id="updateDepartment">
                            </div>                            
                        </div>
                        <div class='col-lg-6'>
                            <div class="form-group">
                                <span>Date Hired: </span>
                                <input type="date" class="form-control" id="updateDate_hired">
                            </div>                            
                        </div>
                    </div>             

                  


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="deleteMemberButton">Delete</button>
                    <button type="button" id="editMemberButton" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>

<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script type="text/javascript">
    function allowDrop(ev) {
        ev.preventDefault();
    }
    function drag(ev) {
       ev.dataTransfer.setData("text", ev.target.id);
    }
    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }

    $(document).ready(function(){


        var id = $('#id').val();
        var fullname = $('#fullname').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var address = $('#address').val();
        var contactdetails = $('#contactdetails').val();
        var position = $('#position').val();
        var department = $('#department').val();
        var date_hired = $('#date_hired').val();
        var dataprovince = $(this).data("province");

        // var province = $('#province').val();
        // var updateProvince = $('#updateProvince').val(province);
        // var updateCity = $('#updateProvince').val(province);

// $('#updateDate_hired').datetimepicker();
    $('.edit_details').click(function() {

        
        get_data_edit();

        var id = $(this).data("id");
        var fullname = $(this).data("fullname");
        var username = $(this).data("username");
        var address = $(this).data("address");
        var contact = $(this).data("contact");
        var position = $(this).data("position");
        var department = $(this).data("department");
        var date_hired = $(this).data("date_hired");
        var password = $(this).data("password");
        var province = $(this).data("province");
        var city = $(this).data("city");
        var provDesc = $(this).data("provincename");
        var updateID= $('#updateID').val(id);
        var updateFullname= $('#updateFullname').val(fullname);
        var updateUsername= $('#updateUsername').val(username);
        var updateAddress= $('#updateAddress').val(address);
        var updatePassword= $('#updatePassword').val(password);
        var updateAddress= $('#updateAddress').val(address);
        var updateContactDetails= $('#updateContactDetails').val(contact);
        var updatePosition= $('#updatePosition').val(position);
        var updateDepartment= $('#updateDepartment').val(department);
        // var updateProvince= $('#updateProvince').val(provDesc);

 
        alert(id +' ' + province);


        $('#updateUsername').dblclick(function() {
            var readonly = $(this).prop("readonly");
            if(readonly!=='false') { // this is readonly
                $(this).prop('readonly', false);

            } else {
                $(this).prop('readonly', true);
            }
        });

    });

                       function get_data_edit(){
                var province = $(this).data("province");
                var id = $(this).data("id");
                $.ajax({
                    url : '<?php echo base_url(); ?>register/get_data_edit',
                    method : "POST",
                    data :{
                        id : id,
                        province :province
                        },
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('#updateProvince').val(data[i].province).trigger('change');
                            console.log('#updateProvince');
                        });
                    }

                });
            }

    // $('#updateProvince').filter(function() {
   
    //         return $(this).text() == provDesc;

    // }).prop('selected', true);



    $('#province').change(function() {    
        var province = $('#province').val();

        // console.log(province);

        $.ajax({
            method : "POST",
            data : {province: province},
            async : true,
            dataType : 'json',
            url: '<?php echo base_url(); ?>register/get_cities',
            success:function(data) {
                var html = '';
                var brgyhtml = '';
                var i;
                html+="<option>Please Choose..</option>";
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].citymunCode+'>'+data[i].citymunDesc+'</option>';
                }
                brgyhtml = "<option>Please Choose..</option>";
            $('#city').html(html);
            $('#barangay').html(brgyhtml);
               
            }
            // success:function(response) {
            //     alert(response);
            // }

        });

        return false;
        // alert($('#province').val());

    });

        $('#city').change(function() { 

        var city = $('#city').val();

        $.ajax({
            method : "POST",
            data : {city: city},
            async : true,
            dataType : 'json',
            url: '<?php echo base_url(); ?>register/get_brgy',
            success:function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].brgyCode+'>'+data[i].brgyDesc+'</option>';
                }
            $('#barangay').html(html);
               
            }
            // success:function(response) {
            //     alert(response);
            // }

        });

        return false;
        // alert($('#province').val());

    });


    $('#updateProvince').change(function() {     
        var province = $('#updateProvince').val();

        // console.log(province);

        $.ajax({
            method : "POST",
            data : {province: province},
            async : true,
            dataType : 'json',
            url: '<?php echo base_url(); ?>register/get_cities',
            success:function(data) {
                var html = '';
                var brgyhtml ='';
                var i;
                html+="<option>Please Choose..</option>";
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].citymunCode+'>'+data[i].citymunDesc+'</option>';
                }
                brgyhtml = "<option value=''>Please Choose..</option>";
            $('#updateCity').html(html);
            $('#updateBarangay').html(brgyhtml);
               
            }
            // success:function(response) {
            //     alert(response);
            // }

        });

        return false;
        // alert($('#province').val());

    });

        $('#updateCity').change(function() { 

        var city = $('#updateCity').val();

        $.ajax({
            method : "POST",
            data : {city: city},
            async : true,
            dataType : 'json',
            url: '<?php echo base_url(); ?>register/get_brgy',
            success:function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].brgyCode+'>'+data[i].brgyDesc+'</option>';
                }
            $('#updateBarangay').html(html);
               
            }
            // success:function(response) {
            //     alert(response);
            // }

        });

        return false;
        // alert($('#province').val());

    });


    $("#tbl_data").dataTable({
        'searching' : true,
        'scrollX' : true,
        "lengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]]
    });
    var addMemberButton = $('#addMemberButton');
    $(addMemberButton).click(function(){
    var fullname = $('#fullname').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var confirmpassword = $('#confirmpassword').val();
    var address = $('#address').val();
    var contactdetails = $('#contactdetails').val();
    var position = $('#position').val();
    var department = $('#department').val();
    var date_hired = $('#date_hired').val();
    var province = $('#province').val();
    var city = $('#city').val();
    var barangay = $('#barangay').val();
    var noblocklot = $('#noblocklot').val();
    var street = $('#street').val();
    var subvilbuil = $('#subvilbuil').val();

    // alert(province);
    // console.log(fullname + ' ' + username  + ' ' + password  + ' ' + position  + ' ' + department  + ' ' + date_hired);

    if (password === confirmpassword) {

    $.ajax({
        type: 'post',
        data: {
        id : id,
        fullname : fullname,
        username : username,
        password : password,
        address : address,
        contactdetails : contactdetails,
        position : position,
        department : department,
        date_hired : date_hired,
        province : province,
        city : city,
        barangay : barangay,
        noblocklot : noblocklot,
        street : street,
        subvilbuil : subvilbuil
    },
    url: '<?php echo base_url(); ?>register/validate_user',
    success:function(response) {
        if (response != 'false') {
            Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1200
            })
// $("#notification").html(response);
            setTimeout(location.reload.bind(location), 1200);
        } else {
            Swal.fire({
            position: 'top-end',
            type: 'error',
            title: 'Something went wrong',
            timer: 1200
            })
        }
    }
    });

} else {
    Swal.fire({
            position: 'top-end',
            type: 'error',
            title: 'Password does not match!',
            
            })
}
});

    $('#deleteMemberButton').click(function() {
        var id = $('#updateID').val();
            Swal.fire({
            position: 'top-end',
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                    type:'POST',
                    data: {
                    id: id
                    },
                    url: '<?php echo base_url(); ?>register/delete_user',
                    sucess:function(response) {
                    }
                    });
                    Swal.fire({
                    position: 'top-end',
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    type: 'success',
                    timer: 1200
                    })
                    setTimeout(location.reload.bind(location), 1200);
                }
            })
    });

    $('#editMemberButton').click(function() {
    var id = $('#updateID').val();
    var fullname = $('#updateFullname').val();
    var username = $('#updateUsername').val();
    var address = $('#updateAddress').val();
    var contact = $('#updateContactDetails').val();
    var position = $('#updatePosition').val();
    var department = $('#updateDepartment').val();
    var date_hired = $('#updateDate_hired').val();

    
    $.ajax({
        type:'POST',
        data: {
        id: id,
        fullname: fullname,
        username: username,
        address: address,
        contact: contact,
        position: position,
        department: department,
        date_hired: date_hired
        },
        url: '<?php echo base_url(); ?>register/update_user',
        success:function(response) {
            if (response != 'false') {
                Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1200
                })
                // $("#notification").html(response);
                setTimeout(location.reload.bind(location), 1200);
            // console.log(response);
            // alert(response);
            } else {
                Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'Something is wrong.',
                text: "Please check all the details.",
                showConfirmButton: false,
                timer: 1200
                })
    // $("#notification").html(response);
                setTimeout(location.reload.bind(location), 1200);
            }
        }
    });
    });

$("#editModal").on("hidden.bs.modal", function () {
   $('#updateUsername').prop('readonly', true);
});

});
</script>