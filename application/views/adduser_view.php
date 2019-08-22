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
                                    <form method="POST">
                        <div class="form-group" style="display: none">
                            <span  >ID: </span>
                            <input type="text" class="form-control" id="id">
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Last Name: </label>
                                    <input type="text" class="form-control" id="lastname" placeholder="LAST NAME eg.(DELA CRUZ)">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">First Name: </label>
                                    <input type="text" class="form-control" id="firstname" placeholder="FIRST NAME AND SUFFIX eg.(JUAN SR./JR/III)">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Middle Initial: </label>
                                    <input type="text" class="form-control" id="mi" placeholder="M.I">
                                </div>
                            </div>                        
                        </div>

                        <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <span>Username: </span>
                                    <input type="text" class="form-control" id="username">
                                </div>
                            </div>                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Password: </span>
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="col-lg-3">
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
                                            <option value="<?php echo $province->provCode; ?>"><?php echo $province->provDesc; ?></option>
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
                                    <span> Barangay: </span>
                                    <input type="text" class="form-control" id="barangay">
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
        var lastname = $('#lastname').val()
        var firstname = $('#firstname').val();
        var mi = $('#mi').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var address = $('#address').val();
        var contactdetails = $('#contactdetails').val();
        var position = $('#position').val();
        var department = $('#department').val();
        var date_hired = $('#date_hired').val();
        var province = $('#province').val();
        var city = $('#city').val();
        var dataprovince = $(this).data("province");




        $('#addMemberButton').click(function() {
            var lastname = $('#lastname').val();
            var firstname = $('#firstname').val();
            var mi = $('#mi').val();
            var fullname = lastname + ', ' + firstname + ' ' + mi;
            var username = $('#username').val();
            var password = $('#password').val();
            var confirmpassword = $('#confirmpassword').val();
            var province = $('#province').val();
            var city = $('#city').val();
            var barangay = $('#barangay').val();
            var noblocklot = $('#noblocklot').val();
            var street = $('#street').val();
            var subvilbuil = $('#subvilbuil').val();
            var contactdetails = $('#contactdetails').val();
            var position = $('#position').val();
            var department = $('#department').val();
            var date_hired = $('#date_hired').val();


            // alert (lastname + ' ' + firstname + ' '  + mi + ' ' + fullname + ' '  + username + ' ' + password + ' '  + confirmpassword + ' ' + province + ' '  + city + ' ' + barangay + ' '  + noblocklot + ' ' + street + ' '  + subvilbuil + ' ' + contactdetails + ' '  + position  + ' '  + department + ' ' + date_hired + ' '  + date_hired);

            if (password != confirmpassword) {
                Swal.fire({
                    position: 'top-end',
                    type: 'error',
                    title: 'Password does not match!',
                })
            } else {

            $.ajax({
                method: "post",
                data: {
                   lastname : lastname,
                   firstname : firstname,
                   mi : mi,
                   username : username,
                   password : password,
                   province : province,
                   city : city,
                   barangay : barangay,
                   noblocklot : noblocklot,
                   street : street,
                   subvilbuil : subvilbuil,
                   contactdetails : contactdetails,
                   position : position,
                   department : department,
                   date_hired : date_hired
                },
            url: '<?php echo base_url(); ?>adduser/validate_user', 
            success:function(response) {
                if (response != 'false') {
                    Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            // $("#notification").html(response);
            setTimeout(window.location.href = '<?php echo base_url(); ?>register', 1500);
             response.redirect;
                } else {
                Swal.fire({
                    position: 'top-end',
                    type: 'error',
                    title: 'Something went wrong',
                    timer: 1500
                })
                }
            }
            });
        }

        });


    $('.edit_details').click(function() {
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

        $('#updateUsername').dblclick(function() {
            var readonly = $(this).prop("readonly");
            if(readonly!=='false') { // this is readonly
                $(this).prop('readonly', false);

            } else {
                $(this).prop('readonly', true);
            }
        });

    });



    $('#province').change(function() {    
        var province = $('#province').val();

        // console.log(province);

        $.ajax({
            method : "POST",
            data : {province: province},
            async : true,
            dataType : 'json',
            url: '<?php echo base_url(); ?>adduser/get_cities',
            success:function(data) {
                var html = '';
                var brgyhtml = '';
                var i;
                html+="<option>Please Choose..</option>";
                brgyhtml+="<option>Please Choose..</option>";
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].citymunCode+'>'+data[i].citymunDesc+'</option>';
                }
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
            url: '<?php echo base_url(); ?>adduser/get_brgy',
            success:function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].brgyCode+'>'+data[i].brgyDesc+'</option>';
                }
            $('#barangay').html(html);
               
            }
        });

        return false;


    });


    $('#updateProvince').change(function() {     
        var province = $('#updateProvince').val();

        // console.log(province);

        $.ajax({
            method : "POST",
            data : {province: province},
            async : true,
            dataType : 'json',
            url: '<?php echo base_url(); ?>adduser/get_cities',
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
            url: '<?php echo base_url(); ?>adduser/get_brgy',
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



$("#editModal").on("hidden.bs.modal", function () {
   $('#updateUsername').prop('readonly', true);
});

});
</script>