<!-- Modal-->
<div class="modal fade" id="donor_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px !important">
        <div class="modal-content">
            <form autocomplete="off" id="form_donor_add" data-form-type="donor" data-modal-id="donor_add_modal" method="POST" action="<?= base_url()?>donors/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Donor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_donor_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control form_donor_add_fields" name="name" placeholder="Donor Name" />
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Contact <span class="text-danger">*</span></label>
                                <input required type="number" min="0" maxlength="10" minlength="10" class="form-control form_donor_add_fields" name="contact" placeholder="Contact"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Gender <span class="text-danger">*</span></label>
                            <div class="radio-inline">
                              <label class="radio radio-primary">
                                <input type="radio" value="male" name="gender_add" class="form_donor_add_radio" />
                                <span></span>
                                Male
                            </label>
                            <label class="radio radio-info">
                                <input type="radio" value="female" name="gender_add" class="form_donor_add_radio" />
                                <span></span>
                                Female
                            </label>
                        </div>
                    </div> 
                </div> 

            </div>

            <div class="row">


             <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="form-group ">
                    <label for="expense_head">Group <span class="text-danger">*</span></label>
                    <select required style="width: 100%" id="group" class="form-control form_donor_add_select" name="group">
                        <option selected disabled>Select</option>
                        <?php foreach (config_item('blood_groups') as $key => $value) { ?>
                            <option><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Last Donated Date</label>
                    <input type="text" id="last_donated_date_add" class="form-control form_donor_add_fields" name="last_donated_date" placeholder="Last Donated Date"/>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Next Donation Date <span class="text-danger">*</span></label>
                    <input required type="text" id="next_donation_date_add" class="form-control form_donor_add_fields" name="next_donation_date" placeholder="Next Donation Date"/>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Donations</label>
                    <input type="number" min="0" class="form-control form_donor_add_fields" name="no_of_donations" placeholder="No"/>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label>Location <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control form_donor_add_fields" name="location" placeholder="Location"/>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label>Remarks</label>
                    <input type="text" class="form-control form_donor_add_fields" name="remarks" placeholder="Remarks"/>
                </div>
            </div>

        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary font-weight-bold form_submit">Submit</button>
    </div>
</form>
</div>
</div>
</div>


<!-- Modal-->
<div class="modal fade" id="donor_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px !important">
        <div class="modal-content">
            <form autocomplete="off" id="form_donor_edit" data-form-type="donor" data-modal-id="donor_edit_modal" method="POST" action="<?= base_url()?>donors/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Donor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_donor_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">

                        <input type="hidden" id="donor_id_edit" name="donor_id">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control form_donor_edit_fields" id="donor_name_edit" name="name" placeholder="Donor Name" />
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Contact <span class="text-danger">*</span></label>
                                <input required maxlength="10" minlength="10" type="number" min="0" class="form-control form_donor_edit_fields" id="donor_contact_edit" name="contact" placeholder="Contact"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Gender <span class="text-danger">*</span></label>
                            <div class="radio-inline">
                              <label class="radio radio-primary">
                                <input type="radio" value="male" name="gender_edit" class="form_donor_edit_radio" />
                                <span></span>
                                Male
                            </label>
                            <label class="radio radio-info">
                                <input type="radio" value="female" name="gender_edit" class="form_donor_edit_radio" />
                                <span></span>
                                Female
                            </label>
                        </div>
                    </div> 
                </div> 


            </div>

            <div class="row">


                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="form-group ">
                        <label for="expense_head">Group <span class="text-danger">*</span></label>
                        <select required style="width: 100%" id="donor_group_edit" class="form-control form_donor_edit_select" name="group">
                            <option selected disabled>Select</option>
                            <?php foreach (config_item('blood_groups') as $key => $value) { ?>
                                <option><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Donated Date</label>
                        <input type="text" id="last_donated_date_edit" class="form-control form_donor_edit_fields" name="last_donated_date" placeholder="Last Donated Date"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Next Donation Date <span class="text-danger">*</span></label>
                        <input required type="text" id="next_donation_date_edit" class="form-control form_donor_edit_fields" name="next_donation_date" placeholder="Last Donated Date"/>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Donations</label>
                        <input type="number" min="0" class="form-control form_donor_add_fields" id="no_of_donations_edit" name="no_of_donations" placeholder="No"/>
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Location <span class="text-danger">*</span></label>
                        <input required type="text" class="form-control form_donor_edit_fields" id="location_edit" name="location" placeholder="Location"/>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" class="form-control form_donor_edit_fields" id="remarks_edit" name="remarks" placeholder="Remarks"/>
                    </div>
                </div>

            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary font-weight-bold form_submit">Submit</button>
        </div>
    </form>
</div>
</div>
</div>


<!-- Modal-->
<div class="modal fade" id="donor_availability_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px !important">
        <div class="modal-content">
            <form autocomplete="off" id="form_donor_availability" data-form-type="donor" data-modal-id="donor_availability_modal" method="POST" action="<?= base_url()?>donors/update_availability">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Donor Availability</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_donor_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">

                        <input type="hidden" id="donor_id_availability" name="donor_id">
                        <input type="hidden" id="donor_contact_availability" name="donor_contact">
                        <input type="hidden" id="donor_name_availability" name="donor_name">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Availability <span class="text-danger">*</span></label>
                                <div class="radio-inline">
                                    <label class="radio radio-primary">
                                        <input type="radio" value="1" name="availability" checked class="form_donor_availability_radio" />
                                        <span></span>
                                        Available
                                    </label>
                                    <label class="radio radio-info">
                                        <input type="radio" value="0" name="availability" class="form_donor_availability_radio" />
                                        <span></span>
                                        Not Available
                                    </label>
                                </div>
                            </div> 
                        </div> 

                        <div class="col-md-3 availability_date_div">
                            <div class="form-group" >
                                <label>Date <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control " id="availability_date" name="availability_date" placeholder="Available Date" value="<?= date('d-m-Y') ?>" />
                            </div>
                        </div>

                        <div class="col-md-3 availability_date_div">
                            <div class="form-group" >
                                <label>Time <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control " id="availability_time" name="availability_time" placeholder="Available Time" value="<?= date('h:i A') ?>" />
                            </div>
                        </div>




                    </div>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold form_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal-->
<div class="modal fade" id="donor_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="donor" data-modal-id="donor_delete_modal" action="<?= base_url()?>donors/delete">
                <div class="modal-body bg-danger">
                    <h2 class="modal-title text-white">Are you sure ? </h2>
                    <h5 class="modal-title text-white">This action can not be reversed</h5>
                    <hr>

                    <input type="hidden" id="donor_id_delete" name="donor_id">

                    <div class="row">
                        <div class="col-md-5"></div>
                        <button type="button" class="btn btn-white text-dark font-weight-bold mr-1" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-white font-weight-bold text-danger form_submit">Confirm and Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
