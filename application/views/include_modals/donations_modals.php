<!-- Modal-->
<div class="modal fade" id="donation_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px !important">
        <div class="modal-content">
            <form autocomplete="off" id="form_donation_add" data-form-type="donation" data-modal-id="donation_add_modal" method="POST" action="<?= base_url()?>donations/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Donation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_donation_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control" name="donated_date" id="donated_date" placeholder="Date" value="<?= date('d-m-Y')?>" />
                            </div>
                        </div>

                        <?php if($page!='hospital_profile'){ ?>

                            <div class="col-lg-9 col-md-9 col-sm-12">
                              <div class="form-group">
                                <label>Type</label>
                                <div class="radio-inline">
                                    <label class="radio radio-primary">
                                        <input type="radio" value="voluntary" name="donation_type_add" class="form_donation_add_radio" />
                                        <span></span>
                                        Voluntary
                                    </label>
                                    <label class="radio radio-info">
                                        <input type="radio" value="replacement" checked name="donation_type_add" class="form_donation_add_radio" />
                                        <span></span>
                                        Replacement
                                    </label>
                                </div>
                                <!-- <span class="form-text text-muted">Some help text goes here</span> -->
                            </div> 
                        </div>  

                    <?php } ?>

                </div>

                <?php if($this->session->userdata('user_role')=='admin'){ ?>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group ">
                                <label for="expense_head">Committee <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_donation_add_select " name="committee" id="committee_add">
                                    <option selected disabled>Select </option>
                                    <?php foreach ($committees as $key => $c) { ?>
                                        <option value="<?= $c->committee_id ?>"><?= $c->committee_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group ">
                                <label for="expense_head">Member <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_donation_add_select" name="member" id="member_add">
                                    <option selected disabled>Select </option>
                                </select>
                            </div>
                        </div>

                    </div>

                <?php } ?>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 replacement_fields_add">
                        <div class="form-group ">
                            <label for="expense_head">Case <span class="text-danger">*</span></label>
                            <select required style="width: 100%" class="form-control form_donation_add_select cases_select" name="case_id" id="case_add">
                                <option selected disabled>Select Case</option>
                            </select>
                        </div>
                    </div>

                </div>

                <?php if($page!='hospital_profile'){ ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 voluntary_fields_add">
                            <div class="form-group ">
                                <label for="expense_head">Hospital <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_donation_add_select" name="hospital_id" id="hospital_add">
                                    <option selected disabled>Select Hopital</option>

                                    <?php foreach ($hospitals as $key => $value) { ?>
                                        <option value="<?= $value->hospital_id ?>" ?><?= $value->hospital_name.' - '.$value->location ?></option>
                                    <?php } ?>
                                    <!-- <option>#1 - Beryl - Balussery - 9876543210 - B+</option> -->
                                </select>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                    <input type="hidden" name="hospital_id" value="<?= $hospital_data->hospital_id ?>">
                <?php } ?>


                <?php if($page!='donor_profile'){ ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group ">
                                <label for="expense_head">Donor <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_donation_add_select" name="donor_id" id="donor_add">
                                    <option selected disabled>Select Donor</option>
                                    <!-- <option>#1 - Beryl - Balussery - 9876543210 - B+</option> -->
                                </select>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                    <input type="hidden" name="donor_id" value="<?= $donor_data->donor_id ?>">
                <?php } ?>





                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea type="text" class="form-control form_donation_add_fields" name="remarks" placeholder="Remarks"></textarea>
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
<div class="modal fade" id="donation_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px !important">
        <div class="modal-content">
            <form autocomplete="off" id="form_donation_edit" data-form-type="donation" data-modal-id="donation_edit_modal" method="POST" action="<?= base_url()?>donations/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Donation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_donation_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control" name="donated_date" id="donated_date_edit" placeholder="Date" value="<?= date('d-m-Y')?>" />
                            </div>
                        </div>


                    </div>


                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group ">
                                <label for="expense_head">Case <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_donation_edit_select cases_select" name="case_id" id="case_edit">
                                    <option selected disabled>Select Case</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group ">
                                <label for="expense_head">Donor <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_donation_edit_select" name="donor_id" id="donor_edit">
                                    <option selected disabled>Select Donor</option>
                                    <!-- <option>#1 - Beryl - Balussery - 9876543210 - B+</option> -->
                                </select>
                            </div>
                        </div>



                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea type="text" class="form-control form_donation_edit_fields" name="remarks" id="remarks_edit"
                                placeholder="Remarks"></textarea>
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
<div class="modal fade" id="donation_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="donation" data-modal-id="donation_delete_modal" action="<?= base_url()?>donations/delete">
                <div class="modal-body bg-danger">
                    <h2 class="modal-title text-white">Are you sure ? </h2>
                    <h5 class="modal-title text-white">This action can not be reversed</h5>
                    <hr>

                    <input type="hidden" id="donation_id_delete" name="donation_id">

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
